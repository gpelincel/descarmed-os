<x-app-layout>
    <x-slot:title>{{ $cliente->nome }}</x-slot:title>
    <section class="flex flex-col gap-4 mx-auto max-w-screen-xl px-4 lg:px-12 text-gray-900 dark:text-white mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="uppercase font-bold text-4xl">{{ $cliente->nome }}</h1>
                <h3 class="text-gray-500 dark:text-gray-400">{{ $cliente->razao_social }}</h3>
            </div>
            <div class="flex gap-2 h-10">
                <button onclick="openModalClienteUpdate({{ $cliente->id }})" data-modal-target="modal-update-cliente"
                    data-modal-toggle="modal-update-cliente" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><i
                        class="fi fi-rr-edit"></i> Editar</button>
                <button type="button" data-modal-target="deleteModal" data-modal-toggle="deleteModal"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><i
                        class="fi fi-rr-trash"></i> Deletar</button>
            </div>
        </div>
        <hr class="border-gray-400/50 dark:border-gray-500">
        <ul class="flex flex-wrap gap-8 text-lg">
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">CNPJ</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->cnpj }}
                </p>
            </li>
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">Telefone</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->telefone }}
                </p>
            </li>
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">Email</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->email }}
                </p>
            </li>
        </ul>
        <ul class="flex flex-wrap gap-8 text-lg">
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">CEP</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->endereco->cep }}
                </p>
            </li>
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">Cidade</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->endereco->cidade }}
                </p>
            </li>
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">Estado</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->endereco->estado }}
                </p>
            </li>
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">Logradouro</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->endereco->logradouro }}
                </p>
            </li>
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">Número</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->endereco->numero }}
                </p>
            </li>
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">Bairro</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->endereco->bairro }}
                </p>
            </li>
            <li>
                <h3 class="font-semibold leading-none text-gray-900 dark:text-white">Complemento</h3>
                <p class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                    {{ $cliente->endereco->complemento }}
                </p>
            </li>
        </ul>
    </section>

    <x-cliente.tabs :ordens="$cliente->ordem_servico->paginate(10)" :equipamentos="$cliente->equipamentos()->paginate(10)" :agendas="$cliente->agendas->paginate(10)"></x-cliente.tabs>

    <x-cliente.update-modal></x-cliente.update-modal>
    <x-os.cadastro-modal :selected="$cliente" :clientes="null" :status="$status" :classificacao="$classificacao"></x-os.cadastro-modal>
    <x-os.update-modal :selected="$cliente" :clientes="null" :status="$status" :classificacao="$classificacao"></x-os.update-modal>
    <x-delete-modal :action="'/cliente/delete/' . $cliente->id"></x-os.delete-modal>

    <x-agenda.update-modal :status="$status" :clientes="null" :selected="$cliente"></x-agenda.update-modal>
    <x-agenda.cadastro-modal :status="$status" :clientes="null" :selected="$cliente"></x-agenda.cadastro-modal>

    <x-equipamento.cadastro-modal :clientes="null" :selected="$cliente"></x-equipamento.cadastro-modal>
    <x-equipamento.update-modal :clientes="null" :selected="$cliente"></x-equipamento.update-modal>

    @if ($errors->any())
        <x-toasts :status="'error'" :message="$errors->all()[0]"></x-toasts>
    @endif
    @if (session('status'))
        <x-toasts :status="session('status')" :message="session('message')"></x-toasts>
    @endif
</x-app-layout>
