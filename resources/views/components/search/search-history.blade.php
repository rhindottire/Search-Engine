<!-- Search History Sidebar -->
<div id="searchHistory" class="fixed left-0 top-0 h-full w-80 bg-gradient-to-b from-[#303134] to-[#2a2a2a] border-r border-[#5f6368] transform -translate-x-full transition-transform duration-300 z-40 overflow-y-auto">
    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-[#e8eaed] text-lg font-medium flex items-center gap-2">
                <svg class="w-5 h-5 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Riwayat Pencarian
            </h2>
            <button onclick="closeSearchHistory()" class="text-[#9aa0a6] hover:text-[#e8eaed] hover:bg-[#3c4043] p-2 rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="space-y-3" id="historyList">
            <!-- History items will be populated by JavaScript -->
        </div>
        
        <div class="mt-6 pt-4 border-t border-[#5f6368]">
            <button onclick="clearSearchHistory()" class="w-full px-4 py-2 bg-[#3c4043] hover:bg-[#5f6368] text-[#bdc1c6] hover:text-[#e8eaed] rounded-lg transition-colors text-sm">
                Hapus Semua Riwayat
            </button>
        </div>
    </div>
</div>

<!-- History Toggle Button -->
<button id="historyToggleBtn" onclick="openSearchHistory()" 
        class="fixed left-4 top-1/2 transform -translate-y-1/2 w-12 h-12 bg-[#303134] hover:bg-[#3c4043] text-[#8ab4f8] rounded-r-lg shadow-lg border border-l-0 border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 z-30 hidden lg:flex items-center justify-center"
        title="Riwayat Pencarian">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
</button>

<script>
function openSearchHistory() {
    const sidebar = document.getElementById('searchHistory');
    const toggleBtn = document.getElementById('historyToggleBtn');
    
    sidebar.classList.remove('-translate-x-full');
    toggleBtn.style.display = 'none';
    loadSearchHistory();
}

function closeSearchHistory() {
    const sidebar = document.getElementById('searchHistory');
    const toggleBtn = document.getElementById('historyToggleBtn');
    
    sidebar.classList.add('-translate-x-full');
    toggleBtn.style.display = 'flex';
}

function loadSearchHistory() {
    const history = JSON.parse(localStorage.getItem('searchHistory') || '[]');
    const historyList = document.getElementById('historyList');
    
    if (history.length === 0) {
        historyList.innerHTML = '<p class="text-[#9aa0a6] text-sm text-center py-4">Belum ada riwayat pencarian</p>';
        return;
    }
    
    historyList.innerHTML = history.map(item => `
        <div class="flex items-center justify-between p-3 bg-[#3c4043] rounded-lg hover:bg-[#5f6368] transition-colors group">
            <a href="${item.url}" class="flex-1 min-w-0">
                <div class="text-[#e8eaed] text-sm font-medium truncate">${item.query}</div>
                <div class="text-[#9aa0a6] text-xs">${item.date}</div>
            </a>
            <button onclick="removeHistoryItem('${item.id}')" class="opacity-0 group-hover:opacity-100 text-[#9aa0a6] hover:text-[#e8eaed] p-1 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </button>
        </div>
    `).join('');
}

function saveSearchToHistory(query) {
    if (!query || query.length < 2) return;
    
    const history = JSON.parse(localStorage.getItem('searchHistory') || '[]');
    const newItem = {
        id: Date.now().toString(),
        query: query,
        url: window.location.href,
        date: new Date().toLocaleDateString('id-ID')
    };
    
    // Remove duplicate
    const filtered = history.filter(item => item.query !== query);
    
    // Add to beginning and limit to 20 items
    filtered.unshift(newItem);
    const limited = filtered.slice(0, 20);
    
    localStorage.setItem('searchHistory', JSON.stringify(limited));
}

function removeHistoryItem(id) {
    const history = JSON.parse(localStorage.getItem('searchHistory') || '[]');
    const filtered = history.filter(item => item.id !== id);
    localStorage.setItem('searchHistory', JSON.stringify(filtered));
    loadSearchHistory();
}

function clearSearchHistory() {
    localStorage.removeItem('searchHistory');
    loadSearchHistory();
}

// Save current search to history
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const query = urlParams.get('query');
    if (query) {
        saveSearchToHistory(query);
    }
});
</script>
