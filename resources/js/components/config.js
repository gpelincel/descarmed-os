function openModalUpdate(id, modal) {
    let config = modal.slice(10);
    let form = document.querySelector(`#${modal}`).querySelector("form");
    let action = form.action;
    console.log(form);

    fetch("/configuracao/" + config + "/" + id)
        .then((response) => response.json())
        .then((result) => {
            form.action += "/"+id;
            form.descricao.value = result.descricao;
            form.ativo.value = result.ativo;
        });
}

document.addEventListener("click", (e) => {
    if (e.target.matches(".btn-update-config")) {
        openModalUpdate(e.target.dataset.id, e.target.dataset.modalTarget);
    }
});
