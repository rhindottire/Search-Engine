@props([
    'query' => ''
])

<!-- Smart Search Suggestions -->
<div class="w-full mb-4" id="searchSuggestions">
    @if($query && strlen($query) > 2)
        <div class="bg-gradient-to-r from-[#303134] to-[#3c4043] rounded-xl p-4 border border-[#5f6368] animate-fade-in">
            <div class="flex items-center gap-2 mb-3">
                <svg class="w-4 h-4 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                </svg>
                <h3 class="text-[#e8eaed] font-medium text-sm">Saran Pencarian Terkait</h3>
            </div>
            
            <div class="flex flex-wrap gap-2">
                @php
                    $suggestions = [
                        $query . ' indonesia',
                        $query . ' tradisional',
                        $query . ' modern',
                        'sejarah ' . $query,
                        'perkembangan ' . $query,
                        $query . ' daerah'
                    ];
                @endphp
                
                @foreach($suggestions as $suggestion)
                    <a href="{{ route('search', ['query' => $suggestion]) }}" 
                       class="inline-flex items-center gap-1 px-3 py-1.5 bg-[#3c4043] hover:bg-[#5f6368] text-[#bdc1c6] hover:text-[#e8eaed] rounded-full text-xs border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        {{ $suggestion }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
