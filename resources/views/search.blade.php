@props([
    "title" => "Hasil Pencarian",
])

<x-layout class="bg-[#202124] min-h-screen" :title="$title">
    <x-search.accessibility />

    <!-- Enhanced Search Header -->
    <x-search.header :query="$query" :data="$data ?? []" />
    
    <!-- Enhanced Search Filters -->
    <x-search.filters />
    
    <main id="search-results" class="reading-optimized flex flex-col gap-4 items-start px-4 sm:px-8 py-6 w-full max-w-4xl mx-auto">
        <!-- Search Insights - Only show if there are results -->
        <x-search.search-insights :data="$data ?? []" />

        <!-- Enhanced Search Statistics -->
        @if(count($data) > 0)
            <x-search.stats 
                :count="count($data)" 
                :query="$query" 
                :time="microtime(true) - LARAVEL_START" 
            />
        @endif

        <!-- Search Suggestions -->
        <x-search.suggestions :query="$query" />

        <!-- Enhanced Search Results -->
        @if(count($data) > 0)
            <x-search.results :data="$data" />
        @else
            <x-search.no-results :query="$query" />
        @endif

        <!-- Enhanced Pagination -->
        <x-search.pagination :hasResults="count($data) > 0" />
    </main>

    <!-- Advanced Components - All hidden by default -->
    <x-search.search-history />
    <x-search.advanced-filters />
    <x-search.export-results :data="$data ?? []" :query="$query" />
    <x-search.reading-mode />
    <x-search.search-analytics :data="$data ?? []" :query="$query" />

    <style>
        /* Page-level animations */
        main {
            animation: fadeInUp 0.8s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom scrollbar for main content */
        main::-webkit-scrollbar {
            width: 6px;
        }
        
        main::-webkit-scrollbar-track {
            background: #202124;
        }
        
        main::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #5f6368, #8ab4f8);
            border-radius: 3px;
        }
        
        main::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #8ab4f8, #aecbfa);
        }

        /* Reading optimizations */
        .reading-optimized {
            line-height: 1.6;
            font-feature-settings: "kern" 1, "liga" 1;
        }
    </style>

    <script>
        // Enhanced page interactions
        document.addEventListener('DOMContentLoaded', () => {
            // Add loading state management
            const searchForms = document.querySelectorAll('form[action*="search"]');
            searchForms.forEach(form => {
                form.addEventListener('submit', () => {
                    showSearchLoading();
                });
            });
            
            // Add smooth reveal animation for search results
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            document.querySelectorAll('.search-result-item').forEach(item => {
                observer.observe(item);
            });
            
            // Add performance monitoring
            if ('requestIdleCallback' in window) {
                requestIdleCallback(() => {
                    console.log('Search page loaded successfully! 🔍');
                });
            }
        });

        function showSearchLoading() {
            const loadingOverlay = document.createElement('div');
            loadingOverlay.className = 'fixed inset-0 bg-[#202124] bg-opacity-90 flex items-center justify-center z-50';
            loadingOverlay.innerHTML = `
                <div class="text-center">
                    <div class="relative">
                        <div class="w-16 h-16 border-4 border-[#5f6368] border-t-[#8ab4f8] rounded-full animate-spin mx-auto mb-4"></div>
                        <div class="absolute inset-0 w-16 h-16 border-4 border-transparent border-t-[#4285f4] rounded-full animate-spin mx-auto" style="animation-delay: 0.3s; animation-duration: 1.2s;"></div>
                    </div>
                    <p class="text-[#e8eaed] text-lg">Mencari hasil terbaik...</p>
                    <div class="mt-2 flex justify-center space-x-1">
                        <div class="w-2 h-2 bg-[#8ab4f8] rounded-full animate-bounce"></div>
                        <div class="w-2 h-2 bg-[#8ab4f8] rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                        <div class="w-2 h-2 bg-[#8ab4f8] rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                    </div>
                </div>
            `;
            document.body.appendChild(loadingOverlay);
        }
    </script>

    <x-search.quick-actions />
</x-layout>
