import './bootstrap';
import 'flowbite';
import Alpine from 'alpinejs';
import Datepicker from "flowbite-datepicker/Datepicker";
import pt from "../../node_modules/flowbite-datepicker/js/i18n/locales/pt-BR";

window.Alpine = Alpine;

Alpine.start();


const datepickerEl = document.getElementById('default-datepicker');
Datepicker.locales.pt = pt['pt-BR'];

new Datepicker(datepickerEl, {
   language: 'pt-BR',
   format: 'dd/mm/yyyy'
});

