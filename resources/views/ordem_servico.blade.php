<x-app-layout>
    <x-slot:title>
        Ordem de Serviço
    </x-slot>

    <x-os-table :ordens="$ordens"></x-os-table>

    @if (session('status'))
        <x-toasts :status="session('status')"></x-toasts>
    @endif
</x-app-layout>