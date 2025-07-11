function openModalDelete(id) {
    let formDelete = document.querySelector("#formDelete");
    formDelete.setAttribute('action', '/cliente/delete/' + id);
}

function openModalOSCad(id){
    let formOSCad = document.querySelector("#formCadOS");
    let inputs = formOSCad.elements;
    inputs.id_cliente.value = id;
}

function openModalRead(id) {
    let modal_content = document.querySelector("#preview-content");
    let spinner = document.querySelector("#preview-spinner");

    spinner.classList.add('flex');
    spinner.classList.remove('hidden');
    modal_content.classList.add('hidden');

    fetch('/cliente/' + id)
        .then(response => response.json())
        .then(result => {
            document.querySelector("#nome-cliente").innerHTML = result.nome;
            document.querySelector("#cnpj-cliente").innerHTML = result.cnpj;
            document.querySelector("#telefone-cliente").innerHTML = result.telefone;
            document.querySelector("#email-cliente").innerHTML = result.email;
            document.querySelector("#razao-social-cliente").innerHTML = result.razao_social;

            addDeleteButton(id);

            spinner.classList.remove("flex");
            spinner.classList.add("hidden");
            modal_content.classList.remove('hidden');
        })
}

function openModalClienteUpdate(id) {
    var formUpdate = document.querySelector("#formUpdateCliente");
    let spinner = document.querySelector("#update-cliente-spinner");

    formUpdate.setAttribute('action', '/cliente/update/' + id);
    formUpdate.classList.add('hidden');
    spinner.classList.remove('hidden');

    fetch('/cliente/' + id, {
        headers:{
            'accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then(result => {
            let form = formUpdate.elements;

            form.nome.value = result.nome;
            form.cnpj.value = result.cnpj;
            form.telefone.value = result.telefone;
            form.email.value = result.email;
            form.razao_social.value = result.razao_social;

            form.cep.value = result.endereco.cep;
            form.logradouro.value = result.endereco.logradouro;
            form.numero.value = result.endereco.numero;
            form.complemento.value = result.endereco.complemento;
            form.bairro.value = result.endereco.bairro;
            form.cidade.value = result.endereco.cidade;
            form.estado.value = result.endereco.estado;

            formUpdate.classList.remove('hidden');
            spinner.classList.add('hidden');
        })
}

function getCEP(cep){
    let cep_value = cep.value.replace('-', '');
    fetch(`https://viacep.com.br/ws/${cep_value}/json/`)
    .then(response => response.json())
    .then(result => {
        let form = cep.form;
        form.logradouro.value = result.logradouro;
        form.cidade.value = result.localidade;
        form.bairro.value = result.bairro;
        form.estado.value = result.uf;
        console.log(result);
    })
}

document.addEventListener("click", (e) => {
    if (e.target.matches(".btn-delete-cliente")) {
        openModalDelete(e.target.dataset.id);
    }
    if (e.target.matches(".btn-update-cliente")) {
        openModalClienteUpdate(e.target.dataset.id);
    }
});

document.addEventListener("change", (event) => {
    if (event.target.matches("#cep")) {
        getCEP(event.target);
    }
});