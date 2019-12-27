import React, { Component } from 'react'

import Header from "./Header"
import Kit from "./Kit"

import '../styles/grid.min.css'
import '../styles/mt.css'

class App extends Component {

  render() {
    return (
      <div id="mt-templates-modal">
        <div className="mt-templates-modal-inner mt-container">

          <Header />
          
          <div className="mt-templates-modal-body">
            <div className="mt-templates-modal-body-inner">
              {/* MT Templates Modal Header */}
              <div className="mt-templates-modal-body-header mt-row">
                <div className="mt-col-sm-6">
                  <div className="body-header-left">
                    <div className="filter body-header-filter">
                      <label htmlFor="filter">Filter</label>
                      <div className="filter-dropdown">
                        <div className="filter-dropdown-inner">
                          <div className="filter-dropdown-inner-left">
                            <div className="filter-dropdown-inner-left-text">Show All</div>
                            <input id="filter-list" readOnly tabIndex={0} className="filter-input" defaultValue />
                          </div>
                          <div className="filter-dropdown-inner-right">
                            <span><img className="icon" src="images/angle-down-solid.svg" alt="" /></span>
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
              {/* MT Templates Modal Mid */}
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
                  <Kit />
                  <Kit />
                  <Kit />
                  <Kit />
                  <Kit />
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    );
  }

}

export default App
