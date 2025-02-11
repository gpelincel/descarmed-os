<x-app-layout>
    <x-slot:title>{{$cliente->nome}}</x-slot:title>
    <h1>{{$cliente->nome}}</h1>
    {{-- <x-os-table :clientes="$cliente->ordens_servico()"></x-os-table> --}}
</x-app-layout>