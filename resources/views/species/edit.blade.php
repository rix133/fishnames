<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Muuda liiki
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('species.index', ['showInprogress' => true])}}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Tagasi nimekirja</a>
                @error('confirmErr')
                    <div class="my-4 text-red-500 font-bold">{{$message}}</div>
                @enderror
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <form id="speciesupadate" method="post" action="{{ route('species.update', $species->id) }}">
                                    @csrf
                                    @method('put')
                                    <x-tr-species-edit :species="$species" :sources="$sources"/>
                                </form>
                                <x-tr-species-fixed :species="$species"/>
                                <x-tr-estname :species="$species" :idSelected="0"/>
                                @if($species->estname()->est_name)
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Toimingud
                                    </th>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        @php $color="red" @endphp
                                        @if($species->estname()->in_termeki)
                                            <button disabled class="px-2 py-1 focus:outline-none inline-flex text-ms leading-5 font-semibold rounded-full bg-{{$color}}-100 text-{{$color}}-800 bg-{{$color}}-500 text-{{$color}}-900">
                                            Aksepteeritud nime muutmiseks vabasta see enne Termeki tabelis. 
                                            </button> 
                                        @else
                                            <a href="{{ route('species.estnames.reset', $species->id) }}">
                                                <button class="px-2 py-1 focus:outline-none inline-flex text-ms leading-5 font-semibold rounded-full bg-{{$color}}-100 text-{{$color}}-800 hover:bg-{{$color}}-500 hover:text-{{$color}}-900">
                                                Tühista kinnitus nimelt: {{$species->estname()->est_name}}
                                                </button> 
                                            </a> 
                                        @endif
                                    </td>

                                </tr>  
                                @else
                                    
                                @endif
                            </table>
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button form="speciesupadate" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Salvesta
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @can("species_access")
            <div class="block mt-8">
            @error('deleteMsg')
                <div class="my-4 text-red-500 font-bold">{{$message}}</div>
             @enderror
                <form class="inline-block" action="{{ route('species.destroy', $species->id) }}" method="POST" onsubmit="return confirm('Oled kindel, et tahad kustutada?');">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="focus:outline-none text-white py-2 px-4 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Kustuta {{$species->latin_name}}
                    </button>                                              
                </form> 
            </div>
            
           @endcan
        </div>
    </div>
</x-app-layout>

