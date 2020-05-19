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

    function pasteElement( newElement, element ) {

        // Original element
        var ogElement = element;
        var ogElementType = element.model.get( "elType" );
        
        // Copied Element
        var elementType = newElement.elementCode.elType;
        var elementCode = newElement.elementCode;
        // var elements = elementCode.elements;
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

        
        var new_element = $e.run( "document/elements/create", {
            model: newWidget,
            container: container,
        });
        
        // TODO: add toast for paste notice
        console.log('pasted');
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
                            xdLocalStorage.setItem( 'mighty-xscp-element', JSON.stringify(copiedElement), function (data) {
                                console.log('copied');
                                // TODO: add toast for copied notice
                            });
                        }
                    },
                    {
                        name: 'paste',
                        title: "MT Paste",
                        callback: function () {
                            xdLocalStorage.getItem( 'mighty-xscp-element', function ( newElement ) {
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