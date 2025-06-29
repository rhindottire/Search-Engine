@props([
    'data' => [],
    'query' => ''
])

<!-- Search Analytics Component - Hidden by default -->
<div id="searchAnalytics" class="fixed bottom-20 left-4 bg-gradient-to-r from-[#303134] to-[#3c4043] rounded-xl p-4 border border-[#5f6368] shadow-lg hidden max-w-xs z-50">
    <div class="flex items-center justify-between mb-3">
        <h3 class="text-[#e8eaed] font-medium text-sm flex items-center gap-2">
            <svg class="w-4 h-4 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Analytics
        </h3>
        <button onclick="hideAnalytics()" class="text-[#9aa0a6] hover:text-[#e8eaed] hover:bg-[#5f6368] p-1 rounded transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    
    <div id="analyticsContent" class="space-y-3 text-xs">
        <div class="flex justify-between">
            <span class="text-[#9aa0a6]">Waktu Pencarian:</span>
            <span class="text-[#e8eaed]" id="searchTime">{{ number_format((microtime(true) - LARAVEL_START), 2) }}s</span>
        </div>
        <div class="flex justify-between">
            <span class="text-[#9aa0a6]">Total Hasil:</span>
            <span class="text-[#e8eaed]" id="totalResults">{{ count($data) }}</span>
        </div>
        <div class="flex justify-between">
            <span class="text-[#9aa0a6]">Skor Rata-rata:</span>
            <span class="text-[#e8eaed]" id="avgScore">
                @if(count($data) > 0)
                    {{ number_format(collect($data)->avg('score'), 1) }}
                @else
                    0.0
                @endif
            </span>
        </div>
        <div class="flex justify-between">
            <span class="text-[#9aa0a6]">Kategori Terbanyak:</span>
            <span class="text-[#e8eaed]" id="topCategory">
                @if(count($data) > 0)
                    {{ Str::limit(explode('|', collect($data)->first()['category'])[0], 10) }}
                @else
                    -
                @endif
            </span>
        </div>
        
        <!-- Performance Meter -->
        <div class="mt-4">
            <div class="flex justify-between mb-1">
                <span class="text-[#9aa0a6]">Performa:</span>
                <span class="text-[#8ab4f8]" id="performanceText">Good</span>
            </div>
            <div class="w-full bg-[#5f6368] rounded-full h-2">
                <div class="bg-gradient-to-r from-[#34a853] to-[#8ab4f8] h-2 rounded-full transition-all duration-500" style="width: 75%" id="performanceBar"></div>
            </div>
        </div>
    </div>
</div>

<!-- Analytics Toggle Button -->
<button id="analyticsToggleBtn" onclick="showAnalytics()" 
        class="fixed bottom-4 left-4 w-12 h-12 bg-[#303134] hover:bg-[#3c4043] text-[#8ab4f8] rounded-full shadow-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 hidden lg:flex items-center justify-center z-40"
        title="Show Analytics">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
    </svg>
</button>

<script>
function showAnalytics() {
    const analytics = document.getElementById('searchAnalytics');
    const toggleBtn = document.getElementById('analyticsToggleBtn');
    
    analytics.classList.remove('hidden');
    toggleBtn.style.display = 'none';
}

function hideAnalytics() {
    const analytics = document.getElementById('searchAnalytics');
    const toggleBtn = document.getElementById('analyticsToggleBtn');
    
    analytics.classList.add('hidden');
    toggleBtn.style.display = 'flex';
}
</script>
