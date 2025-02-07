<x-app-layout>
    <x-slot:title>
        Clientes
    </x-slot>

    <x-clientes-table :clientes="$clientes"></x-clientes-table>

    <x-cliente-cadastro-modal></x-cliente-cadastro-modal>
    <x-cliente-update-modal></x-cliente-update-modal>
    <x-delete-modal></x-delete-modal>

    <script>
        function openModalDelete(id) {
            let formDelete = document.querySelector("#formDelete");
            formDelete.setAttribute('action', '/cliente/delete/' + id);
            formDelete.setAttribute('method', 'post');
        }
    </script>


    @if (session('status'))
        <x-toasts :status="session('status')"></x-toasts>
    @endif
</x-app-layout>
