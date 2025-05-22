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

                    <div class="flex gap-8">
                        <div>
                            <h4 class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Número de Série
                            </h4>
                            <p id="numero-serie-equipamento-agenda"
                                class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></p>
                        </div>
                        <div>
                            <h4 class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Número de
                                Patrimônio</h4>
                            <p id="numero-patrimonio-equipamento-agenda"
                                class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></p>
                        </div>
                        <div>
                            <h4 class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Código Descarmed
                            </h4>
                            <p id="id-equipamento-agenda"
                                class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                            </p>
                        </div>

                    </div>

                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Equipamento</dt>
                    <dd id="nome-equipamento-agenda" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    </dd>

                    <div class="flex gap-8">
                        <div>
                            <h4 class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Data do
                                Agendamento</h4>
                            <p id="data-agenda" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                            </p>
                        </div>
                        <div>
                            <h4 class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Data de Aviso</h4>
                            <p id="data-aviso-agenda" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                            </p>
                        </div>
                    </div>
                </dl>
                <div class="flex justify-between items-center">
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
