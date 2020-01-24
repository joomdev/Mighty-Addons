import React, { Component } from 'react'

class Gallery extends Component {
  
  constructor(props) {
    super(props)
    this.state = {
      isLoaded: false,
    }
  }

  componentDidMount() {
  }

  render() {
      
    return (
    <div id="mighty-gallery" className="mt-extension-gallery">
        <h1>Mighty Gallery</h1>
    </div>
    );
  }
}

export default Gallery
