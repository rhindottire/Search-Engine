<!-- Rotating Galaxy Background -->
<div class="fixed inset-0 overflow-hidden pointer-events-none">
    <!-- Galaxy Container -->
    <div class="absolute inset-0" id="galaxy-container">
        <!-- Galaxy Core -->
        <div class="galaxy-core absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            <div class="core-center"></div>
            <div class="core-glow"></div>
        </div>
        
        <!-- Galaxy Spiral Arms -->
        <div class="galaxy-spiral absolute inset-0" id="spiral-1">
            <div class="spiral-arm arm-1"></div>
            <div class="spiral-arm arm-2"></div>
            <div class="spiral-arm arm-3"></div>
            <div class="spiral-arm arm-4"></div>
        </div>
        
        <!-- Rotating Star Fields -->
        <div class="star-field star-field-1 absolute inset-0" id="stars-near"></div>
        <div class="star-field star-field-2 absolute inset-0" id="stars-mid"></div>
        <div class="star-field star-field-3 absolute inset-0" id="stars-far"></div>
        
        <!-- Orbiting Planets -->
        <div class="planets-container absolute inset-0" id="planets-system">
            <!-- Planet Orbits -->
            <div class="planet-orbit orbit-1">
                <div class="planet planet-mercury" data-cursor="magnetic">
                    <div class="planet-surface"></div>
                    <div class="planet-atmosphere"></div>
                </div>
            </div>
            
            <div class="planet-orbit orbit-2">
                <div class="planet planet-venus" data-cursor="magnetic">
                    <div class="planet-surface"></div>
                    <div class="planet-atmosphere"></div>
                    <div class="planet-ring"></div>
                </div>
            </div>
            
            <div class="planet-orbit orbit-3">
                <div class="planet planet-earth" data-cursor="magnetic">
                    <div class="planet-surface"></div>
                    <div class="planet-atmosphere"></div>
                    <div class="planet-moon"></div>
                </div>
            </div>
            
            <div class="planet-orbit orbit-4">
                <div class="planet planet-mars" data-cursor="magnetic">
                    <div class="planet-surface"></div>
                    <div class="planet-atmosphere"></div>
                </div>
            </div>
        </div>
        
        <!-- Nebula Clouds -->
        <div class="nebula-container absolute inset-0">
            <div class="nebula nebula-1"></div>
            <div class="nebula nebula-2"></div>
            <div class="nebula nebula-3"></div>
        </div>
        
        <!-- Shooting Stars -->
        <div class="shooting-stars absolute inset-0" id="shooting-stars"></div>
        
        <!-- Cosmic Dust -->
        <div class="cosmic-dust absolute inset-0" id="cosmic-dust"></div>
    </div>
</div>

