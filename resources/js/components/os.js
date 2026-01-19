import IMask from "imask";
import Dropzone from "dropzone";

function toBRL(valor) {
    return valor.toLocaleString("pt-BR", {
        style: "currency",
        currency: "BRL",
    });
}

function addValorMask() {
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
}

addValorMask();

if (
    document.querySelector("#id_cliente").value &&
    document.querySelector("#formCadOS")
) {
    verifyClienteID(
        document.querySelector("#id_cliente").value,
        document.querySelector("#formCadOS")
    );
}

document.querySelector("#id_cliente").addEventListener("change", (event) => {
    let id_cliente = event.target.value;
    let form = event.target.form;
    verifyClienteID(id_cliente, form);
});

if (document.querySelector("#btn-add-equipamento-update")) {
    document
        .querySelector("#btn-add-equipamento-update")
        .addEventListener("click", (event) => {
            event.preventDefault();

            let equipamento_form = document.querySelector(
                "#equipamento-form-os-update"
            );
            let novo = document.querySelector("#novo-eqp");

            novo.value = novo.value == "0" ? "1" : "0";
            document.querySelector("#id_equipamento").disabled =
                novo.value == "1";
            equipamento_form.classList.toggle("hidden");
        });

    document
        .querySelector("#btn-add-equipamento")
        .addEventListener("click", (event) => {
            event.preventDefault();

            let equipamento_form = document.querySelector(
                "#equipamento-form-os"
            );
            let novo = document.querySelector("#novo-eqp");

            novo.value = novo.value == "0" ? "1" : "0";
            document.querySelector("#id_equipamento").disabled =
                novo.value == "1";
            equipamento_form.classList.toggle("hidden");
        });
}

function addItemField(event, update = false) {
    let items_id = "#items-field";
    let items_counter = "#item_counter";

    if (update) {
        items_id += "-update";
        items_counter += "_update";
    }

    let unidades = "";

    if (document.querySelector("#id_unidade_1")) {
        let select = document.querySelector("#id_unidade_1");
        unidades = select.innerHTML;
    }

    let counter = Number(document.querySelector(items_counter).value);

    let html = `
<div class="grid grid-cols-[1fr_4fr_2fr] gap-2 col-span-3 item-fields">

    <div class="col-span-3">
        <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Nome do item
        </h4>
        <textarea
            name="nome_item_${counter + 1}"
            id="nome_item_${counter + 1}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                   focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Nome do item"></textarea>
    </div>

    <div>
        <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Qtd.
        </h4>
        <input
            type="number"
            name="qtd_${counter + 1}"
            id="qtd_${counter + 1}"
            min="0"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                   focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 valor-item"
            placeholder="0">
    </div>

    <div>
        <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Und.
        </h4>
        <select
            id="id_unidade_${counter + 1}"
            name="id_unidade_${counter + 1}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                   focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            ${unidades}
        </select>
    </div>

    <div>
        <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Valor un.
        </h4>
        <input
            type="text"
            name="valor_un_${counter + 1}"
            id="valor_un_${counter + 1}"
            class="valor-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                   focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 valor-item"
            placeholder="R$ 0,00">
    </div>

</div>
`;

    document.querySelector(items_id).insertAdjacentHTML("beforeend", html);

    addValorMask();

    // Atualiza o contador
    document.querySelector(items_counter).value = counter + 1;
}

if (document.querySelector("#btn-add-item")) {
    document
        .querySelector("#btn-add-item")
        .addEventListener("click", (event) => {
            event.preventDefault();
            addItemField(event);
        });
}

if (document.querySelector("#btn-add-item-update")) {
    document
        .querySelector("#btn-add-item-update")
        .addEventListener("click", (event) => {
            event.preventDefault();
            addItemField(event, true);
        });
}

function atualizarTotalOS(container) {
    const inputsQtd = container.querySelectorAll('input[name^="qtd_"]');
    const inputsValor = container.querySelectorAll('input[name^="valor_un_"]');

    let total = 0;

    for (let i = 0; i < inputsQtd.length; i++) {
        const qtd = Number(inputsQtd[i].value) || 0;
        const valorInput = inputsValor[i];
        const valorUnitario = Number(valorInput.mask?.typedValue || 0);

        total += qtd * valorUnitario;
    }

    const inputTotal = container.querySelector('input[name="valor_total"]');
    if (inputTotal && inputTotal.mask) {
        inputTotal.mask.typedValue = total;
    } else if (inputTotal) {
        inputTotal.value = total.toFixed(2).replace(".", ",");
    }
}

