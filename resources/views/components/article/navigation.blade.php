@props(['article'])

<nav class="bg-[#303134] rounded-xl p-6 shadow-lg border border-[#3c4043] mt-6">
    <div class="flex items-center justify-between">
        <!-- Previous Article -->
        <div class="flex-1">
            @php
                $prevId = $article['id'] - 1;
            @endphp
            @if($prevId > 0)
                <a href="{{ route('article.detail', $prevId) }}" 
                   class="group flex items-center gap-3 p-4 rounded-lg hover:bg-[#3c4043] transition-all duration-300 hover:scale-105">
                    <div class="w-10 h-10 bg-gradient-to-r from-[#8ab4f8] to-[#4285f4] rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-[#9aa0a6] mb-1">Artikel Sebelumnya</p>
                        <p class="text-[#8ab4f8] font-medium truncate group-hover:text-[#aecbfa] transition-colors">
                            Artikel ID: {{ $prevId }}
                        </p>
                    </div>
                </a>
            @else
                <div class="flex items-center gap-3 p-4 opacity-50">
                    <div class="w-10 h-10 bg-[#5f6368] rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#9aa0a6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-[#9aa0a6] mb-1">Artikel Sebelumnya</p>
                        <p class="text-[#5f6368] font-medium">Tidak tersedia</p>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Current Article Indicator -->
        <div class="px-6 py-4 text-center">
            <div class="w-12 h-12 bg-gradient-to-r from-[#4285f4] to-[#8ab4f8] rounded-full flex items-center justify-center mx-auto mb-2">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="text-xs text-[#9aa0a6] mb-1">Artikel Saat Ini</p>
            <p class="text-[#e8eaed] font-bold">ID: {{ $article['id'] }}</p>
        </div>
        
        <!-- Next Article -->
        <div class="flex-1 flex justify-end">
            @php
                $nextId = $article['id'] + 1;
            @endphp
            <a href="{{ route('article.detail', $nextId) }}" 
               class="group flex items-center gap-3 p-4 rounded-lg hover:bg-[#3c4043] transition-all duration-300 hover:scale-105">
                <div class="flex-1 min-w-0 text-right">
                    <p class="text-xs text-[#9aa0a6] mb-1">Artikel Selanjutnya</p>
                    <p class="text-[#8ab4f8] font-medium truncate group-hover:text-[#aecbfa] transition-colors">
                        Artikel ID: {{ $nextId }}
                    </p>
                </div>
                <div class="w-10 h-10 bg-gradient-to-r from-[#4285f4] to-[#8ab4f8] rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
        </div>
    </div>
    
    <!-- Quick Navigation -->
    <div class="mt-6 pt-4 border-t border-[#3c4043]">
        <div class="flex items-center justify-center gap-4">
            <a href="{{ route('home') }}" 
               class="flex items-center gap-2 px-4 py-2 bg-[#1a73e8] text-white rounded-lg hover:bg-[#1557b0] transition-all duration-300 hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-sm font-medium">Beranda</span>
            </a>
            
            <a href="{{ route('search') }}" 
               class="flex items-center gap-2 px-4 py-2 bg-[#34a853] text-white rounded-lg hover:bg-[#2d8f47] transition-all duration-300 hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span class="text-sm font-medium">Pencarian</span>
            </a>
            
            <button onclick="scrollToTop()" 
                    class="flex items-center gap-2 px-4 py-2 bg-[#ea4335] text-white rounded-lg hover:bg-[#d33b2c] transition-all duration-300 hover:scale-105">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                <span class="text-sm font-medium">Ke Atas</span>
            </button>
        </div>
    </div>
</nav>

<script>
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>
