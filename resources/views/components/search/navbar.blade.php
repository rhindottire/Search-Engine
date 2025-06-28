@props([
    'query' => ''
])

<nav aria-label="navigation" class="flex gap-6 pt-5 px-5">
    <h1 class="text-3xl text-white font-bold">
        <span class="text-blue-600">Next</span>Google
    </h1>
    <div class="w-full">
        <form id="searchForm" method="GET" action="{{ route('search') }}">
            <div class="w-[75%] flex justify-center items-center relative">
                <input class="bg-white w-full h-12 rounded-3xl p-4 pr-28"
                    type="search" id="searchInput" name="query" autocomplete="off"
                    placeholder="Search or type a URL"
                    value="{{ $query }}"
                    form="searchForm"
                />
                <x-lucide-mic class="absolute w-5 h-5 right-20" id="mic-search" />
                <x-lucide-image-up class="absolute w-5 h-5 right-12" id="img-search" />
                <x-lucide-search class="absolute w-5 h-5 right-5" id="searchIcon" />
            </div>
        </form>
        <div class="flex flex-row gap-5 pt-10 pb-2 px-5 text-white">
            <a href="" class="hover:text-blue-500 hover:underline">Semua</a>
            <a href="" class="hover:text-blue-500 hover:underline">Gambar</a>
            <a href="" class="hover:text-blue-500 hover:underline">Shopping</a>
            <a href="" class="hover:text-blue-500 hover:underline">Video</a>
            <a href="" class="hover:text-blue-500 hover:underline">Berita</a>
        </div>
    </div>
    <img src="{{ asset('dodo.jpg') }}" alt="230411100197" class="w-10 h-10 rounded-full">
</nav>
<hr>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.querySelector('#searchInput');
        const iconSearch = document.querySelector('#searchIcon');
        if (!input || !iconSearch) return;

        const searchNow = () => {
            const query = input.value.trim();
            if (!query) {
                event.preventDefault();
                Swal.fire({
                    title: "Input field is empty!",
                    text: "Type any key in search input",
                    icon: "info"
                });
                return;
            }
            document.querySelector('#searchForm').submit();
        };

        iconSearch.addEventListener('click', searchNow);
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') searchNow();
        });
    });
</script>