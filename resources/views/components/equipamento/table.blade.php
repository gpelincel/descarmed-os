<div class="mx-auto max-w-screen-xl px-4 lg:px-12">
    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden w-full">

        {{-- Topbar --}}
        <x-table-top :label="'equipamento'" :options="[
            [
                'name' => 'Nome do equipamento',
                'value' => 'nome',
            ],
            [
                'name' => 'Número de Série',
                'value' => 'numero_serie',
            ],
            [
                'name' => 'Número de Patrimônio',
                'value' => 'numero_serie',
            ],
            [
                'name' => 'Cód. Descarmed',
                'value' => 'id',
            ],
        ]"></x-table-top>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                <x-table-header :headers="['Nº Série', 'Nº Patrimônio','Nome', 'Cliente']"></x-table-header>

                <tbody>
                    @foreach ($equipamentos as $equipamento)
                        {{-- Table Body Rows --}}
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $equipamento->id }}</th>
                                <td class="px-4 py-3">{{ $equipamento->numero_serie }}</td>
                                <td class="px-4 py-3">{{ $equipamento->numero_patrimonio }}</td>
                            <td class="px-4 py-3">{{ $equipamento->nome }}</td>
                            <td class="px-4 py-3">{{ $equipamento->cliente->nome }}</td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button 
                                    data-dropdown-toggle="{{ $equipamento->id }}-equipamento-dropdown"
                                    class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                    type="button">
                                    <i class="fi fi-rs-circle-ellipsis text-xl"></i>
                                </button>
                                <div id="{{ $equipamento->id }}-equipamento-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm">
                                        <li>
                                            <button data-id="{{$equipamento->id}}"
                                                type="button" data-modal-target="modal-update-equipamento"
                                                data-modal-toggle="modal-update-equipamento"
                                                class="flex w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200 btn-update-equipamento">
                                                <i class="fi fi-rr-edit mr-2"></i>
                                                Editar
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" data-id="{{$equipamento->id}}"
                                                data-modal-target="deleteModal" data-modal-toggle="deleteModal"
                                                class="delete-button flex w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400 btn-delete-equipamento">
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
            {{ $equipamentos->links() }}
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