function toBRL(valor) {
    return valor.toLocaleString("pt-BR", {
        style: "currency",
        currency: "BRL",
    });
}

document.querySelector("#id_cliente").addEventListener("change", (event) => {
    let id_cliente = event.target.value;
    let form = event.target.form;
    verifyClienteID(id_cliente, form);
});

verifyClienteID(
    document.querySelector("#id_cliente").value,
    document.querySelector("#formCadOS")
);

function verifyClienteID(id_cliente, form, selected = null) {
    var select = form.id_equipamento;

    if (id_cliente !== "") {
        fetch("/cliente/equipamento/" + id_cliente)
            .then((response) => response.json())
            .then((result) => {
                select.innerHTML = "";

                if (result.length > 0) {
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
                    select.innerHTML = `<option value="" selected="">- Nenhum equipamento cadastrado -</option>`;
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

            form.id_cliente.choices.setChoiceByValue(String(result.equipamento.id_cliente));

            verifyClienteID(
                result.equipamento.id_cliente,
                formUpdate,
                result.id_equipamento
            );

            form.titulo.value = result.titulo;
            form.id_status.value = result.id_status;
            // form.id_cliente.value = result.equipamento.id_cliente;
            form.descricao.value = result.descricao;
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
            let cliente = equipamento.cliente;
            let endereco = cliente.endereco;

            document.querySelector("#cnpj-cliente").innerHTML = cliente.cnpj;
            document.querySelector("#telefone-cliente").innerHTML =
                cliente.telefone;
            document.querySelector("#email-cliente").innerHTML = cliente.email;
            document.querySelector(
                "#endereco-cliente"
            ).innerHTML = `${endereco.cidade}/${endereco.estado} - ${endereco.cep} - ${endereco.logradouro}  Nº ${endereco.numero}`;

            document.querySelector("#os_id").value = id;
            document.querySelector("#titulo-os").innerHTML = result.titulo;
            document.querySelector("#cliente-os").innerHTML =
                equipamento.cliente.nome;
            document.querySelector("#descricao-os").innerHTML =
                result.descricao;
            document.querySelector("#id-equipamento-os").innerHTML =
                equipamento.codigo;
            document.querySelector("#nome-equipamento-os").innerHTML =
                equipamento.nome;
            document.querySelector("#status-os").innerHTML =
                result.status.descricao;
            document.querySelector("#data-inicio-os").innerHTML = new Date(
                result.data_inicio
            ).toLocaleDateString("pt-BR");
            document.querySelector("#data-conclusao-os").innerHTML = new Date(
                result.data_conclusao
            ).toLocaleDateString("pt-BR");
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