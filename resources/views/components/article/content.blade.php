@props(['article'])

<article class="bg-[#303134] rounded-xl p-6 sm:p-8 shadow-2xl border border-[#3c4043] relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 bg-gradient-to-br from-[#4285f4] via-transparent to-[#8ab4f8]"></div>
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(66, 133, 244, 0.1) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(138, 180, 248, 0.1) 0%, transparent 50%);"></div>
    </div>
    
    <div class="relative z-10">
        <!-- Article Metadata -->
        <div class="flex flex-wrap items-center gap-3 mb-6 text-sm text-[#9aa0a6]">
            @if($article['image_url'] !== 'default_culture.jpg')
                <div class="flex items-center gap-2">
                    <img src="{{ $article['image_url'] }}" 
                         alt="Source icon" 
                         class="w-5 h-5 rounded-full object-cover border border-[#5f6368]"
                         onerror="this.style.display='none'">
                    <span>{{ parse_url($article['source_url'], PHP_URL_HOST) }}</span>
                </div>
            @endif
            
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>{{ \Carbon\Carbon::parse($article['date'])->format('d M Y') }}</span>
            </div>
            
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <span>ID: {{ $article['id'] }}</span>
            </div>
            
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ ceil(str_word_count($article['content']) / 200) }} min baca</span>
            </div>
        </div>

        <!-- Article Title -->
        <h1 id="article-title" class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#e8eaed] mb-8 leading-tight">
            {{ $article['title'] }}
        </h1>

        <!-- Categories -->
        @if($article['category'] !== 'Tidak diketahui')
            <div class="flex flex-wrap gap-2 mb-8 pb-6 border-b border-[#3c4043]">
                @foreach(array_slice(explode('|', $article['category']), 0, 4) as $category)
                    <span class="px-4 py-2 bg-gradient-to-r from-[#1a73e8] to-[#4285f4] text-white text-sm rounded-full font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        {{ trim(str_replace('Kategori:', '', $category)) }}
                    </span>
                @endforeach
            </div>
        @endif

        <!-- Article Content -->
        <div class="prose prose-invert prose-lg max-w-none">
            <div class="text-[#bdc1c6] leading-relaxed space-y-6 text-base sm:text-lg">
                @php
                    $paragraphs = array_filter(explode("\n\n", $article['content']));
                @endphp
                
                @foreach($paragraphs as $index => $paragraph)
                    @if(trim($paragraph))
                        <p id="section-{{ $index + 1 }}" class="paragraph-content transition-all duration-300 hover:text-[#e8eaed] scroll-mt-24">
                            {{ trim($paragraph) }}
                        </p>
                    @endif
                @endforeach
            </div>
        </div>

        <!-- Source Link -->
        <div class="mt-8 pt-6 border-t border-[#3c4043]">
            <a href="{{ $article['source_url'] }}" 
               target="_blank" 
               rel="noopener noreferrer"
               class="inline-flex items-center gap-3 px-6 py-3 bg-gradient-to-r from-[#1a73e8] to-[#4285f4] text-white rounded-lg hover:from-[#1557b0] hover:to-[#1a73e8] transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl group">
                <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span class="font-medium">Baca Selengkapnya di Wikipedia</span>
            </a>
        </div>
    </div>
</article>
