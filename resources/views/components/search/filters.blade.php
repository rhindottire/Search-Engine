<!-- Mobile-First Enhanced Search Filter Tabs -->
<div class="px-2 sm:px-4 lg:px-8 max-w-6xl mx-auto">
    <!-- Mobile Filter Toggle -->
    <div class="block sm:hidden mb-4">
        <button onclick="toggleMobileFilters()" 
                class="flex items-center justify-between w-full p-3 bg-[#303134] text-[#e8eaed] rounded-lg border border-[#5f6368] hover:border-[#8ab4f8] transition-all duration-300">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.414A1 1 0 013 6.707V4z"/>
                </svg>
                <span class="font-medium">Filter: Semua</span>
            </span>
            <svg class="w-4 h-4 transition-transform duration-300" id="filterToggleIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
        
        <!-- Mobile Filter Dropdown -->
        <div id="mobileFilters" class="hidden mt-2 bg-[#303134] rounded-lg border border-[#5f6368] overflow-hidden">
            <a href="#" class="mobile-filter-item active flex items-center gap-3 px-4 py-3 text-[#8ab4f8] bg-[#3c4043] hover:bg-[#5f6368] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span class="font-medium">Semua</span>
            </a>
            <a href="#" class="mobile-filter-item flex items-center gap-3 px-4 py-3 text-[#bdc1c6] hover:text-[#e8eaed] hover:bg-[#3c4043] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Gambar</span>
            </a>
            <a href="#" class="mobile-filter-item flex items-center gap-3 px-4 py-3 text-[#bdc1c6] hover:text-[#e8eaed] hover:bg-[#3c4043] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                <span>Video</span>
            </a>
            <a href="#" class="mobile-filter-item flex items-center gap-3 px-4 py-3 text-[#bdc1c6] hover:text-[#e8eaed] hover:bg-[#3c4043] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <span>Berita</span>
            </a>
        </div>
    </div>
    
    <!-- Desktop/Tablet Horizontal Filters -->
    <div class="hidden sm:block">
        <div class="flex gap-3 lg:gap-6 pb-2 text-sm overflow-x-auto scrollbar-hide scroll-smooth">
            <a href="#" class="filter-tab active flex items-center gap-2 text-[#8ab4f8] border-b-2 border-[#8ab4f8] pb-2 hover:text-[#aecbfa] transition-all duration-300 whitespace-nowrap px-2 py-1" data-cursor="hover">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <span class="font-medium">Semua</span>
            </a>
            
            <a href="#" class="filter-tab flex items-center gap-2 text-[#bdc1c6] hover:text-[#e8eaed] pb-2 transition-all duration-300 hover:border-b-2 hover:border-[#5f6368] whitespace-nowrap px-2 py-1" data-cursor="hover">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Gambar</span>
            </a>
            
            <a href="#" class="filter-tab flex items-center gap-2 text-[#bdc1c6] hover:text-[#e8eaed] pb-2 transition-all duration-300 hover:border-b-2 hover:border-[#5f6368] whitespace-nowrap px-2 py-1" data-cursor="hover">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
                <span>Video</span>
            </a>
            
            <a href="#" class="filter-tab flex items-center gap-2 text-[#bdc1c6] hover:text-[#e8eaed] pb-2 transition-all duration-300 hover:border-b-2 hover:border-[#5f6368] whitespace-nowrap px-2 py-1" data-cursor="hover">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <span>Berita</span>
            </a>
            
            <a href="#" class="filter-tab flex items-center gap-2 text-[#bdc1c6] hover:text-[#e8eaed] pb-2 transition-all duration-300 hover:border-b-2 hover:border-[#5f6368] whitespace-nowrap px-2 py-1" data-cursor="hover">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
                <span>Buku</span>
            </a>
            
            <button class="filter-tab flex items-center gap-2 text-[#bdc1c6] hover:text-[#e8eaed] pb-2 transition-all duration-300 hover:border-b-2 hover:border-[#5f6368] whitespace-nowrap px-2 py-1" data-cursor="magnetic">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                </svg>
                <span>Tools</span>
            </button>
        </div>
    </div>
</div>

<style>
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    
    .filter-tab {
        position: relative;
        overflow: hidden;
    }
    
    .filter-tab::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #8ab4f8, #4285f4);
        transition: width 0.3s ease;
    }
    
    .filter-tab:hover::before {
        width: 100%;
    }
    
    .filter-tab.active::before {
        width: 100%;
    }
    
    .filter-tab:hover {
        transform: translateY(-1px);
    }
</style>

<script>
function toggleMobileFilters() {
    const filters = document.getElementById('mobileFilters');
    const icon = document.getElementById('filterToggleIcon');
    const isHidden = filters.classList.contains('hidden');
    
    if (isHidden) {
        filters.classList.remove('hidden');
        filters.style.animation = 'slideDown 0.3s ease-out';
        icon.style.transform = 'rotate(180deg)';
    } else {
        filters.style.animation = 'slideUp 0.3s ease-in';
        icon.style.transform = 'rotate(0deg)';
        setTimeout(() => {
            filters.classList.add('hidden');
        }, 300);
    }
}

// Mobile filter selection
document.addEventListener('DOMContentLoaded', () => {
    const mobileFilterItems = document.querySelectorAll('.mobile-filter-item');
    
    mobileFilterItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Update active state
            mobileFilterItems.forEach(i => {
                i.classList.remove('active', 'text-[#8ab4f8]', 'bg-[#3c4043]');
                i.classList.add('text-[#bdc1c6]');
            });
            
            item.classList.add('active', 'text-[#8ab4f8]', 'bg-[#3c4043]');
            item.classList.remove('text-[#bdc1c6]');
            
            // Update button text
            const buttonText = document.querySelector('button[onclick="toggleMobileFilters()"] span');
            buttonText.textContent = `Filter: ${item.querySelector('span').textContent}`;
            
            // Close dropdown
            toggleMobileFilters();
        });
    });
});

// Add slide animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideUp {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-10px); }
    }
`;
document.head.appendChild(style);
});

    document.addEventListener('DOMContentLoaded', () => {
        const filterTabs = document.querySelectorAll('.filter-tab');
        
        filterTabs.forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Remove active class from all tabs
                filterTabs.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked tab
                tab.classList.add('active');
                
                // Add ripple effect
                const ripple = document.createElement('div');
                const rect = tab.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    background: radial-gradient(circle, rgba(138, 180, 248, 0.3) 0%, transparent 70%);
                    border-radius: 50%;
                    pointer-events: none;
                    animation: ripple 0.6s ease-out;
                    z-index: 0;
                `;
                
                tab.style.position = 'relative';
                tab.style.overflow = 'hidden';
                tab.appendChild(ripple);
                
                setTimeout(() => {
                    if (ripple.parentNode) {
                        ripple.parentNode.removeChild(ripple);
                    }
                }, 600);
            });
        });
    });
</script>
