<x-app-layout>
    <x-slot:title>Configurações</x-slot:title>
    <main class="grid grid-cols-2 gap-4">
        <x-config.table :header="'Status da OS'" :elements="$statusOS" :modal_id="'modal-cad-status'" :action="'status'"></x-config.table>
        <x-config.table :header="'Classificação da OS'" :elements="$classificacaoOS" :modal_id="'modal-cad-classificacao'" :action="'classificacao'"></x-config.table>
        <x-config.table :header="'Unidades de Item'" :elements="$unidade" :modal_id="'modal-cad-unidade'" :action="'unidade'"></x-config.table>
    </main>
    <x-config.unidade-cadastro-modal></x-config.unidade-cadastro-modal>
    <x-config.status-os-cadastro-modal></x-config.status-os-cadastro-modal>
    <x-config.classificacao-os-cadastro-modal></x-config.classificacao-os-cadastro-modal>

    <script>
        document.addEventListener("click", (event) => {
            if (event.target.matches(".delete-button")) {
                let formDelete = document.querySelector("#formDelete");
                formDelete.setAttribute("action", '/configuracao/'+event.target.dataset.action + '/' + event.target.dataset.id);
            }
        })
    </script>

    @if (session('status'))
        <x-toasts :status="session('status')" :message="session('message')"></x-toasts>
    @endif

    @if ($errors->any())
        <x-toasts :status="'error'" :message="$errors->all()[0]"></x-toasts>
    @endif
</x-app-layout>
