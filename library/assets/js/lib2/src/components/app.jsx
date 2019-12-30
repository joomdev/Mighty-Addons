import React, { Component } from 'react'

import '../styles/grid.min.css'
import '../styles/mt.css'

class App extends Component {
  
  constructor(props) {
    super(props);
    this.state = {
      error: null,
      isLoaded: false,
      view: 'templates', // template
      items: [],
      _data: new Map()
    };
  }

  componentDidMount() {
    fetch("#")
      .then(res => res.json())
      .then(
        (result) => {
          console.log(result);
          var _items = new Map();
          result.kits.forEach(function(_kit){
            _items.set('template-' + _kit.id, _kit);
          });

          this.setState({
            isLoaded: true,
            items: result.kits,
            _data: _items,
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

  showTemplate(_id){
    // console.log(_id);
    var _template = this._data.get(_id);
    // this.setState({'view': 'template'});
  }
  back(){
    // this.setState({'view': 'templates'});
  }

  render() {

    const { error, isLoaded, items } = this.state;
    if ( error ) {
      return <div>Error: {error.message}</div>;
    } else if (!isLoaded) {
      return <div>Loading...</div>;
    } else {

      items.forEach(item => {
        console.log(item);
      });

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
                              <li className="top-tabs-temp active">Templates <span className="top-tabs-numb">{items.length}</span></li>
                              <li className="top-tabs-kits">Blocks <span className="top-tabs-numb">200</span></li>
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

                              {items.map(item => (
                                <div className="template-item-inner">
                                  <ul className="template-btn-group">
                                      <li className="template-btn-item mt-btn mt-btn-preview">
                                          <span onClick={this.showTemplate(item.name)}><img className="icon" src="images/eye-solid.svg" alt="" /></span>
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
                                  <div className="template-item-name"><span>{item.name}</span>{item.pages} Pages</div>
                                </div>

                              ))}
                          </div>
                      </div>

                  </div>
              </div>
          </div>
      </div>
      );
    }
  
  }

}

export default App