function verifyClienteID(id_cliente, form, selected = null) {
    var select = form.id_equipamento;

    if (id_cliente !== "" && document.querySelector("#novo-eqp").value == "0") {
        fetch("/cliente/equipamento/" + id_cliente)
            .then((response) => response.json())
            .then((result) => {
                select.innerHTML = "";

                if (result.length > 0) {
                    select.innerHTML += `<option value="0" selected="">- Selecione um equipamento -</option>`;
                    result.forEach((equipamento) => {
                        select.innerHTML += `<option ${
                            selected && equipamento.id == selected
                                ? "selected"
                                : ""
                        } value="${equipamento.id}">${
                            equipamento.nome
                        }</option>`;
                    });

                    select.disabled = false;
                } else {
                    select.innerHTML = `<option value="0" selected="">- Nenhum equipamento cadastrado -</option>`;
                }
            });
    } else {
        select.disabled = true;
        document.querySelector(
            "#id_equipamento"
        ).innerHTML += `<option value="" selected="">- Selecione um cliente -</option>`;
    }
}

function openModalOSUpdate(id) {
    var formUpdate = document.querySelector("#formUpdateOS");
    let spinner = document.querySelector("#update-spinner");

    formUpdate.setAttribute("action", "/ordem-servico/update/" + id);
    formUpdate.classList.add("hidden");
    spinner.classList.remove("hidden");

    fetch("/ordem-servico/" + id)
        .then((response) => response.json())
        .then((result) => {
            let form = formUpdate.elements;
            let os_data = new Date(result.data).toLocaleString().split(",")[0];
            let items = result.items;

            verifyClienteID(
                result.id_cliente,
                formUpdate,
                result.id_equipamento
            );

            if (items.length > 0) {
                let html = "";

                document.querySelector("#item_counter_update").value =
                    items.length;

                items.map((item, counter) => {
                    let unidades = "";

                    if (document.querySelector("#id_unidade_1")) {
                        let select = document.querySelector("#id_unidade_1");
                        unidades = select;

                        for (let e of unidades.children) {
                            e.removeAttribute("selected");

                            if (Number(e.value) == item.id_unidade) {
                                e.setAttribute("selected", "");
                            }
                        }

                        unidades = unidades.innerHTML;
                    }

                    html += `
<div class="grid grid-cols-[1fr_4fr_2fr] gap-2 col-span-3 item-fields">

    <input type="hidden" name="id_item_${counter + 1}" value="${item.id}">

    <div class="col-span-3">
        <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Nome do item
        </h4>
        <textarea
            name="nome_item_${counter + 1}"
            id="nome_item_${counter + 1}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                   focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Nome do item">${item.nome}</textarea>
    </div>

    <div>
        <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Qtd.
        </h4>
        <input
            type="number"
            name="qtd_${counter + 1}"
            id="qtd_${counter + 1}"
            value="${item.quantidade}"
            min="0"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                   focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 valor-item"
            placeholder="0">
    </div>

    <div>
        <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Und.
        </h4>
        <select
            id="id_unidade_${counter + 1}"
            name="id_unidade_${counter + 1}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                   focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            ${unidades}
        </select>
    </div>

    <div>
        <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Valor un.
        </h4>
        <input
            type="text"
            name="valor_un_${counter + 1}"
            id="valor_un_${counter + 1}"
            value="${item.valor_unitario}"
            class="valor-input valor-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                   focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="R$ 0,00">
    </div>

</div>
`;
                });

                document.querySelector("#items-field-update").innerHTML = html;

                addValorMask();

                items.map((item, counter) => {
                    if (document.querySelector("#valor_un_" + (counter + 1))) {
                        document.querySelector(
                            "#valor_un_" + (counter + 1)
                        ).mask.typedValue = item.valor_unitario;
                    }
                });
            } else {
                let unidades = "";
                if (document.querySelector("#id_unidade_1")) {
                    let select = document.querySelector("#id_unidade_1");
                    unidades = select.innerHTML;
                }
                let html = `
<div class="grid grid-cols-[1fr_4fr_2fr] gap-2 col-span-3 item-fields">

    <div class="col-span-3">
        <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Nome do item
        </h4>
        <textarea
            name="nome_item_1"
            id="nome_item_1"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                   focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="Nome do item"></textarea>
    </div>

    <div>
        <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Qtd.
        </h4>
        <input
            type="number"
            name="qtd_1"
            id="qtd_1"
            min="0"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                   focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 valor-item"
            placeholder="0">
    </div>

    <div>
        <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Und.
        </h4>
        <select
            id="id_unidade_1"
            name="id_unidade_1"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                   focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            ${unidades}
        </select>
    </div>

    <div>
        <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            Valor un.
        </h4>
        <input
            type="text"
            name="valor_un_1"
            id="valor_un_1"
            class="valor-input valor-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                   focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                   dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            placeholder="R$ 0,00">
    </div>

</div>
`;

                document.querySelector("#items-field-update").innerHTML = html;
                document.querySelector("#item_counter_update").value = 1;

                addValorMask();
            }

            form.titulo.value = result.titulo;
            form.id_status.value = result.id_status ?? 0;
            form.id_cliente.choices.setChoiceByValue(String(result.id_cliente));
            form.descricao.value = result.descricao;
            form.codigo_compra.value = result.codigo_compra;
            form.nota_fiscal.value = result.nota_fiscal;
            if (result.data_conclusao) {
                form.data_conclusao.value = result.data_conclusao
                    .replaceAll("-", "/")
                    .split("/")
                    .reverse()
                    .join("/");
            }
            form.data_inicio.value = result.data_inicio
                .replaceAll("-", "/")
                .split("/")
                .reverse()
                .join("/");
            form.id_classificacao.value = result.id_classificacao;
            if (result.valor_total) {
                form.valor_total.mask.unmaskedValue = result.valor_total;
            }

            formUpdate.classList.remove("hidden");
            spinner.classList.add("hidden");
        });
}

