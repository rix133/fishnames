@can('species_access')
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="my-4 align-middle justify-center flex">
                    Praegune süsteem ei võimalda automaatset termeki andmebaasi laadimist, kui see võimalus tekib ilmub vastav info siia.
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="my-1 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-1 align-middle inline-block min-w-full sm:px-4 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
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
                        @can('species_access')
                          <form action={{ route('estnames.finish', $estname->id) }} method="post">
                            @method('PUT')
                            @csrf
                            <button class="focus:outline-none text-white text-xs py-2 px-4 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg flex items-center">
                              <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                              </svg>
                              Kinnita, et on EKIsse laetud
                            </button>
                          </form>
                            
                        @endcan
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
@endcan