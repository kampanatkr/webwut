$(document).ready(function () {

    $("#event-thumbnail").change(function () {
        previewPicture(this);
    });

    function previewPicture(input) {
        let imageViewer = $("#image-viewer");
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                imageViewer.attr('src', e.target.result);
                imageViewer.show();
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            imageViewer.attr('src', '');
            imageViewer.hide();
        }
    }
});