<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="flex align-middle">
               {{$estname->est_name}} nimeks liigile&nbsp;
               <i>{{$estname->specie->latin_name}}</i>
               <div class="flex align-middle mx-4">
               <x-estname-confirm :name="$estname"/>
               </div>
           <div>
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8 flex"> 
            <a href="{{ route('estnames.create', ['spid' => $estname->specie_id]) }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Paku uus nimi</a>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            <x-tr-species-details :species="$estname->specie"></x-tr-species-details>
                            <x-tr-species-fixed :species="$estname->specie"/>
                            <x-tr-estname :species="$estname->specie" :idSelected="$estname->id"/>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <x-comment :estname="$estname">
        </x-comment>
    </div>
    

 

</x-app-layout>