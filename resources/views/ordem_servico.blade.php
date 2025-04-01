<x-app-layout>
    <x-slot:title>
        Ordem de Serviço
    </x-slot>

    <x-os.table :ordens="$ordens"></x-os.table>

    <x-os.cadastro-modal :clientes="$clientes" :selected="null" :status="$status" :classificacao="$classificacao"></x-os.cadastro-modal>
    <x-os.update-modal :clientes="$clientes" :selected="null" :status="$status" :classificacao="$classificacao"></x-os.update-modal>
    <x-delete-modal></x-delete-modal>

    @if (session('status'))
        <x-toasts :status="session('status')" :message="session('message')"></x-toasts>
    @endif

    @if ($errors->any())
        <x-toasts :status="'error'" :message="$errors->all()[0]"></x-toasts>
    @endif
</x-app-layout>
