<!-- Loading Skeleton untuk Better UX -->
<div class="w-full space-y-4 sm:space-y-6 animate-pulse">
    @for($i = 0; $i < 5; $i++)
        <div class="search-skeleton-item">
            <!-- URL Skeleton -->
            <div class="flex items-center gap-2 mb-2">
                <div class="w-4 h-4 bg-[#3c4043] rounded-sm"></div>
                <div class="w-32 h-3 bg-[#3c4043] rounded"></div>
                <div class="w-1 h-1 bg-[#3c4043] rounded-full"></div>
                <div class="w-20 h-3 bg-[#3c4043] rounded"></div>
            </div>
            
            <!-- Title Skeleton -->
            <div class="mb-3">
                <div class="w-full h-5 bg-[#3c4043] rounded mb-1"></div>
                <div class="w-3/4 h-5 bg-[#3c4043] rounded"></div>
            </div>
            
            <!-- Snippet Skeleton -->
            <div class="mb-3 space-y-2">
                <div class="w-full h-4 bg-[#3c4043] rounded"></div>
                <div class="w-full h-4 bg-[#3c4043] rounded"></div>
                <div class="w-2/3 h-4 bg-[#3c4043] rounded"></div>
            </div>
            
            <!-- Metadata Skeleton -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-16 h-6 bg-[#3c4043] rounded-full"></div>
                    <div class="w-20 h-6 bg-[#3c4043] rounded-full"></div>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-24 h-8 bg-[#3c4043] rounded-full"></div>
                    <div class="w-8 h-8 bg-[#3c4043] rounded-full"></div>
                </div>
            </div>
        </div>
    @endfor
</div>

<style>
.search-skeleton-item {
    padding: 1.25rem;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(48, 49, 52, 0.3), rgba(60, 64, 67, 0.2));
    border: 1px solid rgba(60, 64, 67, 0.3);
}

@media (min-width: 640px) {
    .search-skeleton-item {
        padding: 1.5rem 1.75rem;
    }
}
</style>
