<div id="modal-update-agenda" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <button type="button"
                class="absolute right-4 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-target="modal-update-agenda" data-modal-toggle="modal-update-agenda">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Atualizar Dados do Agendamento</h3>

            </div>
            <!-- Modal body -->

            <div id="update-agenda-spinner">
                <x-spinner></x-spinner>
            </div>

            <!-- Modal body -->
            <form id="formUpdateAgendamento" action="/agenda/update" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="titulo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Serviço</label>
                        <input type="text" name="titulo" id="titulo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Serviço a ser realizado" required="">
                    </div>
                    <div>
                        <label for="id_classificacao"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Classificação</label>
                        <select id="id_classificacao" name="id_classificacao"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="" selected="">- Selecione -</option>
                            @foreach ($classificacao as $class)
                                <option value="{{ $class->id }}">{{ $class->descricao }}</option>
                            @endforeach
                        </select>
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
                            placeholder="dd/mm/aaaa">
                    </div>
                    <div>
                        <label for="tempo_aviso"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Avisar antes de</label>
                        <select id="tempo_aviso" name="tempo_aviso"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">- Selecione -</option>
                            <option value="1">1 dia</option>
                            <option value="7">7 dias</option>
                            <option value="15">15 dias</option>
                            <option value="30">30 dias</option>
                        </select>
                    </div>
                    <div>
                        <label for="id_status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="id_status" name="id_status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected="">- Selecione -</option>
                            @foreach ($status as $stat)
                                <option value="{{ $stat->id }}">{{ $stat->descricao }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="id_cliente"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cliente</label>
                        <select id="id_cliente" name="id_cliente"
                            class="select-cliente bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @if ($clientes)
                                <option value="" selected="">- Selecione -</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente['id'] }}">{{ $cliente['nome'] }}</option>
                                @endforeach
                            @endif
                            @if ($selected)
                                <option selected="" value="{{ $selected->id }}">{{ $selected->nome }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="id_equipamento"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Equipamento</label>
                        <select id="id_equipamento" name="id_equipamento"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            disabled>
                            <option value="" selected="">- Selecione um cliente -</option>
                        </select>
                    </div>
                    <div class="sm:col-span-2"><label for="descricao"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                        <textarea id="descricao" rows="4" name="descricao"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Descrição da ordem de serviço..."></textarea>
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
