import "./libs/trix";
import './bootstrap';
import 'preline';
import Toastify from 'toastify-js';
import "toastify-js/src/toastify.css";

window.Toastify = Toastify;

import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";

window.flatpickr = flatpickr;

document.addEventListener('DOMContentLoaded', function () {
    flatpickr(".datepicker", {
        dateFormat: "Y-m-d",
        allowInput: true
    });
    flatpickr(".timepicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        allowInput: true
    });
});