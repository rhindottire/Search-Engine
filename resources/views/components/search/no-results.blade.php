@props([
    'query' => ''
])

<!-- Enhanced No Results Component -->
<div class="text-center py-16 animate-fade-in">
    <!-- Animated Icon -->
    <div class="mb-8 relative">
        <div class="relative inline-block">
            <svg class="w-32 h-32 mx-auto text-[#5f6368] animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <div class="absolute inset-0 bg-gradient-to-r from-[#8ab4f8] to-[#4285f4] opacity-20 rounded-full animate-pulse"></div>
        </div>
        
        <!-- Floating particles -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="particle particle-1"></div>
            <div class="particle particle-2"></div>
            <div class="particle particle-3"></div>
        </div>
    </div>
    
    <!-- Enhanced Title -->
    <h3 class="text-[#e8eaed] text-2xl font-bold mb-4 animate-slide-up">
        Tidak ada hasil untuk 
        <span class="text-[#8ab4f8] bg-[#303134] px-3 py-1 rounded-full border border-[#5f6368]">"{{ $query }}"</span>
    </h3>
    
    <!-- Enhanced Suggestions -->
    <div class="text-[#9aa0a6] space-y-6 max-w-md mx-auto animate-slide-up-delay">
        <p class="text-lg">Coba dengan:</p>
        
        <div class="grid gap-3 text-sm">
            <div class="flex items-center gap-3 p-3 bg-[#303134] rounded-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 group" data-cursor="hover">
                <svg class="w-5 h-5 text-[#8ab4f8] group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="group-hover:text-[#e8eaed] transition-colors">Periksa ejaan kata kunci</span>
            </div>
            
            <div class="flex items-center gap-3 p-3 bg-[#303134] rounded-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 group" data-cursor="hover">
                <svg class="w-5 h-5 text-[#8ab4f8] group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                <span class="group-hover:text-[#e8eaed] transition-colors">Gunakan kata kunci yang lebih umum</span>
            </div>
            
            <div class="flex items-center gap-3 p-3 bg-[#303134] rounded-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 group" data-cursor="hover">
                <svg class="w-5 h-5 text-[#8ab4f8] group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                <span class="group-hover:text-[#e8eaed] transition-colors">Coba kata kunci yang berbeda</span>
            </div>
            
            <div class="flex items-center gap-3 p-3 bg-[#303134] rounded-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 group" data-cursor="hover">
                <svg class="w-5 h-5 text-[#8ab4f8] group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                </svg>
                <span class="group-hover:text-[#e8eaed] transition-colors">Gunakan lebih sedikit kata kunci</span>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-delay">
        <a href="{{ route('home') }}" 
           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#1a73e8] to-[#4285f4] text-white rounded-lg hover:from-[#1557b0] hover:to-[#3367d6] transition-all duration-300 hover:scale-105 hover:shadow-lg"
           data-cursor="magnetic">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Kembali ke Beranda
        </a>
        
        <button onclick="suggestSearch()" 
                class="inline-flex items-center gap-2 px-6 py-3 bg-[#303134] text-[#e8eaed] rounded-lg hover:bg-[#3c4043] border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300 hover:scale-105"
                data-cursor="magnetic">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
            Saran Pencarian
        </button>
    </div>
</div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    .animate-fade-in {
        animation: fade-in 0.8s ease-out;
    }
    
    .animate-slide-up {
        animation: slide-up 0.8s ease-out 0.2s both;
    }
    
    .animate-slide-up-delay {
        animation: slide-up 0.8s ease-out 0.4s both;
    }
    
    .animate-fade-in-delay {
        animation: fade-in 0.8s ease-out 0.6s both;
    }
    
    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: #8ab4f8;
        border-radius: 50%;
        animation: particle-float 4s ease-in-out infinite;
    }
    
    .particle-1 {
        top: 20%;
        left: 20%;
        animation-delay: 0s;
    }
    
    .particle-2 {
        top: 30%;
        right: 25%;
        animation-delay: 1s;
    }
    
    .particle-3 {
        bottom: 25%;
        left: 30%;
        animation-delay: 2s;
    }
    
    @keyframes particle-float {
        0%, 100% { 
            transform: translateY(0px) scale(1);
            opacity: 0.7;
        }
        50% { 
            transform: translateY(-20px) scale(1.2);
            opacity: 1;
        }
    }
</style>

<script>
    function suggestSearch() {
        const suggestions = [
            'kebudayaan nasional',
            'budaya indonesia',
            'seni tradisional',
            'festival budaya',
            'sejarah indonesia'
        ];
        
        const randomSuggestion = suggestions[Math.floor(Math.random() * suggestions.length)];
        
        Swal.fire({
            title: '💡 Saran Pencarian',
            text: `Coba cari: "${randomSuggestion}"`,
            icon: 'info',
            background: 'linear-gradient(135deg, #303134, #3c4043)',
            color: '#e8eaed',
            confirmButtonColor: '#1a73e8',
            confirmButtonText: 'Cari Sekarang',
            showCancelButton: true,
            cancelButtonText: 'Batal',
            cancelButtonColor: '#5f6368'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `{{ route('search') }}?query=${encodeURIComponent(randomSuggestion)}`;
            }
        });
    }
</script>
