<div id="reading-progress" class="fixed top-0 left-0 w-full h-1 bg-[#3c4043] z-50">
    <div id="progress-bar" class="h-full bg-gradient-to-r from-[#4285f4] to-[#8ab4f8] transition-all duration-300 ease-out" style="width: 0%"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const progressBar = document.getElementById('progress-bar');
    const article = document.querySelector('main article');
    
    if (!progressBar || !article) return;
    
    function updateProgress() {
        const articleTop = article.offsetTop;
        const articleHeight = article.offsetHeight;
        const windowHeight = window.innerHeight;
        const scrollTop = window.pageYOffset;
        
        const articleBottom = articleTop + articleHeight;
        const windowBottom = scrollTop + windowHeight;
        
        if (scrollTop < articleTop) {
            progressBar.style.width = '0%';
        } else if (windowBottom > articleBottom) {
            progressBar.style.width = '100%';
        } else {
            const progress = ((scrollTop - articleTop) / (articleHeight - windowHeight)) * 100;
            progressBar.style.width = Math.max(0, Math.min(100, progress)) + '%';
        }
    }
    
    window.addEventListener('scroll', updateProgress);
    updateProgress();
});
</script>
