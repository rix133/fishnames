<tr class="border-b">
    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
        Eestikeelsed nimed
    </th>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
        @foreach ($species->estnames as $estname)
            @if($estname->accepted)
                @php $color = "green" @endphp
            @else
                @php $color = "yellow" @endphp
            @endif
            @if($idSelected == $estname->id)
                <div class="px-2 py-1 focus:outline-none inline-flex text-ms leading-5 font-semibold rounded-full bg-{{$color}}-500 text-{{$color}}-900">
                        {{ $estname->est_name }}
                </div>
              
            @else
                <a href="{{ route('estnames.edit', $estname->id) }}">
                    <button class="px-2 py-1 focus:outline-none inline-flex text-ms leading-5 font-semibold rounded-full bg-{{$color}}-100 text-{{$color}}-800 hover:bg-{{$color}}-500 hover:text-{{$color}}-900">
                    {{ $estname->est_name }}
                    </button> 
                </a>     
            @endif
        @endforeach
    </td>
</tr>