<div class="mx-auto max-w-screen-xl px-4 lg:px-8">
    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

        {{-- Topbar --}}
        <x-table-top :label="'cliente'"></x-table-top>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                <x-table-header :headers="['Nome', 'CNPJ', 'Telefone', 'Email', '']"></x-table-header>

                <tbody>
                    @foreach ($clientes as $cliente)
                        {{-- Table Body Rows --}}
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $cliente->id }}</th>
                            <td class="px-4 py-3">{{ $cliente->nome }}</td>
                            <td class="px-4 py-3">{{ $cliente->cnpj }}</td>
                            <td class="px-4 py-3">{{ $cliente->telefone }}</td>
                            <td class="px-4 py-3">{{ $cliente->email }}</td>
                            <td class="px-4 py-3">
                                <button  onclick="openModalOSCad({{$cliente->id}})" type="button" data-modal-target="cadastrarOSModal"
                                    data-modal-toggle="cadastrarOSModal"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><i
                                        class="fi fi-rr-plus-small"></i> Adicionar OS</button>
                            </td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button data-dropdown-toggle="{{ $cliente->id }}-dropdown"
                                    class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                    type="button">
                                    <i class="fi fi-rs-circle-ellipsis text-xl"></i>
                                </button>
                                <div id="{{ $cliente->id }}-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm">
                                        <li>
                                            <button onclick="openModalClienteUpdate({{ $cliente->id }})" type="button"
                                                data-modal-target="modal-update-cliente"
                                                data-modal-toggle="modal-update-cliente"
                                                class="flex w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                <i class="fi fi-rr-edit mr-2"></i>
                                                Editar
                                            </button>
                                        </li>
                                        <li>
                                            <a type="button" href="/cliente/{{ $cliente->id }}"
                                                class="flex w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                <i class="fi fi-rr-eye mr-2"></i>
                                                Ver Detalhes
                                            </a>
                                        </li>
                                        <li>
                                            <button type="button" onclick="openModalDelete({{ $cliente->id }})"
                                                data-modal-target="deleteModal" data-modal-toggle="deleteModal"
                                                class="delete-button flex w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400">
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
            {{ $clientes->links() }}
        </nav>
    </div>
</div>

<!-- End block -->

<x-os-cadastro-modal :clientes="$clientes" :selected="null"></x-os-cadastro-modal>