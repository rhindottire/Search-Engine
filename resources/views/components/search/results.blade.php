@props([
    'data' => []
])

<!-- Mobile-First Enhanced Search Results -->
<div class="w-full space-y-4 sm:space-y-6">
    @foreach ($data as $index => $item)
        <article class="group search-result-item opacity-0 animate-slide-in" style="animation-delay: {{ $index * 0.1 }}s">
            <!-- Mobile Layout -->
            <div class="block sm:hidden space-y-3">
                <!-- Mobile URL breadcrumb -->
                <div class="flex items-center gap-2">
                    @if($item['image_url'] !== 'default_culture.jpg')
                        <img src="{{ $item['image_url'] }}" 
                             alt="Favicon" 
                             class="w-4 h-4 rounded-sm object-cover border border-[#5f6368] flex-shrink-0"
                             onerror="this.style.display='none'">
                    @endif
                    
                    <div class="flex items-center gap-1 text-xs text-[#9aa0a6] min-w-0">
                        <span class="truncate">{{ parse_url($item['source_url'], PHP_URL_HOST) }}</span>
                        <span class="text-[#5f6368] flex-shrink-0">•</span>
                        <span class="flex-shrink-0">{{ \Carbon\Carbon::parse($item['date'])->diffForHumans() }}</span>
                    </div>
                </div>

                <!-- Mobile Title -->
                <h2 class="leading-tight">
                    <a href="{{ route('article.detail', $item['id']) }}" 
                       class="text-[#8ab4f8] text-lg hover:underline transition-all duration-300 hover:text-[#aecbfa] block">
                        {{ Str::limit($item['title'], 80) }}
                    </a>
                </h2>

                <!-- Mobile Snippet -->
                <div class="text-[#bdc1c6] text-sm leading-relaxed">
                    {!! Str::limit(strip_tags($item['snippet']), 120) !!}
                </div>

                <!-- Mobile Metadata -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2 text-xs">
                        <div class="flex items-center gap-1 bg-[#303134] px-2 py-1 rounded-full border border-[#5f6368]">
                            <svg class="w-3 h-3 text-[#8ab4f8]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-[#9aa0a6]">{{ number_format($item['score'], 1) }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <a href="{{ route('article.detail', $item['id']) }}" 
                           class="flex items-center gap-1 text-[#8ab4f8] text-xs font-medium bg-[#303134] px-3 py-1.5 rounded-full border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300">
                            <span>Baca</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        
                        <button class="p-2 text-[#9aa0a6] hover:text-[#8ab4f8] hover:bg-[#303134] rounded-full transition-all duration-300" 
                                onclick="bookmarkArticle({{ $item['id'] }})">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Desktop/Tablet Layout -->
            <div class="hidden sm:block space-y-3">
                <!-- Desktop URL breadcrumb -->
                <div class="flex items-center gap-2 mb-2">
                    @if($item['image_url'] !== 'default_culture.jpg')
                        <div class="relative">
                            <img src="{{ $item['image_url'] }}" 
                                 alt="Favicon" 
                                 class="w-5 h-5 rounded-sm object-cover border border-[#5f6368] group-hover:border-[#8ab4f8] transition-all duration-300"
                                 onerror="this.style.display='none'">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent to-[#8ab4f8] opacity-0 group-hover:opacity-20 rounded-sm transition-opacity duration-300"></div>
                        </div>
                    @endif
                    
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-[#9aa0a6] truncate hover:text-[#bdc1c6] transition-colors">
                            {{ parse_url($item['source_url'], PHP_URL_HOST) }}
                        </span>
                        <span class="text-[#5f6368]">•</span>
                        <span class="text-[#9aa0a6] text-xs flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ \Carbon\Carbon::parse($item['date'])->diffForHumans() }}
                        </span>
                    </div>
                </div>

                <!-- Desktop Title -->
                <h2 class="mb-3 leading-tight">
                    <a href="{{ route('article.detail', $item['id']) }}" 
                       class="text-[#8ab4f8] text-xl hover:underline group-hover:underline transition-all duration-300 hover:text-[#aecbfa] block">
                        <span class="relative">
                            {{ $item['title'] }}
                            <div class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-[#8ab4f8] to-[#4285f4] group-hover:w-full transition-all duration-500"></div>
                        </span>
                    </a>
                </h2>

                <!-- Desktop Snippet -->
                <div class="text-[#bdc1c6] text-sm leading-relaxed mb-3 group-hover:text-[#e8eaed] transition-colors duration-300">
                    <div class="relative">
                        {!! $item['snippet'] !!}
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-transparent to-[#8ab4f8] opacity-0 group-hover:opacity-5 transition-opacity duration-300"></div>
                    </div>
                </div>

                <!-- Desktop Metadata -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4 text-xs text-[#9aa0a6]">
                        <div class="flex items-center gap-1 bg-[#303134] px-2 py-1 rounded-full border border-[#5f6368] group-hover:border-[#8ab4f8] transition-all duration-300">
                            <svg class="w-3 h-3 text-[#8ab4f8]" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Skor: {{ number_format($item['score'], 1) }}</span>
                        </div>
                        
                        @if($item['category'] !== 'Tidak diketahui')
                            <div class="flex items-center gap-1 bg-[#303134] px-2 py-1 rounded-full border border-[#5f6368] group-hover:border-[#8ab4f8] transition-all duration-300">
                                <svg class="w-3 h-3 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <span class="truncate max-w-xs">
                                    {{ Str::limit(explode('|', $item['category'])[0], 20) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <a href="{{ route('article.detail', $item['id']) }}" 
                           class="flex items-center gap-1 text-[#8ab4f8] hover:text-[#aecbfa] text-sm font-medium bg-[#303134] px-3 py-1.5 rounded-full border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 hover:scale-105">
                            <span>Baca selengkapnya</span>
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        
                        <button class="p-2 text-[#9aa0a6] hover:text-[#8ab4f8] hover:bg-[#303134] rounded-full transition-all duration-300" 
                                onclick="bookmarkArticle({{ $item['id'] }})">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Hover effect overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-[#8ab4f8] to-transparent opacity-0 group-hover:opacity-5 transition-opacity duration-500 pointer-events-none rounded-lg"></div>
        </article>
    @endforeach
</div>

<style>
    .search-result-item {
        position: relative;
        padding: 1.25rem;
        border-radius: 12px;
        border: 1px solid transparent;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, rgba(48, 49, 52, 0.3), rgba(60, 64, 67, 0.2));
        backdrop-filter: blur(10px);
        text-align: left;
    }
    
    @media (min-width: 640px) {
        .search-result-item {
            padding: 1.5rem 1.75rem;
        }
    }
    
    .search-result-item:hover {
        border-color: rgba(138, 180, 248, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(138, 180, 248, 0.1);
        background: linear-gradient(135deg, rgba(48, 49, 52, 0.5), rgba(60, 64, 67, 0.3));
    }
    
    @keyframes slide-in {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-slide-in {
        animation: slide-in 0.6s ease-out forwards;
    }
    
    /* Mobile optimizations */
    @media (max-width: 639px) {
        .search-result-item:hover {
            transform: none;
            box-shadow: 0 4px 15px rgba(138, 180, 248, 0.1);
        }
    }

    h2 {
        margin-left: 0;
        padding-left: 0;
    }
</style>

<script>
    function bookmarkArticle(articleId) {
        // Add bookmark functionality
        Swal.fire({
            title: '📚 Bookmark',
            text: 'Artikel telah ditambahkan ke bookmark!',
            icon: 'success',
            background: 'linear-gradient(135deg, #303134, #3c4043)',
            color: '#e8eaed',
            confirmButtonColor: '#1a73e8',
            timer: 2000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            showClass: {
                popup: 'animate__animated animate__slideInRight'
            }
        });
    }
</script>
