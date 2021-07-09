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
        <label for="describer">Kirjeldaja</label>
    </th>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
    <input type="text" name="describer" id="describer" class="form-input rounded-md shadow-sm mt-1 block w-full"
            value="{{ old('describer', $species->describer) }}" />
        @error('describer')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </td>
</tr>
<tr class="border-b">                        
    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        <label for="year_described">Kirjeldamise aasta</label>
    </th>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
    <input type="text" name="year_described" id="year_described" class="form-input rounded-md shadow-sm mt-1 block w-full"
            value="{{ old('year_described', $species->year_described) }}" />
        @error('year_described')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </td>
</tr>
<tr class="border-b">                        
    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        <label for="latin_family">Ladinakeelne sugukond</label>
    </th>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
    <input type="text" name="latin_family" id="latin_family" class="form-input rounded-md shadow-sm mt-1 block w-full"
            value="{{ old('latin_family', $species->latin_family) }}" />
        @error('latin_family')
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
        Nime allikad
    </th>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
        <select name="sources[]" id="sources" class="form-multiselect block rounded-md shadow-sm mt-1 block w-full" multiple="multiple">
            @foreach($sources as $id => $source)
                <option value="{{ $source->id }}"{{ in_array($source->id, old('sources', $species->sources->pluck('id')->toArray())) ? ' selected' : '' }}>
                    {{ $source->name }}
                </option>
            @endforeach
        </select>
        @error('sources')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </td>
</tr>
@if($species->id)
<tr class="border-b">
    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Uus ladinakeelne nimi
    </th>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
    <input type="text" name="new_id" id="new_id" class="form-input rounded-md shadow-sm mt-1 block w-full"
            value="{{ old('new_id', $species->newName()) }}" placeholder="Uus kehtiv nimi..."/>
        @error('new_id')
            <p class="text-sm text-red-600">See peab olema mõni olemasolev ladinakeelne nimi!</p>
        @enderror
    </td>
</tr>
@endif