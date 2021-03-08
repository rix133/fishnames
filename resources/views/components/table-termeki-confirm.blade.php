@can('species_access')
    <form action={{ route('estnames.termeki') }} method="post">
        @method('PUT')
        @csrf
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Ladinakeelne nimi
            </th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Ingliskeelne nimi
            </th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Staatus
            </th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Eestikeelne nimi
            </th>
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Tegevused
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        
                @foreach($estnames as $estname)
                    <tr class="hover:bg-gray-100">
                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">
                            <i>{{$estname->specie->latin_name}}</i>
                            </div>
                            @if($estname->specie->describer)
                            <div class="text-sm text-gray-500">
                            {{$estname->specie->describer}} ({{$estname->specie->year_described}})
                            @endif  
                            </div>
                        </div>
                        </div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{$estname->specie->eng_name}}</div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                        
                    @if($estname->accepted)
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Kinnitatud
                        </span>
                    @else
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Töös
                        </span>
                    @endif
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{$estname->est_name}}
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                        <label class="flex justify-start items-start">
                        <div class="bg-white border-2 rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center mr-2 focus-within:border-blue-500">
                            <input type="checkbox" name="in_termeki[]" value={{$estname->id}} class="opacity-0 absolute" {{  ($estname->in_termeki == 1 ? ' checked' : '') }}>
                            <svg class="fill-current hidden w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20"><path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/></svg>
                        </div>
                        <div class="select-none">Termekis olemas</div>
                        </label>
                    
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                salvesta
            </button>
        </div>
    </form> 
@endcan

<style>
    input:checked + svg {
      display: block;
    }
  </style>
