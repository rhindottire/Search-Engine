@props(['article'])

<header class="relative overflow-hidden bg-gradient-to-br from-[#0f0f0f] via-[#1a1a1a] to-[#0f0f0f] border-b border-[#3c4043]">
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-[#4285f4]/20 to-transparent animate-pulse"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="floating-particles"></div>
        </div>
    </div>
    
    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <!-- Breadcrumb with Animation -->
        <nav class="mb-6 animate-fade-in-up" style="animation-delay: 0.1s">
            <ol class="flex items-center space-x-2 text-sm">
                <li>
                    <a href="{{ route('welcome') }}" class="text-[#8ab4f8] hover:text-[#aecbfa] transition-all duration-300 hover:scale-105 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Beranda
                    </a>
                </li>
                <li class="text-[#5f6368]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
                <li>
                    <a href="{{ route('search') }}" class="text-[#8ab4f8] hover:text-[#aecbfa] transition-all duration-300 hover:scale-105">
                        Pencarian
                    </a>
                </li>
                <li class="text-[#5f6368]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </li>
                <li class="text-[#9aa0a6] truncate max-w-xs">
                    {{ Str::limit($article['title'], 50) }}
                </li>
            </ol>
        </nav>
        
        <!-- Article Title with Typewriter Effect -->
        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#e8eaed] leading-tight mb-4 typewriter-text animate-fade-in-up" style="animation-delay: 0.2s">
                {{ $article['title'] }}
            </h1>
            
            <!-- Article Metadata with Stagger Animation -->
            <div class="flex flex-wrap items-center gap-4 sm:gap-6 text-sm text-[#9aa0a6]">
                <div class="flex items-center gap-2 animate-fade-in-up" style="animation-delay: 0.3s">
                    <div class="w-8 h-8 bg-gradient-to-r from-[#4285f4] to-[#8ab4f8] rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span>Admin</span>
                </div>
                
                <div class="flex items-center gap-2 animate-fade-in-up" style="animation-delay: 0.4s">
                    <svg class="w-4 h-4 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ \Carbon\Carbon::parse($article['date'])->format('d M Y') }}</span>
                </div>
                
                <div class="flex items-center gap-2 animate-fade-in-up" style="animation-delay: 0.5s">
                    <svg class="w-4 h-4 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ ceil(str_word_count($article['content']) / 200) }} menit baca</span>
                </div>
                
                <div class="flex items-center gap-2 animate-fade-in-up" style="animation-delay: 0.6s">
                    <svg class="w-4 h-4 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span id="viewCount">1,234 views</span>
                </div>
            </div>
        </div>
        
        <!-- Category Tags with Bounce Animation -->
        @if($article['category'] !== 'Tidak diketahui')
            <div class="flex flex-wrap gap-2 mb-6">
                @foreach(array_slice(explode('|', $article['category']), 0, 3) as $index => $category)
                    <span class="px-4 py-2 bg-gradient-to-r from-[#1a73e8]/20 to-[#4285f4]/20 text-[#8ab4f8] text-sm rounded-full border border-[#1a73e8]/30 hover:border-[#8ab4f8] transition-all duration-300 hover:scale-105 animate-bounce-in" style="animation-delay: {{ 0.7 + ($index * 0.1) }}s">
                        {{ trim(str_replace('Kategori:', '', $category)) }}
                    </span>
                @endforeach
            </div>
        @endif
        
        <!-- Quick Actions with Slide Animation -->
        <div class="flex flex-wrap gap-3 animate-fade-in-up" style="animation-delay: 0.8s">
            <button onclick="toggleBookmark()" class="flex items-center gap-2 px-4 py-2 bg-[#303134] hover:bg-[#3c4043] text-[#8ab4f8] rounded-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-[#8ab4f8]/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                </svg>
                <span class="hidden sm:inline">Bookmark</span>
            </button>
            
            <button onclick="shareArticle()" class="flex items-center gap-2 px-4 py-2 bg-[#303134] hover:bg-[#3c4043] text-[#8ab4f8] rounded-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-[#8ab4f8]/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                </svg>
                <span class="hidden sm:inline">Share</span>
            </button>
            
            <button onclick="printArticle()" class="flex items-center gap-2 px-4 py-2 bg-[#303134] hover:bg-[#3c4043] text-[#8ab4f8] rounded-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 hover:scale-105 hover:shadow-lg hover:shadow-[#8ab4f8]/20">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                <span class="hidden sm:inline">Print</span>
            </button>
        </div>
    </div>
</header>

<style>
@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes bounce-in {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }
    50% {
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes typewriter {
    from {
        width: 0;
    }
    to {
        width: 100%;
    }
}

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out forwards;
    opacity: 0;
}

.animate-bounce-in {
    animation: bounce-in 0.6s ease-out forwards;
    opacity: 0;
}

.typewriter-text {
    overflow: hidden;
    white-space: nowrap;
    animation: typewriter 2s steps(40, end) forwards;
}

.floating-particles {
    position: absolute;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.floating-particles::before,
.floating-particles::after {
    content: '';
    position: absolute;
    width: 4px;
    height: 4px;
    background: #8ab4f8;
    border-radius: 50%;
    animation: float 6s ease-in-out infinite;
}

.floating-particles::before {
    top: 20%;
    left: 20%;
    animation-delay: 0s;
}

.floating-particles::after {
    top: 60%;
    right: 20%;
    animation-delay: 3s;
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0.7;
    }
    50% {
        transform: translateY(-20px) rotate(180deg);
        opacity: 1;
    }
}
</style>

<script>
function toggleBookmark() {
    const bookmarked = localStorage.getItem('bookmarked_{{ $article["id"] }}');
    if (bookmarked) {
        localStorage.removeItem('bookmarked_{{ $article["id"] }}');
        showToast('Bookmark dihapus', 'success');
    } else {
        localStorage.setItem('bookmarked_{{ $article["id"] }}', 'true');
        showToast('Artikel dibookmark', 'success');
    }
}

function shareArticle() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $article["title"] }}',
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href);
        showToast('Link disalin ke clipboard', 'success');
    }
}

function printArticle() {
    window.print();
}

// Animate view count
let viewCount = 1234;
const viewCountElement = document.getElementById('viewCount');
const animateViewCount = () => {
    let current = 0;
    const increment = viewCount / 50;
    const timer = setInterval(() => {
        current += increment;
        if (current >= viewCount) {
            current = viewCount;
            clearInterval(timer);
        }
        viewCountElement.textContent = Math.floor(current).toLocaleString() + ' views';
    }, 30);
};

// Start animation after page load
setTimeout(animateViewCount, 1000);
</script>
