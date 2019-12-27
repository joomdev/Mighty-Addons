import React, { Component } from 'react';

class Header extends Component {
    render() {
        return (
            <div className="mt-templates-modal-header mt-row">
                <div className="mt-col-sm-4">
                    <div className="brand-logo">
                        <img src="images/logo-white-1.png" alt="Mighty Logo" />
                    </div>
                </div>
                <div className="mt-col-sm-4">
                    <div className="mt-templates-modal-header-top-tabs">
                        <ul className="top-tabs-inner">
                            <li className="top-tabs-temp active">Templates <span className="top-tabs-numb">5</span></li>
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
                                <div className="top-close icon"><img className="icon" src="images/times-solid.svg" alt="" /></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        )
    }
}

export default Header;