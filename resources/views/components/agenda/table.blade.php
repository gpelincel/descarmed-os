<div class="mx-auto max-w-screen-xl px-4 lg:px-12">
    <!-- Start coding here -->
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden w-full">

        {{-- Topbar --}}
        <x-table-top :label="'Agendamento'"></x-table-top>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">


                <x-table-header :headers="['Equipamento', 'Cliente', 'Data de agendamento']"></x-table-header>

                <tbody>
                    @foreach ($agendas as $agenda)
                        {{-- Table Body Rows --}}
                        <tr class="border-b dark:border-gray-700">
                            <th scope="row"
                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $agenda->id }}</th>
                            <td class="px-4 py-3">{{ $agenda->ordem_servico->equipamento->nome }}</td>
                            <td class="px-4 py-3">{{ $agenda->ordem_servico->cliente->nome }}</td>
                            <td class="px-4 py-3">{{ date_format(date_create($agenda->data), 'd/m/Y') }}</td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <button data-dropdown-toggle="{{ $agenda->id }}-agenda-dropdown"
                                    data-dropdown-placement="right"
                                    class="inline-flex items-center text-sm font-medium hover:bg-gray-100 dark:hover:bg-gray-700 p-1.5 dark:hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                    type="button">
                                    <i class="fi fi-rs-circle-ellipsis text-xl"></i>
                                </button>
                                <div id="{{ $agenda->id }}-agenda-dropdown"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                    <ul class="py-1 text-sm">
                                        <li>
                                            <button type="button" data-modal-target="modal-update-agenda"
                                                data-modal-toggle="modal-update-agenda" data-id="{{ $agenda->id }}"
                                                class="flex w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200 btn-update-agenda">
                                                <i class="fi fi-rr-edit mr-2"></i>
                                                Editar
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" data-modal-target="modal-reagendar"
                                                data-modal-toggle="modal-reagendar" data-id="{{ $agenda->id }}"
                                                class="flex w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200 btn-reagendar">
                                                <i class="fi fi-rr-calendar-lines-pen mr-2"></i>
                                                Reagendar
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" data-modal-target="modal-preview-agenda"
                                                data-modal-toggle="modal-preview-agenda" data-id="{{ $agenda->id }}"
                                                class="flex w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200 btn-read-agenda">
                                                <i class="fi fi-rr-eye mr-2"></i>
                                                Ver Detalhes
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" data-modal-target="deleteModal"
                                                data-modal-toggle="deleteModal" data-id="{{ $agenda->id }}"
                                                class="delete-button flex w-full py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400 btn-delete-agenda">
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
            {{ $agendas->links() }}
        </nav>
    </div>
</div>
<x-agenda.preview-modal></x-agenda.preview-modal>
