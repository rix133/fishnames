<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liiginimede rakenduse kasutusjuhend') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="aspect-w-16 aspect-h-9">
                    <iframe src="https://www.youtube-nocookie.com/embed/videoseries?list=PLq-iZzpuwQFCm1k45U0-W17ZePSd5JnJR&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
            </div>
        </div>
    </div>  
</x-app-layout>
