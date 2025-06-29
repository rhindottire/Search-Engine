@props([
    'hasResults' => false
])

@if($hasResults)
<!-- Mobile-First Enhanced Google-style Pagination -->
<div class="w-full pt-8 sm:pt-12 border-t border-[#3c4043] mt-8 sm:mt-12 animate-fade-in">
    <div class="flex flex-col items-center gap-6 sm:gap-8">
        <!-- Mobile Pagination -->
        <div class="block sm:hidden w-full">
            <div class="flex items-center justify-between mb-4">
                <button class="pagination-btn flex items-center gap-2 px-4 py-2 text-[#8ab4f8] hover:bg-[#303134] rounded-lg transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed" 
                        disabled
                        data-cursor="hover">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span class="text-sm">Sebelumnya</span>
                </button>
                
                <div class="text-[#9aa0a6] text-sm">
                    Halaman <span class="text-[#e8eaed] font-medium">1</span> dari <span class="text-[#e8eaed] font-medium">10</span>
                </div>
                
                <button class="pagination-btn flex items-center gap-2 px-4 py-2 text-[#8ab4f8] hover:bg-[#303134] rounded-lg transition-all duration-300" data-cursor="hover">
                    <span class="text-sm">Selanjutnya</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile Page Numbers -->
            <div class="flex items-center justify-center gap-1 overflow-x-auto scrollbar-hide pb-2">
                <button class="pagination-number active w-8 h-8 flex items-center justify-center text-white bg-[#1a73e8] rounded-full font-medium text-sm hover:bg-[#1557b0] transition-all duration-300 flex-shrink-0" data-cursor="magnetic">1</button>
                <button class="pagination-number w-8 h-8 flex items-center justify-center text-[#8ab4f8] hover:bg-[#303134] rounded-full font-medium text-sm transition-all duration-300 flex-shrink-0" data-cursor="hover">2</button>
                <button class="pagination-number w-8 h-8 flex items-center justify-center text-[#8ab4f8] hover:bg-[#303134] rounded-full font-medium text-sm transition-all duration-300 flex-shrink-0" data-cursor="hover">3</button>
                <span class="px-1 text-[#9aa0a6] text-sm">...</span>
                <button class="pagination-number w-8 h-8 flex items-center justify-center text-[#8ab4f8] hover:bg-[#303134] rounded-full font-medium text-sm transition-all duration-300 flex-shrink-0" data-cursor="hover">10</button>
            </div>
        </div>
        
        <!-- Desktop Pagination -->
        <div class="hidden sm:flex items-center gap-2">
            <button class="pagination-btn px-4 py-2 text-[#8ab4f8] hover:bg-[#303134] rounded-lg transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed" 
                    disabled
                    data-cursor="hover">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                <span class="sr-only">Previous</span>
            </button>
            
            <div class="flex items-center gap-1">
                <button class="pagination-number active w-10 h-10 flex items-center justify-center text-white bg-[#1a73e8] rounded-full font-medium hover:bg-[#1557b0] transition-all duration-300" data-cursor="magnetic">1</button>
                <button class="pagination-number w-10 h-10 flex items-center justify-center text-[#8ab4f8] hover:bg-[#303134] rounded-full font-medium transition-all duration-300" data-cursor="hover">2</button>
                <button class="pagination-number w-10 h-10 flex items-center justify-center text-[#8ab4f8] hover:bg-[#303134] rounded-full font-medium transition-all duration-300" data-cursor="hover">3</button>
                <button class="pagination-number w-10 h-10 flex items-center justify-center text-[#8ab4f8] hover:bg-[#303134] rounded-full font-medium transition-all duration-300" data-cursor="hover">4</button>
                <button class="pagination-number w-10 h-10 flex items-center justify-center text-[#8ab4f8] hover:bg-[#303134] rounded-full font-medium transition-all duration-300" data-cursor="hover">5</button>
                <span class="px-2 text-[#9aa0a6]">...</span>
                <button class="pagination-number w-10 h-10 flex items-center justify-center text-[#8ab4f8] hover:bg-[#303134] rounded-full font-medium transition-all duration-300" data-cursor="hover">10</button>
            </div>
            
            <button class="pagination-btn px-4 py-2 text-[#8ab4f8] hover:bg-[#303134] rounded-lg transition-all duration-300" data-cursor="hover">
                <span class="sr-only">Next</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
        
        <!-- NextGoogle Logo -->
        <div class="text-center">
            <div class="text-[#8ab4f8] text-2xl sm:text-3xl font-bold tracking-wider hover:scale-105 transition-transform duration-300 cursor-pointer" data-cursor="magnetic">
                Next<span class="text-[#ea4335]">G</span><span class="text-[#fbbc05]">o</span><span class="text-[#8ab4f8]">o</span><span class="text-[#34a853]">g</span><span class="text-[#ea4335]">l</span><span class="text-[#8ab4f8]">e</span>
            </div>
            <div class="mt-2 text-[#9aa0a6] text-sm">Halaman 1 dari 10</div>
        </div>
        
        <!-- Quick Jump - Hidden on mobile -->
        <div class="hidden sm:flex items-center gap-2 text-sm">
            <span class="text-[#9aa0a6]">Lompat ke halaman:</span>
            <input type="number" 
                   min="1" 
                   max="10" 
                   value="1" 
                   class="w-16 px-2 py-1 bg-[#303134] text-[#e8eaed] border border-[#5f6368] rounded focus:border-[#8ab4f8] focus:outline-none transition-colors"
                   data-cursor="hover">
            <button class="px-3 py-1 bg-[#1a73e8] text-white rounded hover:bg-[#1557b0] transition-colors" data-cursor="magnetic">Go</button>
        </div>
        
        <!-- Mobile Quick Jump -->
        <div class="block sm:hidden w-full">
            <div class="flex items-center justify-center gap-2 text-sm">
                <span class="text-[#9aa0a6]">Ke halaman:</span>
                <input type="number" 
                       min="1" 
                       max="10" 
                       value="1" 
                       class="w-16 px-2 py-1 bg-[#303134] text-[#e8eaed] border border-[#5f6368] rounded focus:border-[#8ab4f8] focus:outline-none transition-colors text-center">
                <button class="px-4 py-1 bg-[#1a73e8] text-white rounded hover:bg-[#1557b0] transition-colors">Go</button>
            </div>
        </div>
    </div>
