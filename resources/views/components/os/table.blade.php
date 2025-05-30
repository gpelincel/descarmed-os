<div class="mx-auto max-w-screen-xl px-4">
    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

        {{-- Topbar --}}
        <x-table-top :label="'OS'" :options="[
            [
                'name' => 'Serviço',
                'value' => 'titulo',
            ],
            [
                'name' => 'Equipamento',
                'value' => 'equipamento',
            ],
            [
                'name' => 'Cliente',
                'value' => 'cliente',
            ],
        ]">
            <div>
                <label for="field" class="text-xs dark:text-white">Status OS:</label>
                <select id="id_status" name="id_status" value="{{ request('id_status') }}"
                    class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="0">Todos</option>
                    @foreach ($status as $stat)
                        <option value="{{ $stat->id }}" {{ request('id_status') == $stat->id ? 'selected' : '' }}>
                            {{ $stat->descricao }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="field" class="text-xs dark:text-white">Classificação OS:</label>
                <select id="id_classificacao" name="id_classificacao" value="{{ request('id_classificacao') }}"
                    class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 w-24">
                    <option value="0">Todos</option>
                    @foreach ($classificacao as $class)
                        <option value="{{ $class->id }}"
                            {{ request('id_classificacao') == $class->id ? 'selected' : '' }}>
                            {{ $class->descricao }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="field" class="text-xs dark:text-white">Data mínima:</label>
                <input readonly name="data_inicio" datepicker type="text" autocomplete="off"
                    datepicker-format="dd/mm/yyyy" value="{{ request('data_inicio') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker w-24"
                    placeholder="dd/mm/aaaa" required>
            </div>
        </x-table-top>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                <x-table-header :headers="['Serviço', 'Status', 'Data de Início', 'Cliente', 'Classificação']"></x-table-header>

                <tbody>
                    @foreach ($ordens as $ordem)
                        {{-- Table Body Rows --}}
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $ordem->id }}</th>
                            <td class="px-4 py-3">{{ $ordem->titulo }}</td>
                            <td class="px-4 py-3">
                                {{ $ordem->status->descricao ?? 'N/A' }}
                            </td>
                            <td class="px-4 py-3">{{ date_format(date_create($ordem->data_inicio), 'd/m/Y') }}</td>
                            <td class="px-4 py-3">{{ $ordem->cliente->nome }}
                            </td>
                            <td class="px-4 py-3">{{ $ordem->classificacao->descricao }}</td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button data-dropdown-toggle="{{ $ordem->id }}-dropdown"
                                    class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                    type="button">
                                    <i class="fi fi-rs-circle-ellipsis text-xl"></i>
                                </button>
                                <div id="{{ $ordem->id }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm">
                                        <li>
                                            <button type="button" data-modal-target="modal-update-os"
                                                data-modal-toggle="modal-update-os" data-id="{{ $ordem->id }}"
                                                class="flex w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200 btn-update-os">
                                                <i class="fi fi-rr-edit mr-2"></i>
                                                Editar
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" data-id="{{ $ordem->id }}"
                                                data-modal-target="modal-preview-os"
                                                data-modal-toggle="modal-preview-os"
                                                class="flex w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200 btn-read-os">
                                                <i class="fi fi-rr-eye mr-2"></i>
                                                Ver Detalhes
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" data-modal-target="deleteModal"
                                                data-modal-toggle="deleteModal" data-id="{{ $ordem->id }}"
                                                class="delete-button flex w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400 btn-delete-os">
                                                <i class="fi fi-rr-trash mr-2"></i>
                                                Deletar
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Table footer --}}

        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4 w-full"
            aria-label="Table navigation">
            {{ $ordens->links() }}
            {{-- <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Showing
                    <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
                    of
                    <span class="font-semibold text-gray-900 dark:text-white">1000</span>
                </span>
                <ul class="inline-flex items-stretch -space-x-px">
                    <li>
                        <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Previous</span>
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                    </li>
                    <li>
                        <a href="#" aria-current="page" class="flex items-center justify-center text-sm z-10 py-2 px-3 leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">...</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">100</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Next</span>
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </li>
                </ul> --}}
        </nav>
    </div>
</div>
<!-- End block -->

<x-os.preview-modal></x-os.preview-modal>
