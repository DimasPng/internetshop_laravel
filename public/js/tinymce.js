document.addEventListener("DOMContentLoaded", function () {
    initTinyMCE();

});
function initTinyMCE() {
    tinymce.init({
        selector: 'textarea.tinymce',
    });
}
