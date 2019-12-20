/* global elementor, elementorCommon */
/* eslint-disable */
"undefined" != typeof jQuery && function ( $ ) {
    $(function () {
        function showStuff() {
			alert('mighty library');
			
        }
        window.elementsModal = null;
        var n = $("#tmpl-elementor-add-section");
        if (0 < n.length) {
            var t = n.text();
            t = t.replace('<div class="elementor-add-section-drag-title', '<div class="elementor-add-section-area-button elementor-add-mighty-button" title="Mighty Library"> <i class="fa fa-folder"></i> </div><div class="elementor-add-section-drag-title'), n.text(t), elementor.on("preview:loaded", function () {
                $(elementor.$previewContents[0].body).on("click", ".elementor-add-mighty-button", showStuff)
            })
        }
    })
}(jQuery);
