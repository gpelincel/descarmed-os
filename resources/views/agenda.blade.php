<x-app-layout>
    <x-slot:title>
        Agenda
    </x-slot>

    <x-agenda.table :agendas="$agendas"></x-agenda.table>
    <x-agenda.cadastro-modal :equipamentos="$equipamentos" :status="$status" :clientes="$clientes"
        :selected="null"></x-agenda.cadastro-modal>
    <x-agenda.update-modal :equipamentos="$equipamentos" :status="$status" :clientes="$clientes"
        :selected="null"></x-agenda.update-modal>
    <x-delete-modal></x-delete-modal>

    @if (session('status'))
        <x-toasts :status="session('status')"></x-toasts>
    @endif
</x-app-layout>
