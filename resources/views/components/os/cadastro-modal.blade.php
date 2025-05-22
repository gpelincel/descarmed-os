<div id="cadastrarOSModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Cadastrar Ordem de Serviço</h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-target="cadastrarOSModal" data-modal-toggle="cadastrarOSModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="formCadOS" action="/ordem-servico" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div>
                        <label for="titulo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Serviço</label>
                        <input type="text" name="titulo" id="titulo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Serviço a ser realizado" required>
                    </div>
                    <div>
                        <label for="id_classificacao"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Classificação</label>
                        <select id="id_classificacao" name="id_classificacao"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option value="" selected="">- Selecione -</option>
                            @foreach ($classificacao as $class)
                                <option value="{{ $class->id }}">{{ $class->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="codigo_compra"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código de Compra
                            (Opcional)</label>
                        <input type="text" name="codigo_compra" id="codigo_compra"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="CP-0000">
                    </div>
                    <div>
                        <label for="nota_fiscal"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nota Fiscal
                            (Opcional)</label>
                        <input type="text" name="nota_fiscal" id="nota_fiscal"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="NF-0000">
                    </div>
                    <div class="relative">
                        <label for="data_inicio"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data
                            Início</label>
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 top-6 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input readonly name="data_inicio" datepicker type="text" autocomplete="off"
                            datepicker-format="dd/mm/yyyy"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker"
                            placeholder="dd/mm/aaaa" required>
                    </div>
                    <div class="relative">
                        <label for="data_conclusao"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data
                            de Conclusão (Opcional)</label>
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 top-6 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input readonly name="data_conclusao" datepicker type="text" autocomplete="off"
                            datepicker-format="dd/mm/yyyy"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker"
                            placeholder="dd/mm/aaaa">
                    </div>
                    <div>
                        <label for="id_status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="id_status" name="id_status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            <option selected="" value="0">- Selecione -</option>
                            @foreach ($status as $stat)
                                <option value="{{ $stat->id }}">{{ $stat->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="id_cliente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cliente</label>

                        <select id="id_cliente" name="id_cliente"
                            class="select-cliente bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required>
                            @if ($clientes)
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente['id'] }}">{{ $cliente['nome'] }}</option>
                                @endforeach
                            @endif
                            @if ($selected)
                                <option selected="" value="{{ $selected->id }}">{{ $selected->nome }}</option>
                            @endif
                        </select>
                    </div>
                    <div id="equipamento-form-os"
                        class="grid gap-4 mb-4 grid-cols-2 border-gray-500 border-t border-b col-span-2 py-5 hidden">
                        <input type="hidden" id="novo-eqp" name="novo-eqp" value="0">
                        <div>
                            <label for="numero_serie"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de
                                Série</label>
                            <input type="text" name="numero_serie" id="numero_serie"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="ABC-000000000">
                        </div>
                        <div>
                            <label for="numero_patrimonio"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de
                                Patrimônio</label>
                            <input type="text" name="numero_patrimonio" id="numero_patrimonio"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="ABC-000000000">
                        </div>
                        <div>
                            <label for="nome"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                            <input type="text" name="nome" id="nome"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Nome do equipamento">
                        </div>
                    </div>
                    <div id="items-list" class="col-span-2 space-y-2">
                        <div class="flex gap-2 items-center border-b border-gray-600 pb-2">
                            <h4 class="block font-medium text-gray-900 dark:text-white">
                                Items</h4>
                            <button id="btn-add-item" data-counter="1"
                                class="text-white inline-flex items-center focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm p-1.5 pt-1 text-center bg-blue-600 hover:bg-blue-700 dark:focus:ring-primary-800 text-xs">
                                <i class="fi fi-rr-plus-small"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-[1fr_4fr_1fr] gap-2">
                            <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qtd.</h4>
                            <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do item</h4>
                            <h4 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor un.</h4>
                        </div>
                        <div class="grid grid-cols-[1fr_4fr_1fr] gap-2 col-span-3">
                            <input type="text" name="qtd_{{ $id }}" id="qtd_{{ $id }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="0">
                            <input type="text" name="nome_item_{{ $id }}"
                                id="nome_item_{{ $id }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Nome do item">
                            <input type="text" name="preco_un_{{ $id }}"
                                id="preco_un_{{ $id }}"
                                class="valor-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="R$ 0,00">
                        </div>
                    </div>
                    <div>
                        <label for="id_equipamento"
                            class="flex items-center gap-2 mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            <span>Equipamento (Opcional)</span>
                            <button id="btn-add-equipamento"
                                class="text-white inline-flex items-center focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm p-1.5 pt-1 text-center bg-blue-600 hover:bg-blue-700 dark:focus:ring-primary-800 text-xs">
                                <i class="fi fi-rr-plus-small"></i>
                            </button>
                        </label>
                        <select id="id_equipamento" name="id_equipamento"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            disabled>
                            <option value="" selected="">- Selecione um cliente -</option>
                        </select>
                    </div>
                    <div>
                        <label for="preco"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor
                            Total (Opcional)</label>
                        <input type="text" name="preco" id="preco"
                            class="valor-input bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="R$ 0,00">
                    </div>
                    <div class="sm:col-span-2"><label for="descricao"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                        <textarea id="descricao" rows="4" name="descricao"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Descrição da ordem de serviço..." required></textarea>
                    </div>
                </div>
                <div class="flex w-full justify-end">
                    <button type="submit"
                        class="text-white inline-flex items-center focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700  dark:focus:ring-primary-800 self-end">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
