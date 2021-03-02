<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Vaata liiki
        </h2>
    </x-slot>
    <x-speciesshow :species="$species">
    </x-speciesshow>
</x-app-layout>