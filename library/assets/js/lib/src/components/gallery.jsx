import React, { Component } from 'react'
import ReactDOM from 'react-dom';


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
      viewType: 'unordered'
    }
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

  updateView = (view) => {
    if ( view != this.state.renderView ) {
      this.setState({ 
        renderView: view
      })
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
    this.updateView('image')
  }

  importImage = ( image ) => {
    this.updateView('loader')
    fetch(MightyLibrary.ajaxurl, {
      method: 'POST',
      headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
      body: 'action=save_mighty_extension_media&image=' + image
    })
    .then(response => response.json())
    .then((data) => {
      importData.model.get("selection").add(data.attachmentData)
      importData.model.frame.trigger("library:selection:add")
      let buttons = document.querySelectorAll(".media-toolbar .media-toolbar-primary .media-button-select")
      console.log(buttons.length)
      buttons[buttons.length-1].click()
      this.updateView('home')
    })
    .catch(function(error) {
      console.log('Something went wrong!');
      console.log(JSON.stringify(error));
    });
  }

  createView = ( view ) => {
    switch( view ) {
      case 'home':
        return <Home searchTerm={ this.state.searchTerm } data={ this.state.images } onClick={ (image) => this.showImage(image) } onChange={ (e) => this.setState({ searchTerm: e.target.value }) } onSearch={ () => this.search() } onViewType={ (type) => this.setState({ viewType: type }) } viewType={this.state.viewType} />
      case 'image':
        return <Image data={ this.state.choosenImage } onImport={ (image) => this.importImage(image) } onViewChange={ (view) => this.updateView(view) } />
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

  enterPressed = (event) => {
    var keyCode = event.keyCode || event.which;
    if ( keyCode == 13 ) { // enter pressed
      this.props.onSearch();
    }
  }

  render() {
    return (
      <div className="mighty-gallery">
        <div className="mt-templates-modal-body-inner mt-templates-modal-body-header">
          <div className="body-header-search">
            <input type="text" value={ this.props.searchTerm } onChange={ (e) => this.props.onChange(e) } type='text' placeholder='Search Photos...' onKeyPress={this.enterPressed.bind(this)} />
            <button><i className="fas fa-search"></i></button>
          </div>
          <div className="photos-view">
            <p>View as:</p>
            <i className={`fas fa-stream${this.props.viewType == 'ordered' ? '' : ' active'}`} onClick={ () => this.props.onViewType('unordered') }></i>
            <i className={`fas fa-align-justify${this.props.viewType == 'ordered' ? ' active' : ''}`} onClick={ () => this.props.onViewType('ordered') } ></i>
          </div>
        </div>
        <Images data={this.props.data} onClick={ (image) => this.props.onClick(image)} viewType={this.props.viewType} />
      </div>
    );
  }
}

class Images extends Component {
  render() {
    return (
      <div className={`search-results${this.props.viewType == 'ordered' ? ' view-ordered' : ''}`}>
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
        <div className="mt-templates-modal-body-inner mt-templates-modal-body-header">
          <button className="mt-btn mt-btn-import" onClick={ () => this.props.onViewChange('home') }><i className="fas fa-long-arrow-alt-left"></i>&nbsp;Back</button>
        </div>
        <div className="selected-image">
          <img src={this.props.data.url} alt={this.props.data.tags} />
          <div className="image-controls">
            <p>Tags: </p>
            <span>{this.props.data.tags}</span>
            <div className="pixabay-notice">
              <a target="_blank" rel="nofollow" href="https://pixabay.com/service/license/">Pixabay License</a>
              <div className="pix-note">
                Free for commercial use
                <br />No attribution required
              </div>
            </div>
            <span className="import-button" onClick={ () => this.props.onImport(this.props.data.url) }>
              <i className="fas fa-download"></i>&nbsp; Insert Image
            </span>
          </div>
        </div>
      </div>
    );
  }
}

export default Gallery
