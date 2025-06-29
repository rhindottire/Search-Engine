@props([
    'data' => []
])

<!-- Search Insights Component - Only show if there are results -->
@if(count($data) > 0)
<div class="w-full mb-6 animate-fade-in">
    <div class="bg-gradient-to-r from-[#303134] to-[#3c4043] rounded-xl p-4 border border-[#5f6368]">
        <div class="flex items-center gap-2 mb-4">
            <svg class="w-5 h-5 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-[#e8eaed] font-medium">Insights Pencarian</h3>
        </div>
        
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-[#3c4043] rounded-lg p-3 text-center">
                <div class="text-2xl font-bold text-[#8ab4f8]">{{ count($data) }}</div>
                <div class="text-xs text-[#9aa0a6]">Total Hasil</div>
            </div>
            
            <div class="bg-[#3c4043] rounded-lg p-3 text-center">
                <div class="text-2xl font-bold text-[#34a853]">
                    {{ number_format(collect($data)->avg('score'), 1) }}
                </div>
                <div class="text-xs text-[#9aa0a6]">Skor Rata-rata</div>
            </div>
            
            <div class="bg-[#3c4043] rounded-lg p-3 text-center">
                <div class="text-2xl font-bold text-[#fbbc05]">
                    {{ number_format((microtime(true) - LARAVEL_START) * 1000) }}ms
                </div>
                <div class="text-xs text-[#9aa0a6]">Waktu Pencarian</div>
            </div>
            
            <div class="bg-[#3c4043] rounded-lg p-3 text-center">
                <div class="text-2xl font-bold text-[#ea4335]">
                    {{ count(array_unique(array_map(fn($item) => explode('|', $item['category'])[0], $data))) }}
                </div>
                <div class="text-xs text-[#9aa0a6]">Kategori Unik</div>
            </div>
        </div>
    </div>
</div>
@endif

<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-out;
}
</style>
