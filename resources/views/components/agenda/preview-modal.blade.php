<div id="modal-preview-agenda" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-[50%] max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 min-h-72">
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white absolute right-2"
                data-modal-toggle="modal-preview-agenda">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <div id="preview-content-agenda" class="hidden">
                <!-- Modal header -->
                <div class="flex gap-2 flex-col mb-4 rounded-t sm:mb-5 text-gray-900 dark:text-white">
                    <h3 id="classificacao-agenda"
                        class="font-bold text-3xl uppercase rounded-t border-b dark:border-gray-600 pb-2">Classificação
                        OS</h3>
                    <div class="text-gray-900 dark:text-white">
                        <h3 id="titulo-agenda" class="font-semibold text-xl">Título da OS</h3>
                        <p id="cliente-agenda" class="font-bold text-gray-900 dark:text-gray-400">Nome do cliente</p>
                    </div>
                </div>
                <dl>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Descrição</dt>
                    <dd id="descricao-agenda" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, recusandae iure vitae,
                        architecto sequi at minima neque, quo repudiandae accusantium quaerat laboriosam? Dignissimos
                        quas
                        ab dolore fugit molestias corrupti sed!
                    </dd>

                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Código do Equipamento</dt>
                    <dd id="id-equipamento-agenda" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>

                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Equipamento</dt>
                    <dd id="nome-equipamento-agenda" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>

                    <div class="flex gap-8">
                        <div>
                            <h4 class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Data Início</h4>
                            <p id="data-inicio-agenda" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                            </p>
                        </div>
                        <div>
                            <h4 class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Data Conclusão</h4>
                            <p id="data-conclusao-agenda" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                            </p>
                        </div>
                        <div>
                            <h4 class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Status</h4>
                            <p id="status-agenda" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                            </p>
                        </div>
                    </div>

                    <div id="preco-container">
                        <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Valor Total</dt>
                        <dd id="preco-agenda" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>
                        </dd>
                    </div>
                </dl>
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <button type="button"
                            class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd"
                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Editar
                        </button>
                        <a id="btn-imprimir" target="_blank"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <i class="fi fi-rs-print mr-2"></i>
                            Imprimir
                        </a>
                    </div>
                    <button type="button" data-modal-target="deleteModal" data-modal-toggle="deleteModal"
                        class="delete-button inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                        <svg aria-hidden="true" class="w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Deletar
                    </button>
                </div>
            </div>
            <div id="preview-spinner-agenda">
                <x-spinner></x-spinner>
            </div>
        </div>
    </div>
</div>
<script>
    function openAgendaModalRead(event, id) {
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
</script>
