( function ( $ ) {
    // XD Local Storage
    xdLocalStorage.init(
        {
            iframeUrl: xscp.xdScript,
            //an option function to be called right after the iframe was loaded and ready for action
            initCallback: function () {
                console.log('Got iframe ready');
            }
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

    function pasteElement( newElement, element ) {

        // Original element
        var ogElement = element;
        var ogElementType = element.model.get( "elType" );
        var elementLocation = {
            index: 0
        };
        
        // Copied Element
        var elementType = newElement.elementCode.elType;
        var elementCode = newElement.elementCode;
        // var elements = elementCode.elements;
        var newWidget = {
            elType: elementType,
            settings: elementCode.settings
        };
        var container;

        switch( elementType ){
            case 'section':
                console.log('section');
                newWidget.elements = getUniqueId( elementCode.elements );
                container = elementor.getPreviewContainer();
                switch( ogElementType ){
                    case 'widget':
                        elementLocation.index = ogElement.getContainer().parent.parent.view.getOption( "_index" ) + 1;
                        break;
                    case 'column':
                        elementLocation.index = ogElement.getContainer().parent.view.getOption( "_index" ) + 1;
                        break;
                    case 'section':
                        elementLocation.index = ogElement.getOption( "_index" ) + 1;
                        break;
                }
                break;
            case 'column':
                console.log('column');
                newWidget.elements = getUniqueId( elementCode.elements );
                switch( ogElementType ){
                    case 'widget':
                        container = ogElement.getContainer().parent.parent;
                        elementLocation.index = ogElement.getContainer().parent.view.getOption( "_index" ) + 1;
                        break;
                    case 'column':
                        container = ogElement.getContainer().parent;
                        elementLocation.index = ogElement.getOption( "_index" ) + 1;
                        break;
                    case 'section':
                        container = ogElement.getContainer();
                        break;
                }
                break;
            case 'widget':
                console.log('widget');
                newWidget.widgetType = newElement.elementType;
                container = ogElement.getContainer();
                switch( ogElementType ){
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

        
        var new_element = $e.run( "document/elements/create", {
            model: newWidget,
            container: container,
            options: elementLocation
        });
        
        console.log('done');
    }


    var copyType = [ 'widget', 'column', 'section' ];

    copyType.forEach( function( item, index ) {
        elementor.hooks.addFilter( 'elements/' + copyType[index] + '/contextMenuGroups', function ( groups, element ) {
            groups.push({
                name: "mt_" + copyType[index],
                actions: [
                    {
                        name: 'copy',
                        title: "MT Copy",
                        callback: function () {
                            var copiedElement = {};
                            copiedElement.elementType = copyType[index] == "widget" ? element.model.get( "widgetType" ) : null;
                            copiedElement.elementCode = element.model.toJSON();
                            xdLocalStorage.setItem( 'element-key', JSON.stringify(copiedElement), function (data) { console.log('copied') });
                        }
                    },
                    {
                        name: 'paste',
                        title: "MT Paste",
                        callback: function () {
                            xdLocalStorage.getItem( 'element-key', function ( newElement ) {
                                pasteElement( JSON.parse( newElement.value ), element );
                            });
                        }
                    }
                ]
            });
            return groups;
        });
    });

} )( jQuery );