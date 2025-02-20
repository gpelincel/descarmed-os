<x-guest-layout>
    <section class="min-h-screen" style="background-image: url('/img/equipamento-medico.jpg'); background-size: cover;">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 h-full">
            <div>
                <img class="w-32 mb-2" src="{{asset('/img/logo.png')}}" alt="logo">
            </div>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-center text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white uppercase">
                        Bem-vindo
                    </h1>
                    <form class="flex flex-col gap-4" action="/login" method="POST">
                        @csrf
                        <div>
                            <label for="usuario" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Usuário</label>
                            <input type="text" name="usuario" id="usuario"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none"
                                placeholder="user123" required="">
                        </div>
                        <div>
                            <label for="senha"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                            <input type="password" name="senha" id="senha" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none"
                                required="">
                        </div>
                        <div class="flex items-center justify-between">
                            <a href="/cliente"
                                class="text-sm font-medium text-primary-600 hover:underline dark:text-blue-500">Esqueceu a senha?</a>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-primary-800">Entrar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @if (session('status'))
        <x-toasts :status="session('status')"></x-toasts>
    @endif
</x-guest-layout>
