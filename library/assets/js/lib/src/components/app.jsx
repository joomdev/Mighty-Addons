import React, { Component } from 'react'
import Loader from './loader.jsx'

import '../styles/grid.min.css'
import '../styles/mt.css'

class App extends Component {
  constructor(props) {
    super(props)
    this.state = {
      error: null,
      isLoaded: false,
      renderView: 'home',
      bannerMessages: [],
      preview: [],
      kits: [],
      blocks: [],
      choosenKit: [],
      kitsData: [],
      responsive: 'desktop'
    }
    // Updates View Globally
    updateView = updateView.bind(this)
  }

  componentDidMount() {
    // Fetching Templates & Blocks
    try {
      Promise.all([
        fetch(MightyLibrary.apiUrl+"templates/pages?key=" + MightyLibrary.key + "&host=" + MightyLibrary.host),
        fetch(MightyLibrary.apiUrl+"templates/blocks?key=" + MightyLibrary.key + "&host=" + MightyLibrary.host)
      ])
      .then(values => Promise.all(values.map(value => value.json())))
      .then(finalVals => {
        let templates = finalVals[0];
        let blocks = finalVals[1];
        this.setState({
          isLoaded: true,
          bannerMessages: templates.updates,
          kitsData: templates.data,
          kits: templates.data.templates,
          blocks: blocks.data,
          renderView: 'home'
        });
      })
    } catch {
      console.log("Something went wrong!");
    }
  }

  showKit = ( templates ) => {
    this.setState({
      choosenKit: templates
    });
    updateView('templates');
  }

  showDemo = ( preview ) => {
    this.setState({
      renderView: 'preview',
      preview: preview
    })
  }

  importJson = ( item ) => {
    let url = MightyLibrary.apiUrl+"template/"+item.id;
    updateView('loading');
    // Installing Template
    fetch(MightyLibrary.ajaxurl, {
      method: 'POST',
      headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
      body: 'action=elementor_fetch_tmpl_data&tmpl=' + url
    })
    .then(response => response.json())
    .then((tmpl) => {
      window.mightyModal.hide()
      if ( MightyLibrary.elementorCompatible ) {
        // Compatibility for older elementor versions
        elementor.sections.currentView.addChildModel(tmpl.data.template.content)
      } else {
        elementor.previewView.addChildModel(tmpl.data.template.content) 
      }
      $e.run( 'document/save/default' );
      updateView('home');
      elementor.notifications.showToast({
        message: elementor.translate( '🎉 Template Imported!' )
      });
    })
    .catch(function(error) {
      console.log('Something went wrong!');
      console.log(JSON.stringify(error));
    });
  }

  responsiveIframe = ( type ) => {
    this.setState({
      responsive: type
    })
  }

  createView = ( view ) => {
    switch( view ) {
      case 'home':
        return <Kits data={ this.state.kitsData } onClick={ (templates) => this.showKit(templates) } banner={ this.state.bannerMessages } />
      case 'templates':
        return <Pages data={ this.state.choosenKit } onClick={ (item) => this.importJson(item) } onPreview={ (url) => this.showDemo(url) } />
      case 'blocks':
        return <Blocks data={ this.state.blocks } onClick={ (item) => this.importJson(item) } onPreview={ (url) => this.showDemo(url) } />
      case 'preview':
        return <Preview data={ this.state.preview } onClick={ (item) => this.importJson(item) } onResponsive={ (type) => this.responsiveIframe(type) } iframeType={ this.state.responsive } />
      case 'loading':
        return <Loader />
    }
  }

  closeModal = () => {
    window.mightyModal.hide();
    setTimeout(() => {
      updateView('home');
    }, 500);
  }

  static getDerivedStateFromError(error) {
    // Update state so the next render will show the fallback UI.
    return { error: true };
  }

  render() {
    
    const { error, isLoaded, kits, blocks, renderView } = this.state;
    if ( error ) {
      return <div>Error: {error.message}</div>;
    } else if (!isLoaded) {
      return <Loader />
    } else {
      let logo = MightyLibrary.baseUrl + 'library/assets/images/mighty-library-logo.svg';
      
      return (
        <div id="mt-templates-modal" className="mt-templates-modal">
          <div className="mt-templates-modal-inner mt-container">

              <div className="mt-templates-modal-header mt-row">
                  <div className="mt-col-sm-4">
                      <div className="brand-logo">
                          <img className="mighty-logo" src={logo} alt="Mighty Addons" />
                          <span className="logo-subheading">LIBRARY</span>
                      </div>
                  </div>
                  <div className="mt-col-sm-4">
                      <div className="mt-templates-modal-header-top-tabs">
                          <ul className="top-tabs-inner">
                              <li onClick={ () => updateView('home') } className={`top-tabs-temp ${renderView == "home" || renderView == "templates" ? 'active' : ''}`}>Templates <span className="top-tabs-numb">{kits.length}</span></li>

                              <li onClick={ () => updateView('blocks') } className={`top-tabs-kits ${renderView == "blocks" ? 'active' : ''}`}>Blocks <span className="top-tabs-numb">{blocks.templates.length}</span></li>
                          </ul>
                      </div>
                  </div>
                  <div className="mt-col-sm-4">
                      <div className="mt-templates-modal-header-top-right">
                          <ul className="top-right">
                              <li className="top-right-list">
                                  <div className="icon" onClick={ ()=> this.closeModal() }>
                                    <i className="fas fa-times"></i>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>

              { this.createView(this.state.renderView) }

          </div>
      </div>
      );
    }
  }
}

