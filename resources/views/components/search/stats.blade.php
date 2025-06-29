@props([
    'count' => 0,
    'query' => '',
    'time' => 0
])

<!-- Mobile-First Enhanced Search Statistics -->
<div class="text-[#9aa0a6] text-sm border-b border-[#3c4043] pb-3 w-full animate-fade-in">
    <!-- Mobile Layout -->
    <div class="block sm:hidden space-y-2">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-[#8ab4f8] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            <span class="text-xs">
                <span class="text-[#e8eaed] font-medium">{{ number_format($count) }}</span> hasil
            </span>
        </div>
        
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2 flex-1 min-w-0">
                <span class="text-xs">untuk</span>
                <span class="text-[#8ab4f8] font-medium bg-[#303134] px-2 py-1 rounded-full border border-[#5f6368] text-xs truncate max-w-[150px]">"{{ Str::limit($query, 20) }}"</span>
            </div>
            
            <div class="flex items-center gap-1 text-xs flex-shrink-0 ml-2">
                <svg class="w-3 h-3 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>({{ number_format($time, 2) }}s)</span>
            </div>
        </div>
        
        <!-- Mobile Quality Indicator -->
        <div class="flex items-center gap-2 pt-1">
            <span class="text-xs">Kualitas:</span>
            <div class="flex gap-1">
                @for($i = 1; $i <= 5; $i++)
                    <div class="w-1.5 h-1.5 rounded-full {{ $i <= 4 ? 'bg-[#8ab4f8]' : 'bg-[#5f6368]' }} animate-pulse" style="animation-delay: {{ $i * 0.1 }}s"></div>
                @endfor
            </div>
            <span class="text-xs text-[#8ab4f8]">Sangat Baik</span>
        </div>
    </div>
    
    <!-- Desktop Layout -->
    <div class="hidden sm:block">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span>Sekitar <span class="text-[#e8eaed] font-medium">{{ number_format($count) }}</span> hasil</span>
                </div>
                
                <div class="flex items-center gap-2">
                    <span>untuk</span>
                    <span class="text-[#8ab4f8] font-medium bg-[#303134] px-2 py-1 rounded-full border border-[#5f6368]">"{{ $query }}"</span>
                </div>
            </div>
            
            <div class="flex items-center gap-4 text-xs">
                <div class="flex items-center gap-1">
                    <svg class="w-3 h-3 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>({{ number_format($time, 2) }} detik)</span>
                </div>
                
                <button class="flex items-center gap-1 hover:text-[#8ab4f8] transition-colors duration-300" data-cursor="hover">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    <span>Refresh</span>
                </button>
            </div>
        </div>
        
        <!-- Desktop Search quality indicator -->
        <div class="mt-2 flex items-center gap-2">
            <div class="flex items-center gap-1">
                <span class="text-xs">Kualitas hasil:</span>
                <div class="flex gap-1">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="w-2 h-2 rounded-full {{ $i <= 4 ? 'bg-[#8ab4f8]' : 'bg-[#5f6368]' }} animate-pulse" style="animation-delay: {{ $i * 0.1 }}s"></div>
                    @endfor
                </div>
                <span class="text-xs text-[#8ab4f8]">Sangat Baik</span>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fade-in 0.5s ease-out;
    }
</style>
