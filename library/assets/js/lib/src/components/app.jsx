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
      wittyTexts: [ 'Generating witty dialog...', 'Spinning violently around the y-axis...', 'Have a good day.', 'Upgrading Windows, your PC will restart several times. Sit back and relax.', 'We\'re building the stuff as fast as we can', '(Pay no attention to the man behind the curtain)', '...and enjoy the elevator music...', 'Would you like fries with that?', 'Go ahead -- hold your breath!', '...at least you\'re not on hold...', 'We\'re testing your patience', 'As if you had any other choice', 'Why don\'t you order a sandwich?', 'While the satellite moves into position', 'keep calm and npm install', 'The bits are flowing slowly today', 'Have you lost weight?', 'Just count to 10', 'Why so serious?', 'It\'s not you. It\'s me.', 'Counting backwards from Infinity', 'Don\'t panic...', 'Do not run! We are your friends!', 'Do you come here often?', 'Spinning the wheel of fortune...', 'Computing chance of success', 'I feel like im supposed to be loading something. . .', 'Should have used a compiled language...', 'Is this Windows?', 'Don\'t break your screen yet!', 'I swear it\'s almost done.', 'Let\'s take a mindfulness minute...', 'Time flies when you’re having fun.', 'Be careful not to step in the git-gui', 'Your left thumb points to the right and your right thumb points to the left.', 'Wait, do you smell something burning?', 'I love my job only when I\'m on vacation...', 'Sometimes I think war is God’s way of teaching us geography.', 'I’ve got problem for your solution…..', 'I think I am, therefore, I am. I think.', 'You don’t pay taxes—they take taxes.', 'I am free of all prejudices. I hate everyone equally.', 'git happens', 'This is not a joke, it\'s a commit.', 'We are not liable for any broken screens as a result of waiting.', 'If you type Google into Google you can break the internet', 'Dividing by zero...', 'If I’m not back in five minutes, just wait longer.', 'Some days, you just can’t get rid of a bug!', 'I need to git pull --my-life-together', 'Looking for sense of humour, please hold on.', 'Please wait while the intern refills his coffee.', 'Installing dependencies', 'Switching to the latest JS framework...', 'Finding someone to hold my beer', 'BRB, working on my side project', '@todo Insert witty loading message', 'Let\'s hope it\'s worth the wait', 'Whatever you do, don\'t look behind you...', 'Feel free to spin in your chair', 'Go ahead, hold your breath and do an ironman plank till loading complete', 'Help, I\'m trapped in a loader!', 'Updating to Windows Vista...', 'Everything in this universe is either a potato or not a potato', 'Reading Terms and Conditions for you.', 'Sooooo... Have you seen my vacation photos yet?', 'Still faster than Windows update' ]
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
    // Installing Template
    fetch(MightyLibrary.ajaxurl, {
      method: 'POST',
      headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
      body: 'action=elementor_fetch_tmpl_data&tmpl=' + url
    })
    .then(response => response.json())
    .then((tmpl) => {
      window.mightyModal.hide(),
      elementor.sections.currentView.addChildModel(tmpl.data.template.content)
      updateView('home');
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
        return <Kits data={ this.state.kitsData } onClick={ (templates) => this.showKit(templates) } />
      case 'templates':
        return <Pages data={ this.state.choosenKit } onClick={ (item) => this.importJson(item) } onPreview={ (url) => this.showDemo(url) } />
      case 'blocks':
        return <Blocks data={ this.state.blocks } onClick={ (item) => this.importJson(item) } onPreview={ (url) => this.showDemo(url) } />
      case 'preview':
        return <Preview data={ this.state.preview } onClick={ (item) => this.importJson(item) } onResponsive={ (type) => this.responsiveIframe(type) } iframeType={ this.state.responsive } />
      case 'loading':
        return <Loader data={ this.state.wittyTexts } />
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
      return <Loader data={ this.state.wittyTexts } />
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
                      
                      <div key={item.id} className="template-item-inner">
                        <ul className="template-btn-group">
                            <button className="template-btn-item mt-btn mt-btn-preview" onClick={ () => this.props.onClick( item.pages ? item.pages : [item] ) }><i className="far fa-eye"></i></button>
                            
                            <button className="template-btn-item mt-btn mt-btn-go">Go Pro&nbsp;<i className="fas fa-rocket"></i></button>
                        </ul>
                        <div className="template-item-figure">
                          <img src={item.thumbnail} alt="template-thumbnail" />
                        </div>
                        <div className="template-item-name"><span>{item.title}</span>{item.pages ? item.pages.length : 1} Pages</div>
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

                    { pages.elementor_type == "pro" ?
                    <div className="elementor-pro-tag">
                      <span>Elementor Pro Required</span>
                    </div>
                    :
                    ''
                    }

                    <ul className="template-preview-btn">
                      { pages.elementor_type == "pro" ?
                      <div className="elementor-pro-notice">
                        <h5>Required Plugins Missing</h5>
                        <img src={MightyLibrary.baseUrl + 'library/assets/images/elementor-pro-notice.png'} alt="elementor-pro-logo" />
                      </div>
                      :
                      ''
                      }
                      
                      <li className="mt-btn mt-btn-preview-big">
                        <span onClick={ () => this.props.onPreview( pages ) }>Preview</span>
                      </li>
                      <li className="mt-btn mt-btn-import">
                        <span onClick={ () => this.props.onClick( pages ) }>{pages.elementor_type == "pro" ? 'Import anyway' : 'Import' }</span>
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
            
            <a target="_blank" href="https://elementor.com/pricing/?ref=6508&campaign=mightyaddon" className="back mt-btn">
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

  constructor(props) {
    super(props);
    this.state = {
      randomWittyText: this.props.data[Math.floor((Math.random() * (this.props.data.length-1)) + 1)]
    };
  }

  shuffleArray = () => {
    let random = Math.floor((Math.random() * (this.props.data.length-1)) + 1);
    this.setState({ randomWittyText: this.props.data[random] });
  }

  componentDidMount() {
    this.timerInterval = setInterval(this.shuffleArray.bind(this), 2000);
  }

  componentWillUnmount() {
    clearInterval(this.timerInterval);
  }

  render() {
    return (
      <div className="loader-box">
        <div className="mighty-loader">
          <svg className="circular" viewBox="25 25 50 50">
            <circle className="path" cx={50} cy={50} r={20} fill="none" strokeWidth={2} strokeMiterlimit={10} />
          </svg>
        </div>
        { this.props.data ? <p className="wittiness">{ this.state.randomWittyText }</p> : '' }
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
