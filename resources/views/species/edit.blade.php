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
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <form id="speciesupadate" method="post" action="{{ route('species.update', $species->id) }}">
                                    @csrf
                                    @method('put')
                                    <tr class="border-b">                            
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            <label for="latin_name">Ladinakeelne nimi</label>
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        <input type="text" name="latin_name" id="latin_name" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                                value="{{ old('latin_name', $species->latin_name) }}" />
                                            @error('latin_name')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ingliskeelne nimi
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                            <input type="text" name="eng_name" id="eng_name" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                                value="{{ old('eng_name', $species->eng_name) }}" />
                                            @error('eng_name')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nime allikas
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                            <select name="source_id" id="source_id" 
                                                class="form-select block rounded-md shadow-sm mt-1 block w-full" 
                                                >
                                                @foreach($sources as $id => $source)
                                                    <option value="{{ $source->id }}" {{$source->id == $species->source_id ? 'selected' : ''}}>
                                                        {{ $source->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('source_id')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    </tr>
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
                                            EKI andmebaasi laetud nimede muutmise võimalust ei ole loodud
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
            <div class="block mt-8">
                <a href="{{ route('species.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Tagasi nimekirja</a>
            </div>
        </div>
    </div>
</x-app-layout>

