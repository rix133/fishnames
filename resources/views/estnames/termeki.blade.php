<x-app-layout>
    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 leading-tight">
            Termeki salvestus
        </span>
        <span class="mx-2">
        @if($showInprogress)
            @php 
            $color = "gray";
            $show = false;
            $lable = "Näita kõiki"
            @endphp
        @else
            @php 
            $color = "yellow";
            $show = true;
            $lable = "Näita ainult EKIs puuduvaid"
            @endphp
        @endif
        <a href="{{ route('estnames.termeki',['showInprogress' => $show, 'search' => $searchString]) }}">
            <button class="px-2 py-1 focus:outline-none inline-flex text-ms leading-5 font-semibold rounded-full bg-{{$color}}-100 text-{{$color}}-800 hover:bg-{{$color}}-500 hover:text-{{$color}}-900">
            {{ $lable }}
            </button> 
            </a>
        </span>
        <span class="float-right hidden md:block">
            @php
                $goto = "termeki";
            @endphp
            <x-search :goto="$goto" :searchString="$searchString"/>
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