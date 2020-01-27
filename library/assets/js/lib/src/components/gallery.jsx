import React, { Component } from 'react'

import '../styles/grid.min.css'
import '../styles/mt.css'

class Gallery extends Component {
  
  constructor(props) {
    super(props)
    this.state = {
      isLoaded: false,
      searchTerm: 'funny cats',
      images: [],
      renderView: 'home',
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

  render() {
    const { isLoaded, images } = this.state;

    if (!isLoaded) {
      return (
        <div className="loader">
          <h1>Loading...</h1>
        </div>
      );
    } else {
      return (
        <div class="mighty-gallery">
          <h1>Mighty Gallery</h1>
          <br/>
          <input className='pixabay-input' value={ this.state.searchTerm } onChange={ (e) => {this.setState({ searchTerm: e.target.value })}} type='text' placeholder='Search for your fav' />
          <button type='submit' className='button button-px-search' onClick={ () => this.search() }>Search</button>

          <Images data={images} />

        </div>
      );
    }
  }
}

class Images extends Component {
  render() {
    return (
      <div className="search-results">
        {this.props.data.map(image => (
          <img key={image.id} draggable='false' className='px-image' src={image.preview} alt={image.tags} />
        ))}
      </div>
    );
  }
}

class Image extends Component {
  render() {
    return (
      <div className="mighty-image">
        
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
