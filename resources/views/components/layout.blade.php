@props(
    [
        "class" => "",
        "title" => "NextGoogle - Search Engine",
    ]
)

<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="NextGoogle - Mesin pencari untuk mata kuliah Information Retrieval">
        <meta name="keywords" content="search engine, information retrieval, budaya indonesia, kebudayaan nasional">
        <meta name="author" content="NextGoogle Team">
        
        <title>{{ $title }}</title>
        
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
        
        <!-- Preload critical resources -->
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style">
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Scheherazade+New:wght@400;700&display=swap" as="style">
        <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" as="style">
        
        <!-- Stylesheets -->
        @vite('resources/css/app.css')
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Scheherazade+New:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
        <style>
            * {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
                box-sizing: border-box;
            }
            
            .arabic-text {
                font-family: 'Scheherazade New', serif;
            }
            
            /* Enhanced Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }
            
            ::-webkit-scrollbar-track {
                background: linear-gradient(180deg, #202124, #303134);
            }
            
            ::-webkit-scrollbar-thumb {
                background: linear-gradient(180deg, #5f6368, #8ab4f8);
                border-radius: 4px;
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(180deg, #8ab4f8, #aecbfa);
            }
            
            /* Smooth scrolling */
            html {
                scroll-behavior: smooth;
            }
            
            /* Enhanced Focus styles */
            *:focus {
                outline: 2px solid #8ab4f8;
                outline-offset: 2px;
                box-shadow: 0 0 0 4px rgba(138, 180, 248, 0.2);
            }
            
            /* Enhanced Loading animation */
            .loading {
                display: inline-block;
                width: 20px;
                height: 20px;
                border: 3px solid #5f6368;
                border-radius: 50%;
                border-top-color: #8ab4f8;
                animation: spin 1s ease-in-out infinite;
            }
            
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
            
            /* Reduce motion for accessibility */
            @media (prefers-reduced-motion: reduce) {
                *,
                *::before,
                *::after {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                }
            }
            
            /* High contrast mode support */
            @media (prefers-contrast: high) {
                .text-[#9aa0a6] {
                    color: #ffffff !important;
                }
                .border-[#5f6368] {
                    border-color: #ffffff !important;
                }
            }
        </style>
    </head>
    <body class="{{ $class }} antialiased">
        <!-- Skip to main content for accessibility -->
        <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-[#1a73e8] text-white px-4 py-2 rounded-lg z-50 transition-all duration-300">
            Skip to main content
        </a>
        
        <div id="main-content">
            {{ $slot }}
        </div>
        
        <!-- Enhanced Loading overlay -->
        <div id="loading-overlay" class="fixed inset-0 bg-gradient-to-br from-[#0a0a0a] via-[#202124] to-[#303134] bg-opacity-95 flex items-center justify-center z-50 backdrop-blur-sm">
            <div class="text-center">
                <div class="relative">
                    <div class="loading mb-4 mx-auto"></div>
                    <div class="absolute inset-0 loading opacity-50 scale-150"></div>
                </div>
                <p class="text-[#e8eaed] text-lg animate-pulse">Memuat hasil pencarian...</p>
                <div class="mt-4 flex justify-center space-x-1">
                    <div class="w-2 h-2 bg-[#8ab4f8] rounded-full animate-bounce"></div>
                    <div class="w-2 h-2 bg-[#8ab4f8] rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                    <div class="w-2 h-2 bg-[#8ab4f8] rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                </div>
            </div>
        </div>
        
        <!-- Performance monitoring -->
        <script>
            // Performance optimization
            if ('requestIdleCallback' in window) {
                requestIdleCallback(() => {
                    // Non-critical initialization
                    console.log('NextGoogle loaded successfully! 🚀');
                });
            }
            
            // Show loading overlay on form submission
            document.addEventListener('DOMContentLoaded', () => {
                const forms = document.querySelectorAll('form');
                const loadingOverlay = document.getElementById('loading-overlay');
                
                forms.forEach(form => {
                    form.addEventListener('submit', () => {
                        loadingOverlay.classList.remove('hidden');
                        loadingOverlay.style.animation = 'fadeIn 0.3s ease-out';
                    });
                });
                
                // Hide loading overlay when page loads
                window.addEventListener('load', () => {
                    loadingOverlay.style.animation = 'fadeOut 0.3s ease-in';
                    setTimeout(() => {
                        loadingOverlay.classList.add('hidden');
                    }, 300);
                });
                
                // Preload next page resources
                const links = document.querySelectorAll('a[href^="/"]');
                links.forEach(link => {
                    link.addEventListener('mouseenter', () => {
                        const prefetchLink = document.createElement('link');
                        prefetchLink.rel = 'prefetch';
                        prefetchLink.href = link.href;
                        document.head.appendChild(prefetchLink);
                    });
                });
            });
            
            // Enhanced SweetAlert2 defaults
            if (typeof Swal !== 'undefined') {
                Swal.mixin({
                    background: 'linear-gradient(135deg, #303134, #3c4043)',
                    color: '#e8eaed',
                    confirmButtonColor: '#1a73e8',
                    cancelButtonColor: '#5f6368',
                    customClass: {
                        popup: 'rounded-xl border border-[#5f6368] shadow-2xl',
                        title: 'text-xl font-bold',
                        content: 'text-base',
                        confirmButton: 'px-6 py-3 rounded-lg font-medium hover:scale-105 transition-transform',
                        cancelButton: 'px-6 py-3 rounded-lg font-medium hover:scale-105 transition-transform'
                    },
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown animate__faster'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp animate__faster'
                    }
                });
            }
            
            // Add fade animations
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeIn {
                    from { opacity: 0; }
                    to { opacity: 1; }
                }
                
                @keyframes fadeOut {
                    from { opacity: 1; }
                    to { opacity: 0; }
                }
            `;
            document.head.appendChild(style);
        </script>
    </body>
</html>
