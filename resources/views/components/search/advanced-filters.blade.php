<!-- Advanced Filters Modal -->
<div id="advancedFilters" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-gradient-to-b from-[#303134] to-[#2a2a2a] rounded-xl p-6 max-w-2xl w-full border border-[#5f6368] max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-[#e8eaed] text-xl font-medium flex items-center gap-2">
                <svg class="w-5 h-5 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"/>
                </svg>
                Filter Pencarian Lanjutan
            </h3>
            <button onclick="hideAdvancedFilters()" class="text-[#9aa0a6] hover:text-[#e8eaed] p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <form id="advancedFilterForm" class="space-y-6">
            <!-- Date Range -->
            <div>
                <label class="block text-[#e8eaed] text-sm font-medium mb-2">Rentang Tanggal</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[#9aa0a6] text-xs mb-1">Dari</label>
                        <input type="date" class="w-full px-3 py-2 bg-[#3c4043] text-[#e8eaed] border border-[#5f6368] rounded-lg focus:border-[#8ab4f8] focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-[#9aa0a6] text-xs mb-1">Sampai</label>
                        <input type="date" class="w-full px-3 py-2 bg-[#3c4043] text-[#e8eaed] border border-[#5f6368] rounded-lg focus:border-[#8ab4f8] focus:outline-none">
                    </div>
                </div>
            </div>
            
            <!-- Category Filter -->
            <div>
                <label class="block text-[#e8eaed] text-sm font-medium mb-2">Kategori</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                    @php
                        $categories = [
                            'Seni Budaya',
                            'Sejarah',
                            'Tradisi',
                            'Festival',
                            'Musik',
                            'Tarian',
                            'Kuliner',
                            'Arsitektur',
                            'Bahasa'
                        ];
                    @endphp
                    @foreach($categories as $category)
                        <label class="flex items-center gap-2 p-2 bg-[#3c4043] rounded-lg hover:bg-[#5f6368] transition-colors cursor-pointer">
                            <input type="checkbox" class="text-[#8ab4f8] bg-[#3c4043] border-[#5f6368] rounded focus:ring-[#8ab4f8]">
                            <span class="text-[#bdc1c6] text-sm">{{ $category }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            
            <!-- Score Range -->
            <div>
                <label class="block text-[#e8eaed] text-sm font-medium mb-2">Skor Relevansi Minimum</label>
                <div class="flex items-center gap-4">
                    <input type="range" min="0" max="10" value="5" class="flex-1 h-2 bg-[#3c4043] rounded-lg appearance-none cursor-pointer slider" id="scoreRange">
                    <span class="text-[#8ab4f8] font-medium w-8" id="scoreValue">5.0</span>
                </div>
            </div>
            
            <!-- Sort Options -->
            <div>
                <label class="block text-[#e8eaed] text-sm font-medium mb-2">Urutkan Berdasarkan</label>
                <select class="w-full px-3 py-2 bg-[#3c4043] text-[#e8eaed] border border-[#5f6368] rounded-lg focus:border-[#8ab4f8] focus:outline-none">
                    <option value="relevance">Relevansi</option>
                    <option value="date">Tanggal Terbaru</option>
                    <option value="title">Judul A-Z</option>
                    <option value="score">Skor Tertinggi</option>
                </select>
            </div>
            
            <!-- Results Per Page -->
            <div>
                <label class="block text-[#e8eaed] text-sm font-medium mb-2">Hasil Per Halaman</label>
                <select class="w-full px-3 py-2 bg-[#3c4043] text-[#e8eaed] border border-[#5f6368] rounded-lg focus:border-[#8ab4f8] focus:outline-none">
                    <option value="10">10 hasil</option>
                    <option value="25">25 hasil</option>
                    <option value="50">50 hasil</option>
                    <option value="100">100 hasil</option>
                </select>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex gap-3 pt-4 border-t border-[#5f6368]">
                <button type="submit" class="flex-1 px-4 py-2 bg-[#1a73e8] hover:bg-[#1557b0] text-white rounded-lg transition-colors font-medium">
                    Terapkan Filter
                </button>
                <button type="button" onclick="resetAdvancedFilters()" class="px-4 py-2 bg-[#3c4043] hover:bg-[#5f6368] text-[#bdc1c6] hover:text-[#e8eaed] rounded-lg transition-colors">
                    Reset
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.slider::-webkit-slider-thumb {
    appearance: none;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: #8ab4f8;
    cursor: pointer;
    box-shadow: 0 0 2px 0 #000;
}

.slider::-moz-range-thumb {
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: #8ab4f8;
    cursor: pointer;
    border: none;
}
</style>

<script>
function showAdvancedFilters() {
    const modal = document.getElementById('advancedFilters');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function hideAdvancedFilters() {
    const modal = document.getElementById('advancedFilters');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function resetAdvancedFilters() {
    document.getElementById('advancedFilterForm').reset();
    document.getElementById('scoreValue').textContent = '5.0';
}

// Score range slider
document.addEventListener('DOMContentLoaded', () => {
    const scoreRange = document.getElementById('scoreRange');
    const scoreValue = document.getElementById('scoreValue');
    
    if (scoreRange && scoreValue) {
        scoreRange.addEventListener('input', (e) => {
            scoreValue.textContent = parseFloat(e.target.value).toFixed(1);
        });
    }
    
    // Advanced filter form submission
    const form = document.getElementById('advancedFilterForm');
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            // Apply filters logic here
            hideAdvancedFilters();
            
            Swal.fire({
                title: '✅ Filter Diterapkan',
                text: 'Filter pencarian lanjutan telah diterapkan',
                icon: 'success',
                background: 'linear-gradient(135deg, #303134, #3c4043)',
                color: '#e8eaed',
                confirmButtonColor: '#1a73e8',
                timer: 2000,
                showConfirmButton: false
            });
        });
    }
});
</script>
