@props([
    "title" => $article['title'] ?? "Detail Artikel",
])

<x-layout class="bg-[#202124] min-h-screen" :title="$title">
    <!-- Reading Progress -->
    <x-article.reading-progress />

    <!-- Header dengan back button -->
    <header class="sticky top-0 bg-[#202124] border-b border-[#3c4043] z-10">
        <div class="flex items-center gap-4 px-4 sm:px-8 py-4 max-w-4xl mx-auto">
            <button onclick="history.back()" 
                    class="flex items-center gap-2 text-[#8ab4f8] hover:text-[#aecbfa] transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke hasil pencarian
            </button>
            <div class="flex-1"></div>
            <a href="{{ route('home') }}" class="text-[#8ab4f8] text-xl font-bold hover:text-[#aecbfa]">
                <span class="text-[#4285f4]">Next</span>Google
            </a>
        </div>
    </header>

    <!-- Table of Contents -->
    <x-article.table-of-contents :article="$article" />

    <main class="px-4 sm:px-8 py-8 max-w-6xl mx-auto article-content">
        <!-- Article Header -->
        <article class="bg-[#303134] rounded-xl p-6 sm:p-8 shadow-lg border border-[#3c4043]">
            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 mb-4 text-sm text-[#9aa0a6]">
                @if($article['image_url'] !== 'default_culture.jpg')
                    <img src="{{ $article['image_url'] }}" 
                         alt="Source icon" 
                         class="w-4 h-4 rounded object-cover"
                         onerror="this.style.display='none'">
                @endif
                <span>{{ parse_url($article['source_url'], PHP_URL_HOST) }}</span>
                <span>•</span>
                <span>{{ \Carbon\Carbon::parse($article['date'])->format('d M Y') }}</span>
                <span>•</span>
                <span>ID: {{ $article['id'] }}</span>
            </div>

            <!-- Title -->
            <h1 id="article-title" class="text-3xl sm:text-4xl font-bold text-[#e8eaed] mb-6 leading-tight">
                {{ $article['title'] }}
            </h1>

            <!-- Metadata -->
            <div class="flex flex-wrap gap-4 mb-8 pb-6 border-b border-[#3c4043]">
                @if($article['category'] !== 'Tidak diketahui')
                    <div class="flex flex-wrap gap-2">
                        @foreach(array_slice(explode('|', $article['category']), 0, 3) as $category)
                            <span class="px-3 py-1 bg-[#1a73e8] text-white text-xs rounded-full">
                                {{ trim(str_replace('Kategori:', '', $category)) }}
                            </span>
                        @endforeach
                    </div>
                @endif
                <a href="{{ $article['source_url'] }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   class="flex items-center gap-2 text-[#8ab4f8] hover:underline text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    Lihat di Wikipedia
                </a>
            </div>

            <!-- Content -->
            <div class="prose prose-invert max-w-none">
                <div class="text-[#bdc1c6] leading-relaxed space-y-4 text-base">
                    @php
                        $paragraphs = array_filter(explode("\n\n", $article['content']));
                    @endphp
                    
                    @foreach($paragraphs as $index => $paragraph)
                        @if(trim($paragraph))
                            <p id="section-{{ $index + 1 }}" class="paragraph-content">{{ trim($paragraph) }}</p>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Actions -->
            <div class="flex flex-wrap gap-4 mt-8 pt-6 border-t border-[#3c4043]">
                <button onclick="shareArticle()" 
                        class="flex items-center gap-2 px-4 py-2 bg-[#1a73e8] text-white rounded-lg hover:bg-[#1557b0] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                    </svg>
                    Bagikan
                </button>
                <button onclick="printArticle()" 
                        class="flex items-center gap-2 px-4 py-2 bg-[#3c4043] text-[#e8eaed] rounded-lg hover:bg-[#5f6368] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak
                </button>
            </div>
        </article>

        <!-- Article Navigation -->
        <x-article.navigation :article="$article" />

        <!-- Related Articles -->
        <section id="related-articles">
            <x-article.related :relatedArticles="$relatedArticles" />
        </section>
    </main>

    <!-- Floating Action Button - Only Scroll to Top -->
    <div class="fixed bottom-6 right-6 z-40 floating-actions">
        <!-- Scroll to Top -->
        <button onclick="scrollToTop()" 
                class="w-12 h-12 bg-gradient-to-r from-[#4285f4] to-[#8ab4f8] text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 flex items-center justify-center group"
                title="Scroll to Top">
            <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
            </svg>
        </button>
    </div>
    
    <!-- Help Button with Working Functionality -->
    <button id="helpButton" onclick="showKeyboardHelp()" 
            class="fixed bottom-6 left-6 w-12 h-12 bg-gradient-to-r from-[#5f6368] to-[#3c4043] hover:from-[#8ab4f8] hover:to-[#4285f4] text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110 flex items-center justify-center font-bold z-40 group"
            title="Keyboard Shortcuts">
        <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </button>

    <!-- Help Modal -->
    <div id="helpModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="bg-gradient-to-br from-[#303134] to-[#1a1a1a] rounded-xl border border-[#5f6368] shadow-2xl max-w-md w-full transform scale-95 opacity-0 transition-all duration-300" id="helpModalContent">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-[#e8eaed] text-lg font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Keyboard Shortcuts
                    </h3>
                    <button onclick="hideKeyboardHelp()" class="text-[#9aa0a6] hover:text-[#e8eaed] transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between py-2 px-3 bg-[#3c4043]/30 rounded-lg">
                        <span class="text-[#bdc1c6]">Toggle Table of Contents</span>
                        <kbd class="px-2 py-1 bg-[#5f6368] text-[#e8eaed] rounded text-sm font-mono">T</kbd>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-[#3c4043]/30 rounded-lg">
                        <span class="text-[#bdc1c6]">Scroll to Top</span>
                        <kbd class="px-2 py-1 bg-[#5f6368] text-[#e8eaed] rounded text-sm font-mono">Home</kbd>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-[#3c4043]/30 rounded-lg">
                        <span class="text-[#bdc1c6]">Scroll to Bottom</span>
                        <kbd class="px-2 py-1 bg-[#5f6368] text-[#e8eaed] rounded text-sm font-mono">End</kbd>
                    </div>
                    <div class="flex items-center justify-between py-2 px-3 bg-[#3c4043]/30 rounded-lg">
                        <span class="text-[#bdc1c6]">Go Back</span>
                        <kbd class="px-2 py-1 bg-[#5f6368] text-[#e8eaed] rounded text-sm font-mono">Esc</kbd>
                    </div>
                </div>
                
                <div class="mt-6 pt-4 border-t border-[#3c4043]">
                    <p class="text-[#9aa0a6] text-sm text-center">
                        Tekan <kbd class="px-1 py-0.5 bg-[#5f6368] text-[#e8eaed] rounded text-xs">?</kbd> kapan saja untuk melihat shortcuts
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Enhanced Scripts -->
    <script>
        // Smooth scroll to top
        function scrollToTop() {
            window.scrollTo({ 
                top: 0, 
                behavior: 'smooth' 
            });
        }
        
        // Show keyboard shortcuts help
        function showKeyboardHelp() {
            const modal = document.getElementById('helpModal');
            const content = document.getElementById('helpModalContent');
            
            modal.classList.remove('hidden');
            
            // Animate modal appearance
            setTimeout(() => {
                content.style.transform = 'scale(1)';
                content.style.opacity = '1';
            }, 10);
        }
        
        // Hide keyboard shortcuts help
        function hideKeyboardHelp() {
            const modal = document.getElementById('helpModal');
            const content = document.getElementById('helpModalContent');
            
            content.style.transform = 'scale(0.95)';
            content.style.opacity = '0';
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // ? to show help
            if (e.key === '?' && !e.ctrlKey && !e.altKey && !e.metaKey) {
                const activeElement = document.activeElement;
                if (activeElement.tagName !== 'INPUT' && activeElement.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                    showKeyboardHelp();
                }
            }
            
            // ESC to go back or close modal
            if (e.key === 'Escape') {
                const helpModal = document.getElementById('helpModal');
                if (!helpModal.classList.contains('hidden')) {
                    hideKeyboardHelp();
                } else {
                    history.back();
                }
            }
            
            // Home to scroll to top
            if (e.key === 'Home') {
                e.preventDefault();
                scrollToTop();
            }
            
            // End to scroll to bottom
            if (e.key === 'End') {
                e.preventDefault();
                window.scrollTo({ 
                    top: document.body.scrollHeight, 
                    behavior: 'smooth' 
                });
            }
        });
        
        // Click outside modal to close
        document.getElementById('helpModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideKeyboardHelp();
            }
        });
        
        // Enhanced loading and performance
        document.addEventListener('DOMContentLoaded', function() {
            // Lazy load images
            const images = document.querySelectorAll('img[data-src]');
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            images.forEach(img => imageObserver.observe(img));
            
            // Preload next/prev articles
            const navLinks = document.querySelectorAll('nav a[href*="/article/"]');
            navLinks.forEach(link => {
                link.addEventListener('mouseenter', () => {
                    const prefetchLink = document.createElement('link');
                    prefetchLink.rel = 'prefetch';
                    prefetchLink.href = link.href;
                    document.head.appendChild(prefetchLink);
                });
            });
            
            // Initialize reading progress
            updateReadingProgress();
        });

        function shareArticle() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $article["title"] }}',
                    text: 'Artikel menarik dari NextGoogle',
                    url: window.location.href
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(window.location.href).then(() => {
                    alert('Link artikel telah disalin ke clipboard!');
                });
            }
        }

        function printArticle() {
            window.print();
        }

        function updateReadingProgress() {
            // This function is handled by the reading-progress component
        }

        function showToast(message, type) {
            // Simple toast implementation
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 px-4 py-2 rounded-lg text-white z-50 transition-all duration-300 ${
                type === 'success' ? 'bg-green-600' : 
                type === 'error' ? 'bg-red-600' : 
                'bg-blue-600'
            }`;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }
    </script>
    
    <!-- Enhanced Styles -->
    <style>
        /* Smooth transitions */
        * {
            transition: all 0.3s ease !important;
        }
        
        /* Enhanced focus styles */
        button:focus,
        a:focus {
            outline: 2px solid #8ab4f8;
            outline-offset: 2px;
        }
        
        /* Modal backdrop blur */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }
        
        /* Keyboard shortcut styling */
        kbd {
            font-family: ui-monospace, SFMono-Regular, "SF Mono", Consolas, "Liberation Mono", Menlo, monospace;
            font-weight: 600;
        }
    </style>
</x-layout>
