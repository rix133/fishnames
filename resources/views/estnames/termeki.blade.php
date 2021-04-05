<x-app-layout>
    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 leading-tight">
            Termeki salvestus
            </span>
        <span class="float-right hidden md:block">
            @php
                $goto = "termeki";
            @endphp
            <x-search :goto="$goto"/>
        </span>
    </x-slot>
    
    <div class= "my-4">
        <x-species-to-eki :estnames="$estnames"/>  
    </div>
    


</x-app-layout>