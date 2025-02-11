<x-app-layout>
    <x-slot:title>{{ $cliente->nome }}</x-slot:title>
    <section class="flex flex-col gap-4 mx-auto max-w-screen-xl px-4 lg:px-12 text-gray-900 dark:text-white mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="uppercase font-bold text-4xl">{{ $cliente->nome }}</h1>
                <h3 class="text-gray-500 dark:text-gray-400">{{ $cliente->razao_social }}</h3>
            </div>
            <div class="flex gap-2 h-10">
                <button onclick="openModalClienteUpdate({{ $cliente->id }})" data-modal-target="modal-update"
                    data-modal-toggle="modal-update" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><i
                        class="fi fi-rr-edit"></i> Editar</button>
                <button type="button" data-modal-target="deleteModal" data-modal-toggle="deleteModal"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><i
                        class="fi fi-rr-trash"></i> Deletar</button>
            </div>
        </div>
        <hr class="border-gray-400/50 dark:border-gray-500">
        <ul class="flex gap-8">
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">CNPJ</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->cnpj }}
                </p>
            </li>
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">Telefone</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->telefone }}
                </p>
            </li>
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">Email</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->email }}
                </p>
            </li>
        </ul>
    </section>
    <x-cliente-update-modal></x-cliente-update-modal>
    <x-os-table :ordens="$cliente->ordens_servico()->paginate(10)"></x-os-table>
    <x-os-cadastro-modal :selected="$cliente" :clientes="null"></x-os-cadastro-modal>
    <x-os-update-modal :selected="$cliente" :clientes="null"></x-os-update-modal>
    <x-delete-modal :action="'/cliente/delete/' . $cliente->id"></x-os-delete-modal>
</x-app-layout>
