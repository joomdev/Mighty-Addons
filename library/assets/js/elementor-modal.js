/* global elementor, elementorCommon */
/* eslint-disable */
"undefined" != typeof jQuery && function ( $ ) {
    $(function () {
        function showStuff() {
			
            if (elementorCommon) {
                
                window.mightyModal || (window.mightyModal = elementorCommon.dialogsManager.createWidget(
                    "lightbox", {
                        id: "mighty-library-modal",
                        headerMessage: !1,
                        message: "",
                        hide: {
                            auto: !1,
                            onClick: !1,
                            onOutsideClick: !1,
                            onOutsideContextMenu: !1,
                            onBackgroundClick: !0
                        },
                        position: {
                            my: "center",
                            at: "center"
                        },
                        onShow: function () {
                            var content = window.mightyModal.getElements("content");
                            if( content.html() === '' ) {
                                content.html('<div id="mighty-library"></div>');
                            }
                        },
                        onHide: function () {}
                }), window.mightyModal.getElements("header").remove(), 
                window.mightyModal.getElements("message").append(window.mightyModal.addElement("content"))), 
                window.mightyModal.show()
            }
            
        }
        window.mightyModal = null;
        var btn = $("#tmpl-elementor-add-section");

        if ( 0 < btn.length && MightyAddonsModal.enableLibrary !== "on" ) {
            var btnText = btn.text();
            btnText = btnText.replace('<div class="elementor-add-section-drag-title', '<div class="elementor-add-section-area-button elementor-add-mighty-button" title="Mighty Library"> <i class="fa fa-folder"></i> </div><div class="elementor-add-section-drag-title'),
            btn.text(btnText), elementor.on("preview:loaded", function () {
                $(elementor.$previewContents[0].body).on("click", ".elementor-add-mighty-button", showStuff)
            })
        }

        // Updating pro widgets stub button functcionality
        if ( undefined !== window.elementor.panel ) {

            parent.document.addEventListener( "mousedown", function( e ) {
				var widgets = parent.document.querySelectorAll( ".elementor-element--promotion" );

				if (widgets.length > 0) {
					for (var i = 0; i < widgets.length; i++) {

						if ( widgets[i].contains( e.target ) ) {
							
                            var icon = widgets[i].querySelector( ".icon > i" );
							var dialog = parent.document.querySelector( "#elementor-element--promotion__dialog" );

							if ( icon.classList.toString().indexOf( "mf" ) >= 0 ) {
								dialog.querySelector(".dialog-buttons-action").style.display = "none";

								if ( dialog.querySelector(".ma-dialog-cta") === null ) {

									var ctaBtn = document.createElement("button");
									ctaBtn.setAttribute( "onclick", "window.open('https://mightythemes.com/mighty-addons/pricing/')" );
									ctaBtn.setAttribute( "class", "ma-dialog-cta dialog-button dialog-action dialog-buttons-action elementor-button elementor-button-success" );
									ctaBtn.textContent = "Upgrade Mighty Addons 🚀";

									dialog.querySelector( ".dialog-buttons-wrapper" ).appendChild( ctaBtn );
								} else {
									dialog.querySelector( ".ma-dialog-cta" ).style.display = "";
								}
							} else {
								dialog.querySelector( ".dialog-buttons-action" ).style.display = "";

								if (dialog.querySelector( ".ma-dialog-cta" ) !== null) {
									dialog.querySelector( ".ma-dialog-cta" ).style.display = "none";
								}
							}
						}
					}
				}
			});

        }
        
    })
}(jQuery);
