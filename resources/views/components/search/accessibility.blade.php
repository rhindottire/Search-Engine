<!-- Accessibility Enhancements -->
<div class="sr-only" aria-live="polite" id="search-announcements"></div>

<!-- Skip Links -->
<div class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 z-50">
    <a href="#search-results" class="bg-[#1a73e8] text-white px-4 py-2 rounded-lg">
        Skip to search results
    </a>
</div>

<!-- Keyboard Shortcuts Help -->
<div id="keyboardHelp" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-[#303134] rounded-xl p-6 max-w-md w-full border border-[#5f6368]">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-[#e8eaed] text-lg font-medium">Keyboard Shortcuts</h3>
            <button onclick="hideKeyboardHelp()" class="text-[#9aa0a6] hover:text-[#e8eaed]">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="space-y-3 text-sm">
            <div class="flex items-center justify-between">
                <span class="text-[#bdc1c6]">Focus search</span>
                <kbd class="bg-[#5f6368] text-[#e8eaed] px-2 py-1 rounded text-xs">/</kbd>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[#bdc1c6]">New search</span>
                <kbd class="bg-[#5f6368] text-[#e8eaed] px-2 py-1 rounded text-xs">Ctrl + H</kbd>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[#bdc1c6]">Scroll to top</span>
                <kbd class="bg-[#5f6368] text-[#e8eaed] px-2 py-1 rounded text-xs">Home</kbd>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-[#bdc1c6]">Show this help</span>
                <kbd class="bg-[#5f6368] text-[#e8eaed] px-2 py-1 rounded text-xs">?</kbd>
            </div>
        </div>
    </div>
</div>

<script>
// Enhanced keyboard shortcuts
document.addEventListener('keydown', (e) => {
    // Focus search input with '/' key
    if (e.key === '/' && !e.target.matches('input, textarea')) {
        e.preventDefault();
        const searchInput = document.querySelector('#searchInput') || document.querySelector('input[name="query"]');
        if (searchInput) {
            searchInput.focus();
            announceToScreenReader('Search input focused');
        }
    }
    
    // Go to home with 'Ctrl+H'
    if (e.key === 'h' && e.ctrlKey) {
        e.preventDefault();
        window.location.href = '{{ route("home") }}';
    }
    
    // Scroll to top with 'Home' key
    if (e.key === 'Home' && !e.target.matches('input, textarea')) {
        e.preventDefault();
        scrollToTop();
        announceToScreenReader('Scrolled to top');
    }
    
    // Show keyboard help with '?' key
    if (e.key === '?' && !e.target.matches('input, textarea')) {
        e.preventDefault();
        showKeyboardHelp();
    }
    
    // Close keyboard help with 'Escape'
    if (e.key === 'Escape') {
        hideKeyboardHelp();
    }
});

function announceToScreenReader(message) {
    const announcements = document.getElementById('search-announcements');
    if (announcements) {
        announcements.textContent = message;
        setTimeout(() => {
            announcements.textContent = '';
        }, 1000);
    }
}

function showKeyboardHelp() {
    const modal = document.getElementById('keyboardHelp');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function hideKeyboardHelp() {
    const modal = document.getElementById('keyboardHelp');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Announce search results count to screen readers
document.addEventListener('DOMContentLoaded', () => {
    const resultsCount = document.querySelectorAll('.search-result-item').length;
    if (resultsCount > 0) {
        announceToScreenReader(`${resultsCount} search results found`);
    }
});
</script>
