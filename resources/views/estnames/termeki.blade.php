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
    <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8 ">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                <div class="my-4 align-middle justify-center flex">
                    Praegune süsteem ei võimalda automaatset termeki andmebaasi laadimist, kui see võimalus tekib ilmub vastav info siia.
                </div>
            </div>
        </div>
    </div>
    
    <div class= "m-2">
        {{$estnames->appends($_GET)->onEachSide(1)->links()}}  
        
    </div>
    <x-species-to-eki :estnames="$estnames"/> 


</x-app-layout>