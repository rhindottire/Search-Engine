{{-- {{dd($data)}} --}}

<x-layout class="bg-[rgb(32,33,36)]" :title="$query">
    <div class="flex justify-between h-min m-8 gap-5">
        <h1 class="text-3xl text-white font-bold">
            <span class="text-blue-600">Next</span>Google
        </h1>
        <div class="w-full flex justify-center items-center relative">
            <input class="bg-white w-full h-12 rounded-3xl p-4 pr-28"
                type="search" id="searchInput" name="search" autocomplete="off"
                placeholder="Search or type a URL"
                value="{{$query}}"
            />
            <x-lucide-mic class="absolute w-5 h-5 right-20" id="mic-search" />
            <x-lucide-image-up class="absolute w-5 h-5 right-12" id="img-search" />
            <x-lucide-search class="absolute w-5 h-5 right-5" id="icon-search" />
        </div>
        <img src="{{asset('dodo.jpg')}}" alt="230411100197" class="w-10 h-10 rounded-full">
    </div><hr>
    <main class="container mx-auto p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($data as $item)
                <div class="bg-gray-800 text-white rounded-lg shadow-lg p-4 transform transition duration-300 hover:scale-105">
                    <h1 class="text-lg font-semibold line-clamp-1 mb-2">{{ $item['title'] }}</h1>
                    <a href="http://books.toscrape.com/{{ $item['url'] }}" class="block">
                        <img src="http://books.toscrape.com/{{ $item['image'] }}" alt="Book Cover" class="w-full h-48 object-cover rounded-md">
                    </a>
                    <p class="text-yellow-400 font-bold mt-3">Price: {{ $item['price'] }}</p>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-gray-300">
                            Rating: {!! str_repeat('⭐', round($item['score'])) !!}
                        </span>
                        <button class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-600">View</button>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <script>
        document.querySelector('#icon-search').addEventListener('click', () => {
            const query = document.querySelector('#searchInput').value.trim();
            if (query) window.location.href = `/search?query=${query}`;
        });
    </script>

</x-layout>