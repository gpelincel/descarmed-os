{{-- Topbar --}}
<div class="flex flex-col md:flex-row items-end justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
    @if (isset($options))
        {{-- Search Input --}}
        <div class="w-full md:w-3/4">
            <form class="flex items-end gap-4">
                <label for="search" class="sr-only">Buscar</label>
                <div class="relative w-1/2">
                    <input type="text" id="search" name="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2 pl-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Buscar" value="{{ request('search') }}">
                </div>
                <div>
                    <label for="field" class="text-xs dark:text-white">Buscar por:</label>
                    <select id="field" name="field"
                        class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($options as $opt)
                            <option value="{{ $opt['value'] }}"
                                {{ request('field') === $opt['value'] ? 'selected' : '' }}>
                                {{ $opt['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{ $slot }}
                <button type="submit"
                    class="p-2.5 h-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 px-4">Filtrar</button>
            </form>
        </div>
    @endif
    {{-- Tools menu --}}
    <div
        class="flex items-end">
        <button type="button" data-modal-target="cadastrar{{ $label }}Modal"
            data-modal-toggle="cadastrar{{ $label }}Modal"
            class="flex uppercase items-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
            </svg>
            Cadastrar {{ $label }}
        </button>
        {{-- <div class="flex items-center space-x-3 w-full md:w-auto">
            <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown"
                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                type="button">
                <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                </svg>
                Actions
            </button>
            <div id="actionsDropdown"
                class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                    <li>
                        <a href="#"
                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mass
                            Edit</a>
                    </li>
                </ul>
                <div class="py-1">
                    <a href="#"
                        class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                        all</a>
                </div>
            </div>
            <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                type="button">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400"
                    viewbox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                        clip-rule="evenodd" />
                </svg>
                Filter
                <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                </svg>
            </button>
            <div id="filterDropdown" class="z-10 hidden w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Category</h6>
                <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                    <li class="flex items-center">
                        <input id="apple" type="checkbox" value=""
                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Apple
                            (56)</label>
                    </li>
                    <li class="flex items-center">
                        <input id="fitbit" type="checkbox" value=""
                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Fitbit
                            (56)</label>
                    </li>
                    <li class="flex items-center">
                        <input id="dell" type="checkbox" value=""
                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="dell" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Dell
                            (56)</label>
                    </li>
                    <li class="flex items-center">
                        <input id="asus" type="checkbox" value="" checked=""
                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="asus" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Asus
                            (97)</label>
                    </li>
                    <li class="flex items-center">
                        <input id="logitech" type="checkbox" value="" checked=""
                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="logitech"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Logitech (97)</label>
                    </li>
                    <li class="flex items-center">
                        <input id="msi" type="checkbox" value="" checked=""
                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="msi" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">MSI
                            (97)</label>
                    </li>
                    <li class="flex items-center">
                        <input id="bosch" type="checkbox" value="" checked=""
                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="bosch" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Bosch
                            (176)</label>
                    </li>
                    <li class="flex items-center">
                        <input id="sony" type="checkbox" value=""
                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="sony" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Sony
                            (234)</label>
                    </li>
                    <li class="flex items-center">
                        <input id="samsung" type="checkbox" value="" checked=""
                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="samsung"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Samsung (76)</label>
                    </li>
                    <li class="flex items-center">
                        <input id="canon" type="checkbox" value=""
                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="canon" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Canon
                            (49)</label>
                    </li>
                    <li class="flex items-center">
                        <input id="microsoft" type="checkbox" value=""
                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="microsoft"
                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Microsoft (45)</label>
                    </li>
                    <li class="flex items-center">
                        <input id="razor" type="checkbox" value=""
                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="razor" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Razor
                            (49)</label>
                    </li>
                </ul>
            </div>
        </div> --}}
    </div>
</div>
