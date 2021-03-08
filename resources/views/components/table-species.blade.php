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
                  Eesti nimevariandid
                </th>
                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Tegevused
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($species as $liik)
              <tr class="hover:bg-gray-100">
                <td class="px-4 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        <i>{{$liik->latin_name}}</i>
                      </div>
                      @if($liik->describer)
                      <div class="text-sm text-gray-500">
                        {{$liik->describer}} ({{$liik->year_described}})
                      @endif  
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-4 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{$liik->eng_name}}</div>
                </td>
                <td class="px-4 py-4 whitespace-nowrap">
                  
                @if($liik->estname)
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    Kinnitatud
                  </span>
                @elseif(count($liik->estnames)>0)
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                      Töös
                  </span>
                @endif
                </td>
                <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
                    @if($liik->estname) 
                        {{$liik->estname}}
                    @else
                    <table class="divide-y divide-gray-200 float-right">
                    @foreach ($liik->estnames as $name)
                    <tr>
                      <td class="px-1 whitespace-nowrap">
                      {{$name->est_name}}
                      </td>
                      <td class="px-1 whitespace-nowrap">
                        <a href="{{ route('estnames.edit', $name->id) }}">
                          <button type="button" class="focus:outline-none text-white text-xs py-2 px-4 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg flex">
                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            Arvamused ({{count($name->notes)}})
                          </button>
                        </a>
                      </td>
                      <td class="px-1 whitespace-nowrap">
                        <x-estname-confirm :name="$name"/>
                      </td>
                    </tr>
                    @endforeach
                    </table>
                @endif 
                </td>
                <td class="px-4 py-4 whitespace-nowrap">
                  @if($liik->estname) 
                  <span></span> 
                  @else
                  <a href="{{ route('estnames.create', ['spid' => $liik->id]) }}">
                    <button type="button" class="focus:outline-none text-white text-xs py-2 px-4 rounded-md bg-gray-500 hover:bg-gray-600 hover:shadow-lg inline-flex items-center">
                      <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      Paku uus nimi
                    </button>
                  </a>
                  @endif
                @can('species_access')
                  <a href="{{ route('species.edit', $liik->id) }}">
                    <button type="button" class="focus:outline-none text-white text-xs py-2 px-4 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        
                        Muuda andmeid
                    </button>
                  </a>
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