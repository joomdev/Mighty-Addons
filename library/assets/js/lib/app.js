import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import App from './src/components/app.jsx';
import Gallery from './src/components/gallery.jsx';

class MightyThemesLibraryClass {
    constructor() {
        this.initiatedLibrary = false;
    }

    callback(mutationsList, observer) {

        var _libraryExists = document.getElementById('mighty-library');
        if( _libraryExists !== null && !this.initiatedLibrary) {
            this.initiatedLibrary = true;
            ReactDOM.render(<App /> , document.getElementById('mighty-library'));
        } else {
            this.initiatedLibrary = false;
        }

        var _galleryExists = document.getElementsByClassName('mighty-photos-browser');
        if( _galleryExists !== null && Object.entries(_galleryExists).length > 0 ) {
            Array.from(_galleryExists).forEach(element => {
                ReactDOM.render(<Gallery /> , element);
            });
        }
    };
    
    init() {
        const observer = new MutationObserver(this.callback);
        observer.observe(document, { attributes: true, childList: true, subtree: true });
    };
};

var MightyThemesLibrary = new MightyThemesLibraryClass();
MightyThemesLibrary.init();