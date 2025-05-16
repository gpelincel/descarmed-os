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

            <form action="/imprimir" target="_blank" method="POST" id="preview-content" class="hidden">
                @csrf
                <!-- Modal header -->
                <div class="flex gap-2 flex-col mb-4 rounded-t sm:mb-5 text-gray-900 dark:text-white">
                    <h3 id="classificacao-os"
                        class="font-bold text-3xl uppercase rounded-t border-b dark:border-gray-600 pb-2">Classificação
                        OS</h3>
                    <div class="text-gray-900 dark:text-white">
                        <h3 id="titulo-os" class="font-semibold text-xl">Título da OS</h3>
                        <p id="cliente-os" class="font-bold text-gray-900 dark:text-gray-400">Nome do cliente</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-x-4">
                    <div>
                        <h4
                            class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                            <input checked type="checkbox" value="true" name="cnpj_cliente" id="cnpj_cliente"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            CNPJ
                        </h4>
                        <p id="cnpj-cliente" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></p>
                    </div>
                    <div>
                        <h4
                            class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                            <input checked type="checkbox" value="true" name="telefone_cliente" id="telefone_cliente"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            Telefone
                        </h4>
                        <p id="telefone-cliente" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></p>
                    </div>
                    <div>
                        <h4
                            class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                            <input checked type="checkbox" value="true" name="email_cliente" id="email_cliente"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            Email
                        </h4>
                        <p id="email-cliente" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></p>
                    </div>
                    <div>
                        <h4
                            class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                            <input checked type="checkbox" value="true" name="endereco_cliente" id="endereco_cliente"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            Endereço
                        </h4>
                        <p id="endereco-cliente" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></p>
                    </div>
                </div>
                <dl>
                    <input type="hidden" name="os_id" id="os_id">
                    <dt class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                        <input checked type="checkbox" value="true" name="descricao" id="descricao"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        Descrição
                    </dt>
                    <dd id="descricao-os" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, recusandae iure vitae,
                        architecto sequi at minima neque, quo repudiandae accusantium quaerat laboriosam? Dignissimos
                        quas
                        ab dolore fugit molestias corrupti sed!
                    </dd>

                    <dt class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                        <input checked type="checkbox" value="true" name="nome_equipamento" id="nome_equipamento"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">Equipamento
                    </dt>
                    <dd id="nome-equipamento-os" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    </dd>

                    <div class="flex gap-8">
                        <div>
                            <h4
                                class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                <input checked type="checkbox" value="true" readonly name="numero_serie"
                                    id="numero_serie"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">Número de Série
                            </h4>
                            <p id="numero-serie-equipamento-os" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                            </p>
                        </div>
                        <div>
                            <h4
                                class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                <input checked type="checkbox" value="true" readonly name="numero_patrimonio"
                                    id="numero_patrimonio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">Número de Patrimônio
                            </h4>
                            <p id="numero-patrimonio-equipamento-os" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                            </p>
                        </div>
                        <div>
                            <h4
                                class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                <input checked type="checkbox" value="true" readonly name="id_equipamento"
                                    id="id_equipamento"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">Cód. Descarmed
                            </h4>
                            <p id="id-equipamento-os" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-8">
                        <div>
                            <h4
                                class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                <input checked type="checkbox" value="true" readonly name="data_inicio"
                                    id="data_inicio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">Data
                                Início
                            </h4>
                            <p id="data-inicio-os" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                            </p>
                        </div>
                        <div>
                            <h4
                                class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                <input checked type="checkbox" value="true" readonly name="data_conclusao"
                                    id="data_conclusao"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">Data
                                Conclusão
                            </h4>
                            <p id="data-conclusao-os"
                                class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                            </p>
                        </div>
                        <div>
                            <h4
                                class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                                <input checked type="checkbox" value="true" name="status" id="status"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">Status
                            </h4>
                            <p id="status-os" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                            </p>
                        </div>
                    </div>

                    <div id="preco-container">
                        <dt
                            class="flex gap-2 items-center mb-2 font-semibold leading-none text-gray-900 dark:text-white">
                            <input checked type="checkbox" value="true" name="valor" id="valor"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">Valor
                            Total
                        </dt>
                        <dd id="preco-os" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>
                        </dd>
                    </div>
                </dl>
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <button type="submit" id="btn-imprimir"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <i class="fi fi-rs-print mr-2"></i>
                            Imprimir
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
            </form>
            <div id="preview-spinner">
                <x-spinner></x-spinner>
            </div>
        </div>
    </div>
</div>
