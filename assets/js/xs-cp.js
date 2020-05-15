var element_type = [ 'widget', 'column', 'section' ];

element_type.forEach( function( item, index ) {
    elementor.hooks.addFilter( 'elements/' + element_type[index] + '/contextMenuGroups', function ( groups, element ) {
        groups.push(
            {
                name: "mt_" + element_type[index],
                actions: [
                    {
                        name: 'copy',
                        title: "MT Copy",
                        callback: function () {
                            console.log('copy');
                        }
                    },
                    {
                        name: 'paste',
                        title: "MT Paste",
                        callback: function () {
                            console.log('paste');
                        }
                    }
                ]
            }
        );
        return groups;
    });
});