import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";
import Datepicker from "flowbite-datepicker/Datepicker";
import pt from "../../node_modules/flowbite-datepicker/js/i18n/locales/pt-BR";
import IMask from "imask";

window.Alpine = Alpine;

Alpine.start();

const datepickerEl = document.getElementById("default-datepicker");
Datepicker.locales.pt = pt["pt-BR"];

new Datepicker(datepickerEl, {
    language: "pt-BR",
    format: "dd/mm/yyyy",
});

const datetimepickerEl = document.getElementById("default-datetimepicker");
Datepicker.locales.pt = pt["pt-BR"];
new Datepicker(datetimepickerEl, {
    language: "pt-BR",
    format: "dd/mm/yyyy",
});

document.querySelectorAll(".telefone-input").forEach((e) => {
    IMask(e, {
        mask: "(00) 0000-0000",
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

document.querySelectorAll(".valor-input").forEach((e) => {
    IMask(e, {
        mask: "R$ num",
        blocks: {
            num: {
                mask: Number,
                thousandsSeparator: ".",
                radix: ",",
                scale: 2, // Define duas casas decimais
                signed: false,
                normalizeZeros: true,
                padFractionalZeros: true,
            },
        },
    });
});
