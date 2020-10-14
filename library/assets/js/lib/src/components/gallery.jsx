import React, { Component } from 'react'

import Loader from './loader.jsx'
import ReactPaginate from 'react-paginate'

if ("undefined" != typeof wp && wp.media && ( Number(MightyLibrary.pxStatus) || Number(MightyLibrary.unsplashStatus) ) ) {

  var e = wp.media.view.MediaFrame.Select,
    i = (wp.media.controller.Library, wp.media.view.l10n),
    t = wp.media.view.Frame,
    importData = null,
    tabTitle = MightyLibrary.plgShortName + " Photos",
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
      isSearching: false,
      searchTerm: defaultSearchTerm,
      images: [],
      renderView: 'home',
      choosenImage: [],
      viewType: 'ordered',
      totalPages: '',
      currentPage: 1,
      searchPlatform: Number(MightyLibrary.pxStatus) ? 'pixabay' : 'unsplash',
      proEnabled: ''
    }
  }

  componentDidMount() {
    this.search()
  }

  updateView = (view) => {
    if ( view != this.state.renderView ) {
      this.setState({
        renderView: view
      })
    }
  }

  search = ( page ) => {
    this.setState({ isSearching: true });
    let host = this.state.searchPlatform == "pixabay" ? MightyLibrary.apiUrl+MightyLibrary.pxUrl : MightyLibrary.apiUrl+MightyLibrary.usUrl;
    let pagination = page !== undefined ? page : this.state.currentPage;
    let url = host+this.state.searchTerm+"/"+pagination+"?key="+MightyLibrary.key+"&host="+MightyLibrary.host;
    
    fetch(url)
    .then(response => response.json())
    .then((res) => {
      if ( res.status == "error" || ( this.state.searchPlatform == "unsplash" && !MightyLibrary.maProStatus  ) ) {
        this.setState({
          images: [],
          totalPages: 0,
          proEnabled: false
        });
      } else {
        this.setState({
          images: res.data.images,
          totalPages: res.data.pages,
          proEnabled: true
        });
      }
      
      this.setState({
        isLoaded: true,
        isSearching: false,
      });
    })
    .catch(function(error) {
      console.log('Something went wrong!');
      console.log(JSON.stringify(error));
    });
  }

  showImage = ( image ) => {
    this.setState({
      choosenImage: image
    })
    this.updateView('image')
  }

  importImage = ( image, size ) => {
    this.updateView('loader')
    fetch(MightyLibrary.ajaxurl, {
      method: 'POST',
      headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
      body: 'action=save_mighty_extension_media&size='+size+'&src='+ this.state.searchPlatform +'&image=' + image
    })
    .then(response => response.json())
    .then((data) => {
      importData.model.get("selection").add(data.attachmentData)
      importData.model.frame.trigger("library:selection:add")
      let buttons = document.querySelectorAll(".media-toolbar .media-toolbar-primary .media-button-select")
      buttons[buttons.length-1].click()
      this.updateView('home')
    })
    .catch(function(error) {
      console.log('Something went wrong!');
      console.log(JSON.stringify(error));
    });
  }

  pagination = ( page ) => {
    this.setState({ currentPage: page })
    this.search( page )
  }

  platformType = ( platform ) => {
    this.setState({ searchPlatform: platform }, () =>
      this.search()
    );
  }

  createView = ( view ) => {
    switch( view ) {
      case 'home':
        return <Home 
                  searchTerm={ this.state.searchTerm }
                  data={ this.state.images } 
                  onClick={ (image) => this.showImage(image) } 
                  onChange={ (e) => this.setState({ searchTerm: e.target.value }) } 
                  onSearch={ () => this.search() } 
                  onViewType={ (type) => this.setState({ viewType: type }) } 
                  viewType={this.state.viewType} 
                  isSearching={ this.state.isSearching } 
                  totalPages={ this.state.totalPages } 
                  onPaginate={ (page) => this.pagination( page ) } 
                  currentPage={ this.state.currentPage } 
                  activeSearchPlatform={ (platform) => this.platformType( platform ) } 
                  searchPlatform={ this.state.searchPlatform } 
                  proEnabled ={ this.state.proEnabled }
                />
      case 'image':
        return <Image 
                data={ this.state.choosenImage } 
                onImport={ (image, size) => this.importImage(image, size) } 
                onViewChange={ (view) => this.updateView(view) } 
                platform={ this.state.searchPlatform }
              />
      case 'loader':
        return <Loader />
    }
  }

  render() {
    const { isLoaded } = this.state;

    if ( !isLoaded ) {
      return <Loader />
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
            <button onClick={ () => this.props.onSearch() }><i className="fas fa-search"></i></button>
          </div>
          <div className="brand-filters">

            {Number(MightyLibrary.pxStatus) ?
              <span className={`action-button${this.props.searchPlatform == "pixabay" ? ' active' : ''}`} onClick={ () => this.props.activeSearchPlatform('pixabay') }>
                Pixabay
              </span>
              :
              ''
            }
            
            {Number(MightyLibrary.unsplashStatus) ?
              <span className={`action-button${this.props.searchPlatform == "unsplash" ? ' active' : ''}`} onClick={ () => this.props.activeSearchPlatform('unsplash') }>
                Unsplash
              </span>
              :
              ''
            }

          </div>
          <div className="photos-view">
            <p>View as:</p>
            <i className={`fas fa-stream${this.props.viewType == 'ordered' ? '' : ' active'}`} onClick={ () => this.props.onViewType('unordered') }></i>
            <i className={`fas fa-align-justify${this.props.viewType == 'ordered' ? ' active' : ''}`} onClick={ () => this.props.onViewType('ordered') } ></i>
          </div>
        </div>
        
        { !this.props.isSearching ?
            this.props.searchPlatform == "pixabay" ?
              <PixabayImages 
                data={this.props.data} 
                onClick={ (image) => this.props.onClick(image)} 
                viewType={this.props.viewType} 
                pages={this.props.totalPages} 
                onPagination={ (page) => this.props.onPaginate(page) } 
                currentPage={this.props.currentPage}
              />
              :
              <UnsplashImages 
                data={this.props.data} 
                onClick={ (image) => this.props.onClick(image)} 
                viewType={this.props.viewType} 
                pages={this.props.totalPages} 
                onPagination={ (page) => this.props.onPaginate(page) } 
                currentPage={this.props.currentPage} 
                proEnabled ={ this.props.proEnabled }
              />
            :
          <Loader />
        }
      </div>
    );
  }
}

