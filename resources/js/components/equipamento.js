function openModalDelete(id) {
    let formDelete = document.querySelector("#formDelete");
    formDelete.setAttribute('action', '/equipamento/delete/' + id);
}

function openModalEquipamentoUpdate(id) {
    var formUpdate = document.querySelector("#formUpdateEquipamento");
    let spinner = document.querySelector("#update-equipamento-spinner");

    formUpdate.setAttribute('action', '/equipamento/update/' + id);
    formUpdate.classList.add('hidden');
    spinner.classList.remove('hidden');

    fetch('/equipamento/' + id, {
        headers:{
            'accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then(result => {
            let form = formUpdate.elements;

            form.nome.value = result.nome;
            form.id_cliente.value = result.id_cliente;
            form.codigo.value = result.codigo;

            formUpdate.classList.remove('hidden');
            spinner.classList.add('hidden');
        })
}

document.addEventListener("click", (e) => {
    if (e.target.matches(".btn-delete-equipamento")) {
        openModalDelete(e.target.dataset.id);
    }
    if (e.target.matches(".btn-update-equipamento")) {
        openModalEquipamentoUpdate(e.target.dataset.id);
    }
});