</div>

<style>
    .pagination-number.active {
        box-shadow: 0 4px 12px rgba(26, 115, 232, 0.3);
    }
    
    .pagination-number:hover:not(.active) {
        transform: scale(1.1);
    }
    
    .pagination-btn:hover:not(:disabled) {
        transform: translateX(2px);
    }
    
    .pagination-btn:first-child:hover {
        transform: translateX(-2px);
    }
    
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fade-in 0.8s ease-out;
    }
    
    /* Mobile optimizations */
    @media (max-width: 639px) {
        .pagination-number:hover:not(.active) {
            transform: none;
        }
        
        .pagination-btn:hover:not(:disabled) {
            transform: none;
        }
        
        .pagination-btn:first-child:hover {
            transform: none;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const paginationNumbers = document.querySelectorAll('.pagination-number');
        
        paginationNumbers.forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove active class from all
                paginationNumbers.forEach(b => b.classList.remove('active'));
                
                // Add active class to clicked
                btn.classList.add('active');
                
                // Add ripple effect
                const ripple = document.createElement('div');
                const rect = btn.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = event.clientX - rect.left - size / 2;
                const y = event.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
                    border-radius: 50%;
                    pointer-events: none;
                    animation: ripple 0.6s ease-out;
                `;
                
                btn.style.position = 'relative';
                btn.style.overflow = 'hidden';
                btn.appendChild(ripple);
                
                setTimeout(() => {
                    if (ripple.parentNode) {
                        ripple.parentNode.removeChild(ripple);
                    }
                }, 600);
            });
        });
    });
</script>
@endif
