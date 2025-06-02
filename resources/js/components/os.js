import IMask from "imask";

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

document
    .querySelector("#btn-add-equipamento")
    .addEventListener("click", (event) => {
        event.preventDefault();

        let equipamento_form = document.querySelector("#equipamento-form-os");
        let novo = document.querySelector("#novo-eqp");

        novo.value = novo.value == "0" ? "1" : "0";
        document.querySelector("#id_equipamento").disabled = novo.value == "1";
        equipamento_form.classList.toggle("hidden");
    });

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
    <div class="grid grid-cols-[1fr_2fr_4fr_1fr] gap-2 col-span-3 item-fields">
    <input type="number" name="qtd_${counter + 1}" id="qtd_${counter + 1}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 valor-item"
        placeholder="0">
        <select id="id_unidade_${counter + 1}" name="id_unidade_${counter + 1}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            ${unidades}
        </select>
    <input type="text" name="nome_item_${counter + 1}" id="nome_item_${
        counter + 1
    }"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="Nome do item">
    <input type="text" name="preco_un_${counter + 1}" id="preco_un_${
        counter + 1
    }"
        class="valor-input valor-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="R$ 0,00">
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
    const inputsValor = container.querySelectorAll('input[name^="preco_un_"]');

    let total = 0;

    for (let i = 0; i < inputsQtd.length; i++) {
        const qtd = Number(inputsQtd[i].value) || 0;
        const precoInput = inputsValor[i];
        const valorUnitario = Number(precoInput.mask?.typedValue || 0);

        total += qtd * valorUnitario;
    }

    const inputTotal = container.querySelector('input[name="preco"]');
    if (inputTotal && inputTotal.mask) {
        inputTotal.mask.typedValue = total;
    } else if (inputTotal) {
        inputTotal.value = total.toFixed(2).replace(".", ",");
    }
}

function verifyClienteID(id_cliente, form, selected = null) {
    var select = form.id_equipamento;

    console.log(document.querySelector("#novo-eqp").value == "0");

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
                        unidades = select.innerHTML;
                    }

                    html += `
                        <div class="grid grid-cols-[1fr_2fr_4fr_1fr] gap-2 col-span-3 item-fields">
                        <input type="hidden" name="id_item_${
                            counter + 1
                        }" value="${item.id}">
                        <input type="number" name="qtd_${
                            counter + 1
                        }" id="qtd_${counter + 1}"
                            value="${item.quantidade}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 valor-item"
                            placeholder="0">
                        <select id="id_unidade_${
                            counter + 1
                        }" name="id_unidade_${counter + 1}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            ${unidades}
                        </select>
                        <input value="${
                            item.nome
                        }" type="text" name="nome_item_${
                        counter + 1
                    }" id="nome_item_${counter + 1}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Nome do item">
                        <input value="${
                            item.valor_unitario
                        }" type="text" name="preco_un_${
                        counter + 1
                    }" id="preco_un_${counter + 1}"
                            class="valor-input valor-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="R$ 0,00">
                    </div>
                    `;
                });

                document.querySelector("#items-field-update").innerHTML = html;

                addValorMask();

                items.map((item, counter) => {
                    if (document.querySelector("#preco_un_" + (counter + 1))) {
                        document.querySelector(
                            "#preco_un_" + (counter + 1)
                        ).mask.typedValue = item.valor_unitario;
                    }

                    if (document.querySelector("#id_unidade_" + (counter + 1))) {
                        document.querySelector(
                            "#id_unidade_" + (counter + 1)
                        ).options.selectedIndex = item.id_unidade;
                    }
                });
            } else {
                let unidades = ""
                if (document.querySelector("#id_unidade_1")) {
                        let select = document.querySelector("#id_unidade_1");
                        unidades = select.innerHTML;
                    }
                let html = `
                    <div class="grid grid-cols-[1fr_2fr_4fr_1fr] gap-2 col-span-3 item-fields">
                        <input type="number" name="qtd_1" id="qtd_1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 valor-item"
                            placeholder="0">
                        <select id="id_unidade_1" name="id_unidade_1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            ${unidades}
                        </select>
                        <input type="text" name="nome_item_1" id="nome_item_1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Nome do item">
                        <input type="text" name="preco_un_1" id="preco_un_1"
                            class="valor-input valor-item bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="R$ 0,00">
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
            if (result.preco) {
                form.preco.mask.unmaskedValue = result.preco;
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

            document.querySelector("#preco-os").innerHTML =
                toBRL(Number(result.preco)) ?? "N/A";

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
