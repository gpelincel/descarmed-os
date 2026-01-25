import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";
import Datepicker from "flowbite-datepicker/Datepicker";
import pt from "../../node_modules/flowbite-datepicker/js/i18n/locales/pt-BR";
import IMask from "imask";
import Choices from "choices.js";
import "choices.js/public/assets/styles/choices.css";
import "./components/agenda.js";
import "./components/clientes.js";
import "./components/equipamento.js";
import "./components/os.js";
import "./components/config.js"

window.Alpine = Alpine;

Alpine.start();

const datepickerEls = document.querySelectorAll(".datepicker");
Datepicker.locales.pt = pt["pt-BR"];

datepickerEls.forEach((e) => {
    new Datepicker(e, {
        language: "pt-BR",
        format: "dd/mm/yyyy",
    });
});

document.querySelectorAll(".telefone-input").forEach((e) => {
    IMask(e, {
        mask: "(00) 9 0000-0000",
    });
});

document.querySelectorAll(".cep-input").forEach((e) => {
    IMask(e, {
        mask: "00000-000",
    });
});

document.querySelectorAll(".cnpj-input").forEach((e) => {
    IMask(e, {
        mask: "00.000.000/0000-00",
    });
});

    

let classSelect =
    "choices bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 mb-0";
classSelect = classSelect.split(" ");

const clienteSelect = document.querySelectorAll(".select-cliente");

if (clienteSelect) {
    clienteSelect.forEach((e) => {
        e.choices = new Choices(e, {
            searchEnabled: true,
            shouldSort: false,
            placeholder: true,
            placeholderValue: "- Selecione -",
            itemSelectText: "",
            classNames: {
                containerOuter: "choices",
                containerInner: classSelect,
                input: "choices__input",
                listDropdown: "choices__list--dropdown",
                itemSelectable: "choices__item--selectable",
            },
        });
    });
}