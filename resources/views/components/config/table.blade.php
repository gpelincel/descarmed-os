@props(['modal_id', 'header', 'elements', 'action'])

<section>
    <div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th></th>
                    <th class="font-bold dark:text-white py-2 px-4">{{ $header }}</th>
                    <th class="py-2">
                        <button data-modal-target="{{ $modal_id }}" data-modal-toggle="{{ $modal_id }}"
                            type="button"
                            class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">+</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($elements as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <td class="w-[10%] pl-4">
                            @if ($item->ativo)
                                <div class="bg-green-700 rounded-full h-2 w-2"></div>
                            @else
                                <div class="bg-gray-700 rounded-full h-2 w-2"></div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->descricao }}
                            </span>
                        </td>
                        <td>
                            <button data-modal-target="{{ $modal_id }}" data-modal-toggle="{{ $modal_id }}"
                                data-id="{{ $item->id }}"
                                class="btn-update-config px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Editar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</section>
