<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DESCARMED | {{$title}}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <main class="ml-[15vw] p-6">
        <x-sidenav></x-sidenav>
        {{$slot}}
    </main>
</body>
</html>