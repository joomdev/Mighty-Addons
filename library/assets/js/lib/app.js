import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import App from './src/components/app.jsx';

class MightyThemesLibraryClass{
    constructor(){
        this.initiated = false;
    }
    callback(mutationsList, observer){
        var _exists = document.getElementById('mighty-library');
        if( _exists !== null && !this.initiated) {
            this.initiated = true;
            ReactDOM.render(<App /> , document.getElementById('mighty-library'));
        }else{
            this.initiated = false;
        }
    };
    init(){
        const observer = new MutationObserver(this.callback);
        observer.observe(document, { attributes: true, childList: true, subtree: true });
    };
};

var MightyThemesLibrary = new MightyThemesLibraryClass();
MightyThemesLibrary.init();