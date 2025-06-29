<section class="fixed bottom-8 right-8 z-20">
    <div class="bg-[#303134] rounded-xl p-4 border border-[#3c4043] shadow-lg backdrop-blur-sm hidden lg:block">
        <div class="flex items-center justify-between mb-3">
            <h3 class="text-[#e8eaed] font-medium text-sm flex items-center gap-2">
                <span class="text-lg">⚡</span>
                Akses Cepat
            </h3>
            <button onclick="toggleShortcuts()" class="text-[#9aa0a6] hover:text-[#e8eaed] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="space-y-2" id="shortcut-items">
            @php
                $shortcuts = [
                    ['name' => 'Budaya Indonesia', 'query' => 'budaya indonesia', 'icon' => '🏛️', 'color' => 'from-blue-500 to-purple-600'],
                    ['name' => 'Seni Tradisional', 'query' => 'seni tradisional', 'icon' => '🎭', 'color' => 'from-pink-500 to-red-600'],
                    ['name' => 'Festival Budaya', 'query' => 'festival budaya', 'icon' => '🎪', 'color' => 'from-yellow-500 to-orange-600'],
                    ['name' => 'Sejarah Indonesia', 'query' => 'sejarah indonesia', 'icon' => '📚', 'color' => 'from-green-500 to-teal-600'],
                ];
            @endphp
            @foreach($shortcuts as $shortcut)
                <a href="{{ route('search', ['query' => $shortcut['query']]) }}" 
                   class="flex items-center gap-3 p-3 hover:bg-gradient-to-r hover:{{ $shortcut['color'] }} rounded-lg transition-all duration-300 group shortcut-item">
                    <span class="text-lg group-hover:animate-bounce">{{ $shortcut['icon'] }}</span>
                    <span class="text-[#bdc1c6] text-sm group-hover:text-white font-medium">{{ $shortcut['name'] }}</span>
                    <svg class="w-3 h-3 text-[#9aa0a6] group-hover:text-white ml-auto opacity-0 group-hover:opacity-100 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Mobile Floating Action Button -->
<div class="fixed bottom-6 right-6 z-20 lg:hidden">
    <button onclick="toggleMobileShortcuts()" 
            class="w-14 h-14 bg-gradient-to-r from-[#1a73e8] to-[#4285f4] rounded-full shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center mobile-fab">
        <span class="text-2xl animate-pulse">⚡</span>
    </button>
    
    <!-- Mobile Shortcuts Menu -->
    <div id="mobile-shortcuts" class="absolute bottom-16 right-0 bg-gradient-to-br from-[#303134] to-[#3c4043] rounded-xl p-4 border border-[#5f6368] shadow-2xl backdrop-blur-sm hidden min-w-[200px]">
        <h3 class="text-[#e8eaed] font-medium text-sm mb-3 flex items-center gap-2">
            <span class="text-lg">⚡</span>
            Akses Cepat
        </h3>
        <div class="space-y-2">
            @foreach($shortcuts as $shortcut)
                <a href="{{ route('search', ['query' => $shortcut['query']]) }}" 
                   class="flex items-center gap-3 p-2 hover:bg-[#3c4043] rounded-lg transition-all duration-300 group">
                    <span class="text-lg group-hover:animate-bounce">{{ $shortcut['icon'] }}</span>
                    <span class="text-[#bdc1c6] text-sm group-hover:text-[#e8eaed]">{{ $shortcut['name'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

<style>
    .shortcut-panel {
        animation: slideInRight 0.5s ease-out;
    }
    
    .mobile-fab {
        animation: bounceIn 0.8s ease-out;
    }
    
    .shortcut-item:hover {
        transform: translateX(-5px) scale(1.02);
    }
    
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes bounceIn {
        0% {
            transform: scale(0.3);
            opacity: 0;
        }
        50% {
            transform: scale(1.1);
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    @keyframes fadeOut {
        to {
            opacity: 0;
            transform: scale(0.95);
        }
    }
</style>

<script>
    function toggleShortcuts() {
        const panel = document.querySelector('.shortcut-panel');
        panel.style.animation = 'slideOutRight 0.3s ease-in forwards';
        setTimeout(() => {
            panel.parentElement.style.display = 'none';
        }, 300);
    }
    
    function toggleMobileShortcuts() {
        const menu = document.getElementById('mobile-shortcuts');
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
    
    // Close mobile shortcuts when clicking outside
    document.addEventListener('click', (e) => {
        const menu = document.getElementById('mobile-shortcuts');
        const fab = document.querySelector('.mobile-fab');
        
        if (!menu.contains(e.target) && !fab.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
</script>
