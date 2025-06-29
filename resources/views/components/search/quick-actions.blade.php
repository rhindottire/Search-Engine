<!-- Quick Actions untuk Better UX -->
<div class="fixed bottom-6 right-6 z-20 hidden lg:block">
    <div class="flex flex-col gap-3">
        <!-- Scroll to Top -->
        <button onclick="scrollToTop()" 
                class="w-12 h-12 bg-[#303134] hover:bg-[#3c4043] text-[#8ab4f8] rounded-full shadow-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 flex items-center justify-center group"
                title="Scroll to top">
            <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
            </svg>
        </button>
        
        <!-- New Search -->
        <a href="{{ route('home') }}" 
           class="w-12 h-12 bg-[#1a73e8] hover:bg-[#1557b0] text-white rounded-full shadow-lg transition-all duration-300 flex items-center justify-center group"
           title="New search">
            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
        </a>
        
        <!-- Share Results -->
        <button onclick="shareResults()" 
                class="w-12 h-12 bg-[#303134] hover:bg-[#3c4043] text-[#8ab4f8] rounded-full shadow-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 flex items-center justify-center group"
                title="Share results">
            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
            </svg>
        </button>
    </div>
</div>

<!-- Mobile Quick Actions -->
<div class="fixed bottom-6 right-6 z-20 lg:hidden">
    <button onclick="toggleMobileQuickActions()" 
            class="w-14 h-14 bg-[#1a73e8] hover:bg-[#1557b0] text-white rounded-full shadow-lg transition-all duration-300 flex items-center justify-center">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
        </svg>
    </button>
    
    <!-- Mobile Actions Menu -->
    <div id="mobileQuickActions" class="absolute bottom-16 right-0 bg-[#303134] rounded-xl p-3 border border-[#5f6368] shadow-2xl hidden min-w-[160px]">
        <div class="space-y-2">
            <button onclick="scrollToTop()" class="flex items-center gap-3 w-full p-2 text-[#e8eaed] hover:bg-[#3c4043] rounded-lg transition-colors text-left">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
                <span class="text-sm">Ke Atas</span>
            </button>
            <a href="{{ route('home') }}" class="flex items-center gap-3 w-full p-2 text-[#e8eaed] hover:bg-[#3c4043] rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="text-sm">Pencarian Baru</span>
            </a>
            <button onclick="shareResults()" class="flex items-center gap-3 w-full p-2 text-[#e8eaed] hover:bg-[#3c4043] rounded-lg transition-colors text-left">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                </svg>
                <span class="text-sm">Bagikan</span>
            </button>
        </div>
    </div>
</div>

<script>
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

function shareResults() {
    if (navigator.share) {
        navigator.share({
            title: 'Hasil Pencarian NextGoogle',
            text: 'Lihat hasil pencarian menarik ini!',
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href).then(() => {
            Swal.fire({
                title: '🔗 Link Disalin!',
                text: 'Link hasil pencarian telah disalin ke clipboard',
                icon: 'success',
                background: 'linear-gradient(135deg, #303134, #3c4043)',
                color: '#e8eaed',
                confirmButtonColor: '#1a73e8',
                timer: 2000,
                showConfirmButton: false
            });
        });
    }
}

function toggleMobileQuickActions() {
    const menu = document.getElementById('mobileQuickActions');
    const isHidden = menu.classList.contains('hidden');
    
    if (isHidden) {
        menu.classList.remove('hidden');
        menu.style.animation = 'fadeIn 0.3s ease-out';
    } else {
        menu.style.animation = 'fadeOut 0.3s ease-in';
        setTimeout(() => {
            menu.classList.add('hidden');
        }, 300);
    }
}

// Close mobile actions when clicking outside
document.addEventListener('click', (e) => {
    const menu = document.getElementById('mobileQuickActions');
    const button = e.target.closest('button[onclick="toggleMobileQuickActions()"]');
    
    if (!menu.contains(e.target) && !button) {
        menu.classList.add('hidden');
    }
});
</script>
