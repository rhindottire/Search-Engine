@props(['relatedArticles'])

@if(count($relatedArticles) > 0)
<section id="related-articles" class="mt-12 scroll-mt-24">
    <div class="flex items-center gap-3 mb-8 animate-fade-in-up">
        <div class="w-1 h-8 bg-gradient-to-b from-[#4285f4] to-[#8ab4f8] rounded-full animate-pulse"></div>
        <h2 class="text-2xl sm:text-3xl font-bold text-[#e8eaed]">Artikel Terkait</h2>
        <div class="flex-1 h-px bg-gradient-to-r from-[#3c4043] to-transparent"></div>
    </div>
    
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($relatedArticles as $index => $related)
            <article class="group bg-gradient-to-br from-[#303134] to-[#1a1a1a] rounded-xl p-6 border border-[#3c4043] hover:border-[#8ab4f8] transition-all duration-500 hover:shadow-2xl hover:shadow-[#8ab4f8]/20 hover:-translate-y-2 relative overflow-hidden animate-slide-in-up" style="animation-delay: {{ $index * 0.1 }}s">
                <!-- Animated Background Gradient -->
                <div class="absolute inset-0 bg-gradient-to-br from-[#4285f4]/0 via-[#8ab4f8]/0 to-[#34a853]/0 group-hover:from-[#4285f4]/10 group-hover:via-[#8ab4f8]/10 group-hover:to-[#34a853]/10 transition-all duration-500"></div>
                
                <!-- Floating Particles -->
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <div class="particle particle-1"></div>
                    <div class="particle particle-2"></div>
                    <div class="particle particle-3"></div>
                </div>
                
                <div class="relative z-10">
                    <!-- Article Number with Pulse Effect -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="relative">
                            <span class="w-10 h-10 bg-gradient-to-r from-[#4285f4] to-[#8ab4f8] text-white text-sm font-bold rounded-full flex items-center justify-center shadow-lg group-hover:shadow-xl group-hover:shadow-[#8ab4f8]/50 transition-all duration-300 group-hover:scale-110">
                                {{ $index + 1 }}
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-[#4285f4] to-[#8ab4f8] rounded-full animate-ping opacity-0 group-hover:opacity-75"></div>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-[#9aa0a6] group-hover:text-[#bdc1c6] transition-all duration-300">
                            <svg class="w-3 h-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ ceil(str_word_count($related['content']) / 200) }} min</span>
                        </div>
                    </div>
                    
                    <!-- Title with Typewriter Effect on Hover -->
                    <h3 class="text-[#8ab4f8] font-semibold mb-3 group-hover:text-[#aecbfa] transition-all duration-300 line-clamp-2 text-lg leading-tight group-hover:scale-105 transform-gpu">
                        <a href="{{ route('article.detail', $related['id']) }}" class="hover:underline relative">
                            {{ $related['title'] }}
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#4285f4] to-[#8ab4f8] group-hover:w-full transition-all duration-500"></span>
                        </a>
                    </h3>
                    
                    <!-- Content Preview with Fade Effect -->
                    <p class="text-[#9aa0a6] text-sm line-clamp-3 mb-4 leading-relaxed group-hover:text-[#bdc1c6] transition-all duration-300">
                        {{ Str::limit(strip_tags($related['content']), 120) }}
                    </p>
                    
                    <!-- Categories with Bounce Animation -->
                    @if($related['category'] !== 'Tidak diketahui')
                        <div class="flex flex-wrap gap-1 mb-4">
                            @foreach(array_slice(explode('|', $related['category']), 0, 2) as $catIndex => $category)
                                <span class="px-2 py-1 bg-[#1a73e8]/20 text-[#8ab4f8] text-xs rounded-full border border-[#1a73e8]/30 group-hover:border-[#8ab4f8] group-hover:bg-[#1a73e8]/30 transition-all duration-300 hover:scale-110 transform-gpu animate-bounce-in" style="animation-delay: {{ ($index * 0.1) + ($catIndex * 0.05) }}s">
                                    {{ trim(str_replace('Kategori:', '', $category)) }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                    
                    <!-- Metadata with Slide Animation -->
                    <div class="flex items-center justify-between text-xs text-[#9aa0a6] pt-4 border-t border-[#3c4043] group-hover:border-[#5f6368] transition-all duration-300">
                        <div class="flex items-center gap-2 group-hover:translate-x-1 transition-transform duration-300">
                            <div class="w-2 h-2 bg-[#8ab4f8] rounded-full animate-pulse"></div>
                            <span>ID: {{ $related['id'] }}</span>
                        </div>
                        <div class="flex items-center gap-2 group-hover:-translate-x-1 transition-transform duration-300">
                            <svg class="w-3 h-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($related['date'])->diffForHumans() }}</span>
                        </div>
                    </div>
                    
                    <!-- Read More Button with Magnetic Effect -->
                    <a href="{{ route('article.detail', $related['id']) }}" 
                       class="inline-flex items-center gap-2 mt-4 text-[#8ab4f8] hover:text-[#aecbfa] transition-all duration-300 group-hover:translate-x-2 transform-gpu magnetic-button">
                        <span class="text-sm font-medium">Baca Selengkapnya</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 group-hover:scale-110 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
                
                <!-- Hover Glow Effect -->
                <div class="absolute inset-0 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                    <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-[#4285f4]/20 via-transparent to-[#8ab4f8]/20 blur-xl"></div>
                </div>
            </article>
        @endforeach
    </div>
    
    <!-- Load More Button with Ripple Effect -->
    <div class="text-center mt-8 animate-fade-in-up" style="animation-delay: {{ count($relatedArticles) * 0.1 + 0.2 }}s">
        <button onclick="loadMoreRelated()" 
                class="relative px-8 py-3 bg-gradient-to-r from-[#1a73e8] to-[#4285f4] text-white rounded-lg hover:from-[#1557b0] hover:to-[#1a73e8] transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl font-medium overflow-hidden group ripple-button">
            <span class="relative z-10">Muat Artikel Lainnya</span>
            <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
        </button>
    </div>
</section>

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

@keyframes slide-in-up {
    from {
        opacity: 0;
        transform: translateY(50px) scale(0.9);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes bounce-in {
    0%, 100% {
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

.animate-fade-in-up {
    animation: fade-in-up 0.6s ease-out forwards;
    opacity: 0;
}

.animate-slide-in-up {
    animation: slide-in-up 0.8s ease-out forwards;
    opacity: 0;
}

.animate-bounce-in {
    animation: bounce-in 0.6s ease-out forwards;
    opacity: 0;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Floating Particles */
.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: #8ab4f8;
    border-radius: 50%;
    animation: float-particle 4s ease-in-out infinite;
}

.particle-1 {
    top: 20%;
    left: 20%;
    animation-delay: 0s;
}

.particle-2 {
    top: 60%;
    right: 30%;
    animation-delay: 1.5s;
}

.particle-3 {
    bottom: 30%;
    left: 60%;
    animation-delay: 3s;
}

@keyframes float-particle {
    0%, 100% {
        transform: translateY(0px) rotate(0deg);
        opacity: 0.7;
    }
    50% {
        transform: translateY(-15px) rotate(180deg);
        opacity: 1;
    }
}

/* Magnetic Button Effect */
.magnetic-button {
    transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
}

.magnetic-button:hover {
    transform: translateX(8px) scale(1.05);
}

/* Ripple Effect */
.ripple-button {
    position: relative;
    overflow: hidden;
}

.ripple-button::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.ripple-button:active::before {
    width: 300px;
    height: 300px;
}
</style>

<script>
function loadMoreRelated() {
    // Add loading animation
    const button = event.target;
    const originalText = button.innerHTML;
    
    button.innerHTML = `
        <div class="flex items-center gap-2">
            <div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
            <span>Memuat...</span>
        </div>
    `;
    
    // Simulate loading
    setTimeout(() => {
        button.innerHTML = originalText;
        showToast('Fitur akan segera tersedia', 'info');
    }, 2000);
}

// Add magnetic effect to buttons
document.querySelectorAll('.magnetic-button').forEach(button => {
    button.addEventListener('mousemove', (e) => {
        const rect = button.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;
        
        button.style.transform = `translate(${x * 0.1}px, ${y * 0.1}px) scale(1.05)`;
    });
    
    button.addEventListener('mouseleave', () => {
        button.style.transform = '';
    });
});

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
        }
    });
}, observerOptions);

// Observe all animated elements
document.querySelectorAll('.animate-slide-in-up, .animate-bounce-in').forEach(el => {
    el.style.animationPlayState = 'paused';
    observer.observe(el);
});
</script>
@endif
