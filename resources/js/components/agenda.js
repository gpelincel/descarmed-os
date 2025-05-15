function openAgendaModalRead(id) {
    let modal_content = document.querySelector("#preview-content-agenda");
    let spinner = document.querySelector("#preview-spinner-agenda");

    document.querySelector('#btn-imprimir').href = `/imprimir/${id}`;

    spinner.classList.add('flex');
    spinner.classList.remove('hidden');
    modal_content.classList.add('hidden');

    fetch('/ordem-servico/' + id)
        .then(response => response.json())
        .then(result => {
            document.querySelector("#titulo-agenda").innerHTML = result.titulo;
            document.querySelector("#cliente-agenda").innerHTML = result.equipamento.cliente.nome;
            document.querySelector("#descricao-agenda").innerHTML = result.descricao;
            document.querySelector("#id-equipamento-agenda").innerHTML = result.equipamento.codigo;
            document.querySelector("#nome-equipamento-agenda").innerHTML = result.equipamento.nome;
            document.querySelector("#status-agenda").innerHTML = result.status.descricao;
            document.querySelector("#data-inicio-agenda").innerHTML = new Date(result.data_inicio).toLocaleDateString('pt-BR');
            document.querySelector("#data-conclusao-agenda").innerHTML = new Date(result.data_conclusao).toLocaleDateString('pt-BR');

            if (result.preco) {
                document.querySelector("#preco-container").style.display = "block";
                document.querySelector("#preco-agenda").innerHTML = "R$ " + result.preco;
            } else {
                document.querySelector("#preco-container").style.display = "none";
            }

            document.querySelector("#classificacao-agenda").innerHTML = "Manutenção preventiva";

            spinner.classList.remove("flex");
            spinner.classList.add("hidden");
            modal_content.classList.remove('hidden');
        })
}

function openModalDelete(id) {
    let formDelete = document.querySelector("#formDelete");
    formDelete.setAttribute('action', '/agenda/delete/' + id);
}

function openModalAgendaUpdate(id) {
    var formUpdate = document.querySelector("#formUpdateAgendamento");
    let spinner = document.querySelector("#update-agenda-spinner");

    formUpdate.setAttribute('action', '/agenda/update/' + id);
    formUpdate.classList.add('hidden');
    spinner.classList.remove('hidden');

    fetch('/agenda/' + id, {
            headers: {
                'accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(result => {
            let form = formUpdate.elements;

            let dataInicio = new Date(result.ordem_servico.data_inicio);
            let dataAviso = new Date(result.data_aviso);

            let diffMs = Math.abs(dataAviso - dataInicio); // Diferença em milissegundos
            let days = Math.floor(diffMs / (1000 * 60 * 60 * 24)); // Converter para dias

            form.titulo.value = result.ordem_servico.titulo;
            form.data_inicio.value = dataInicio.toLocaleString().split(',')[0];
            form.tempo_aviso.value = days;
            form.id_status.value = result.ordem_servico.id_status;
            form.id_cliente.choices.setChoiceByValue(String(result.id_cliente));
            verifyClienteID(
                result.ordem_servico.equipamento.id_cliente,
                form,
                result.ordem_servico.id_equipamento
            );

            form.descricao.value = result.ordem_servico.descricao;
            form.id_classificacao.value = result.ordem_servico.id_classificacao;

            form.id_cliente.addEventListener("change", (event) => {
                let id_cliente = event.target.value;
                verifyClienteID(id_cliente, form);
            });

            formUpdate.classList.remove('hidden');
            spinner.classList.add('hidden');
        })
}

document.querySelector("#id_cliente").addEventListener("change", (event) => {
    let id_cliente = event.target.value;
    let form = event.target.form;
    verifyClienteID(id_cliente, form);
});

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

document.addEventListener("click", (e) => {
    if (e.target.matches(".btn-delete-agenda")) {
        openModalDelete(e.target.dataset.id);
    }
    if (e.target.matches(".btn-update-agenda")) {
        openModalAgendaUpdate(e.target.dataset.id);
    }
    if (e.target.matches(".btn-read-agenda")) {
        openAgendaModalRead(e.target.dataset.id);
    }
});