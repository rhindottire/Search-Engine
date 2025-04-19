@props([
    "title" => "NextGoogle",
])

<x-layout class="bg-[#202124]" :title="$title" >
    <x-welcome.hero />

    <main class="flex flex-col justify-center items-center mt-36">
        <h1 class="text-6xl text-white font-bold">
            <span class="text-6xl text-blue-600">Next</span>Google
        </h1>
        <nav class="flex justify-center items-center w-full mt-9">
            <div class="w-1/2 flex justify-center items-end mb-10 relative">
                <x-lucide-search class="absolute w-5 h-5 left-4 top-10" id="searchIcon" />
                <input class="mt-6 bg-white w-full h-12 pl-16 rounded-3xl p-4 pr-40"
                        type="text" id="searchInput" name="search" autocomplete="off"
                        placeholder="Search NextGoogle or type a URL" />
                <x-lucide-mic class="absolute w-5 h-5 right-12 top-10" id="searchMic" />
                <x-lucide-image-up class="absolute w-5 h-5 right-5 top-10" id="searchImg" />
            </div>
        </nav>
    </main>

    <x-welcome.shortcut />

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
                        text: "type any key in search input",
                        icon: "info"
                    });
                    return;
                }
                const url = new URL('/search', window.location.origin);
                url.searchParams.set('query', query);
                window.location.href = url.toString();
            };

            iconSearch.addEventListener('click', searchNow);
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') searchNow();
            });
        });
    </script>
</x-layout>