import React, { Component } from 'react'

import '../styles/grid.min.css'
import '../styles/mt.css'

class App extends Component {
  
  constructor(props) {
    super(props)
    this.state = {
      error: null,
      isLoaded: false,
      renderView: 'home', // template
      items: [],
      choosenKit: [],
    }
    // Updates View Globally
    updateView = updateView.bind(this)
  }

  componentDidMount() {
    fetch("http://elementoraddons.local/wp-content/uploads/kits/kits.json")
      .then(res => res.json())
      .then(
        (result) => {

          this.setState({
            isLoaded: true,
            items: result.kits
          });
        },
        // Note: it's important to handle errors here
        // instead of a catch() block so that we don't swallow
        // exceptions from actual bugs in components.
        (error) => {
          this.setState({
            isLoaded: true,
            error
          });
        }
      )
  }

  showKit = ( templates ) => {
    this.setState({
      renderView: 'templates',
      choosenKit: templates
    });
  }

  importJson = ( item ) => {

    fetch(item.url)
    .then(response => response.json())
    .then((tmpl) => {
      
      window.mightyModal.hide(),
      elementor.sections.currentView.addChildModel(tmpl.content)
    })
    .catch((error) => {
      console.error(error)
    })
    
  }

  createView() {
    
    switch( this.state.renderView ) {
      case 'home':
        return <Kits data = { this.state.items } onClick = { (templates) => this.showKit(templates) } />
      case 'templates':
        return <Templates data = { this.state.choosenKit } onClick = { (item) => this.importJson(item) } />
      case 'blocks':
        return <Blocks data = {this.state.blocks } />
    }

  }

  render() {

    const { error, isLoaded, items } = this.state;
    if ( error ) {
      return <div>Error: {error.message}</div>;
    } else if (!isLoaded) {
      return <div>Loading...</div>;
    } else {
      
      return (
        
        <div id="mt-templates-modal">
          <div className="mt-templates-modal-inner mt-container">

              <div className="mt-templates-modal-header mt-row">
                  <div className="mt-col-sm-4">
                      <div className="brand-logo">
                          <img src="images/logo-white-1.png" alt="Mighty Logo" />
                      </div>
                  </div>
                  <div className="mt-col-sm-4">
                      <div className="mt-templates-modal-header-top-tabs">
                          <ul className="top-tabs-inner">
                              
                              <li onClick={ () => updateView('templates') } className="top-tabs-temp active">Templates <span className="top-tabs-numb">{items.length}</span></li>
                              <li onClick={ () => updateView('blocks') } className="top-tabs-kits">Blocks <span className="top-tabs-numb">200</span></li>
                          </ul>
                      </div>
                  </div>
                  <div className="mt-col-sm-4">
                      <div className="mt-templates-modal-header-top-right">
                          <ul className="top-right">
                              <li className="top-right-list">
                                  <span>Sync</span>
                                  <div className="top-sync"><img className="icon" src="images/sync-solid.svg" alt="" /></div>
                              </li>
                              <li className="top-right-list">
                                  <div className="top-close icon"><img className="icon" src="images/times-solid.svg" alt="" />
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>

              { this.createView() }
              
          </div>
        </div>
      );
    }
  
  }

}

class Kits extends Component {
  