class Filters extends Component {
  render() {
    return (
      <div className="filters-section mt-templates-modal-body-mid mt-row">
        <div className="category-input">
          <select
            value={ this.props.chosenCategory }
            onChange={ this.props.onCategoryChange() }
          >
            <option key='0' value='0'>All</option>
            {this.props.categories.map( ( category, index ) => (
              <option key={index} value={category['id']}>{category['title']}</option>
            ))}
          </select>
        </div>
        
        <div className="search-input">
          <input 
            type="text"
            value={ this.props.searchTerm }
            onChange={ this.props.onSearchInput() }
            type='text' 
            placeholder='Search...'
          />
        </div>
      </div>
    )
  }
}

class Kits extends Component {

  state = {
    selectedCategory: '0',
    searchTerm: '',
    templates: this.props.data.templates
  }

  updateCategory = ({ target }) => {
    this.setState({
      selectedCategory: target.value,
    });
    this.updateTemplates( target.value );
  }

  search = ( term ) => {
    let searchTerm = term.target.value;
    if ( searchTerm !== '' ) {
      this.updateTemplates( this.state.selectedCategory );

      let searchedTemplates = this.state.templates.filter( template => {
        if( template.title.toLowerCase().includes( searchTerm.toLowerCase() ) ) {
          return template;
        }
      });

      this.setState({
        templates: searchedTemplates
      });
    } else {
      this.updateTemplates( this.state.selectedCategory );
    }
    
  }

  updateTemplates = ( category ) => {
    
    if( category !== '0' ) {
      let categorisedTemplates = this.props.data.templates.filter( template => {
        if ( template.category == parseInt( category ) ) {
          return template;
        }
      });

      this.setState({
        templates: categorisedTemplates
      });
    } else {
      this.setState({
        templates: this.props.data.templates
      });
    }
    
  }

  render() {
    return (
      <div className="mt-templates-modal-body">
        <div className="mt-templates-modal-body-inner">
          {/* Banner Ads */}
          {this.props.banner.map((item, i) => (
            (item.type == "banner") ? <div key={i} className="mighty-banner" dangerouslySetInnerHTML={{ __html: item.html + item.styles }} /> : ''
          ))}

          <Filters
            chosenCategory={ this.selectedCategory }
            categories={ this.props.data.categories }
            onCategoryChange={ () => this.updateCategory }
            onSearchInput={ () => this.search }
          />

          <div className="mt-templates-modal-body-main">
              <div className="template-item">
                {this.state.templates.map(item => (
                  <div key={item.id} className="template-item-inner">

                    <div className="template-tags">
                      { item.tags.latest ?
                        <div className="latest-tag">
                          <span>Latest</span>
                        </div>
                        :
                        ''
                      }
                    </div>

                    <ul className="template-btn-group">
                        <button className="template-btn-item mt-btn mt-btn-preview" onClick={ () => this.props.onClick( item.pages ? item.pages : [item] ) }><i className="far fa-eye"></i></button>
                    </ul>
                    <div className="template-item-figure">
                      <img src={item.thumbnail} alt="template-thumbnail" />
                    </div>
                    <div className="template-item-name">
                      <span className="page-title">{item.title}</span>
                      <span className="page-count">{item.pages ? item.pages.length + " Pages" : 1 + " Page"}</span>
                    </div>
                  </div>
                ))}
              </div>
          </div>

          </div>
      </div>
    );
  }
}

