(function ( $ ) {
    if ("undefined" != typeof wp && wp.media) {

        var e = wp.media.view.MediaFrame.Select,
            i = (wp.media.controller.Library, wp.media.view.l10n),
            t = wp.media.view.Frame,
            o = null,
            tabTitle = "Mighty Photos",
            defaultSearchTerm = "Cats";

        wp.media.view.MightyAddons_AttachmentsBrowser = t.extend({
            tagName: "div",
            className: "mighty-photos-browser mightyaddons-pixabay",
            initialize: function () {
                o = this
            }
        }), e.prototype.browseRouter = function (e) {
            var t = {};
            t.upload = {
                text: i.uploadFilesTitle,
                priority: 20
            }, t.browse = {
                text: i.mediaLibraryTitle,
                priority: 40
            }, t.mightygallery = {
                text: tabTitle,
                priority: 61
            }, e.set(t)
        }, e.prototype.mightygallery = function (e) {
            var t = this.state();
            e.view = new wp.media.view.MightyAddons_AttachmentsBrowser({
                controller: this,
                model: t,
                AttachmentView: t.get("AttachmentView")
            })
        }

        // Renders the content
        function renderView() {
            var html = '<div id="mighty-extension-pixabay">';

            html += '<form id="mighty-px-extension" name="mighty-px-extension" method="POST" action="" enctype="multipart/form-data">';
            html += '<input type="url" name="newfilename" id="src"  multiple="false" />';
            html += '<button type="submit" class="button media-button button-primary button-large media-button-select">Upload</button>';
            html += '</form>';

            html += '<div id="image-details">';
            html += '</div>';

            html += "<h1>Pixabay</h1>";
            html += "<input class='pixabay-input' value='"+ defaultSearchTerm +"' type='text' placeholder='Search for your fav' name='pixabay-input' />";
            html += "<br>";
            html += "<button type='submit' class='button button-px-search'>Search</button>";
            html += "<div class='search-results'>";
            html += '</div>';
            html += '</div>';
            $('body .media-modal-content .media-frame-content')[0].innerHTML = html;
        }

        // Fetches stuff
        function getImages( searchTerm ) {
            $('.search-results').html('Fething results for you..');
            $.ajax({
                type: 'GET',
                // url: '#', // Hidden for security purpose 🙈,
                success: function(response) {
                    if ( response ) {
                        console.log(response.data.images);
                        $('.search-results').html('');
                        $.each( response.data.images, function( key, value ) {
                            $('.search-results').append("<img draggable='false' data-id='" + response.data.images[key].id + "' data-url='" + response.data.images[key].url + "' class='px-image-obj' src='"+response.data.images[key].preview+"' />");
                        });
                    } else {
                        console.log('#212 Something went wrong! Can\'t fetch details.');
                    }
                }
            });
        }

        // function uploadImage() {
            
        //     var type = this.$('[data-setting="format"] :checked').val(),
        //         suffix = thepaste.options.mime_types.convert[ type ],
        //         name = this.$('input[data-setting="title"]').val() + '.' + suffix,
        //         blob = this.image.getAsBlob( type, thepaste.options.jpeg_quality );
            

        //     this.bindUploaderEvents();

        //     blob.detach( blob.getSource() );
        //     blob.name = name;
        //     blob.type = type;
        //     this.getUploader().addFile( blob , name );

        //     this.disabled( true );

        //     this.trigger( 'action:upload:dataimage' , this );
        // }

        function saveImage(settings) {
            $.ajax({
                url: settings.ajaxurl,
                type: 'post',
                data: {
                    action: 'save_mighty_extension_media',
                    security: settings.nonce,
                    fields: $('form#mighty-px-extension').serialize(),
                    postid: settings.postId,
                },
                success: function(response) {
                    console.log(response);
                    console.log('successfully saved!');
                    // uploadImage();
                },
                error: function() {
                    console.log('#212 Something went wrong!');
                }
            });
        }


        //
        // Inits & Event Listeners
        //

        $(document).ready(function($){
            if ( wp.media ) {
                wp.media.view.Modal.prototype.on( "open", function() {
                    // Renders on Media Manager instance
                    if($('body').find('.mighty-photos-browser .mightyaddons-pixabay').html() == tabTitle) {
                        renderView();
                        getImages(defaultSearchTerm);
                    } else {
                        console.warn('Pixabay Instance not found.');
                    }
                });

                // Renders on Tab Click Event Trigger
                $(wp.media).on('click', '.media-frame-router .media-menu-item', function(e){
                    if(e.target.innerText == tabTitle) {
                        renderView();
                        getImages(defaultSearchTerm);
                    }
                });

                // Fetches search results on Search Event trigger
                $(document).on('click', '#mighty-extension-pixabay .button-px-search', function(){
                    var searchTerm = $('.pixabay-input').val();
                    getImages(searchTerm);
                });

                // Click event on image
                $(document).on('click', '#mighty-extension-pixabay .search-results .px-image-obj', function() {
                    var imageId = $(this).data('id');
                    var image = $(this).data('url');
                    
                    o.model.get("selection").add(data.attachmentData),
                    o.model.frame.trigger("library:selection:add"),
                    $(".media-frame .media-button-select").click(),
                    alert('done')
                });

                $(document).on('submit', 'form#mighty-px-extension', function (e) {
                    e.preventDefault();
                    saveImage(MightyExtensions);
                });

            }
        });
    }
})( jQuery );