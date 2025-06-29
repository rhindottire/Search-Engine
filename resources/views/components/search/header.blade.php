@props([
    'query' => '',
    'data' => []
])

<!-- Enhanced Mobile-First Search Header -->
<header class="sticky top-0 bg-gradient-to-r from-[#202124] via-[#303134] to-[#202124] border-b border-[#3c4043] z-50 backdrop-blur-sm">
    <!-- Mobile Layout -->
    <div class="block lg:hidden">
        <!-- Mobile Top Bar -->
        <div class="flex items-center justify-between px-4 py-3">
            <!-- Mobile Logo -->
            <a href="{{ route('home') }}" class="group">
                <h1 class="text-xl font-bold transition-all duration-300 group-hover:scale-105">
                    <span class="text-[#4285f4] group-hover:animate-pulse">Next</span><span class="text-white group-hover:text-[#8ab4f8] transition-colors">Google</span>
                </h1>
            </a>
            
            <!-- Mobile Menu Button -->
            <button class="p-2 text-[#9aa0a6] hover:text-[#8ab4f8] hover:bg-[#303134] rounded-full transition-all duration-300" onclick="toggleMobileMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Search Form -->
        <div class="px-4 pb-4">
            <form id="mobileSearchForm" method="GET" action="{{ route('search') }}">
                <div class="relative">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 z-10">
                        <svg class="w-4 h-4 text-[#9aa0a6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    
                    <input class="w-full h-12 pl-10 pr-16 bg-gradient-to-r from-[#303134] to-[#3c4043] text-[#e8eaed] placeholder-[#9aa0a6] rounded-full border border-[#5f6368] focus:border-[#8ab4f8] focus:outline-none focus:shadow-lg focus:shadow-[#8ab4f8]/20 transition-all duration-300 text-base"
                           type="search" 
                           name="query" 
                           autocomplete="off"
                           placeholder="Cari..."
                           value="{{ $query }}"
                    />
                    
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center gap-1">
                        <button type="button" class="p-2 hover:bg-[#3c4043] rounded-full transition-all duration-300">
                            <svg class="w-4 h-4 text-[#9aa0a6]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Desktop Layout -->
    <div class="hidden lg:flex items-center gap-6 px-4 sm:px-8 py-4 max-w-6xl mx-auto">
        <!-- Desktop Logo -->
        <a href="{{ route('home') }}" class="flex-shrink-0 group">
            <h1 class="text-2xl sm:text-3xl text-white font-bold transition-all duration-300 group-hover:scale-105">
                <span class="text-[#4285f4] group-hover:animate-pulse">Next</span><span class="group-hover:text-[#8ab4f8] transition-colors">Google</span>
            </h1>
        </a>

        <!-- Desktop Search Form -->
        <div class="flex-1 max-w-2xl">
            <form id="searchForm" method="GET" action="{{ route('search') }}">
                <div class="relative group">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 z-10">
                        <svg class="w-4 h-4 text-[#9aa0a6] group-focus-within:text-[#8ab4f8] transition-all duration-300" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    
                    <input class="w-full h-11 pl-12 pr-20 bg-gradient-to-r from-[#303134] to-[#3c4043] text-[#e8eaed] placeholder-[#9aa0a6] rounded-full border border-[#5f6368] hover:border-[#8ab4f8] focus:border-[#8ab4f8] focus:outline-none focus:shadow-lg focus:shadow-[#8ab4f8]/20 transition-all duration-300"
                           type="search" 
                           id="searchInput" 
                           name="query" 
                           autocomplete="off"
                           placeholder="Cari atau ketik URL"
                           value="{{ $query }}"
                           form="searchForm"
                    />
                    
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center gap-2">
                        <button type="button" class="p-1.5 hover:bg-[#3c4043] rounded-full transition-all duration-300 group">
                            <svg class="w-3.5 h-3.5 text-[#9aa0a6] group-hover:text-[#8ab4f8] transition-colors" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z"/>
                            </svg>
                        </button>
                        <button type="button" class="p-1.5 hover:bg-[#3c4043] rounded-full transition-all duration-300 group">
                            <svg class="w-3.5 h-3.5 text-[#9aa0a6] group-hover:text-[#8ab4f8] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Desktop Action Buttons -->
        <div class="flex items-center gap-2">
            <!-- Advanced Filters Button -->
            <button onclick="showAdvancedFilters()" 
                    class="inline-flex items-center gap-2 px-3 py-2 bg-[#303134] hover:bg-[#3c4043] text-[#8ab4f8] hover:text-[#aecbfa] rounded-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"/>
                </svg>
                <span class="hidden xl:inline">Filter</span>
            </button>
            
            <!-- Export Button -->
            <button onclick="showExportResults()" 
                    class="inline-flex items-center gap-2 px-3 py-2 bg-[#303134] hover:bg-[#3c4043] text-[#8ab4f8] hover:text-[#aecbfa] rounded-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="hidden xl:inline">Ekspor</span>
            </button>
            
            <!-- Reading Mode Button -->
            <button onclick="enterReadingMode()" 
                    class="inline-flex items-center gap-2 px-3 py-2 bg-[#303134] hover:bg-[#3c4043] text-[#8ab4f8] hover:text-[#aecbfa] rounded-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <span class="hidden xl:inline">Baca</span>
            </button>
            
            <!-- Desktop User Avatar -->
            <div class="flex-shrink-0 ml-2">
                <div class="relative group">
                    <img src="{{ asset('dodo.jpg') }}" 
                         alt="User Avatar" 
                         class="w-8 h-8 rounded-full border-2 border-transparent group-hover:border-[#8ab4f8] transition-all duration-300 group-hover:scale-110 cursor-pointer">
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Menu Overlay -->
<div id="mobileMenu" class="fixed inset-0 bg-[#202124] bg-opacity-95 z-40 hidden lg:hidden backdrop-blur-sm">
    <div class="flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-[#3c4043]">
            <h2 class="text-[#e8eaed] text-lg font-medium">Menu</h2>
            <button onclick="toggleMobileMenu()" class="p-2 text-[#9aa0a6] hover:text-[#8ab4f8] rounded-full">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="flex-1 p-4 space-y-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3 p-3 text-[#e8eaed] hover:bg-[#303134] rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Beranda
            </a>
            
            <button onclick="showAdvancedFilters(); toggleMobileMenu();" class="flex items-center gap-3 p-3 text-[#e8eaed] hover:bg-[#303134] rounded-lg transition-colors w-full text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"/>
                </svg>
                Filter Lanjutan
            </button>
            
            <button onclick="showExportResults(); toggleMobileMenu();" class="flex items-center gap-3 p-3 text-[#e8eaed] hover:bg-[#303134] rounded-lg transition-colors w-full text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Ekspor Hasil
            </button>
            
            <button onclick="enterReadingMode(); toggleMobileMenu();" class="flex items-center gap-3 p-3 text-[#e8eaed] hover:bg-[#303134] rounded-lg transition-colors w-full text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Mode Baca
            </button>
        </div>
    </div>
</div>

<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    const isHidden = menu.classList.contains('hidden');
    
    if (isHidden) {
        menu.classList.remove('hidden');
        menu.style.animation = 'fadeIn 0.3s ease-out';
        document.body.style.overflow = 'hidden';
    } else {
        menu.style.animation = 'fadeOut 0.3s ease-in';
        setTimeout(() => {
            menu.classList.add('hidden');
            document.body.style.overflow = '';
        }, 300);
    }
}

// Handle both forms
document.addEventListener('DOMContentLoaded', () => {
    const forms = ['#searchForm', '#mobileSearchForm'];
    
    forms.forEach(formSelector => {
        const form = document.querySelector(formSelector);
        if (form) {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const input = form.querySelector('input[name="query"]');
                const query = input.value.trim();
                
                if (!query) {
                    Swal.fire({
                        title: "Kolom pencarian kosong!",
                        text: "Masukkan kata kunci untuk mencari",
                        icon: "info",
                        background: 'linear-gradient(135deg, #303134, #3c4043)',
                        color: '#e8eaed',
                        confirmButtonColor: '#1a73e8'
                    });
                    return;
                }
                
                form.submit();
            });
        }
    });
});
</script>
