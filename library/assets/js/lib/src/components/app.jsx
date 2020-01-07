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
    fetch("http://elementoraddons.local/wp-content/uploads/kits/kits.json")
      .then(res => res.json())
      .then(
        (result) => {
          this.setState({
            isLoaded: true,
            kitsData: result,
            kits: result.kits,
            blocks: result.blocks,
            renderView: 'home'
          });
        },
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
    updateView('loading');
    fetch(item.url)
    .then(response => response.json())
    .then((tmpl) => {
      window.mightyModal.hide(),
      elementor.sections.currentView.addChildModel(tmpl.content)
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

  createView( view ) {
    switch( view ) {
      case 'home':
        return <Kits data={ this.state.kitsData } onClick={ (templates) => this.showKit(templates) } />
      case 'templates':
        return <Templates data={ this.state.choosenKit } onClick={ (item) => this.importJson(item) } onPreview={ (url) => this.showDemo(url) } />
      case 'blocks':
        return <Blocks data={ this.state.kitsData } onClick={ (item) => this.importJson(item) } onPreview={ (url) => this.showDemo(url) } />
      case 'preview':
        return <Preview data={ this.state.preview } onClick={ (item) => this.importJson(item) } onResponsive={ (type) => this.responsiveIframe(type) } iframeType={ this.state.responsive } />
      case 'loading':
        return <Loader />
    }
  }

  closeModal() {
    window.mightyModal.hide();
    setTimeout(() => {
      updateView('home');
    }, 500);
  }

  render() {

    const { error, isLoaded, kits, blocks, renderView } = this.state;
    if ( error ) {
      return <div>Error: {error.message}</div>;
    } else if (!isLoaded) {
      return (
        <div className="loader">
          <div className="mighty-loader"></div>
        </div>
      );
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
                              <li onClick={ ()=> updateView('home') } className={`top-tabs-temp ${renderView == "home" ||
                                  renderView == "templates" ? 'active' : ''}`}>Templates <span
                                      className="top-tabs-numb">{kits.length}</span></li>
                              <li onClick={ ()=> updateView('blocks') } className={`top-tabs-kits ${renderView == "blocks" ?
                                  'active' : ''}`}>Blocks <span className="top-tabs-numb">{blocks.length}</span></li>
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

              <div className="mt-templates-modal-body-mid mt-row">
                  <div className="mt-col-sm-6">
                      <div className="mt-templates-modal-body-mid-left">{this.props.data.bannerMsg}</div>
                  </div>
                  <div className="mt-col-sm-6">
                      <div className="mt-templates-modal-body-mid-right">
                          <a href={this.props.data.ctaUrl} target="_blank" className="mt-btn mt-btn-blue">{this.props.data.ctaBtn}</a>
                      </div>
                  </div>
              </div>

              <div className="mt-templates-modal-body-main">
                  <div className="template-item">

                      {this.props.data.kits.map(item => (
                        <div key={item.id} className="template-item-inner">
                          <ul className="template-btn-group">
                              <button className="template-btn-item mt-btn mt-btn-preview" onClick={ () => this.props.onClick( item.templates ) }><i className="far fa-eye"></i></button>
                              
                              <button className="template-btn-item mt-btn mt-btn-go">Go Pro&nbsp;<i className="fas fa-rocket"></i></button>
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
                
                {this.props.data.map(kit => (
                  <div key={kit.id} className="template-item-inner">
                    <ul className="template-preview-btn">
                      <li className="mt-btn mt-btn-preview-big">
                        <span onClick={ () => this.props.onPreview( kit ) }>Preview</span>
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
      <div className="mt-templates-modal-body">
        <div className="mt-templates-modal-body-inner">
          <div className="mt-templates-modal-body-main">
            <div className="mt-template-views-body">
              <div className="template-item">
                {this.props.data.blocks.map(block => (
                  
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
                      <img src={block.image} alt="" />
                    </div>
                    <div className="template-item-name"><span>{block.name}</span></div>
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
  render() {
    let previousView = (this.props.data.type == "template" ? 'templates' : 'blocks');
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
          <div className="cta-section mt-templates-modal-body-mid cta-responsive">
            <button onClick={ ()=> updateView(previousView)} className="back mt-btn">
              <i className="fas fa-long-arrow-alt-left"></i>&nbsp;Back
            </button>

            <div className="responsive-controls">
              <i onClick={ () => this.props.onResponsive('desktop') } className="fas fa-laptop"></i>
              <i onClick={ () => this.props.onResponsive('tablet') } className="fas fa-tablet-alt"></i>
              <i onClick={ () => this.props.onResponsive('mobile') } className="fas fa-mobile-alt"></i>
            </div>
            
            <button onClick={ ()=> this.props.onClick(this.props.data) } className="back mt-btn">
              <i className="far fa-arrow-alt-circle-down"></i>&nbsp;Import
            </button>
          </div>
          <div className="mt-templates-modal-body-main preview-section">
            <iframe style={iframeWidth} src={this.props.data.preview} frameBorder={0} allowFullScreen width="" />
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
