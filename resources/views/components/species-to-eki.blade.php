@can('estname_access')
    <div class="flex flex-col">
        <div class="my-1 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-1 align-middle inline-block min-w-full sm:px-4 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
              <x-table-termeki-confirm :estnames="$estnames"/>
            </div>
          </div>
        </div>
      </div>
@endcan