<style>
    /* Galaxy Core */
    .galaxy-core {
        width: 200px;
        height: 200px;
        animation: rotate-slow 60s linear infinite;
    }
    
    .core-center {
        width: 40px;
        height: 40px;
        background: radial-gradient(circle, #ffffff 0%, #8ab4f8 30%, #4285f4 60%, transparent 100%);
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0 0 40px #8ab4f8, 0 0 80px #4285f4, 0 0 120px #1a73e8;
        animation: pulse-core 3s ease-in-out infinite;
    }
    
    .core-glow {
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, transparent 20%, rgba(138, 180, 248, 0.1) 40%, transparent 80%);
        border-radius: 50%;
        animation: pulse-glow 4s ease-in-out infinite reverse;
    }
    
    /* Galaxy Spiral Arms */
    .galaxy-spiral {
        animation: rotate-galaxy 120s linear infinite;
    }
    
    .spiral-arm {
        position: absolute;
        top: 50%;
        left: 50%;
        transform-origin: 0 0;
        width: 800px;
        height: 4px;
        background: linear-gradient(90deg, 
            rgba(138, 180, 248, 0.8) 0%, 
            rgba(138, 180, 248, 0.4) 30%, 
            rgba(138, 180, 248, 0.2) 60%, 
            transparent 100%);
        border-radius: 2px;
        filter: blur(1px);
    }
    
    .arm-1 { transform: rotate(0deg); }
    .arm-2 { transform: rotate(90deg); }
    .arm-3 { transform: rotate(180deg); }
    .arm-4 { transform: rotate(270deg); }
    
    /* Star Fields with Parallax */
    .star-field-1 {
        animation: rotate-stars-fast 40s linear infinite;
    }
    
    .star-field-2 {
        animation: rotate-stars-medium 80s linear infinite reverse;
    }
    
    .star-field-3 {
        animation: rotate-stars-slow 160s linear infinite;
    }
    
    /* Planet Orbits */
    .planet-orbit {
        position: absolute;
        top: 50%;
        left: 50%;
        border: 1px dashed rgba(138, 180, 248, 0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
    }
    
    .orbit-1 {
        width: 300px;
        height: 300px;
        animation: rotate-orbit 20s linear infinite;
    }
    
    .orbit-2 {
        width: 450px;
        height: 450px;
        animation: rotate-orbit 35s linear infinite reverse;
    }
    
    .orbit-3 {
        width: 600px;
        height: 600px;
        animation: rotate-orbit 50s linear infinite;
    }
    
    .orbit-4 {
        width: 750px;
        height: 750px;
        animation: rotate-orbit 70s linear infinite reverse;
    }
    
    /* Planets */
    .planet {
        position: absolute;
        top: -15px;
        right: -15px;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .planet:hover {
        transform: scale(1.5);
        filter: brightness(1.3);
    }
    
    .planet-mercury .planet-surface {
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 30% 30%, #ffa500, #ff6347, #8b4513);
        border-radius: 50%;
        position: relative;
    }
    
    .planet-venus .planet-surface {
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 30% 30%, #ffd700, #ffb347, #daa520);
        border-radius: 50%;
        position: relative;
    }
    
    .planet-earth .planet-surface {
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 30% 30%, #4169e1, #228b22, #1e90ff);
        border-radius: 50%;
        position: relative;
    }
    
    .planet-mars .planet-surface {
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 30% 30%, #cd5c5c, #a0522d, #8b0000);
        border-radius: 50%;
        position: relative;
    }
    
    .planet-atmosphere {
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: radial-gradient(circle, transparent 60%, rgba(255, 255, 255, 0.3) 100%);
        border-radius: 50%;
        animation: atmosphere-glow 3s ease-in-out infinite;
    }
    
    .planet-moon {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 8px;
        height: 8px;
        background: radial-gradient(circle, #c0c0c0, #808080);
        border-radius: 50%;
        animation: moon-orbit 5s linear infinite;
    }
    
    .planet-ring {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 40px;
        height: 40px;
        border: 2px solid rgba(255, 215, 0, 0.5);
        border-radius: 50%;
        transform: translate(-50%, -50%) rotateX(75deg);
        animation: ring-rotate 2s linear infinite;
    }
    
    /* Nebula Clouds */
    .nebula {
        position: absolute;
        border-radius: 50%;
        filter: blur(20px);
        opacity: 0.3;
        animation: nebula-drift 30s ease-in-out infinite;
    }
    
    .nebula-1 {
        width: 400px;
        height: 200px;
        background: radial-gradient(ellipse, rgba(138, 43, 226, 0.4), transparent);
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }
    
    .nebula-2 {
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 20, 147, 0.3), transparent);
        top: 60%;
        right: 15%;
        animation-delay: -10s;
    }
    
    .nebula-3 {
        width: 500px;
        height: 150px;
        background: radial-gradient(ellipse, rgba(0, 191, 255, 0.2), transparent);
        bottom: 20%;
        left: 30%;
        animation-delay: -20s;
    }
    
    /* Animations */
    @keyframes rotate-slow {
        from { transform: translate(-50%, -50%) rotate(0deg); }
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    @keyframes rotate-galaxy {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    @keyframes rotate-orbit {
        from { transform: translate(-50%, -50%) rotate(0deg); }
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }
    
    @keyframes rotate-stars-fast {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    @keyframes rotate-stars-medium {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    @keyframes rotate-stars-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    @keyframes pulse-core {
        0%, 100% { 
            transform: translate(-50%, -50%) scale(1);
            box-shadow: 0 0 40px #8ab4f8, 0 0 80px #4285f4, 0 0 120px #1a73e8;
        }
        50% { 
            transform: translate(-50%, -50%) scale(1.2);
            box-shadow: 0 0 60px #8ab4f8, 0 0 120px #4285f4, 0 0 180px #1a73e8;
        }
    }
    
    @keyframes pulse-glow {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.1); }
    }
    
    @keyframes atmosphere-glow {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.7; }
    }
    
    @keyframes moon-orbit {
        from { transform: rotate(0deg) translateX(20px) rotate(0deg); }
        to { transform: rotate(360deg) translateX(20px) rotate(-360deg); }
    }
    
    @keyframes ring-rotate {
        from { transform: translate(-50%, -50%) rotateX(75deg) rotateZ(0deg); }
        to { transform: translate(-50%, -50%) rotateX(75deg) rotateZ(360deg); }
    }
    
    @keyframes nebula-drift {
        0%, 100% { transform: translateX(0) translateY(0) scale(1); }
        25% { transform: translateX(20px) translateY(-10px) scale(1.1); }
        50% { transform: translateX(-10px) translateY(20px) scale(0.9); }
        75% { transform: translateX(-20px) translateY(-15px) scale(1.05); }
    }
    
    @keyframes shooting-star {
        0% { 
            transform: translateX(-100px) translateY(-100px) rotate(45deg);
            opacity: 0;
        }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { 
            transform: translateX(calc(100vw + 100px)) translateY(calc(100vh + 100px)) rotate(45deg);
            opacity: 0;
        }
    }
    
    @keyframes twinkle {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.2); }
    }
    
    @keyframes cosmic-drift {
        0% { transform: translateX(0) rotate(0deg); }
        100% { transform: translateX(-100px) rotate(360deg); }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .galaxy-core { width: 150px; height: 150px; }
        .spiral-arm { width: 400px; }
        .orbit-1 { width: 200px; height: 200px; }
        .orbit-2 { width: 300px; height: 300px; }
        .orbit-3 { width: 400px; height: 400px; }
        .orbit-4 { width: 500px; height: 500px; }
        .planet { width: 20px; height: 20px; top: -10px; right: -10px; }
        .nebula { filter: blur(10px); }
    }
