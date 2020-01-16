import React, { Component } from 'react'

import '../styles/grid.min.css'
import '../styles/mt.css'

class App extends Component {
  
  constructor(props) {
    super(props)
    this.state = {
      error: null,
      isLoaded: false,
      renderView: 'home',
      preview: [],
      kits: [],
      blocks: [],
      choosenKit: [],
      kitsData: [],
      responsive: 'desktop',
    }
    // Updates View Globally
    updateView = updateView.bind(this)
  }

  componentDidMount() {
    // Fething Templates & Blocks
    try {
      Promise.all([
        fetch(MightyLibrary.apiUrl+"templates/pages"),
        fetch(MightyLibrary.apiUrl+"templates/blocks")
      ])
      .then(values => Promise.all(values.map(value => value.json())))
      .then(finalVals => {
        let templates = finalVals[0];
        let blocks = finalVals[1];
        this.setState({
          isLoaded: true,
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
    fetch(url, {
      method: 'POST',
      headers : new Headers(),
      body: ({
        "key" : MightyLibrary.key,
        "host" : MightyLibrary.host
      })
    })
    .then(response => response.json())
    .then((tmpl) => {
      window.mightyModal.hide(),
      elementor.sections.currentView.addChildModel(tmpl.data.template.content)
      updateView('home');
    })
    .catch((error) => {
      console.error(error)
    })
  }

  responsiveIframe = ( type ) => {
    this.setState({
      responsive: type
    })
  }

  createView = ( view ) => {
    switch( view ) {
      case 'home':
        return <Kits data={ this.state.kitsData } onClick={ (templates) => this.showKit(templates) } />
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
      let logo = MightyLibrary.baseUrl + 'library/assets/images/mighty-addons-logo.svg';
      
      return (
        <div id="mt-templates-modal" className="mt-templates-modal">
          <div className="mt-templates-modal-inner mt-container">

              <div className="mt-templates-modal-header mt-row">
                  <div className="mt-col-sm-4">
                      <div className="brand-logo">
                          <img className="mighty-logo" src={logo} alt="Mighty Addons" />
                      </div>
                  </div>
                  <div className="mt-col-sm-4">
                      <div className="mt-templates-modal-header-top-tabs">
                          <ul className="top-tabs-inner">
                              <li onClick={ ()=> updateView('home') } className={`top-tabs-temp ${renderView == "home" || renderView == "templates" ? 'active' : ''}`}>Templates <span className="top-tabs-numb">{kits.length}</span></li>

                              <li onClick={ ()=> updateView('blocks') } className={`top-tabs-kits ${renderView == "blocks" ? 'active' : ''}`}>Blocks <span className="top-tabs-numb">{blocks.templates.length}</span></li>
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

class Kits extends Component {

  render() {
    return (
      <div className="mt-templates-modal-body">
        <div className="mt-templates-modal-body-inner">

              {/* <div className="mt-templates-modal-body-mid mt-row">
                  <div className="mt-col-sm-6">
                      <div className="mt-templates-modal-body-mid-left">{this.props.data.bannerMsg}</div>
                  </div>
                  <div className="mt-col-sm-6">
                      <div className="mt-templates-modal-body-mid-right">
                          <a href={this.props.data.ctaUrl} target="_blank" className="mt-btn mt-btn-blue">{this.props.data.ctaBtn}</a>
                      </div>
                  </div>
              </div> */}

              <div className="mt-templates-modal-body-main">
                  <div className="template-item">

                      {this.props.data.templates.map(item => (
                        
                        item.pages ?

                        <div key={item.id} className="template-item-inner">
                          <ul className="template-btn-group">
                              <button className="template-btn-item mt-btn mt-btn-preview" onClick={ () => this.props.onClick( item.pages ) }><i className="far fa-eye"></i></button>
                              
                              <button className="template-btn-item mt-btn mt-btn-go">Go Pro&nbsp;<i className="fas fa-rocket"></i></button>
                          </ul>
                          <div className="template-item-figure">
                            <img src={item.pages[0].thumbnail} alt="" />
                          </div>
                          <div className="template-item-name"><span>{item.title}</span>{item.pages.length} Pages</div>
                        </div>
                        :
                        ''
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
            <div className="mt-col-sm-6">
              <button onClick={ () => updateView('home')} className="back mt-btn">
                <i className="fas fa-long-arrow-alt-left"></i>&nbsp;Back
              </button>
            </div>
          </div>
          <div className="mt-templates-modal-body-main">
            <div className="mt-template-views-body">
              <div className="template-item">
                
                {this.props.data.map(pages => (
                  <div key={pages.id} className="template-item-inner">
                    
                    {/* <div className="elementor-pro">
                      <img src={MightyLibrary.baseUrl+'library/assets/images/elementor-logo.png'} alt=""/> Pro
                    </div> */}

                    { pages.elementor_type == "pro" ? 
                    
                    <div className="elementor-pro-tag">
                      <span>Elementor Pro Required</span>
                    </div>
                    :
                    ''
                    }

                    <ul className="template-preview-btn">
                      <li className="mt-btn mt-btn-preview-big">
                        <span onClick={ () => this.props.onPreview( pages ) }>Preview</span>
                      </li>
                      <li className="mt-btn mt-btn-import">
                        <span onClick={ () => this.props.onClick( pages ) }>Import</span>
                      </li>
                    </ul>
                    <div className="template-item-figure">
                      <img src={pages.thumbnail} alt="" />
                    </div>
                    <div className="template-item-name"><span>{pages.title}</span></div>
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
      <div className="mt-templates-modal-body">
        <div className="mt-templates-modal-body-inner">
          <div className="mt-templates-modal-body-main">
            <div className="mt-template-views-body">
              <div className="template-item">
                {this.props.data.templates.map(block => (
                  
                  <div key={block.id} className="template-item-inner">
                    <ul className="template-preview-btn">
                      <li className="mt-btn mt-btn-preview-big">
                        <span onClick={ () => this.props.onPreview( block ) }>Preview</span>
                      </li>
                      <li className="mt-btn mt-btn-import">
                        <span onClick={ () => this.props.onClick( block ) }>Import</span>
                      </li>
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
            
            <a href="#" className="back mt-btn">
              Get Elementor Pro
            </a>
          </div>
          :
          ''
          }

          <div className="cta-section mt-templates-modal-body-mid cta-responsive">
            <button onClick={ ()=> updateView(previousView)} className="back mt-btn">
              <i className="fas fa-long-arrow-alt-left"></i>&nbsp;Back
            </button>

            <div className="responsive-controls">
              <i title="Desktop View" onClick={ () => this.props.onResponsive('desktop') } className={`fas fa-laptop ${ this.props.iframeType == "desktop" ? 'active' : '' }`}></i>
              <i title="Tablet View" onClick={ () => this.props.onResponsive('tablet') } className={`fas fa-tablet-alt ${ this.props.iframeType == "tablet" ? 'active' : '' }`}></i>
              <i title="Mobile View" onClick={ () => this.props.onResponsive('mobile') } className={`fas fa-mobile-alt ${ this.props.iframeType == "mobile" ? 'active' : '' }`}></i>
              <i title="Fullscreen View" onClick={ () => this.showFullscreen() } className="fas fa-expand"></i>
            </div>
            
            <button onClick={ ()=> this.props.onClick(this.props.data) } className="back mt-btn">
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

class Loader extends Component {
  render() {
    return (
      <div className="mt-loader">
        <div className="mighty-loader"></div>
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
