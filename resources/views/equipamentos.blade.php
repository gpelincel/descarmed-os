<x-app-layout>
    <x-slot:title>
        Equipamento
    </x-slot>

    <x-equipamento.table :equipamentos="$equipamentos" :clientes="$clientes"></x-equipamento.table>
    <x-equipamento.cadastro-modal :clientes="$clientes" :selected="null"></x-equipamento.cadastro-modal>
    <x-equipamento.update-modal :clientes="$clientes" :selected="null"></x-equipamento.update-modal>
    <x-delete-modal></x-delete-modal>

    @if (session('status'))
        <x-toasts :status="session('status')" :message="session('message')"></x-toasts>
    @endif

    @if ($errors->any())
        <x-toasts :status="'error'" :message="$errors->all()[0]"></x-toasts>
    @endif
</x-app-layout>
