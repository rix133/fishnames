<div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="block mb-8">
        <a href="{{ route('species.index', ['showInprogress' => true]) }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Tagasi liikide nimekirja</a>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 w-full">
                        <x-tr-species-details :species="$species"/>
                        <x-tr-estname :species="$species" :idSelected="0"/>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

