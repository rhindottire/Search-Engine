<!-- Reading Mode Component -->
<div id="readingMode" class="fixed inset-0 bg-gradient-to-br from-[#0f0f0f] via-[#1a1a1a] to-[#0f0f0f] z-50 hidden overflow-y-auto">
    <div class="min-h-screen">
        <!-- Reading Mode Header -->
        <div class="sticky top-0 bg-gradient-to-r from-[#1a1a1a]/95 to-[#2d2d2d]/95 backdrop-blur-lg border-b border-[#3c4043] z-10">
            <div class="max-w-4xl mx-auto px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-[#8ab4f8] to-[#4285f4] rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-[#e8eaed] text-xl font-bold">Mode Baca</h1>
                                <p class="text-[#9aa0a6] text-sm">Pengalaman membaca yang optimal</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <!-- Font Size Controls -->
                        <div class="flex items-center gap-2 bg-[#303134] rounded-lg p-1">
                            <button onclick="decreaseFontSize()" class="p-2 text-[#9aa0a6] hover:text-[#e8eaed] hover:bg-[#3c4043] rounded-md transition-colors" title="Perkecil Font">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                            </button>
                            <span class="text-[#9aa0a6] text-sm px-2" id="fontSizeDisplay">16px</span>
                            <button onclick="increaseFontSize()" class="p-2 text-[#9aa0a6] hover:text-[#e8eaed] hover:bg-[#3c4043] rounded-md transition-colors" title="Perbesar Font">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Theme Toggle -->
                        <button onclick="toggleReadingTheme()" class="p-2 text-[#9aa0a6] hover:text-[#e8eaed] hover:bg-[#3c4043] rounded-lg transition-colors" title="Ganti Tema">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                        </button>
                        
                        <!-- Close Button -->
                        <button onclick="exitReadingMode()" class="p-2 text-[#9aa0a6] hover:text-[#e8eaed] hover:bg-[#dc2626] rounded-lg transition-colors" title="Tutup Mode Baca">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reading Content -->
        <div class="max-w-4xl mx-auto px-6 py-8">
            <div id="readingContent" class="reading-content">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
        
        <!-- Reading Progress Bar -->
        <div class="fixed bottom-0 left-0 right-0 h-1 bg-[#3c4043]">
            <div id="readingProgress" class="h-full bg-gradient-to-r from-[#8ab4f8] to-[#4285f4] transition-all duration-300" style="width: 0%"></div>
        </div>
    </div>
</div>

<!-- Reading Mode Toggle Button -->
<button onclick="enterReadingMode()" 
        class="hidden sm:inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-[#303134] to-[#3c4043] hover:from-[#3c4043] hover:to-[#5f6368] text-[#8ab4f8] hover:text-[#aecbfa] rounded-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 text-sm shadow-lg">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
    </svg>
    Mode Baca
</button>

<style>
/* Reading Mode Themes with Better Contrast */
.reading-dark {
    background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 50%, #0f0f0f 100%) !important;
}

.reading-dark .reading-content {
    color: #e8eaed !important;
}

.reading-dark .reading-content h1 {
    color: #ffffff !important;
    text-shadow: 0 2px 4px rgba(0,0,0,0.5);
}

.reading-dark .reading-content h2 {
    color: #f1f3f4 !important;
}

.reading-dark .reading-content p {
    color: #d2d4d6 !important;
}

.reading-light {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 50%, #ffffff 100%) !important;
}

.reading-light .reading-content {
    color: #1a1a1a !important;
}

.reading-light .reading-content h1 {
    color: #000000 !important;
    text-shadow: none;
}

.reading-light .reading-content h2 {
    color: #202124 !important;
}

.reading-light .reading-content p {
    color: #3c4043 !important;
}

.reading-light .reading-content article {
    background: rgba(255, 255, 255, 0.8) !important;
    border: 1px solid rgba(0, 0, 0, 0.1) !important;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
}