</style>

<script>
    class GalaxyBackground {
        constructor() {
            this.init();
        }
        
        init() {
            this.createStarFields();
            this.createShootingStars();
            this.createCosmicDust();
            this.addPlanetInteractions();
        }
        
        createStarFields() {
            const starFields = ['stars-near', 'stars-mid', 'stars-far'];
            const starCounts = [100, 150, 200];
            
            starFields.forEach((fieldId, index) => {
                const container = document.getElementById(fieldId);
                const starCount = starCounts[index];
                
                for (let i = 0; i < starCount; i++) {
                    const star = document.createElement('div');
                    star.className = 'absolute bg-white rounded-full';
                    
                    // Random size based on distance
                    const size = Math.random() * (3 - index) + 1;
                    star.style.width = size + 'px';
                    star.style.height = size + 'px';
                    
                    // Random position
                    star.style.left = Math.random() * 100 + '%';
                    star.style.top = Math.random() * 100 + '%';
                    
                    // Random opacity and animation
                    star.style.opacity = Math.random() * 0.8 + 0.2;
                    star.style.animationDelay = Math.random() * 3 + 's';
                    star.style.animationDuration = (Math.random() * 2 + 2) + 's';
                    star.style.animation = 'twinkle infinite ease-in-out';
                    
                    // Add color variation
                    const colors = ['#ffffff', '#8ab4f8', '#aecbfa', '#c8e6c9', '#ffeb3b'];
                    const color = colors[Math.floor(Math.random() * colors.length)];
                    star.style.backgroundColor = color;
                    star.style.boxShadow = `0 0 ${size * 2}px ${color}`;
                    
                    container.appendChild(star);
                }
            });
        }
        
        createShootingStars() {
            const container = document.getElementById('shooting-stars');
            
            const createShootingStar = () => {
                const star = document.createElement('div');
                star.className = 'absolute';
                star.style.left = '-100px';
                star.style.top = Math.random() * 70 + '%';
                star.style.width = '100px';
                star.style.height = '2px';
                star.style.background = 'linear-gradient(90deg, transparent, #ffffff, #8ab4f8, transparent)';
                star.style.animation = 'shooting-star 3s linear';
                star.style.transform = 'rotate(45deg)';
                star.style.boxShadow = '0 0 10px #8ab4f8, 0 0 20px #4285f4';
                
                container.appendChild(star);
                
                setTimeout(() => {
                    if (star.parentNode) {
                        star.parentNode.removeChild(star);
                    }
                }, 3000);
            };
            
            // Create shooting stars periodically
            setInterval(createShootingStar, Math.random() * 8000 + 5000);
            setTimeout(createShootingStar, 3000);
        }
        
        createCosmicDust() {
            const container = document.getElementById('cosmic-dust');
            const dustCount = 50;
            
            for (let i = 0; i < dustCount; i++) {
                const dust = document.createElement('div');
                dust.className = 'absolute rounded-full';
                dust.style.width = Math.random() * 2 + 1 + 'px';
                dust.style.height = dust.style.width;
                dust.style.background = 'rgba(138, 180, 248, 0.3)';
                dust.style.left = Math.random() * 100 + '%';
                dust.style.top = Math.random() * 100 + '%';
                dust.style.animation = `cosmic-drift ${Math.random() * 20 + 30}s linear infinite`;
                dust.style.animationDelay = Math.random() * 10 + 's';
                
                container.appendChild(dust);
            }
        }
        
        addPlanetInteractions() {
            const planets = document.querySelectorAll('.planet');
            
            planets.forEach(planet => {
                planet.addEventListener('click', () => {
                    // Create explosion effect
                    this.createPlanetExplosion(planet);
                });
            });
        }
        
        createPlanetExplosion(planet) {
            const rect = planet.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            
            for (let i = 0; i < 8; i++) {
                const particle = document.createElement('div');
                particle.className = 'absolute w-2 h-2 rounded-full';
                particle.style.background = 'radial-gradient(circle, #8ab4f8, #4285f4)';
                particle.style.left = centerX + 'px';
                particle.style.top = centerY + 'px';
                particle.style.pointerEvents = 'none';
                particle.style.zIndex = '9999';
                
                const angle = (i / 8) * Math.PI * 2;
                const velocity = 100;
                const vx = Math.cos(angle) * velocity;
                const vy = Math.sin(angle) * velocity;
                
                particle.style.animation = `particle-explode 1s ease-out forwards`;
                particle.style.setProperty('--vx', vx + 'px');
                particle.style.setProperty('--vy', vy + 'px');
                
                document.body.appendChild(particle);
                
                setTimeout(() => {
                    if (particle.parentNode) {
                        particle.parentNode.removeChild(particle);
                    }
                }, 1000);
            }
            
            // Add explosion animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes particle-explode {
                    0% {
                        transform: translate(0, 0) scale(1);
                        opacity: 1;
                    }
                    100% {
                        transform: translate(var(--vx), var(--vy)) scale(0);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }
    
    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        new GalaxyBackground();
    });
</script>
