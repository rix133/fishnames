<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liigitabeli 
            @can('species_access')
            import /
            @endcan
            export excelisse
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8">
            <a href="{{ route('species.index') }}" class="bg-gray-200 hover:bg-gray-300 text-black font-bold py-2 px-4 rounded">Tagasi liikide nimekirja</a>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 w-full">
                            @can('species_access')
                            <tr class="border-b">
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Impordi
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <form class="flex flex-wrap align-center" action="{{ route('excel.import') }}" method="POST" enctype="multipart/form-data" id="species-upload-form">
                                        @csrf
                                         <button disabled id="excelUploadButton" for="species-upload-form" class="disabled:opacity-75 hover:disabled:bg-blue-500 cursor-not-allowed  item-right focus:outline-none text-white text-xs py-2 px-4 rounded-md bg-blue-500 flex">
                                            <svg fill="#FFF" class="w-4 h-4 mr-2" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 16h6v-6h4l-7-7-7 7h4zm-4 2h14v2H5z"/>
                                            </svg>
                                            <span class="ml-2">Lae üles</span>
                                        </button>
                                        <input class="py-1 mx-6" id="file-upload" type="file" name="file" onchange="checkfile(this)" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    </form>
                                    @if ($failures ?? false)
                                    <div class="alert alert-danger" role="alert">
                                        <strong>Errors:</strong>
                                        
                                        <ul>
                                            @foreach ($failures as $failure)
                                                @foreach ($failure->errors() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </td>
                            </tr>
                            @endcan
                            <tr class="border-b">
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Expordi
                                </th>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                    <form class="flex flex-wrap align-center" action="{{ route('excel.export') }}" method="GET">
                                        @csrf
                                        <button class="item-right focus:outline-none text-white text-xs py-2 px-4 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg flex">
                                            <svg fill="#FFF" class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/>
                                            </svg>
                                            <span class="ml-2">Lae alla</span>
                                        </button>
                                        <select class="py-1 mx-6" name="download-filter">
                                            <option value="all">Kõik</option>
                                            <option value="inProgress">Töös olevad</option>
                                            <option value="confirmed">Kinnitatud</option>
                                            <option value="inEKI">EKIs olemas</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script type="text/javascript" language="javascript">
    btn = document.getElementById("excelUploadButton");
    function checkfile(sender) {
        var validExts = new Array(".xlsx", ".xls");
        var fileExt = sender.value;
        fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
        if (validExts.indexOf(fileExt) < 0) {
          btn.disabled = true;
          btn.className += " cursor-not-allowed";
        }
        else {
            btn.disabled = false;
            btn.className = btn.className.replace(/\bcursor-not-allowed\b/g, "");
            btn.className += " hover:bg-blue-600 hover:shadow-lg";
        }
    }
    </script>

