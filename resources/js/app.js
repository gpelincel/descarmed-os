import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";
import Datepicker from "flowbite-datepicker/Datepicker";
import pt from "../../node_modules/flowbite-datepicker/js/i18n/locales/pt-BR";
import IMask from "imask";

window.Alpine = Alpine;

Alpine.start();

const datepickerEls = document.querySelectorAll(".datepicker");
Datepicker.locales.pt = pt["pt-BR"];

datepickerEls.forEach(e => {
    new Datepicker(e, {
        language: "pt-BR",
        format: "dd/mm/yyyy",
    });
})

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

document.querySelectorAll(".valor-input").forEach((e) => {
    const mask = IMask(e, {
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

    e.mask = mask;
});

