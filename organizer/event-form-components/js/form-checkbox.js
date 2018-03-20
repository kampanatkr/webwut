// script for auto toggle input when checkbox is marked
$(document).ready(function () {
    let freeCheckbox = $('#attending-cost-free-checkbox');
    let acInput = $('#attending-cost');
    let ageCheckbox = $('#age-checkbox');
    let ageInput = $('#age');

    // if free checkbox is checked, wipe data and disable an input box
    freeCheckbox.on('click', function () {
        if ($(this).prop('checked')) {
            disableCheckbox(acInput);
        } else {
            enableCheckbox(acInput);
        }
    });

    // if age is checked, wipe data and disable an input box
    ageCheckbox.on('click', function () {
        if ($(this).prop('checked')) {
            disableCheckbox(ageInput);
        } else {
            enableCheckbox(ageInput);
        }
    });
});

function disableCheckbox(checkbox) {
    checkbox.val('');
    checkbox.prop('disabled', true);
}

function enableCheckbox(checkbox) {
    checkbox.prop('disabled', false);
}