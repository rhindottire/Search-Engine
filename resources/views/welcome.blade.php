@props(
    [
        "title" => "NextGoogle",
        "array" => [1,2,3,4,5],
    ]
)

<x-layout class="bg-[#202124]" :title="$title" >
    {{-- @foreach ( $array as $arr )
        <div class="text-white flex">
            @if ( $arr === 3 )
                {{$arr}}
            @endif
        </div>
    @endforeach --}}

    <div id="navbar" class="flex justify-end m-5 gap-5 text-white">
        <a href="https://github.com/rhindottire">
            <x-lucide-github class="w-8 h-8" />
        </a>
        <a href="https://www.linkedin.com/in/achmad-ridho-fa-iz-1a2345350/">
            <x-lucide-linkedin class="w-8 h-8" />
        </a>
        <a href="https://www.facebook.com/profile.php?id=100074005363545&locale=id_ID">
            <x-lucide-facebook class="w-8 h-8" />
        </a>
        <a href="https://www.instagram.com/rhindottire/">
            <x-lucide-instagram class="w-8 h-8" />
        </a>
        <img src="{{asset('dodo.jpg')}}" alt="230411100197" class="w-8 h-8 rounded-full">
    </div>

    <div id="content" class="flex flex-col justify-center items-center mt-36">
        <h1 class="text-6xl text-white font-bold">
            <span class="text-6xl text-blue-600">Next</span>Google
        </h1>
        <div class="flex justify-center items-center w-full mt-9">
            <div class="w-1/2 flex justify-center items-end mb-10 relative">
                <x-lucide-search class="absolute w-5 h-5 left-4 top-10" id="icon-search" />
                <input class="mt-6 bg-white w-full h-12 pl-16 rounded-3xl p-4 pr-40"
                    type="text" id="searchInput" name="search" placeholder="Search NextGoogle or type a URL" autocomplete="off"/>
                <x-lucide-mic class="absolute w-5 h-5 right-12 top-10" id="mic-search" />
                <x-lucide-image-up class="absolute w-5 h-5 right-5 top-10" id="img-search" />
            </div>
        </div>
    </div>

    <script>
        document.querySelector('#icon-search').addEventListener('click', () => {
            const query = document.querySelector('#searchInput').value.trim();
            if (query) window.location.href = `/search?query=${query}`;
        });
    </script>

</x-layout>