class Pages extends Component {
  render() {

    return (
      <div className="mt-templates-modal-body">
        <div className="mt-templates-modal-body-inner">
          <div className="cta-section mt-templates-modal-body-mid mt-row">
            <button onClick={ () => updateView('home') } className="back mt-btn">
              <i className="fas fa-long-arrow-alt-left"></i>&nbsp;Back
            </button>
          </div>
          <div className="mt-templates-modal-body-main">
            <div className="mt-template-views-body">
              <div className="template-item">
                {this.props.data.map(pages => (
                  <div key={pages.id} className="template-item-inner">

                    <div className="template-tags">

                    { pages.tags.latest ?
                      <div className="latest-tag">
                        <span>Latest</span>
                      </div>
                      :
                      ''
                    }

                    { pages.elementor_type == "pro" ?
                      <div className="elementor-pro-tag">
                        <span>Elementor Pro Required</span>
                      </div>
                      :
                      ''
                    }

                    </div>

                    <div className="template-preview-btn">

                      { pages.elementor_type == "pro" && !MightyLibrary.elementorPro ?
                      <div className="elementor-pro-notice">
                        <a target="_blank" href="https://elementor.com/pricing/?ref=6508&campaign=mightyaddon">
                          <p>Required Plugins Missing</p>
                          <img src={MightyLibrary.baseUrl + 'library/assets/images/elementor-pro-notice.png'} alt="elementor-pro-logo" />
                        </a>
                      </div>
                      :
                      ''
                      }

                      <li className="mt-btn mt-btn-preview-big">
                        <span onClick={ () => this.props.onPreview( pages ) }>Preview</span>
                      </li>

                      { pages.free ?
                        <li className="mt-btn mt-btn-import">
                          <span onClick={ () => this.props.onClick( pages ) }>{pages.elementor_type == "pro" && !MightyLibrary.elementorPro ? 'Import anyway' : 'Import' }</span>
                        </li>
                      :
                        MightyLibrary.keyActive ?
                        <li className="mt-btn mt-btn-import">
                          <span onClick={ () => this.props.onClick( pages ) }>{pages.elementor_type == "pro" && !MightyLibrary.elementorPro ? 'Import anyway' : 'Import' }</span>
                        </li>
                        :
                        <a className="mt-btn mt-btn-import go-pro-btn" href="https://mightythemes.com/products/mighty-addons" target="_BLANK">Go Pro 🚀</a>
                      }
                    </div>
                    <div className="template-item-figure">
                      <img src={pages.thumbnail} alt="" />
                    </div>
                    <div className="template-item-name">
                      <span>{pages.title}</span>
                      { pages.free == false ?
                        <div className="mighty-pro-tag">
                          <span>Pro</span>
                        </div>
                      :
                      ''
                      }
                    </div>
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

  state = {
    selectedCategory: '0',
    searchTerm: '',
    templates: this.props.data.templates
  }

  updateCategory = ({ target }) => {
    this.setState({
      selectedCategory: target.value,
    });
    this.updateTemplates( target.value );
  }

  search = ( term ) => {
    let searchTerm = term.target.value;
    if ( searchTerm !== '' ) {
      this.updateTemplates( this.state.selectedCategory );

      let searchedTemplates = this.state.templates.filter( template => {
        if( template.title.toLowerCase().includes( searchTerm.toLowerCase() ) ) {
          return template;
        }
      });

      this.setState({
        templates: searchedTemplates
      });
    } else {
      this.updateTemplates( this.state.selectedCategory );
    }
  }

  updateTemplates = ( category ) => {
    
    if( category !== '0' ) {
      let categorisedTemplates = this.props.data.templates.filter( template => {
        if ( template.category == parseInt( category ) ) {
          return template;
        }
      });

      this.setState({
        templates: categorisedTemplates
      });
    } else {
      this.setState({
        templates: this.props.data.templates
      });
    }
    
  }

  render() {
    return (
      <div className="mt-templates-modal-body">
        <div className="mt-templates-modal-body-inner">

          <Filters
            chosenCategory={ this.selectedCategory }
            categories={ this.props.data.categories }
            onCategoryChange={ () => this.updateCategory }
            onSearchInput={ () => this.search }
          />

          <div className="mt-templates-modal-body-main">
            <div className="mt-template-views-body">
              <div className="template-item">
                {this.state.templates.map(block => (
                  <div key={block.id} className="template-item-inner">

                    <div className="template-tags">

                      { block.tags.latest ?
                        <div className="latest-tag">
                          <span>Latest</span>
                        </div>
                        :
                        ''
                      }

                      { block.elementor_type == "pro" ?
                      <div className="elementor-pro-tag">
                        <span>Elementor Pro Required</span>
                      </div>
                      :
                      ''
                      }

                    </div>

                    <ul className="template-preview-btn">

                      { block.elementor_type == "pro" ?
                        <div className="elementor-pro-notice">
                          <p>Required Plugins Missing</p>
                          <img src={MightyLibrary.baseUrl + 'library/assets/images/elementor-pro-notice.png'} alt="elementor-pro-logo" />
                        </div>
                      :
                      ''
                      }

                      <li className="mt-btn mt-btn-preview-big">
                        <span onClick={ () => this.props.onPreview( block ) }>Preview</span>
                      </li>

                      { block.free ?
                        <li className="mt-btn mt-btn-import">
                          <span onClick={ () => this.props.onClick( block ) }>{block.elementor_type == "pro" ? 'Import anyway' : 'Import' }</span>
                        </li>
                      :
                        MightyLibrary.keyActive ?
                        <li className="mt-btn mt-btn-import">
                          <span onClick={ () => this.props.onClick( block ) }>{block.elementor_type == "pro" ? 'Import anyway' : 'Import' }</span>
                        </li>
                        :
                        <a className="mt-btn mt-btn-import go-pro-btn" href="https://mightythemes.com/products/mighty-addons" target="_BLANK">Go Pro 🚀</a>
                      }

                    </ul>
                    <div className="template-item-figure">
                      <img src={block.thumbnail} alt="" />
                    </div>
                    <div className="template-item-name"><span>{block.title}</span></div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>
      </div>
    )
  }
}

class Preview extends Component {
  
  showFullscreen = () => {
    if (document.fullscreenEnabled || document.webkitFullscreenEnabled || document.mozFullScreenEnabled || document.msFullscreenEnabled) {
      
      var iframe = document.querySelector('#mighty-library iframe');
      // Do fullscreen
      if (iframe.requestFullscreen) {
        iframe.requestFullscreen();
      } else if (iframe.webkitRequestFullscreen) {
        iframe.webkitRequestFullscreen();
      } else if (iframe.mozRequestFullScreen) {
        iframe.mozRequestFullScreen();
      } else if (iframe.msRequestFullscreen) {
        iframe.msRequestFullscreen();
      }
    } else {
      alert('Your browser is not supported');
    }
  }

  render() {
    
    let previousView = (this.props.data.type == "page" ? 'templates' : 'blocks');
    let iframeWidth;
    switch( this.props.iframeType ) {
      case 'desktop': iframeWidth = {width: "100%"};
      break;
      case 'tablet': iframeWidth = {width: "768px"};
      break;
      case 'mobile': iframeWidth = {width: "320px"};
      break;
    }
    return (
      <div className="mt-templates-modal-body">
        <div className="mt-templates-modal-body-inner">

          { this.props.data.elementor_type == "pro" && !MightyLibrary.elementorPro ?
          <div className="cta-section mt-templates-modal-body-mid cta-responsive elementor-pro-banner">
            <span><big><b>Required Plugins Missing : Elementor Pro</b></big>
            <br />
            This template requires Elementor Pro. To ensure this template works best, you'll need to buy and install <b>Elementor Pro</b> version 2.2.0 or above.</span>
            
            <a target="_blank" href="https://elementor.com/pricing/?ref=6508&campaign=mightyaddon" className="mt-btn mt-btn-pro">
              Get Elementor Pro
            </a>
          </div>
          :
          ''
          }

          <div className="cta-section mt-templates-modal-body-mid cta-responsive">
            <button onClick={ ()=> updateView(previousView) } className="back mt-btn">
              <i className="fas fa-long-arrow-alt-left"></i>&nbsp;Back
            </button>

            <div className="responsive-controls">
              <i title="Desktop View" onClick={ () => this.props.onResponsive('desktop') } className={`fas fa-laptop ${ this.props.iframeType == "desktop" ? 'active' : '' }`}></i>
              <i title="Tablet View" onClick={ () => this.props.onResponsive('tablet') } className={`fas fa-tablet-alt ${ this.props.iframeType == "tablet" ? 'active' : '' }`}></i>
              <i title="Mobile View" onClick={ () => this.props.onResponsive('mobile') } className={`fas fa-mobile-alt ${ this.props.iframeType == "mobile" ? 'active' : '' }`}></i>
              <i title="Fullscreen View" onClick={ () => this.showFullscreen() } className="fas fa-expand"></i>
            </div>
            
            <button onClick={ () => this.props.onClick(this.props.data) } className="back mt-btn">
              <i className="far fa-arrow-alt-circle-down"></i>&nbsp;
              { this.props.data.elementor_type == "pro" ? 'Import Anyway' : 'Import' }
            </button>
          </div>
          <div className="mt-templates-modal-body-main preview-section">
            <iframe style={iframeWidth} src={this.props.data.link} frameBorder={0} allowFullScreen width="" />
          </div>
        </div>
      </div>
    )
  }
}

function updateView( view ) {
  if ( view != this.state.renderView ) {
    this.setState({
      renderView: view
    })
  }
}

export default App
