{{-- {{ dump(shell_exec("which python")) }}
{{ dump(shell_exec("python --version")) }} --}}
{{-- {{ dd( $data ) }} --}}

<x-layout class="bg-[rgb(32,33,36)]" :title="$query">
    <x-search.navbar />

    <main class="flex flex-col gap-6 items-start px-4 sm:px-8 py-6 w-full max-w-5xl mx-auto">
        <!-- Search stats -->
        @if(count($data) > 0)
            <div class="text-gray-400 text-sm ml-1">
                About {{ count($data) }} results for <span class="text-blue-300 font-medium">{{ $query }}</span>
            </div>
        @endif

        @forelse ($data as $item)
            <div class="p-5 bg-[rgb(48,49,52)] rounded-xl shadow-lg w-full hover:shadow-xl transition-shadow duration-200 border border-[rgb(60,64,67)]">
                <!-- Surah info header -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-3">
                    <div>
                        <h2 class="text-[rgb(138,180,248)] text-lg font-medium">
                            {{ $item['surah_name_roman'] }} ({{ $item['surah_name_en'] }})
                            <span class="text-gray-400 ml-1">{{ $item['surah_no'] }}:{{ $item['ayah_no_surah'] }}</span>
                        </h2>
                        <div class="text-gray-400 text-sm mt-1">
                            <span class="inline-block px-2 py-0.5 bg-[rgb(60,64,67)] rounded-full mr-2 text-xs">
                                {{ $item['place_of_revelation'] }}
                            </span>
                            <span class="inline-block px-2 py-0.5 bg-[rgb(60,64,67)] rounded-full mr-2 text-xs">
                                Juz {{ $item['juz_no'] }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-2 sm:mt-0 text-sm text-gray-400">
                        Score: <span class="text-[rgb(138,180,248)]">{{ number_format($item['score'], 4) }}</span>
                    </div>
                </div>
                
                <!-- English translation -->
                <p class="text-gray-200 text-lg mb-4 leading-relaxed">{{ $item['ayah_en'] }}</p>
                
                <!-- Arabic text -->
                <div class="arabic-text text-right mb-3 py-3 border-t border-b border-[rgb(60,64,67)]">
                    <p class="text-[rgb(232,234,237)] text-2xl md:text-3xl" dir="rtl">{{ $item['ayah_ar'] }}</p>
                </div>
                
                <!-- Metadata section -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2 mt-4 text-xs">
                    <div class="text-gray-400">
                        <span class="text-gray-500">Ayah in Quran:</span> {{ $item['ayah_no_quran'] }}/{{ $item['total_ayah_quran'] }}
                    </div>
                    <div class="text-gray-400">
                        <span class="text-gray-500">Ayah in Surah:</span> {{ $item['ayah_no_surah'] }}/{{ $item['total_ayah_surah'] }}
                    </div>
                    <div class="text-gray-400">
                        <span class="text-gray-500">Hizb:</span> {{ $item['hizb_quarter'] }}
                    </div>
                    <div class="text-gray-400">
                        <span class="text-gray-500">Words:</span> {{ $item['no_of_word_ayah'] }}
                    </div>
                </div>
            </div>
        @empty
            <div class="p-8 bg-[rgb(48,49,52)] rounded-xl shadow-md w-full text-center">
                <p class="text-gray-200 text-lg">No results found for <strong class="text-blue-300">{{ $query }}</strong>.</p>
                <p class="text-gray-400 mt-2">Try different keywords or check your spelling.</p>
            </div>
        @endforelse
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.querySelector('#searchInput');
            const iconSearch = document.querySelector('#searchIcon');
            if (!input || !iconSearch) return;

            const searchNow = () => {
                const query = input.value.trim();
                if (!query) {
                    event.preventDefault();
                    Swal.fire({
                        title: "Input field is empty!",
                        text: "type any key in search input",
                        icon: "info"
                    });
                    return;
                }
                const url = new URL('/search', window.location.origin);
                url.searchParams.set('query', query);
                window.location.href = url.toString();
            };

            iconSearch.addEventListener('click', searchNow);
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') searchNow();
            });
        });
    </script>
</x-layout>