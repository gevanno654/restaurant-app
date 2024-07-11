import $ from 'jquery';
import 'bootstrap-input-spinner';

$(document).ready(function () {
    $("input[type='number']").inputSpinner({
        decrementButton: "<strong>-</strong>", // Custom decrement button
        incrementButton: "<strong>+</strong>", // Custom increment button
        groupClass: "input-group-prepend",
        buttonsClass: "btn-outline-secondary",
        buttonsWidth: "2.5rem",
        textAlign: "center"
    });
});
