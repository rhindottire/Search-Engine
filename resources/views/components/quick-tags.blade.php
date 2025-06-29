<div class="w-full max-w-4xl mx-auto animate-fade-in-delay">
    <div class="text-center mb-4">
        <p class="text-[#9aa0a6] text-sm md:text-base">Atau coba pencarian populer:</p>
    </div>
    
    <!-- Desktop Tags -->
    <div class="hidden md:flex flex-wrap justify-center gap-3 mb-6">
        @php
            $tags = [
                ['name' => 'Kebudayaan Nasional', 'query' => 'kebudayaan nasional', 'icon' => '🏛️', 'color' => 'from-blue-500 to-purple-600'],
                ['name' => 'Seni Tradisional', 'query' => 'seni tradisional', 'icon' => '🎭', 'color' => 'from-pink-500 to-red-600'],
                ['name' => 'Festival Budaya', 'query' => 'festival budaya', 'icon' => '🎪', 'color' => 'from-yellow-500 to-orange-600'],
                ['name' => 'Warisan Budaya', 'query' => 'warisan budaya', 'icon' => '🏺', 'color' => 'from-green-500 to-teal-600'],
                ['name' => 'Tarian Daerah', 'query' => 'tarian daerah', 'icon' => '💃', 'color' => 'from-indigo-500 to-blue-600'],
                ['name' => 'Musik Tradisional', 'query' => 'musik tradisional', 'icon' => '🎵', 'color' => 'from-purple-500 to-pink-600'],
            ];
        @endphp
        
        @foreach($tags as $tag)
            <a href="{{ route('search', ['query' => $tag['query']]) }}" 
               class="group relative inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r {{ $tag['color'] }} bg-opacity-20 hover:bg-opacity-100 text-[#e8eaed] hover:text-white rounded-full border border-transparent hover:border-white/20 transition-all duration-300 magnetic hover-lift">
                <span class="text-lg group-hover:animate-bounce">{{ $tag['icon'] }}</span>
                <span class="text-sm font-medium">{{ $tag['name'] }}</span>
                <div class="absolute inset-0 bg-gradient-to-r {{ $tag['color'] }} rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
            </a>
        @endforeach
    </div>
    
    <!-- Mobile Tags - Horizontal Scroll -->
    <div class="md:hidden mb-6">
        <div class="flex gap-3 overflow-x-auto pb-4 px-4 -mx-4 scrollbar-hide">
            @foreach($tags as $tag)
                <a href="{{ route('search', ['query' => $tag['query']]) }}" 
                   class="flex-shrink-0 inline-flex items-center gap-2 px-4 py-3 bg-gradient-to-r {{ $tag['color'] }} bg-opacity-20 text-[#e8eaed] rounded-full border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 min-w-max">
                    <span class="text-lg">{{ $tag['icon'] }}</span>
                    <span class="text-sm font-medium whitespace-nowrap">{{ $tag['name'] }}</span>
                </a>
            @endforeach
        </div>
        
        <!-- Scroll indicator -->
        <div class="flex justify-center mt-2">
            <div class="flex gap-1">
                <div class="w-2 h-2 bg-[#5f6368] rounded-full animate-pulse"></div>
                <div class="w-2 h-2 bg-[#5f6368] rounded-full animate-pulse" style="animation-delay: 0.2s"></div>
                <div class="w-2 h-2 bg-[#5f6368] rounded-full animate-pulse" style="animation-delay: 0.4s"></div>
            </div>
        </div>
    </div>
    
    <!-- Mobile Quick Actions -->
    <div class="md:hidden flex justify-center gap-4 mt-6">
        <button onclick="showRandomSearch()" class="flex items-center gap-2 px-4 py-2 bg-[#303134] hover:bg-[#3c4043] text-[#e8eaed] rounded-full border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300">
            <span class="text-lg">🎲</span>
            <span class="text-sm">Acak</span>
        </button>
        
        <button onclick="showTrendingTopics()" class="flex items-center gap-2 px-4 py-2 bg-[#303134] hover:bg-[#3c4043] text-[#e8eaed] rounded-full border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300">
            <span class="text-lg">🔥</span>
            <span class="text-sm">Trending</span>
        </button>
    </div>
</div>

<style>
    /* Hide scrollbar for mobile tags */
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    
    /* Mobile optimizations */
    @media (max-width: 768px) {
        .quick-tags {
            padding: 0 1rem;
        }
        
        /* Smooth scroll for mobile tags */
        .overflow-x-auto {
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }
    }
    
    /* Enhanced hover effects for desktop */
    @media (min-width: 769px) {
        .magnetic:hover {
            transform: translateY(-2px) scale(1.05);
        }
    }
</style>

<script>
    // Mobile-specific functionality
    function showRandomSearch() {
        const tags = [
            'kebudayaan nasional', 'seni tradisional', 'festival budaya', 
            'warisan budaya', 'tarian daerah', 'musik tradisional',
            'batik indonesia', 'wayang kulit', 'gamelan', 'borobudur'
        ];
        
        const randomTag = tags[Math.floor(Math.random() * tags.length)];
        window.location.href = `{{ route('search') }}?query=${encodeURIComponent(randomTag)}`;
    }
    
    function showTrendingTopics() {
        const trending = [
            'festival budaya 2024', 'seni digital indonesia', 'kuliner nusantara',
            'fashion tradisional modern', 'wisata budaya indonesia'
        ];
        
        const randomTrending = trending[Math.floor(Math.random() * trending.length)];
        window.location.href = `{{ route('search') }}?query=${encodeURIComponent(randomTrending)}`;
    }
    
    // Smooth scroll for mobile tags
    document.addEventListener('DOMContentLoaded', function() {
        const tagContainer = document.querySelector('.overflow-x-auto');
        
        if (tagContainer && window.innerWidth <= 768) {
            // Auto-scroll animation for mobile
            let scrollAmount = 0;
            const scrollStep = 1;
            const scrollDelay = 50;
            
            function autoScroll() {
                if (scrollAmount < tagContainer.scrollWidth - tagContainer.clientWidth) {
                    tagContainer.scrollLeft = scrollAmount;
                    scrollAmount += scrollStep;
                } else {
                    scrollAmount = 0;
                }
            }
            
            // Start auto-scroll after 3 seconds of inactivity
            let scrollTimeout;
            
            tagContainer.addEventListener('scroll', () => {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    setInterval(autoScroll, scrollDelay);
                }, 3000);
            });
        }
    });
</script>
