import React, { Component } from 'react'

import '../styles/grid.min.css'
import '../styles/mt.css'

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
    console.log(image)
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
        <button type='submit' className='button button-px-search' onClick={ () => this.props.onSearch }>Search</button>

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
