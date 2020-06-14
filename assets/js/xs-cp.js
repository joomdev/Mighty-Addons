( function ( $ ) {
    // XD Local Storage
    xdLocalStorage.init(
        {
            iframeUrl: xscp.xdScript,
            initCallback: function () { /* ain't nothin but a g thang */ }
        }
    );

    function getUniqueId( elements ) {
        elements.forEach( function( item, index ) {
            item.id = elementor.helpers.getUniqueID();
            if( item.elements.length > 0 ) {
                getUniqueId( item.elements );
            }
        } );
        return elements;
    }

    function importContent( newWidget, elementCode, container ) {

        var elementCodeStringify = JSON.stringify(elementCode);
        var containsMedia = /png|gif|webp|tiff|psd|raw|bmp|heif|svg|jpg/.test(elementCodeStringify);
        
        if ( containsMedia ) {
            fetch(MightyLibrary.ajaxurl, {
                method: 'POST',
                headers: new Headers({'Content-Type': 'application/x-www-form-urlencoded'}),
                body: 'action=elementor_fetch_copy_paste_data&data=' + elementCodeStringify
            })
            .then(response => response.json())
            .then((tmpl) => {
    
                var newWidget = {};
                newWidget.elType = tmpl.data[0].elType;
                newWidget.settings = tmpl.data[0].settings;
                newWidget.elements = tmpl.data[0].elements;
    
                $e.run( "document/elements/create", {
                    model: newWidget,
                    container: container
                });
            })
            .catch(function(error) {
                console.log('Something went wrong!');
                console.log(JSON.stringify(error));
            });
        } else {
            $e.run( "document/elements/create", {
                model: newWidget,
                container: container,
            });
        }

        // TODO: add toast for paste notice
        console.log('pasted');
    }

    function pasteElement( newElement, element ) {

        // Original element
        var ogElement = element;
        var ogElementType = element.model.get( "elType" );
        
        // Copied Element
        var elementType = newElement.elementCode.elType;
        var elementCode = newElement.elementCode;
        
        var newWidget = {
            elType: elementType,
            settings: elementCode.settings
        };
        var container;

        switch( elementType ) {
            case 'section':
                newWidget.elements = getUniqueId( elementCode.elements );
                container = elementor.getPreviewContainer();
                break;
            case 'column':
                newWidget.elements = getUniqueId( elementCode.elements );
                switch( ogElementType ){
                    case 'widget':
                        container = ogElement.getContainer().parent.parent;
                        break;
                    case 'column':
                        container = ogElement.getContainer().parent;
                        break;
                    case 'section':
                        container = ogElement.getContainer();
                        break;
                }
                break;
            case 'widget':
                newWidget.widgetType = newElement.elementType;
                container = ogElement.getContainer();
                switch( ogElementType ) {
                    case 'widget':
                        container = ogElement.getContainer().parent;
                        ogElementType.index = ogElement.getOption( "_index" ) + 1;
                        break;
                    case 'column':
                        container = ogElement.getContainer();
                        break;
                    case 'section':
                        container = ogElement.children.findByIndex(0).getContainer();
                        break;
                }
                break;
        }

        importContent( newWidget, elementCode, container );
    }


    var copyType = [ 'widget', 'column', 'section' ];
    var allElements = [];

    copyType.forEach( function( item, index ) {
        elementor.hooks.addFilter( 'elements/' + copyType[index] + '/contextMenuGroups', function ( groups, element ) {
            allElements.push(element);

            groups.push({
                name: "mt_" + copyType[index],
                actions: [
                    {
                        name: 'ma_copy',
                        title: xscp.copy,
                        callback: function () {
                            var copiedElement = {};
                            copiedElement.elementType = copyType[index] == "widget" ? element.model.get( "widgetType" ) : null;
                            copiedElement.elementCode = element.model.toJSON();
                            xdLocalStorage.setItem( 'mighty-xscp-element', JSON.stringify(copiedElement), function (data) {
                                console.log('copied');
                                // TODO: add toast for copied notice
                            });
                        }
                    },
                    {
                        name: 'ma_paste',
                        title: xscp.paste,
                        callback: function () {
                            xdLocalStorage.getItem( 'mighty-xscp-element', function ( newElement ) {
                                pasteElement( JSON.parse( newElement.value ), element );
                            });
                        }
                    },
                    {
                        name: 'ma_copy_all',
                        title: xscp.copy_all,
                        callback: function () {
                            var allSections = [];
                            allElements.forEach(elem => {
                                if ( elem.container.type == "section" ) {
                                    var sect = elem.model.toJSON();
                                    if ( sect.isInner === false && sect.elements.length ) {
                                        allSections.push( elem.model.toJSON() );
                                    }
                                }
                            });

                            xdLocalStorage.setItem( 'mighty-xscp-page-sections', JSON.stringify(allSections), function (data) {
                                // TODO: add toast for copied notice
                                console.log('copied page');
                            });
                        }
                    },
                    {
                        name: 'ma_paste_all',
                        title: xscp.paste_all,
                        callback: function () {
                            xdLocalStorage.getItem( 'mighty-xscp-page-sections', function ( newElement ) {
                                var copiedSections = JSON.parse( newElement.value );
                                copiedSections.forEach(elem => {
                                    // Copied Element
                                    var newSection = {};
                                    var elementType = "section";
                                    var newSection = {
                                        elType: elementType,
                                        settings: elem.settings
                                    };
                                    newSection.elements = getUniqueId( elem.elements );
                                    var container = elementor.getPreviewContainer();
                                    
                                    var newSection = $e.run( "document/elements/create", {
                                        model: newSection,
                                        container: container,
                                    });
                                });

                                console.log('pasted page');
                                
                            });
                        }
                    },
                ]
            });
            return groups;
        });
    });

} )( jQuery );