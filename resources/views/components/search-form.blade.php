<div class="w-full max-w-2xl mx-auto mb-8 animate-slide-up-delay">
    <form action="{{ route('search') }}" method="GET" class="relative group">
        <div class="relative flex items-center bg-gradient-to-r from-[#303134] to-[#3c4043] rounded-full border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 hover:shadow-lg hover:shadow-[#4285f4]/20 hover-lift">
            <!-- Search Icon -->
            <div class="absolute left-4 md:left-6 text-[#9aa0a6] group-hover:text-[#8ab4f8] transition-colors duration-300">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            
            <!-- Search Input -->
            <input 
                type="text" 
                name="query" 
                value="{{ request('query') }}" 
                placeholder="Cari informasi budaya Indonesia..." 
                class="w-full py-4 md:py-5 pl-12 md:pl-16 pr-12 md:pr-16 bg-transparent text-[#e8eaed] placeholder-[#9aa0a6] text-base md:text-lg rounded-full focus:outline-none focus:ring-2 focus:ring-[#8ab4f8] focus:border-transparent transition-all duration-300"
                autocomplete="off"
                spellcheck="false"
            >
            
            <!-- Voice Search Button - Hidden on small mobile -->
            <button 
                type="button" 
                class="absolute right-12 md:right-16 text-[#9aa0a6] hover:text-[#8ab4f8] transition-colors duration-300 magnetic hidden sm:block"
                title="Pencarian suara"
                onclick="startVoiceSearch()"
            >
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                </svg>
            </button>
            
            <!-- Search Button -->
            <button 
                type="submit" 
                class="absolute right-2 md:right-3 bg-gradient-to-r from-[#1a73e8] to-[#4285f4] text-white p-2 md:p-3 rounded-full hover:from-[#1557b0] hover:to-[#3367d6] transition-all duration-300 magnetic hover-lift group"
                title="Cari"
            >
                <svg class="w-4 h-4 md:w-5 md:h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </div>
        
        <!-- Search Suggestions - Mobile Optimized -->
        <div id="search-suggestions" class="absolute top-full left-0 right-0 mt-2 bg-gradient-to-br from-[#303134] to-[#3c4043] rounded-2xl border border-[#5f6368] shadow-2xl backdrop-blur-sm hidden z-50 max-h-60 md:max-h-80 overflow-y-auto">
            <div class="p-3 md:p-4">
                <div class="text-[#9aa0a6] text-xs md:text-sm mb-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Saran Pencarian
                </div>
                <div class="space-y-1">
                    @php
                        $suggestions = [
                            'kebudayaan nasional indonesia',
                            'seni tradisional nusantara',
                            'festival budaya daerah',
                            'warisan budaya indonesia',
                            'tarian tradisional indonesia'
                        ];
                    @endphp
                    @foreach($suggestions as $suggestion)
                        <div class="flex items-center gap-3 p-2 md:p-3 hover:bg-[#3c4043] rounded-lg cursor-pointer transition-all duration-200 group suggestion-item" data-suggestion="{{ $suggestion }}">
                            <svg class="w-4 h-4 text-[#9aa0a6] group-hover:text-[#8ab4f8] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span class="text-[#e8eaed] text-sm md:text-base group-hover:text-[#8ab4f8] transition-colors">{{ $suggestion }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </form>
    
    <!-- Mobile Search Tips -->
    <div class="mt-4 text-center md:hidden">
        <p class="text-[#9aa0a6] text-sm">
            💡 Tip: Gunakan kata kunci spesifik untuk hasil terbaik
        </p>
    </div>
</div>

<style>
    /* Enhanced mobile search styling */
    @media (max-width: 640px) {
        .search-form input {
            font-size: 16px !important; /* Prevent zoom on iOS */
        }
    }
    
    /* Custom scrollbar for suggestions */
    #search-suggestions::-webkit-scrollbar {
        width: 4px;
    }
    
    #search-suggestions::-webkit-scrollbar-track {
        background: transparent;
    }
    
    #search-suggestions::-webkit-scrollbar-thumb {
        background: #5f6368;
        border-radius: 2px;
    }
    
    #search-suggestions::-webkit-scrollbar-thumb:hover {
        background: #8ab4f8;
    }
</style>

<script>
    // Enhanced search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.querySelector('input[name="query"]');
        const suggestions = document.getElementById('search-suggestions');
        const suggestionItems = document.querySelectorAll('.suggestion-item');
        
        // Show suggestions on focus
        searchInput.addEventListener('focus', () => {
            if (searchInput.value.length > 0) {
                suggestions.classList.remove('hidden');
            }
        });
        
        // Hide suggestions on blur (with delay for clicks)
        searchInput.addEventListener('blur', () => {
            setTimeout(() => {
                suggestions.classList.add('hidden');
            }, 200);
        });
        
        // Show suggestions while typing
        searchInput.addEventListener('input', () => {
            if (searchInput.value.length > 2) {
                suggestions.classList.remove('hidden');
            } else {
                suggestions.classList.add('hidden');
            }
        });
        
        // Handle suggestion clicks
        suggestionItems.forEach(item => {
            item.addEventListener('click', () => {
                const suggestion = item.dataset.suggestion;
                searchInput.value = suggestion;
                suggestions.classList.add('hidden');
                searchInput.form.submit();
            });
        });
        
        // Keyboard navigation
        let selectedIndex = -1;
        
        searchInput.addEventListener('keydown', (e) => {
            const visibleItems = Array.from(suggestionItems);
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                selectedIndex = Math.min(selectedIndex + 1, visibleItems.length - 1);
                updateSelection(visibleItems);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                selectedIndex = Math.max(selectedIndex - 1, -1);
                updateSelection(visibleItems);
            } else if (e.key === 'Enter' && selectedIndex >= 0) {
                e.preventDefault();
                visibleItems[selectedIndex].click();
            } else if (e.key === 'Escape') {
                suggestions.classList.add('hidden');
                selectedIndex = -1;
            }
        });
        
        function updateSelection(items) {
            items.forEach((item, index) => {
                if (index === selectedIndex) {
                    item.classList.add('bg-[#3c4043]');
                } else {
                    item.classList.remove('bg-[#3c4043]');
                }
            });
        }
    });
    
    // Voice search functionality
    function startVoiceSearch() {
        if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            const recognition = new SpeechRecognition();
            
            recognition.lang = 'id-ID';
            recognition.continuous = false;
            recognition.interimResults = false;
            
            recognition.onstart = () => {
                document.querySelector('input[name="query"]').placeholder = 'Mendengarkan...';
            };
            
            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                document.querySelector('input[name="query"]').value = transcript;
                document.querySelector('input[name="query"]').form.submit();
            };
            
            recognition.onerror = () => {
                document.querySelector('input[name="query"]').placeholder = 'Cari informasi budaya Indonesia...';
                alert('Maaf, fitur pencarian suara tidak tersedia.');
            };
            
            recognition.onend = () => {
                document.querySelector('input[name="query"]').placeholder = 'Cari informasi budaya Indonesia...';
            };
            
            recognition.start();
        } else {
            alert('Browser Anda tidak mendukung pencarian suara.');
        }
    }
</script>
