<x-app-layout>
    <x-slot name="header">
        <span class="font-semibold text-xl text-gray-800 leading-tight">
            Liigid   
        </span>
        <span class="mx-2">
            @if($showInprogress)
                @php 
                $color = "gray";
                $show = false;
                $lable = "Näita kõiki"
                @endphp
            @else
                @php 
                $color = "yellow";
                $show = true;
                $lable = "Näita ainult töösolevaid"
                @endphp
            @endif
            <a href="{{ route('species.index',['showInprogress' => $show]) }}">
                <button class="px-2 py-1 focus:outline-none inline-flex text-ms leading-5 font-semibold rounded-full bg-{{$color}}-100 text-{{$color}}-800 hover:bg-{{$color}}-500 hover:text-{{$color}}-900">
                {{ $lable }}
                </button> 
            </a>
        </span>
        
    </x-slot>
    <x-table-species :species="$species"/>  

  
</x-app-layout>
