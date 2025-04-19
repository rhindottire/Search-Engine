{{ dump(shell_exec("which python")) }}
{{ dump(shell_exec("python --version")) }}
{{ dd($data) }}

<x-layout class="bg-[rgb(32,33,36)]" :title="$query">
    <x-search.navbar />

    <main class="flex flex-col gap-4 items-start px-8 py-4 w-full max-w-4xl mx-auto">
        @forelse ($data as $item)
            <div class="p-4 bg-zinc-800 rounded-xl shadow-md w-full">
                <p class="text-white text-lg font-bold">{{ $item['ayah_en'] }}</p>
                <p class="text-blue-300 text-2xl text-right mt-2">{{ $item['ayah_ar'] }}</p>
                <div class="mt-2 text-sm text-gray-400">Score: {{ number_format($item['score'], 4) }}</div>
            </div>
        @empty
            <p class="text-white">No results found for <strong>{{ $query }}</strong>.</p>
        @endforelse
    </main>

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