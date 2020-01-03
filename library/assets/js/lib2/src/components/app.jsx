import React, { Component } from 'react'

import '../styles/grid.min.css'
import '../styles/mt.css'
// import {logo} from '../assets/mighty-addons-logo.svg'

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
      kitsData: []
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
            blocks: result.blocks
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
      renderView: 'templates',
      choosenKit: templates
    });
  }

  showDemo = ( preview ) => {
    this.setState({
      renderView: 'preview',
      preview: preview
    })
  }

  importJson = ( item ) => {
    this.setState({
      renderView: 'loading'
    });

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

  createView( view ) {
    console.log("In create view : " + view)
    switch( view ) {
      case 'home':
        return <Kits data={ this.state.kitsData } onClick={ (templates) => this.showKit(templates) } />
      case 'templates':
        return <Templates data={ this.state.choosenKit } onClick={ (item) => this.importJson(item) } onPreview={ (url) => this.showDemo(url) } />
      case 'blocks':
        return <Blocks data={ this.state.kitsData } onClick={ (item) => this.importJson(item) } onPreview={ (url) => this.showDemo(url) } />
      case 'preview':
        return <Preview data={ this.state.preview } />
      case 'loading':
        return <Loader />
    }

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
      
      return (
        <div id="mt-templates-modal" className="mt-templates-modal">
          <div className="mt-templates-modal-inner mt-container">

              <div className="mt-templates-modal-header mt-row">
                  <div className="mt-col-sm-4">
                      <div className="brand-logo">
                          {/* <img src={logo} alt="Mighty Addons" /> */}
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
                                  <span>Sync</span>
                                  <div className="top-sync"><i class="fas fa-sync-alt"></i></div>
                              </li>
                              <li className="top-right-list">
                                  <div className="icon" onClick={ ()=> window.mightyModal.hide() }><i
                                          class="fas fa-times"></i></div>
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
                        <div className="template-item-inner">
                          <ul className="template-btn-group">
                              <button className="template-btn-item mt-btn mt-btn-preview" onClick={ () => this.props.onClick( item.templates ) }><i class="far fa-eye"></i></button>
                              
                              <button className="template-btn-item mt-btn mt-btn-go">Go Pro&nbsp;<i class="fas fa-rocket"></i></button>
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
                <i class="fas fa-long-arrow-alt-left"></i>&nbsp;Back
              </button>
            </div>
          </div>
          <div className="mt-templates-modal-body-main">
            <div className="mt-template-views-body">
              <div className="template-item">
                
                {this.props.data.map(kit => (
                  <div className="template-item-inner">
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
                  
                  <div className="template-item-inner">
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
    return (
      <div className="mt-templates-modal-body">
        <div className="mt-templates-modal-body-inner">
          <div className="cta-section mt-templates-modal-body-mid mt-row">
            <div className="mt-col-sm-6">
            <button onClick={ () => updateView(previousView)} className="back mt-btn">
                <i class="fas fa-long-arrow-alt-left"></i>&nbsp;Back
              </button>
            </div>
          </div>
          <div className="mt-templates-modal-body-main preview-section">
            <iframe src={this.props.data.preview} frameBorder={0} allowFullScreen />
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
  console.log(view),
  this.setState({ 
    renderView: view
  });
  console.log("State value: " + this.state.renderView);
}

export default App
