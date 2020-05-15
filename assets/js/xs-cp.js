var copyType = [ 'widget', 'column', 'section' ];

copyType.forEach( function( item, index ) {
    elementor.hooks.addFilter( 'elements/' + copyType[index] + '/contextMenuGroups', function ( groups, element ) {
        groups.push(
            {
                name: "mt_" + copyType[index],
                actions: [
                    {
                        name: 'copy',
                        title: "MT Copy",
                        callback: function () {
                            var copiedElement = {};
                            copiedElement.elementType = copyType[index] == "widget" ? element.model.get( "widgetType" ) : null;
                            copiedElement.elementCode = element.model.toJSON();
                            localStorage.removeItem('element-key');
                            localStorage.setItem( 'element-key', JSON.stringify(copiedElement) );
                            // console.log(JSON.stringify(copiedElement).length); // approx sixe of element
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
            }
        );
        return groups;
    });
});