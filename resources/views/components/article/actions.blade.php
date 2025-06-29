@props(['article'])

<div class="bg-[#303134] rounded-xl p-6 shadow-lg border border-[#3c4043] mt-6">
    <h3 class="text-[#e8eaed] font-semibold mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
        </svg>
        Aksi Artikel
    </h3>
    
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <!-- Share Button -->
        <button onclick="shareArticle()" 
                class="flex flex-col items-center gap-2 p-4 bg-[#1a73e8] text-white rounded-lg hover:bg-[#1557b0] transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl group">
            <svg class="w-6 h-6 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
            </svg>
            <span class="text-sm font-medium">Bagikan</span>
        </button>

        <!-- Print Button -->
        <button onclick="printArticle()" 
                class="flex flex-col items-center gap-2 p-4 bg-[#34a853] text-white rounded-lg hover:bg-[#2d8f47] transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl group">
            <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            <span class="text-sm font-medium">Cetak</span>
        </button>

        <!-- Bookmark Button -->
        <button onclick="toggleBookmark({{ $article['id'] }})" 
                id="bookmark-btn-{{ $article['id'] }}"
                class="flex flex-col items-center gap-2 p-4 bg-[#ea4335] text-white rounded-lg hover:bg-[#d33b2c] transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl group">
            <svg class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
            </svg>
            <span class="text-sm font-medium">Bookmark</span>
        </button>

        <!-- Copy Link Button -->
        <button onclick="copyArticleLink()" 
                class="flex flex-col items-center gap-2 p-4 bg-[#fbbc04] text-[#202124] rounded-lg hover:bg-[#f9ab00] transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl group">
            <svg class="w-6 h-6 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>
            <span class="text-sm font-medium">Salin Link</span>
        </button>
    </div>
    
    <!-- Social Share Buttons -->
    <div class="mt-6 pt-4 border-t border-[#3c4043]">
        <p class="text-[#9aa0a6] text-sm mb-3">Bagikan ke:</p>
        <div class="flex flex-wrap gap-3">
            <button onclick="shareToWhatsApp()" 
                    class="flex items-center gap-2 px-4 py-2 bg-[#25d366] text-white rounded-lg hover:bg-[#20ba5a] transition-all duration-300 hover:scale-105">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                </svg>
                <span class="text-sm">WhatsApp</span>
            </button>
            
            <button onclick="shareToTwitter()" 
                    class="flex items-center gap-2 px-4 py-2 bg-[#1da1f2] text-white rounded-lg hover:bg-[#1a91da] transition-all duration-300 hover:scale-105">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                </svg>
                <span class="text-sm">Twitter</span>
            </button>
            
            <button onclick="shareToFacebook()" 
                    class="flex items-center gap-2 px-4 py-2 bg-[#4267b2] text-white rounded-lg hover:bg-[#365899] transition-all duration-300 hover:scale-105">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                <span class="text-sm">Facebook</span>
            </button>
        </div>
    </div>
</div>

<script>
function shareArticle() {
    const title = '{{ $article["title"] }}';
    const url = window.location.href;
    
    if (navigator.share) {
        navigator.share({
            title: title,
            text: 'Artikel menarik dari NextGoogle',
            url: url
        }).catch(console.error);
    } else {
        copyArticleLink();
    }
}

function printArticle() {
    window.print();
}

function toggleBookmark(articleId) {
    const btn = document.getElementById(`bookmark-btn-${articleId}`);
    const bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
    
    if (bookmarks.includes(articleId)) {
        const index = bookmarks.indexOf(articleId);
        bookmarks.splice(index, 1);
        btn.classList.remove('bg-[#ea4335]', 'hover:bg-[#d33b2c]');
        btn.classList.add('bg-[#5f6368]', 'hover:bg-[#3c4043]');
        showToast('Bookmark dihapus', 'info');
    } else {
        bookmarks.push(articleId);
        btn.classList.remove('bg-[#5f6368]', 'hover:bg-[#3c4043]');
        btn.classList.add('bg-[#ea4335]', 'hover:bg-[#d33b2c]');
        showToast('Artikel dibookmark', 'success');
    }
    
    localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
}

function copyArticleLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        showToast('Link artikel disalin ke clipboard', 'success');
    }).catch(() => {
        showToast('Gagal menyalin link', 'error');
    });
}

function shareToWhatsApp() {
    const title = '{{ $article["title"] }}';
    const url = window.location.href;
    const text = `${title}\n\n${url}`;
    window.open(`https://wa.me/?text=${encodeURIComponent(text)}`, '_blank');
}

function shareToTwitter() {
    const title = '{{ $article["title"] }}';
    const url = window.location.href;
    const text = `${title}`;
    window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`, '_blank');
}

function shareToFacebook() {
    const url = window.location.href;
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank');
}

function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg text-white z-50 transform translate-y-full transition-transform duration-300 ${
        type === 'success' ? 'bg-[#34a853]' : 
        type === 'error' ? 'bg-[#ea4335]' : 
        'bg-[#1a73e8]'
    }`;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.transform = 'translateY(0)';
    }, 100);
    
    setTimeout(() => {
        toast.style.transform = 'translateY(full)';
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}

// Check bookmark status on load
document.addEventListener('DOMContentLoaded', function() {
    const articleId = {{ $article['id'] }};
    const bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
    const btn = document.getElementById(`bookmark-btn-${articleId}`);
    
    if (bookmarks.includes(articleId)) {
        btn.classList.remove('bg-[#5f6368]', 'hover:bg-[#3c4043]');
        btn.classList.add('bg-[#ea4335]', 'hover:bg-[#d33b2c]');
    }
});
</script>
