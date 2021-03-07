<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Termeki salvestus
        </h2>
    </x-slot>
    
    <div class= "my-4 bg-white">
        <x-species-to-eki :estnames="$estnames"/>  
    </div>
    


</x-app-layout>