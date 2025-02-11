<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>DESCARMED | {{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <main class="ml-[15vw]">
        <x-sidenav></x-sidenav>
        <section class="bg-gray-300 dark:bg-gray-900 p-3 sm:p-5 antialiased min-h-screen">
            {{ $slot }}
        </section>
    </main>
</body>

</html>
