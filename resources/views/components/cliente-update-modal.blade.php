<div id="modal-update-cliente" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <button type="button"
                class="absolute right-4 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-target="modal-update-cliente" data-modal-toggle="modal-update-cliente">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>

            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Atualizar Dados do Cliente</h3>

            </div>
            <!-- Modal body -->

            <div id="update-cliente-spinner">
                <x-spinner></x-spinner>
            </div>

            <form id="formUpdateCliente" method="POST" class="hidden">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="nome"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                        <input type="text" name="nome" id="nome"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Nome do cliente" required="">
                    </div>
                    <div>
                        <label for="cnpj"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CNPJ</label>
                        <input type="text" name="cnpj" id="cnpj"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="CNPJ do cliente" required="">
                    </div>
                    <div>
                        <label for="razao_social"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Razão Social</label>
                        <input type="text" name="razao_social" id="razao_social"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Exemplo e Cia LTDA." required="">
                    </div>
                    <div>
                        <label for="telefone"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
                        <input type="text" name="telefone" id="telefone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="(00) 9 0000-0000" required="">
                    </div>
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="cliente@email.com" required="">
                    </div>
                </div>
                <div class="flex w-full justify-end">
                    <button type="submit"
                        class="text-white inline-flex items-center focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-blue-600 hover:bg-blue-700 dark:focus:ring-primary-800 self-end">
                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModalClienteUpdate(id) {
        var formUpdate = document.querySelector("#formUpdateCliente");
        let spinner = document.querySelector("#update-cliente-spinner");

        formUpdate.setAttribute('action', '/cliente/update/' + id);
        formUpdate.classList.add('hidden');
        spinner.classList.remove('hidden');

        fetch('/cliente/' + id, {
            headers:{
                'accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(result => {
                let form = formUpdate.elements;

                form.nome.value = result.nome;
                form.cnpj.value = result.cnpj;
                form.telefone.value = result.telefone;
                form.email.value = result.email;
                form.razao_social.value = result.razao_social;

                formUpdate.classList.remove('hidden');
                spinner.classList.add('hidden');
            })
    }
</script>
