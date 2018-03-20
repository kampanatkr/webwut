// script for auto toggle input when checkbox is marked
$(document).ready(function () {
    $('#map').on('click', function () {
        // if this certain element exists, get the text
        console.log($('#map').find($(this)).text());
    });
});