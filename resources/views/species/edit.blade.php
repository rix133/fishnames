<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Muuda liiki
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('species.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Tagasi nimekirja</a>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <form method="post" action="{{ route('species.update', $species->id) }}">
                            @csrf
                            @method('put')
                                <table class="min-w-full divide-y divide-gray-200 w-full">
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
                                            {{ $species->eng_name }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Viimati muudetud
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                            {{ $species->updated_at }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Eestikeelsed nimed
                                        </th>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                            @foreach ($species->estnames as $estname)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        {{ $estname->est_name }}
                                                    </span>
                                            @endforeach
                                        </td>
                                    </tr>
                                </table>
                                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                        Salvesta
                                    </button>
                                </div>
                            </form>
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
