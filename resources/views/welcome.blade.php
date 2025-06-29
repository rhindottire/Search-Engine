@props([
    "title" => "NextGoogle - Search Engine",
])

<x-layout class="bg-[#0a0a0a] overflow-hidden relative" :title="$title">
    <!-- Advanced Cursor Effects -->
    <x-cursor-effects />
    
    <!-- Rotating Galaxy Background -->
    <x-animated-background />

    <!-- Hero Section -->
    <x-welcome.hero />
    
    <main class="relative flex flex-col justify-center items-center min-h-screen px-4 z-10">
        <!-- Logo with enhanced animation -->
        <div class="text-center mb-8 animate-fade-in">
            <h1 class="text-6xl sm:text-7xl md:text-8xl text-white font-bold mb-4 animate-bounce-in glow-text">
                <span class="text-6xl sm:text-7xl md:text-8xl text-[#4285f4] animate-pulse-glow">Next</span><span class="animate-color-shift">Google</span>
            </h1>
            <p class="text-[#9aa0a6] text-lg sm:text-xl animate-slide-up typewriter">
                Mesin pencari untuk mata kuliah Information Retrieval
            </p>
        </div>

        <!-- Enhanced Search Form -->
        <x-search-form />

        <!-- Enhanced Quick Search Tags -->
        <x-quick-tags />
    </main>

    <!-- Enhanced Shortcut Component - Fixed for mobile -->
    <x-welcome.shortcut />

    <style>
        /* Core Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes bounceIn {
            0% { transform: scale(0.3) rotate(-10deg); opacity: 0; }
            50% { transform: scale(1.1) rotate(5deg); }
            70% { transform: scale(0.9) rotate(-2deg); }
            100% { transform: scale(1) rotate(0deg); opacity: 1; }
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes colorShift {
            0%, 100% { color: #ffffff; }
            25% { color: #8ab4f8; }
            50% { color: #aecbfa; }
            75% { color: #c8e6c9; }
        }
        
        @keyframes pulseGlow {
            0%, 100% { text-shadow: 0 0 5px #4285f4, 0 0 10px #4285f4, 0 0 15px #4285f4; }
            50% { text-shadow: 0 0 10px #4285f4, 0 0 20px #4285f4, 0 0 30px #4285f4; }
        }
        
        @keyframes typewriter {
            from { width: 0; }
            to { width: 100%; }
        }
        
        /* Apply animations */
        .animate-fade-in {
            animation: fadeIn 1.2s ease-out;
        }
        
        .animate-bounce-in {
            animation: bounceIn 1.5s ease-out;
        }
        
        .animate-slide-up {
            animation: slideUp 1s ease-out 0.3s both;
        }
        
        .animate-slide-up-delay {
            animation: slideUp 1s ease-out 0.6s both;
        }
        
        .animate-fade-in-delay {
            animation: fadeIn 1.2s ease-out 0.9s both;
        }
        
        .animate-color-shift {
            animation: colorShift 4s ease-in-out infinite;
        }
        
        .animate-pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite;
        }
        
        /* Glow effects */
        .glow-text {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        
        /* Typewriter effect */
        .typewriter {
            overflow: hidden;
            border-right: 2px solid #8ab4f8;
            white-space: nowrap;
            animation: typewriter 3s steps(50) 1s both, blink 1s infinite 4s;
        }
        
        @keyframes blink {
            50% { border-color: transparent; }
        }
        
        /* Responsive enhancements */
        @media (max-width: 768px) {
            .glow-text {
                text-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
            }
        }
    </style>
</x-layout>
