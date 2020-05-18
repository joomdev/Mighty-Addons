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
                            var el = JSON.parse( localStorage.getItem('element-key') );
                            console.log(JSON.stringify(el));
                        }
                    }
                ]
            });
            return groups;
        });
    });

} )( jQuery );