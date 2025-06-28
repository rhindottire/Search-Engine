@props([
    "title" => "Hasil Pencarian",
])

<x-layout class="bg-[#202124]" :title="$title">
    <x-search.navbar :query="$query" />

    <main class="flex flex-col gap-6 items-start px-4 sm:px-8 py-6 w-full max-w-5xl mx-auto">
        <!-- Search stats -->
        @if(count($data) > 0)
            <div class="text-gray-400 text-sm ml-1">
                About {{ count($data) }} results for <span class="text-blue-300 font-medium">{{ $query }}</span>
            </div>
        @endif

        @forelse ($data as $item)
            <div class="p-5 bg-[rgb(48,49,52)] rounded-xl shadow-lg w-full hover:shadow-xl transition-shadow duration-200 border border-[rgb(60,64,67)]">
                <!-- Article header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3">
                    <div>
                        <h2 class="text-[rgb(138,180,248)] text-lg font-medium">
                            {!! $item['title'] !!}
                        </h2>
                        <div class="text-gray-400 text-sm mt-1">
                            <span class="inline-block px-2 py-0.5 bg-[rgb(60,64,67)] rounded-full mr-2 text-xs">
                                ID: {{ $item['id'] }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-2 sm:mt-0 text-sm text-gray-400">
                        Score: <span class="text-[rgb(138,180,248)]">{{ number_format($item['score'], 2) }}</span>
                    </div>
                </div>
                
                <!-- Article content -->
                <p class="text-gray-200 text-base leading-relaxed">{!! $item['content'] !!}</p>
            </div>
        @empty
            <div class="p-8 bg-[rgb(48,49,52)] rounded-xl shadow-md w-full text-center">
                <p class="text-gray-200 text-lg">No results found for <strong class="text-blue-300">{{ $query }}</strong>.</p>
                <p class="text-gray-400 mt-2">Try different keywords or check your spelling.</p>
            </div>
        @endforelse
    </main>
</x-layout>