.reading-sepia {
    background: linear-gradient(135deg, #f4f1ea 0%, #faf8f1 50%, #f4f1ea 100%) !important;
}

.reading-sepia .reading-content {
    color: #3d2914 !important;
}

.reading-sepia .reading-content h1 {
    color: #2d1f0f !important;
    text-shadow: none;
}

.reading-sepia .reading-content h2 {
    color: #4a3319 !important;
}

.reading-sepia .reading-content p {
    color: #5f4b32 !important;
}

.reading-sepia .reading-content article {
    background: rgba(250, 248, 241, 0.8) !important;
    border: 1px solid rgba(95, 75, 50, 0.2) !important;
}

/* Reading Content Styling */
.reading-content {
    line-height: 1.8;
    font-feature-settings: "kern" 1, "liga" 1, "calt" 1;
    text-rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.reading-content h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 2rem;
    background: linear-gradient(135deg, #8ab4f8, #4285f4);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1.2;
}

.reading-content article {
    margin-bottom: 3rem;
    padding: 2rem;
    background: rgba(48, 49, 52, 0.3);
    border-radius: 16px;
    border: 1px solid rgba(95, 99, 104, 0.2);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.reading-content article:hover {
    background: rgba(48, 49, 52, 0.5);
    border-color: rgba(138, 180, 248, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.reading-content h2 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #e8eaed;
    line-height: 1.4;
}

.reading-content p {
    font-size: 1rem;
    line-height: 1.8;
    color: #bdc1c6;
    margin-bottom: 1rem;
}

.reading-content .article-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid rgba(95, 99, 104, 0.2);
    font-size: 0.875rem;
    color: #9aa0a6;
}

.reading-content .article-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    background: linear-gradient(135deg, #8ab4f8, #4285f4);
    color: white;
    border-radius: 50%;
    font-weight: 600;
    font-size: 0.875rem;
    margin-bottom: 1rem;
}
</style>

<script>
let currentFontSize = 16;
let currentTheme = 'dark';

function enterReadingMode() {
    const results = document.querySelectorAll('.search-result-item');
    let content = '<h1>📚 Hasil Pencarian dalam Mode Baca</h1>';
    
    if (results.length === 0) {
        content += '<div class="text-center py-12"><p class="text-xl text-[#9aa0a6]">Tidak ada hasil untuk dibaca</p></div>';
    } else {
        results.forEach((result, index) => {
            const titleElement = result.querySelector('h2 a');
            const snippetElement = result.querySelector('.text-\\[\\#bdc1c6\\]') || result.querySelector('p');
            const linkElement = result.querySelector('a[href]');
            
            const title = titleElement?.textContent || 'Judul tidak tersedia';
            const snippet = snippetElement?.textContent || 'Konten tidak tersedia';
            const link = linkElement?.href || '#';
            
            content += `
                <article>
                    <div class="article-number">${index + 1}</div>
                    <h2>${title}</h2>
                    <p>${snippet}</p>
                    <div class="article-meta">
                        <span>📄 Artikel ${index + 1}</span>
                        <span>•</span>
                        <a href="${link}" target="_blank" class="text-[#8ab4f8] hover:text-[#aecbfa] transition-colors">
                            🔗 Buka Link Asli
                        </a>
                    </div>
                </article>
            `;
        });
    }
    
    document.getElementById('readingContent').innerHTML = content;
    document.getElementById('readingMode').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Apply current theme
    applyReadingTheme();
    
    // Initialize reading progress
    updateReadingProgress();
    window.addEventListener('scroll', updateReadingProgress);
}

function exitReadingMode() {
    document.getElementById('readingMode').classList.add('hidden');
    document.body.style.overflow = '';
    window.removeEventListener('scroll', updateReadingProgress);
}

function increaseFontSize() {
    currentFontSize = Math.min(currentFontSize + 2, 24);
    document.getElementById('readingContent').style.fontSize = currentFontSize + 'px';
    document.getElementById('fontSizeDisplay').textContent = currentFontSize + 'px';
}

function decreaseFontSize() {
    currentFontSize = Math.max(currentFontSize - 2, 12);
    document.getElementById('readingContent').style.fontSize = currentFontSize + 'px';
    document.getElementById('fontSizeDisplay').textContent = currentFontSize + 'px';
}

function toggleReadingTheme() {
    const themes = ['dark', 'light', 'sepia'];
    const currentIndex = themes.indexOf(currentTheme);
    const nextIndex = (currentIndex + 1) % themes.length;
    currentTheme = themes[nextIndex];
    
    applyReadingTheme();
}

function applyReadingTheme() {
    const readingMode = document.getElementById('readingMode');
    
    // Remove all theme classes
    readingMode.classList.remove('reading-dark', 'reading-light', 'reading-sepia');
    // Add new theme class
    readingMode.classList.add(`reading-${currentTheme}`);
}

function updateReadingProgress() {
    const readingMode = document.getElementById('readingMode');
    const progressBar = document.getElementById('readingProgress');
    
    if (!readingMode || readingMode.classList.contains('hidden')) return;
    
    const scrollTop = readingMode.scrollTop;
    const scrollHeight = readingMode.scrollHeight - readingMode.clientHeight;
    const progress = (scrollTop / scrollHeight) * 100;
    
    progressBar.style.width = Math.min(progress, 100) + '%';
}

// Keyboard shortcuts for reading mode
document.addEventListener('keydown', (e) => {
    const readingMode = document.getElementById('readingMode');
    if (readingMode && !readingMode.classList.contains('hidden')) {
        if (e.key === 'Escape') {
            exitReadingMode();
        } else if (e.key === '+' || e.key === '=') {
            e.preventDefault();
            increaseFontSize();
        } else if (e.key === '-') {
            e.preventDefault();
            decreaseFontSize();
        } else if (e.key === 't' || e.key === 'T') {
            e.preventDefault();
            toggleReadingTheme();
        }
    }
});
</script>
