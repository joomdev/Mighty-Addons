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
    })
}(jQuery);