class PixabayImages extends Component {
  render() {
    return (
      <div className={`pixabay-images${this.props.viewType == 'ordered' ? ' view-ordered' : ''}${this.props.data.length < 1 ? ' error-not-found' : ''}`}>
        {this.props.data.length < 1 ?
          <div className="not-found">
            <img src={MightyLibrary.baseUrl + 'library/assets/images/retro-pc.svg'} alt="Images not found!" />
            <h4>We do need to upgrade things around here!</h4>
            <p>Until then, search for something else.</p>
          </div>
          :
          <div className="search-results">
            {this.props.data.map(image => (
              <img key={image.id} onClick={ () => this.props.onClick(image) } draggable='false' className='px-image' src={image.preview} alt={image.tags} />
            ))}

            <div className="mt-pixabay-pagination">
              <nav aria-label="mighty-photos-pagination">
                  <ReactPaginate
                    previousLabel={'Previous'}
                    nextLabel={'Next'}
                    pageCount={this.props.pages}
                    marginPagesDisplayed={2}
                    pageRangeDisplayed={3}
                    onPageChange={ ( data ) => { this.props.onPagination(data.selected+1) } }
                    forcePage={this.props.currentPage - 1}
                    previousClassName={'page-item'}
                    previousLinkClassName={'page-link'}
                    breakClassName={'page-item'}
                    breakLinkClassName={'page-link'}
                    nextClassName={'page-item'}
                    nextLinkClassName={'page-link'}
                    breakLabel={'...'}
                    breakClassName={'page-item'}
                    containerClassName={'pagination pagination-sm'}
                    subContainerClassName={'pages pagination'}
                    pageClassName={'page-item'}
                    pageLinkClassName={'page-link'}
                    activeClassName={'active'}
                  />
              </nav>
            </div>
          </div>
        }

      </div>
    );
  }
}