function openModalRead(id) {
    let modal_content = document.querySelector("#preview-content");
    let spinner = document.querySelector("#preview-spinner");

    document.querySelector("#btn-imprimir").href = `/imprimir/${id}`;

    spinner.classList.add("flex");
    spinner.classList.remove("hidden");
    modal_content.classList.add("hidden");

    fetch("/ordem-servico/" + id)
        .then((response) => response.json())
        .then((result) => {
            let equipamento = result.equipamento;
            let cliente = result.cliente;
            let endereco = cliente.endereco;

            document.querySelector("#cnpj-cliente").innerHTML =
                cliente.cnpj ?? "N/A";
            document.querySelector("#telefone-cliente").innerHTML =
                cliente.telefone ?? "N/A";
            document.querySelector("#email-cliente").innerHTML =
                cliente.email ?? "N/A";
            document.querySelector("#endereco-cliente").innerHTML = `${
                endereco.cidade
                    ? endereco.cidade + "/" + endereco.estado
                    : "N/A"
            } - ${endereco.cep ?? "N/A"} - ${
                endereco.logradouro ?? "N/A"
            }  Nº ${endereco.numero ?? "N/A"}`;

            document.querySelector("#os_id").value = id;
            document.querySelector("#titulo-os").innerHTML = result.titulo;
            document.querySelector("#cliente-os").innerHTML = cliente.nome;
            document.querySelector("#descricao-os").innerHTML =
                result.descricao;

            document.querySelector("#codigo-compra-os").innerHTML =
                result.codigo_compra ?? "N/A";
            document.querySelector("#nota-fiscal-os").innerHTML =
                result.nota_fiscal ?? "N/A";

            if (equipamento) {
                document.querySelector("#equipamento-container").hidden = false;
                document.querySelector("#nome-equipamento-os").innerHTML =
                    equipamento.nome;
                document.querySelector(
                    "#numero-serie-equipamento-os"
                ).innerHTML = equipamento.numero_serie;
                document.querySelector(
                    "#numero-patrimonio-equipamento-os"
                ).innerHTML = equipamento.numero_patrimonio;
                document.querySelector("#id-equipamento-os").innerHTML =
                    equipamento.id;
            } else {
                document.querySelector("#equipamento-container").hidden = true;
            }

            if (result.status) {
                document.querySelector("#status-container").hidden = false;
                document.querySelector("#status-os").innerHTML =
                    result.status.descricao;
            } else {
                document.querySelector("#status-container").hidden = true;
            }

            if (result.items.length > 0) {
                document.querySelector("#items-container").hidden = false;
                document.querySelector("#items-table").innerHTML = "";
                result.items.map((e) => {
                    document.querySelector("#items-table").innerHTML += `
                    <tr>
                        <td>${e.quantidade}</td>
                        <td>${e.unidade ? e.unidade.descricao : "N/A"}</td>
                        <td>${e.nome}</td>
                        <td>${toBRL(e.valor_unitario)}</td>
                    </tr>
                    `;
                });
            } else {
                document.querySelector("#items-container").hidden = true;
            }

            console.log(result.anexos, result.anexos.length);

            if (result.anexos.length > 0) {
                document.querySelector("#anexos-container").hidden = false;
                let grid = document.querySelector("#anexos-grid");
                grid.innerHTML = "";

                result.anexos.map(anexo => {
                    let image = new Image();
                    image.src = anexo.url;
                    image.className = 'w-full rounded-md object-cover';
                    grid.appendChild(image);
                })
            }

            document.querySelector("#data-inicio-os").innerHTML = new Date(
                result.data_inicio
            ).toLocaleDateString("pt-BR");

            if (result.data_conclusao) {
                document.querySelector(
                    "#data-conclusao-container"
                ).hidden = false;
                document.querySelector("#data-conclusao-os").innerHTML =
                    new Date(result.data_conclusao).toLocaleDateString("pt-BR");
            } else {
                document.querySelector(
                    "#data-conclusao-container"
                ).hidden = true;
            }

            document.querySelector("#classificacao-os").innerHTML =
                result.classificacao.descricao;

            document.querySelector("#valor_total-os").innerHTML =
                toBRL(Number(result.valor_total)) ?? "N/A";

            addDeleteButton(id);

            spinner.classList.remove("flex");
            spinner.classList.add("hidden");
            modal_content.classList.remove("hidden");
        });
}

