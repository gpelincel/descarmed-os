<div id="modal-preview-os" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-[50%] max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 min-h-72">
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white absolute right-2"
                data-modal-toggle="modal-preview-os">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <div id="preview-content" class="hidden">
                <!-- Modal header -->
                <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                    <div class="text-gray-900 dark:text-white">
                        <h3 id="titulo-os" class="font-semibold text-2xl">Título da OS</h3>
                        <p id="cliente-os" class="font-bold text-gray-900 dark:text-gray-400">Nome do cliente</p>
                    </div>
                </div>
                <dl>
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Descrição</dt>
                    <dd id="descricao-os" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, recusandae iure vitae,
                        architecto sequi at minima neque, quo repudiandae accusantium quaerat laboriosam? Dignissimos
                        quas
                        ab dolore fugit molestias corrupti sed!
                    </dd>

                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Histórico</dt>
                    <dd class="mb-6">
                        <ol
                            class="flex items-center w-full space-y-1 sm:flex sm:space-x-8 sm:space-y-0 rtl:space-x-reverse">
                            <li
                                class="flex items-center bg-gray-100 text-gray-800 font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300 space-x-2">
                                <i class="fi fi-rr-calendar-clock mb-[-3px]"></i>
                                <span>
                                    <h3 class="font-medium leading-tight">Agendada</h3>
                                </span>
                            </li>
                            <i class="fi fi-rs-angle-circle-right text-gray-500 dark:text-gray-400"></i>
                            <li id="status-andamento"
                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 rtl:space-x-reverse">
                                <i class="fi fi-rr-time-forward mb-[-3px]"></i>
                                <span>
                                    <h3 class="font-medium leading-tight">Em andamento</h3>
                                </span>
                            </li>
                            <i class="fi fi-rs-angle-circle-right text-gray-500 dark:text-gray-400"></i>
                            <li id="status-concluida"
                                class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 rtl:space-x-reverse">
                                <i class="fi fi-rs-check-circle mb-[-3px]"></i>
                                <span>
                                    <h3 class="font-medium leading-tight">Concluída</h3>
                                </span>
                            </li>
                        </ol>
                    </dd>
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
            <div id="preview-spinner">
                <x-spinner></x-spinner>
            </div>
        </div>
    </div>
</div>
<script>
    function addDeleteButton(id) {
        document.querySelector(".delete-button").addEventListener("click", openModalDelete(id));
    }

    function openModalRead(event, id) {
        let modal_content = document.querySelector("#preview-content");
        let spinner = document.querySelector("#preview-spinner");

        spinner.classList.add('flex');
        spinner.classList.remove('hidden');
        modal_content.classList.add('hidden');

        fetch('/ordem-servico/' + id)
            .then(response => response.json())
            .then(result => {
                document.querySelector("#titulo-os").innerHTML = result.titulo;
                document.querySelector("#cliente-os").innerHTML = result.cliente.nome;
                document.querySelector("#descricao-os").innerHTML = result.descricao;


                let activeClass = ["font-medium", "px-2.5", "py-0.5", "rounded-full"];
                let inactiveClass = ["text-gray-500", "dark:text-gray-400"];

                const andamento = document.querySelector("#status-andamento");
                const concluida = document.querySelector("#status-concluida");
                const aguardando = document.querySelector("#status-aguardando"); // Badge do primeiro status

                if (aguardando) atualizarBadge(aguardando, result.status >= 1,
                    "bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300");
                if (andamento) atualizarBadge(andamento, result.status >= 2,
                    "bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300");
                if (concluida) atualizarBadge(concluida, result.status === 3,
                    "bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300");

                /**
                 * Atualiza o badge com base no status.
                 * @param {HTMLElement} elemento - O badge a ser atualizado.
                 * @param {boolean} ativo - Se o badge deve estar ativo.
                 * @param {string} corAtiva - As classes para quando estiver ativo.
                 */
                function atualizarBadge(elemento, ativo, corAtiva) {
                    if (ativo) {
                        elemento.classList.remove(...inactiveClass);
                        elemento.classList.add(...activeClass, ...corAtiva.split(" "));
                    } else {
                        elemento.classList.remove(...activeClass, ...corAtiva.split(" "));
                        elemento.classList.add(...inactiveClass);
                    }
                }

                addDeleteButton(id);

                spinner.classList.remove("flex");
                spinner.classList.add("hidden");
                modal_content.classList.remove('hidden');
            })
    }
</script>
