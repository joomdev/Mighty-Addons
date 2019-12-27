import React, { Component } from 'react'

class Kit extends Component {
    render() {
        return (
            <div className="template-item-inner">
                <ul className="template-btn-group">
                    <li className="template-btn-item mt-btn mt-btn-preview">
                        <span><img className="icon" src="images/eye-solid.svg" alt="" /></span>
                    </li>
                    <li className="template-btn-item mt-btn mt-btn-go">
                        <span><img className="icon" src="images/external-link-alt-solid.svg" alt="" /> Go
                            Pro</span>
                    </li>
                    <li className="template-btn-item mt-btn mt-btn-fav">
                        <span><img className="icon" src="images/heart-solid.svg" alt="" /></span>
                    </li>
                </ul>
                <div className="template-item-figure">
                    <img src="images/team-view-1.jpg" alt="" />
                </div>
                <div className="template-item-name"><span>Jd Builder</span>6 Pages</div>
            </div>
        )
    }
}

export default Kit