function addDeleteButton(id) {
    document
        .querySelector(".delete-button")
        .addEventListener("click", openModalDelete(id));
}

function openModalDelete(id) {
    let formDelete = document.querySelector("#formDelete");
    formDelete.setAttribute("action", "/ordem-servico/delete/" + id);
}

document.addEventListener("click", (e) => {
    if (e.target.matches(".btn-read-os")) {
        openModalRead(e.target.dataset.id);
    }
    if (e.target.matches(".btn-delete-os")) {
        openModalDelete(e.target.dataset.id);
    }
    if (e.target.matches(".btn-update-os")) {
        openModalOSUpdate(e.target.dataset.id);
    }
});

document.addEventListener("change", (event) => {
    if (event.target.matches(".valor-item")) {
        atualizarTotalOS(event.target.form);
    }
});

Dropzone.autoDiscover = false;

const previewContainer = document.getElementById("anexos-preview");
const dz = new Dropzone("#anexos-dropzone", {
    url: "/", // não usado
    autoProcessQueue: false,
    clickable: true,
    previewsContainer: previewContainer,
    acceptedFiles: "image/*",
    previewTemplate: `
        <div class="flex flex-col">
            <img data-dz-thumbnail class="w-full object-cover rounded mb-2">
            <button data-dz-remove class="dz-remove text-white focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded text-sm px-2 py-1 text-center bg-red-600 hover:bg-red-700 dark:focus:ring-primary-800">
                Remover
            </button>
        </div>
    `,
});

// Função auxiliar: converte File em Base64
function fileToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = () => {
            const base64String = reader.result.split(",")[1]; // remove "data:image/png;base64,"
            resolve({
                format: file.type.split("/")[1] || "png",
                data: base64String,
            });
        };
        reader.onerror = (err) => reject(err);
        reader.readAsDataURL(file);
    });
}

const form = document.querySelector("#formCadOS");

form.addEventListener("submit", async function (e) {
    e.preventDefault(); // previne submit normal

    const formData = new FormData(form);

    // Converte todos os arquivos do Dropzone para Base64
    const base64Files = await Promise.all(dz.files.map(file => fileToBase64(file)));

    // Adiciona como JSON no FormData
    formData.set("images", JSON.stringify(base64Files));

    fetch(form.action, {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": document.querySelector("input[name=_token]").value,
        },
    })
    .then(res => res.json())
    .then(data => {
        location.reload();
    });
});
