<x-app-layout>
    <x-slot:title>
        Ordem de Serviço
    </x-slot>

    <x-os-table :ordens="$ordens"></x-os-table>

    <x-os-cadastro-modal :clientes="$clientes"></x-os-cadastro-modal>
    <x-os-update-modal :clientes="$clientes"></x-os-update-modal>
    <x-delete-modal></x-delete-modal>

    <script>
        function openModalDelete(id) {
            let formDelete = document.querySelector("#formDelete");
            formDelete.setAttribute('action', '/ordem-servico/delete/' + id);
            formDelete.setAttribute('method', 'post');
        }
    </script>


    @if (session('status'))
        <x-toasts :status="session('status')"></x-toasts>
    @endif
</x-app-layout>
