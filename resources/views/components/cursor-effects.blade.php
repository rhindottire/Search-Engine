<!-- Advanced Cursor Effects -->
<div id="cursor-effects">
    <!-- Main Cursor -->
    <div id="cursor-main" class="fixed pointer-events-none z-[9999] mix-blend-difference">
        <div class="cursor-dot"></div>
        <div class="cursor-ring"></div>
    </div>
    
    <!-- Particle Trail -->
    <div id="cursor-particles" class="fixed pointer-events-none z-[9998]"></div>
    
    <!-- Magnetic Field Indicator -->
    <div id="magnetic-field" class="fixed pointer-events-none z-[9997] opacity-0 transition-opacity duration-300">
        <div class="magnetic-ring"></div>
    </div>
</div>

<style>
    /* Advanced Cursor Styles */
    .cursor-dot {
        width: 8px;
        height: 8px;
        background: radial-gradient(circle, #8ab4f8 0%, #4285f4 50%, transparent 70%);
        border-radius: 50%;
        position: absolute;
        top: -4px;
        left: -4px;
        box-shadow: 0 0 20px #8ab4f8, 0 0 40px #4285f4, 0 0 60px #1a73e8;
        animation: pulse-cursor 2s ease-in-out infinite;
    }
    
    .cursor-ring {
        width: 40px;
        height: 40px;
        border: 2px solid rgba(138, 180, 248, 0.3);
        border-radius: 50%;
        position: absolute;
        top: -20px;
        left: -20px;
        transition: all 0.1s ease-out;
        background: radial-gradient(circle, transparent 60%, rgba(138, 180, 248, 0.1) 100%);
    }
    
    .cursor-particle {
        position: absolute;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        pointer-events: none;
        animation: particle-float 2s ease-out forwards;
    }
    
    .magnetic-ring {
        width: 80px;
        height: 80px;
        border: 2px dashed rgba(138, 180, 248, 0.5);
        border-radius: 50%;
        position: absolute;
        top: -40px;
        left: -40px;
        animation: rotate 3s linear infinite;
        background: radial-gradient(circle, transparent 70%, rgba(138, 180, 248, 0.1) 100%);
    }
    
    @keyframes pulse-cursor {
        0%, 100% { 
            transform: scale(1);
            box-shadow: 0 0 20px #8ab4f8, 0 0 40px #4285f4, 0 0 60px #1a73e8;
        }
        50% { 
            transform: scale(1.2);
            box-shadow: 0 0 30px #8ab4f8, 0 0 60px #4285f4, 0 0 90px #1a73e8;
        }
    }
    
    @keyframes particle-float {
        0% {
            opacity: 1;
            transform: scale(1) rotate(0deg);
        }
        100% {
            opacity: 0;
            transform: scale(0) rotate(360deg) translateY(-50px);
        }
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* Cursor States */
    .cursor-hover .cursor-ring {
        width: 60px;
        height: 60px;
        top: -30px;
        left: -30px;
        border-color: rgba(138, 180, 248, 0.8);
        background: radial-gradient(circle, transparent 50%, rgba(138, 180, 248, 0.2) 100%);
    }
    
    .cursor-click .cursor-dot {
        transform: scale(2);
        box-shadow: 0 0 40px #8ab4f8, 0 0 80px #4285f4, 0 0 120px #1a73e8;
    }
    
    .cursor-magnetic .cursor-ring {
        width: 100px;
        height: 100px;
        top: -50px;
        left: -50px;
        border-color: rgba(255, 215, 0, 0.8);
        background: radial-gradient(circle, transparent 40%, rgba(255, 215, 0, 0.2) 100%);
        animation: magnetic-pulse 0.5s ease-in-out infinite alternate;
    }
    
    @keyframes magnetic-pulse {
        from { transform: scale(1); }
        to { transform: scale(1.1); }
    }
</style>

<script>
    class AdvancedCursor {
        constructor() {
            this.cursor = document.getElementById('cursor-main');
            this.cursorDot = this.cursor.querySelector('.cursor-dot');
            this.cursorRing = this.cursor.querySelector('.cursor-ring');
            this.particleContainer = document.getElementById('cursor-particles');
            this.magneticField = document.getElementById('magnetic-field');
            
            this.mouseX = 0;
            this.mouseY = 0;
            this.cursorX = 0;
            this.cursorY = 0;
            
            this.particles = [];
            this.maxParticles = 20;
            
            this.init();
        }
        
        init() {
            // Hide default cursor
            document.body.style.cursor = 'none';
            
            // Mouse move handler
            document.addEventListener('mousemove', (e) => {
                this.mouseX = e.clientX;
                this.mouseY = e.clientY;
                this.createParticle(e.clientX, e.clientY);
            });
            
            // Click handlers
            document.addEventListener('mousedown', () => {
                this.cursor.classList.add('cursor-click');
                this.createExplosion(this.mouseX, this.mouseY);
            });
            
            document.addEventListener('mouseup', () => {
                this.cursor.classList.remove('cursor-click');
            });
            
            // Hover handlers for interactive elements
            const interactiveElements = document.querySelectorAll('button, a, input, [data-cursor="hover"]');
            interactiveElements.forEach(el => {
                el.addEventListener('mouseenter', () => {
                    this.cursor.classList.add('cursor-hover');
                    this.showMagneticField();
                });
                
                el.addEventListener('mouseleave', () => {
                    this.cursor.classList.remove('cursor-hover');
                    this.hideMagneticField();
                });
            });
            
            // Magnetic elements
            const magneticElements = document.querySelectorAll('[data-cursor="magnetic"]');
            magneticElements.forEach(el => {
                el.addEventListener('mouseenter', () => {
                    this.cursor.classList.add('cursor-magnetic');
                });
                
                el.addEventListener('mouseleave', () => {
                    this.cursor.classList.remove('cursor-magnetic');
                });
                
                el.addEventListener('mousemove', (e) => {
                    this.magneticEffect(el, e);
                });
            });
            
            // Animation loop
            this.animate();
        }
        
        animate() {
            // Smooth cursor following
            this.cursorX += (this.mouseX - this.cursorX) * 0.1;
            this.cursorY += (this.mouseY - this.cursorY) * 0.1;
            
            this.cursor.style.left = this.cursorX + 'px';
            this.cursor.style.top = this.cursorY + 'px';
            
            this.magneticField.style.left = this.cursorX + 'px';
            this.magneticField.style.top = this.cursorY + 'px';
            
            // Update particles
            this.updateParticles();
            
            requestAnimationFrame(() => this.animate());
        }
        
        createParticle(x, y) {
            if (this.particles.length >= this.maxParticles) {
                const oldParticle = this.particles.shift();
                if (oldParticle.element.parentNode) {
                    oldParticle.element.parentNode.removeChild(oldParticle.element);
                }
            }
            
            const particle = document.createElement('div');
            particle.className = 'cursor-particle';
            
            const colors = ['#8ab4f8', '#4285f4', '#1a73e8', '#aecbfa', '#c8e6c9'];
            const color = colors[Math.floor(Math.random() * colors.length)];
            
            particle.style.background = `radial-gradient(circle, ${color} 0%, transparent 70%)`;
            particle.style.left = x + 'px';
            particle.style.top = y + 'px';
            particle.style.boxShadow = `0 0 10px ${color}`;
            
            // Random direction
            const angle = Math.random() * Math.PI * 2;
            const velocity = Math.random() * 3 + 1;
            const vx = Math.cos(angle) * velocity;
            const vy = Math.sin(angle) * velocity;
            
            this.particleContainer.appendChild(particle);
            
            this.particles.push({
                element: particle,
                x: x,
                y: y,
                vx: vx,
                vy: vy,
                life: 1,
                decay: 0.02
            });
        }
        
        updateParticles() {
            this.particles.forEach((particle, index) => {
                particle.x += particle.vx;
                particle.y += particle.vy;
                particle.life -= particle.decay;
                
                particle.element.style.left = particle.x + 'px';
                particle.element.style.top = particle.y + 'px';
                particle.element.style.opacity = particle.life;
                particle.element.style.transform = `scale(${particle.life})`;
                
                if (particle.life <= 0) {
                    if (particle.element.parentNode) {
                        particle.element.parentNode.removeChild(particle.element);
                    }
                    this.particles.splice(index, 1);
                }
            });
        }
        
        createExplosion(x, y) {
            for (let i = 0; i < 12; i++) {
                setTimeout(() => {
                    this.createParticle(
                        x + (Math.random() - 0.5) * 20,
                        y + (Math.random() - 0.5) * 20
                    );
                }, i * 50);
            }
        }
        
        showMagneticField() {
            this.magneticField.style.opacity = '1';
        }
        
        hideMagneticField() {
            this.magneticField.style.opacity = '0';
        }
        
        magneticEffect(element, event) {
            const rect = element.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            
            const deltaX = event.clientX - centerX;
            const deltaY = event.clientY - centerY;
            
            const distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
            const maxDistance = 100;
            
            if (distance < maxDistance) {
                const force = (maxDistance - distance) / maxDistance;
                const moveX = deltaX * force * 0.3;
                const moveY = deltaY * force * 0.3;
                
                element.style.transform = `translate(${moveX}px, ${moveY}px) scale(${1 + force * 0.1})`;
            }
        }
    }
    
    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        new AdvancedCursor();
    });
</script>
