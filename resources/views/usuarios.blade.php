<x-app-layout>
    <x-slot:title>
        Usuário
    </x-slot>

    <x-usuario-table :usuarios="$usuarios"></x-usuario-table>
    <x-usuario-cadastro-modal></x-usuario-cadastro-modal>
    <x-delete-modal></x-delete-modal>

    @if (session('status'))
        <x-toasts :status="session('status')" :message="session('message')"></x-toasts>
    @endif
</x-app-layout>
