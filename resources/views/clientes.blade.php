<x-app-layout>
    <x-slot:title>
        Clientes
    </x-slot>

    <x-cliente.table :clientes="$clientes"></x-cliente.table>

    <x-cliente.cadastro-modal></x-cliente.cadastro-modal>

    <x-cliente.update-modal></x-cliente.update-modal>
    <x-delete-modal></x-delete-modal>

    <script>
        function openModalDelete(id) {
            let formDelete = document.querySelector("#formDelete");
            formDelete.setAttribute('action', '/cliente/delete/' + id);
        }

        function openModalOSCad(id){
            let formOSCad = document.querySelector("#formCadOS");
            let inputs = formOSCad.elements;
            inputs.id_cliente.value = id;
        }
    </script>


    @if (session('status'))
        <x-toasts :status="session('status')"></x-toasts>
    @endif
</x-app-layout>
