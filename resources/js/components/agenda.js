function openAgendaModalRead(id) {
    let modal_content = document.querySelector("#preview-content-agenda");
    let spinner = document.querySelector("#preview-spinner-agenda");

    spinner.classList.add('flex');
    spinner.classList.remove('hidden');
    modal_content.classList.add('hidden');

    fetch('/agenda/' + id)
        .then(response => response.json())
        .then(result => {
            let ordem_servico = result.ordem_servico;
            let equipamento = ordem_servico.equipamento;
            let cliente = ordem_servico.cliente;

            document.querySelector("#titulo-agenda").innerHTML = ordem_servico.titulo;
            document.querySelector("#cliente-agenda").innerHTML = cliente.nome;
            document.querySelector("#descricao-agenda").innerHTML = ordem_servico.descricao;
            document.querySelector("#id-equipamento-agenda").innerHTML = equipamento.id;
            document.querySelector("#numero-serie-equipamento-agenda").innerHTML = equipamento.numero_serie;
            document.querySelector("#numero-patrimonio-equipamento-agenda").innerHTML = equipamento.numero_patrimonio;
            document.querySelector("#nome-equipamento-agenda").innerHTML = equipamento.nome;
            if (ordem_servico.status) {
                document.querySelector("#status-agenda").innerHTML = ordem_servico.status.descricao;
            }
            document.querySelector("#data-agenda").innerHTML = new Date(result.data).toLocaleDateString('pt-BR');
            document.querySelector("#data-aviso-agenda").innerHTML = new Date(result.data_aviso).toLocaleDateString('pt-BR');

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
            let ordem_servico = result.ordem_servico;

            let dataInicio = new Date(result.data);
            let dataAviso = new Date(result.data_aviso);

            let diffMs = Math.abs(dataAviso - dataInicio); // Diferença em milissegundos
            let days = Math.floor(diffMs / (1000 * 60 * 60 * 24)); // Converter para dias

            form.titulo.value = ordem_servico.titulo;
            form.data.value = dataInicio.toLocaleString().split(',')[0];
            form.tempo_aviso.value = days;
            form.id_cliente.value = result.id_cliente;
            form.id_cliente.choices.setChoiceByValue(String(result.ordem_servico.id_cliente));

            verifyClienteID(
                result.ordem_servico.id_cliente,
                form,
                ordem_servico.id_equipamento
            );

            form.descricao.value = ordem_servico.descricao;

            form.id_cliente.addEventListener("change", (event) => {
                let id_cliente = event.target.value;
                verifyClienteID(id_cliente, form);
            });

            formUpdate.classList.remove('hidden');
            spinner.classList.add('hidden');
        })
}

function openAgendaModalReagendar(id) {
    var formUpdate = document.querySelector("#formUpdateReagendamento");
    formUpdate.setAttribute('action', '/agenda/update/' + id);
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

    if (e.target.matches(".btn-reagendar")) {
        openAgendaModalReagendar(e.target.dataset.id);
    }
});