class UnsplashImages extends Component {
  
  render() {
    return (
      <div className={`unsplash-images${this.props.viewType == 'ordered' ? ' view-ordered' : ''}${this.props.data.length < 1 ? ' error-not-found' : ''}`}>
        
        {this.props.data.length < 1 ?
          <div className="not-found">
            <img src={MightyLibrary.baseUrl + 'library/assets/images/retro-pc.svg'} alt="Images not found!" />
            {
              this.props.proEnabled ?
                <div className="error-message">
                  <h4>We do need to upgrade things around here!</h4> 
                  <p>Until then, search for something else.</p>
                </div>
                :
                <h4>Unsplash is only available for Pro Users!</h4>
            }
          </div>
          :
          <div className="search-results">
            {this.props.data.map(image => (
              <img key={image.id} onClick={ () => this.props.onClick(image) } draggable='false' className='px-image' src={image.preview} alt={image.tags} />
            ))}

            <div className="mt-pixabay-pagination">
              <nav aria-label="mighty-photos-pagination">
                  <ReactPaginate
                    previousLabel={'Previous'}
                    nextLabel={'Next'}
                    pageCount={this.props.pages}
                    marginPagesDisplayed={2}
                    pageRangeDisplayed={3}
                    onPageChange={ ( data ) => { this.props.onPagination(data.selected+1) } }
                    forcePage={this.props.currentPage - 1}
                    previousClassName={'page-item'}
                    previousLinkClassName={'page-link'}
                    breakClassName={'page-item'}
                    breakLinkClassName={'page-link'}
                    nextClassName={'page-item'}
                    nextLinkClassName={'page-link'}
                    breakLabel={'...'}
                    breakClassName={'page-item'}
                    containerClassName={'pagination pagination-sm'}
                    subContainerClassName={'pages pagination'}
                    pageClassName={'page-item'}
                    pageLinkClassName={'page-link'}
                    activeClassName={'active'}
                  />
              </nav>
            </div>
          </div>
        }
      </div>
    );
  }
}

class Image extends Component {

  state = {
    selectedImageSize: MightyLibrary.imageSizes[MightyLibrary.imageSizes.length-1]['size'],
  }

  updateSize = ({ target }) => {
    this.setState({
      selectedImageSize: target.value,
    });
  }

  render() {    
    return (
      <div className="mighty-image">
        <div className="mt-templates-modal-body-inner mt-templates-modal-body-header">
          <button className="mt-btn mt-btn-import" onClick={ () => this.props.onViewChange('home') }><i className="fas fa-long-arrow-alt-left"></i>&nbsp;Back</button>
        </div>
        <div className="selected-image">
          <img src={ this.props.data.preview } alt={ this.props.data.tags } />
          <div className="image-controls">
            <h4>Description</h4>
            <p>{ this.props.data.tags }</p>
            { this.props.platform == "pixabay" &&
            <div className="pixabay-notice">
              <a target="_blank" rel="nofollow" href="https://pixabay.com/service/license/">Pixabay License</a>
              <div className="pix-note">
                Free for commercial use
                <br />No attribution required
              </div>
            </div> }
            <h4>Credits</h4>
            { this.props.platform == "pixabay" ?
             <p>Photo by <a target="_blank" href={ 'https://pixabay.com/users/' + this.props.data.user }>{ this.props.data.user }</a> on <a target="_blank" href="https://pixabay.com"> Pixabay</a></p>
             :
             <p>Photo by <a target="_blank" href={ 'https://unsplash.com/@' + this.props.data.username }>{ this.props.data.user }</a> on <a target="_blank" href="https://unsplash.com"> Unsplash</a></p>
            }

            <h4>Choose Size</h4>
            <select
              value={this.state.selectedImageSize}
              onChange={this.updateSize}
            >
              {MightyLibrary.imageSizes.map((size, index) => (
                <option key={index} value={size['size']}>{size['name']}</option>
              ))}
            </select>

            <span className="action-button" onClick={ () => this.props.onImport( this.props.data.url, this.state.selectedImageSize ) }>
              <i className="fas fa-download"></i>&nbsp; Insert Image
            </span>
          </div>
        </div>
      </div>
    );
  }
}

export default Gallery
