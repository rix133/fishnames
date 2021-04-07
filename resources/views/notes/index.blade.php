<x-app-layout>
    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 leading-tight">
            Kommentaarid
        </span>
        <span class="float-right hidden md:block">
            @php
                $goto = "notes";
            @endphp
            <x-search :goto="$goto"/>
        </span>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ladinakeelne nimi
                                    </th>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Eestikeelne nimi
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kommentaar eestikeelsele nimele
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3 bg-gray-50">

                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($notes as $note)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                           <i> {{ $note->estname->specie->latin_name}}</i>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $note->estname->est_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $note->description }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('notes.show', $note->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">
                                                <button type="button" class="focus:outline-none text-white text-xs py-2 px-4 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg inline-flex items-center">
                                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Näita täpsemalt
                                                </button>
                                            </a>
                                            <a href="{{ route('estnames.edit', $note->estname) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">
                                                <button type="button" class="focus:outline-none text-white text-xs py-2 px-4 rounded-md bg-gray-500 hover:bg-gray-600 hover:shadow-lg inline-flex items-center">
                                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                    Lisa kommentaar 
                                                </button>
                                            </a>
                                            <form class="inline-block" action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Oled kindel, et tahad kustutada?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                @if($user_id==$note->user_id)
                                                <button type="submit" class="focus:outline-none text-white text-xs py-2 px-4 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg inline-flex items-center">
                                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Kustuta
                                                </button>  
                                                @endif                                            
                                            </form>
                                        </td>     
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{$notes->appends($_GET)->onEachSide(1)->links()}}  
    </div>
</x-app-layout>
