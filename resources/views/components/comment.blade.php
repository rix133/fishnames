<div class="flex">
    <div class="flex-1 border rounded-lg px-4 py-1 sm:px-6 sm:py-2 leading-relaxed">
      <strong>{{$estname->est_name}}</strong> <span class="text-xs text-gray-400"> (pakkus: {{$estname->user->name}})</span>      
      <h4 class="my-1 uppercase tracking-wide text-gray-400 font-bold text-xs">Kommentaarid</h4>
      <div class="space-y-0">
        @foreach($estname->notes as $note)
        <div class="flex">
          <div class="flex-1 bg-gray-100 rounded-lg px-4 py-1 sm:px-6 sm:py-2 leading-relaxed">
            <strong>{{$note->user->name}}</strong> <span class="text-xs text-gray-400">lisatud: {{date('d-m-Y', strtotime($note->created_at))}}</span>
            <p class="text-xs sm:text-sm">
              {{$note->description}}
            </p>
          </div>
        </div>
        @endforeach
        @can("estname_access")
        <h4 class="my-1 uppercase tracking-wide text-gray-400 font-bold text-xs">Lisa kommentaar</h4>
        <form method="post" action="{{ route('notes.store') }}">
            @csrf
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-2 bg-white sm:p-6">                    
                    <textarea id="message" name="description" type="text" placeholder="Kirjuta siia oma arvamus..." class="form-input rounded-md shadow-sm mt-1 block w-full"></textarea>    
                    @error('description')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <input type="hidden" value="{{$estname->id}}" name="estname_id">
                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        Lisa kommentaar
                    </button>
                </div>
            </div>
        </form>
        @endcan
      </div>
    </div>

</div>