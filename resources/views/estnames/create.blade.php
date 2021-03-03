<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Paku uus nimi
        </h2>
    </x-slot>
    <div>
        <x-speciesshow :species="$liik">
        </x-speciesshow>


        <div class="max-w-6xl mx-auto py-1 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('estnames.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-2 bg-white sm:p-6">
                            <label for="newname" class="block font-medium text-sm text-gray-700">Uus eestikeelne nimi</label>
                            <input type="text" name="est_name" id="newname" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                    value="{{ old('est_name', '') }}" />
                            @error('est_name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            <label for="message" class="block font-medium text-sm text-gray-700 py-1">Kommentaar</label>
                            <textarea id="message" name="note" type="text" placeholder="Valikuline..." class="form-input rounded-md shadow-sm mt-1 block w-full">{{old('note', '')}}</textarea>    
                        </div>
                        <input type="hidden" value="{{$liik->id}}" name="specie_id">
                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Salvesta
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>