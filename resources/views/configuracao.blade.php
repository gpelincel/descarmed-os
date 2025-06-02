<x-app-layout>
    <x-slot:title>Configurações</x-slot:title>
    <main class="grid grid-cols-2 gap-4">
        <x-config.table :header="'Status da OS'" :elements="$statusOS" :modal_id="'modal-cad-status'"></x-config.table>
        <x-config.table :header="'Classificação da OS'" :elements="$classificacaoOS" :modal_id="'modal-cad-classificacao'"></x-config.table>
        <x-config.table :header="'Unidades de Item'" :elements="$unidade" :modal_id="'modal-cad-unidade'"></x-config.table>
    </main>
    <x-config.unidade-cadastro-modal></x-config.unidade-cadastro-modal>
    <x-config.status-os-cadastro-modal></x-config.status-os-cadastro-modal>
    <x-config.classificacao-os-cadastro-modal></x-config.classificacao-os-cadastro-modal>
</x-app-layout>
