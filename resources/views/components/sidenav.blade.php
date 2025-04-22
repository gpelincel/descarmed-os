<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-[15vw] h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="flex flex-col justify-between h-full px-2 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <div class="w-full flex flex-col gap-3 justify-center text-center dark:text-gray-400 text-gray-500 mb-8">
                {{-- <img class="w-32" src="/img/logo.png" alt=""> --}}
                <i class="fi fi-sr-circle-user text-8xl"></i>
                <p>{{session('username')}}</p>
            </div>
            <li>
                <a href="/cliente"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i
                        class="fi fi-rr-users text-xl text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Clientes</span>
                </a>
            </li>
            <li>
                <a href="/ordem-servico"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i
                        class="fi fi-rs-customize text-xl text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Ordens de Serviço</span>
                </a>
            </li>
            <li>
                <a href="/agenda"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i
                        class="fi fi-rs-calendar text-xl text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Agenda</span>
                </a>
            </li>
            <li>
                <a href="/equipamento"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i
                        class="fi fi-rr-tool-box text-xl text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Equipamentos</span>
                </a>
            </li>
            <li>
                <a href="/usuario"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i
                        class="fi fi-rr-users-gear text-xl text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Usuários</span>
                </a>
            </li>
            <li>
                <a href="/configuracao"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i
                        class="fi fi-rs-gears text-xl text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="flex-1 ms-3 whitespace-nowrap">Configurações</span>
                </a>
            </li>
        </ul>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="flex items-center p-2 text-red-500 rounded-lg dark:text-red-500 group">
                <i class="fi fi-rr-sign-out-alt text-xl text-red-500 dark:text-red-500 dark:group-hover:text-red"></i>
                <span class="flex-1 ms-3 whitespace-nowrap">Sair</span>
            </button>
        </form>
    </div>
</aside>
