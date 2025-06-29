@props([
    'data' => [],
    'query' => ''
])

<!-- Export Results Component -->
<div id="exportResults" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-gradient-to-b from-[#303134] to-[#2a2a2a] rounded-xl p-6 max-w-md w-full border border-[#5f6368]">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-[#e8eaed] text-lg font-medium flex items-center gap-2">
                <svg class="w-5 h-5 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Ekspor Hasil Pencarian
            </h3>
            <button onclick="hideExportResults()" class="text-[#9aa0a6] hover:text-[#e8eaed] p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        
        <div class="space-y-4">
            <div class="text-[#9aa0a6] text-sm mb-4">
                Ekspor {{ count($data) }} hasil pencarian untuk "{{ $query }}"
            </div>
            
            <!-- Export Options -->
            <div class="space-y-3">
                <button onclick="exportToPDF()" class="w-full flex items-center gap-3 p-3 bg-[#3c4043] hover:bg-[#5f6368] text-[#e8eaed] rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-[#ea4335]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <div class="text-left">
                        <div class="font-medium">Ekspor ke PDF</div>
                        <div class="text-xs text-[#9aa0a6]">Format dokumen untuk dibaca</div>
                    </div>
                </button>
                
                <button onclick="exportToCSV()" class="w-full flex items-center gap-3 p-3 bg-[#3c4043] hover:bg-[#5f6368] text-[#e8eaed] rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-[#34a853]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <div class="text-left">
                        <div class="font-medium">Ekspor ke CSV</div>
                        <div class="text-xs text-[#9aa0a6]">Format spreadsheet untuk analisis</div>
                    </div>
                </button>
                
                <button onclick="exportToJSON()" class="w-full flex items-center gap-3 p-3 bg-[#3c4043] hover:bg-[#5f6368] text-[#e8eaed] rounded-lg transition-colors">
                    <svg class="w-5 h-5 text-[#8ab4f8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                    <div class="text-left">
                        <div class="font-medium">Ekspor ke JSON</div>
                        <div class="text-xs text-[#9aa0a6]">Format data untuk developer</div>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
const searchData = @json($data);
const searchQuery = @json($query);

function showExportResults() {
    const modal = document.getElementById('exportResults');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function hideExportResults() {
    const modal = document.getElementById('exportResults');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function exportToPDF() {
    // Create PDF content
    const content = searchData.map(item => `
        Judul: ${item.title}
        Sumber: ${item.source_url}
        Tanggal: ${item.date}
        Skor: ${item.score}
        Konten: ${item.content.substring(0, 500)}...
        
        ---
    `).join('\n');
    
    const blob = new Blob([`Hasil Pencarian: ${searchQuery}\n\n${content}`], { type: 'text/plain' });
    downloadFile(blob, `search-results-${searchQuery}.txt`);
    
    hideExportResults();
    showExportSuccess('PDF');
}

function exportToCSV() {
    const headers = ['ID', 'Judul', 'Sumber', 'Tanggal', 'Skor', 'Kategori'];
    const rows = searchData.map(item => [
        item.id,
        `"${item.title.replace(/"/g, '""')}"`,
        item.source_url,
        item.date,
        item.score,
        `"${item.category.replace(/"/g, '""')}"`
    ]);
    
    const csvContent = [headers.join(','), ...rows.map(row => row.join(','))].join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv' });
    downloadFile(blob, `search-results-${searchQuery}.csv`);
    
    hideExportResults();
    showExportSuccess('CSV');
}

function exportToJSON() {
    const exportData = {
        query: searchQuery,
        timestamp: new Date().toISOString(),
        total_results: searchData.length,
        results: searchData
    };
    
    const blob = new Blob([JSON.stringify(exportData, null, 2)], { type: 'application/json' });
    downloadFile(blob, `search-results-${searchQuery}.json`);
    
    hideExportResults();
    showExportSuccess('JSON');
}

function downloadFile(blob, filename) {
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
}

function showExportSuccess(format) {
    Swal.fire({
        title: '📥 Ekspor Berhasil!',
        text: `File ${format} telah diunduh`,
        icon: 'success',
        background: 'linear-gradient(135deg, #303134, #3c4043)',
        color: '#e8eaed',
        confirmButtonColor: '#1a73e8',
        timer: 2000,
        showConfirmButton: false
    });
}
</script>
