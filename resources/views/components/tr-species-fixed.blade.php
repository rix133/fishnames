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
        Staatus
    </th>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
        @if($species->new_id)
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                    Nimi kehtetu
                  </span>
       @endif 
        @if(count($species->confirmedNames)>0)
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
            Kinnitatud
            </span>
        @elseif(count($species->estnames)>0)
            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                Töös
            </span>
        @endif
        @foreach($species->confirmedNames as $name)
            @if($name->in_termeki)
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                {{$name->est_name}} EKI andmebaasi laetud
                </span>
            @endif
        @endforeach
    </td>
</tr>