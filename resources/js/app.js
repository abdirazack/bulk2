import './bootstrap';
import Alpine from 'alpinejs'
import $ from 'jquery'
window.$ = window.jQuery = $;
import select2 from 'select2';
select2();

// window.Alpine = Alpine
 
// Alpine.start()

$(document).ready(function() {
    console.log('jquery is working');
    $('.select2').select2(
        {
            width: '100',
            theme: 'bootstrap4',
            placeholder: 'Select an option',
        }
    );
;

});