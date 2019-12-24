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
                            // alert('show');
                            var content = window.mightyModal.getElements("content");
                            content.html('');
                            
                            content.html('<div id="mighty-library"></div>');
                        },
                        onHide: function () {
                            // alert('hide');
                            // var content = window.mightyModal.getElements("content");
                            // content.html('');
                            // var e = window.mightyModal.getElements("content");
                            // window.ElementsReact && 0 < e.length && window.ElementsReact.elementor3rdPartyViewClose(e.get(0)), window.location.hash = ""
                        }
                }), window.mightyModal.getElements("header").remove(), 
                window.mightyModal.getElements("message").append(window.mightyModal.addElement("content"))), 
                window.mightyModal.show()
            }
            
        }
        window.mightyModal = null;
        var n = $("#tmpl-elementor-add-section");
        if (0 < n.length) {
            var t = n.text();
            t = t.replace('<div class="elementor-add-section-drag-title', '<div class="elementor-add-section-area-button elementor-add-mighty-button" title="Mighty Library"> <i class="fa fa-folder"></i> </div><div class="elementor-add-section-drag-title'), n.text(t), elementor.on("preview:loaded", function () {
                $(elementor.$previewContents[0].body).on("click", ".elementor-add-mighty-button", showStuff)
            })
        }
    })
}(jQuery);
