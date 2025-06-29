@props([
    'query' => ''
])

<nav aria-label="navigation" class="sticky top-0 bg-[#202124] border-b border-[#3c4043] z-10">
    <div class="flex items-center gap-6 px-4 sm:px-8 py-4 max-w-6xl mx-auto">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex-shrink-0">
            <h1 class="text-2xl sm:text-3xl text-white font-bold hover:opacity-80 transition-opacity">
                <span class="text-[#4285f4]">Next</span>Google
            </h1>
        </a>

        <!-- Search Form -->
        <div class="flex-1 max-w-2xl">
            <form id="searchForm" method="GET" action="{{ route('search') }}">
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                        <svg class="w-4 h-4 text-[#9aa0a6] group-focus-within:text-[#8ab4f8] transition-colors" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    
                    <input class="w-full h-11 pl-12 pr-20 bg-[#303134] text-[#e8eaed] placeholder-[#9aa0a6] rounded-full border border-[#5f6368] hover:border-[#8ab4f8] focus:border-[#8ab4f8] focus:outline-none transition-colors"
                           type="search" 
                           id="searchInput" 
                           name="query" 
                           autocomplete="off"
                           placeholder="Cari atau ketik URL"
                           value="{{ $query }}"
                           form="searchForm"
                    />
                    
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center gap-2">
                        <button type="button" class="p-1.5 hover:bg-[#3c4043] rounded-full transition-colors">
                            <svg class="w-3.5 h-3.5 text-[#9aa0a6] hover:text-[#8ab4f8]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z"/>
                                <path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/>
                            </svg>
                        </button>
                        <button type="button" class="p-1.5 hover:bg-[#3c4043] rounded-full transition-colors">
                            <svg class="w-3.5 h-3.5 text-[#9aa0a6] hover:text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- User Avatar -->
        <div class="flex-shrink-0">
            <img src="{{ asset('dodo.jpg') }}" 
                 alt="User Avatar" 
                 class="w-8 h-8 rounded-full border-2 border-transparent hover:border-[#8ab4f8] transition-colors cursor-pointer">
        </div>
    </div>

    <!-- Search Filter Tabs -->
    <div class="px-4 sm:px-8 max-w-6xl mx-auto">
        <div class="flex gap-6 pb-2 text-sm">
            <a href="#" class="text-[#8ab4f8] border-b-2 border-[#8ab4f8] pb-2 hover:text-[#aecbfa]">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Semua
                </span>
            </a>
            <a href="#" class="text-[#bdc1c6] hover:text-[#e8eaed] pb-2 transition-colors">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Gambar
                </span>
            </a>
            <a href="#" class="text-[#bdc1c6] hover:text-[#e8eaed] pb-2 transition-colors">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                    Video
                </span>
            </a>
            <a href="#" class="text-[#bdc1c6] hover:text-[#e8eaed] pb-2 transition-colors">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    Berita
                </span>
            </a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.querySelector('#searchInput');
        const form = document.querySelector('#searchForm');

        const searchNow = () => {
            const query = input.value.trim();
            if (!query) {
                Swal.fire({
                    title: "Kolom pencarian kosong!",
                    text: "Masukkan kata kunci untuk mencari",
                    icon: "info",
                    background: '#303134',
                    color: '#e8eaed',
                    confirmButtonColor: '#1a73e8'
                });
                return;
            }
            form.submit();
        };

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            searchNow();
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchNow();
            }
        });
    });
</script>