  render() {
    return (
      
      <div className="mt-templates-modal-body">
        <div className="mt-templates-modal-body-inner">

              <div className="mt-templates-modal-body-header mt-row">
                  <div className="mt-col-sm-6">
                      <div className="body-header-left">
                          <div className="filter body-header-filter">
                              <label htmlFor="filter">Filter</label>
                              <div className="filter-dropdown">
                                  <div className="filter-dropdown-inner">
                                      <div className="filter-dropdown-inner-left">
                                          <div className="filter-dropdown-inner-left-text">Show All</div>
                                          <input id="filter-list" readOnly tabIndex={0} className="filter-input"
                                              defaultValue />
                                      </div>
                                      <div className="filter-dropdown-inner-right">
                                          <span><img className="icon" src="images/angle-down-solid.svg"
                                                  alt="" /></span>
                                      </div>
                                  </div>
                                  <div className="filter-dropdown-list">
                                      <ul className="filter-dropdown-list-inner">
                                          <li className="filter-dropdown-list-items active"><a href="#">Show all</a>
                                          </li>
                                          <li className="filter-dropdown-list-items"><a href="#">Page</a></li>
                                          <li className="filter-dropdown-list-items"><a href="#">Single</a></li>
                                          <li className="filter-dropdown-list-items"><a href="#">Archive</a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div className="mt-col-sm-6">
                      <div className="body-header-search">
                          <input type="text" placeholder="Search Templates.." name="search" />
                          <button type="submit">
                              <img className="icon" src="images/search-solid.svg" alt="" />
                          </button>
                      </div>
                  </div>
              </div>

              <div className="mt-templates-modal-body-mid mt-row">
                  <div className="mt-col-sm-6">
                      <div className="mt-templates-modal-body-mid-left">Sign up for an exclusive launch discount.
                      </div>
                  </div>
                  <div className="mt-col-sm-6">
                      <div className="mt-templates-modal-body-mid-right">
                          <a href="#" className="mt-btn mt-btn-blue">Learn more</a>
                      </div>
                  </div>
              </div>

              <div className="mt-templates-modal-body-main">
                  <div className="template-item">

                      {this.props.data.map(item => (
                        <div className="template-item-inner">
                          <ul className="template-btn-group">
                              <li className="template-btn-item mt-btn mt-btn-preview">
                                  <span onClick={ () => this.props.onClick( item.templates ) }>View</span>
                              </li>
                              <li className="template-btn-item mt-btn mt-btn-go">
                                  <span><img className="icon" src="images/external-link-alt-solid.svg" alt="" />Go Pro</span>
                              </li>
                              <li className="template-btn-item mt-btn mt-btn-fav">
                                  <span><img className="icon" src="images/heart-solid.svg" alt="" /></span>
                              </li>
                          </ul>
                          <div className="template-item-figure">
                            <img src={item.image} alt="" />
                          </div>
                          <div className="template-item-name"><span>{item.name}</span>{item.templates.length} Pages</div>
                        </div>

                      ))}
                  </div>
              </div>

          </div>
      </div>
    );
  }
}

class Templates extends Component {
  
  render() {
    return (
      <div className="mt-templates-modal-body">
        <div className="mt-templates-modal-body-inner">
          <div className="mt-templates-modal-body-mid mt-row">
            <div className="mt-col-sm-6">
              <span onClick={ () => updateView('home')} className="back mt-btn"><img className="icon" src="images/long-arrow-alt-left-solid.svg" alt="" />
                Back</span>
            </div>
          </div>
          <div className="mt-templates-modal-body-main">
            <div className="mt-template-views-body">
              <div className="template-item">
                
                {this.props.data.map(kit => (
                  <div className="template-item-inner">
                    <ul className="template-preview-btn">
                      <li className="mt-btn mt-btn-preview-big">
                        <span>Preview</span>
                      </li>
                      <li className="mt-btn mt-btn-import">
                        <span onClick={ () => this.props.onClick( kit ) }>Import</span>
                      </li>
                    </ul>
                    <div className="template-item-figure">
                      <img src={kit.image} alt="" />
                    </div>
                    <div className="template-item-name"><span>{kit.name}</span></div>
                  </div>
                ))}

              </div>
            </div>
          </div>
        </div>
      </div>
    );
  }
}

class Blocks extends Component {
  render() {
    return (
      <div>
        <h1>Mighty Blocks</h1>
      </div>
    )
  }
}

function updateView( view ) {
  console.log(view),
  this.setState({ 
    renderView: view
  });
}

export default App
