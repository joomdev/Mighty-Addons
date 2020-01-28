import React, { Component } from 'react'

import '../styles/grid.min.css'
import '../styles/mt.css'

if ("undefined" != typeof wp && wp.media) {

  var e = wp.media.view.MediaFrame.Select,
    i = (wp.media.controller.Library, wp.media.view.l10n),
    t = wp.media.view.Frame,
    importData = null,
    tabTitle = "Mighty Photos",
    defaultSearchTerm = "Cats"; // 🐈

  wp.media.view.MightyAddons_AttachmentsBrowser = t.extend({
    tagName: "div",
    id: "mighty-extension-pixabay",
    className: "mighty-photos-browser mightyaddons-pixabay",
    initialize: function () {
      importData = this
    }
  }), e.prototype.bindHandlers = function () {
    this.on("router:create:browse", this.createRouter, this), this.on("router:render:browse", this.browseRouter, this), this.on("content:create:browse", this.browseContent, this), this.on("content:create:mightygallery", this.mightygallery, this), this.on("content:render:upload", this.uploadContent, this), this.on("toolbar:create:select", this.createSelectToolbar, this)
  }, e.prototype.browseRouter = function (e) {
    var t = {};
    t.upload = {
      text: i.uploadFilesTitle,
      priority: 20
    }, t.browse = {
      text: i.mediaLibraryTitle,
      priority: 40
    }, t.mightygallery = {
      text: tabTitle,
      priority: 61
    }, e.set(t)
  }, e.prototype.mightygallery = function (e) {
    var t = this.state();
    e.view = new wp.media.view.MightyAddons_AttachmentsBrowser({
      controller: this,
      model: t,
      AttachmentView: t.get("AttachmentView")
    })
  }
}

class Gallery extends Component {
  
  constructor(props) {
    super(props)
    this.state = {
      isLoaded: false,
      searchTerm: 'cats',
      images: [],
      renderView: 'home',
      choosenImage: [],
    }

    // Updates View Globally
    updateView = updateView.bind(this)
  }

  componentDidMount() {
    try {
      Promise.all([
        fetch("#")
      ])
      .then(values => Promise.all(values.map(value => value.json())))
      .then(finalVals => {
        let images = finalVals[0];
        this.setState({
          images: images.data.images,
          isLoaded: true
        });
      })
    } catch {
      console.log("Something went wrong!");
    }
  }

  search = () => {
    try {
      Promise.all([
        fetch("#")
      ])
      .then(values => Promise.all(values.map(value => value.json())))
      .then(finalVals => {
        let images = finalVals[0];
        this.setState({
          images: images.data.images,
          isLoaded: true
        });
      })
    } catch {
      console.log("Something went wrong!");
    }
  }

  showImage = ( image ) => {
    this.setState({
      choosenImage: image
    })
    updateView('image')
  }

  importImage = ( image ) => {
    fetch(MightyLibrary.ajaxurl, {
      method: 'POST',
      headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
      body: 'action=save_mighty_extension_media&image=' + image
    })
    .then(response => response.json())
    .then((data) => {
      importData.model.get("selection").add(data.attachmentData),
      importData.model.frame.trigger("library:selection:add"),
      document.querySelector(".media-frame .media-button-select").click(),
      document.getElementById("mighty-extension-pixabay").remove(),
      alert('imported')
    })
    .catch(function(error) {
      console.log('Something went wrong!');
      console.log(JSON.stringify(error));
    });
  }

  createView = ( view ) => {
    switch( view ) {
      case 'home':
        return <Home searchTerm={ this.state.searchTerm } data={ this.state.images } onClick={ (image) => this.showImage(image) } onChange={ (e) => this.setState({ searchTerm: e.target.value }) } onSearch={ () => this.search() } />
      case 'image':
        return <Image data={ this.state.choosenImage } onImport={ (image) => this.importImage(image) } />
    }
  }

  render() {
    const { isLoaded } = this.state;

    if ( !isLoaded ) {
      return (
        <div className="loader">
          <h1>Loading...</h1>
        </div>
      );
    } else {

      return (
        this.createView(this.state.renderView)
      );
      
    }
  }
}

class Home extends Component {
  render() {
    return (
      <div className="mighty-gallery">
        <h1>Mighty Gallery</h1>
        <br/>
        <input className='pixabay-input' value={ this.props.searchTerm } onChange={ (e) => this.props.onChange(e) } type='text' placeholder='Search for your fav' />
        <button type='submit' className='button button-px-search' onClick={ () => this.props.onSearch() }>Search</button>

        <Images data={this.props.data} onClick={ (image) => this.props.onClick(image) } />

      </div>
    );
  }
}

class Images extends Component {
  render() {
    return (
      <div className="search-results">
        {this.props.data.map(image => (
          <img key={image.id} onClick={ () => this.props.onClick(image) } draggable='false' className='px-image' src={image.preview} alt={image.tags} />
        ))}
      </div>
    );
  }
}

class Image extends Component {
  render() {
    return (
      <div className="mighty-image">
        <button className="button" onClick={ () => updateView('home') }>👈🏻 Back</button>
        <div className="mt-row">
          <div className="mt-col-md-6">
            <img src={this.props.data.preview} alt={this.props.data.tags} />
          </div>
          <div className="mt-col-md-6">
            <button className='button button-px-search' onClick={ () => this.props.onImport(this.props.data.url) }>🔽 Import</button>
          </div>
        </div>
      </div>
    );
  }
}

function updateView( view ) {
  if ( view != this.state.renderView ) {
    this.setState({ 
      renderView: view
    })
  }
}

export default Gallery
