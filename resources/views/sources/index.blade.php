<x-app-layout>
    <x-slot name="header">
        <div class="max-w-6xl mx-auto">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Allikad
        </h2>
        </div>
    </x-slot>
     <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            @can("species_access")
            <div class="block mb-8">
                <a href="{{ route('sources.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Lisa allikas</a>
                @if($errors->any())
                <span class="mx-4 text-red-500 font-bold">{{$errors->first()}}</span>
                 @endif
            </div>
            @endcan
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full">
                                <thead>
                                <tr>
                                    <th scope="col" width="50" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nimi 
                                    </th>
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Selgitus/viide
                                    </th>
                                    @can('species_access')
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tegevused
                                    </th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($sources as $source)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $source->id }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $source->name }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $source->description }}
                                        </td>

                                        @can('species_access')
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('sources.edit', $source->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">
                                                <button type="button" class="focus:outline-none text-white text-xs py-2 px-4 rounded-md bg-gray-500 hover:bg-gray-600 hover:shadow-lg inline-flex items-center">
                                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                    Muuda 
                                                </button>
                                            </a>
                                            <form class="inline-block" action="{{ route('sources.destroy', $source->id) }}" method="POST" onsubmit="return confirm('Oled kindel, et tahad kustutada?');">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="focus:outline-none text-white text-xs py-2 px-4 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg inline-flex items-center">
                                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Kustuta
                                                </button>                                              
                                            </form>
                                        </td>
                                        @endcan
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
