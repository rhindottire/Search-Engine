@props(
    [
        "href" => "#",
        "class" => null,
    ]
)

<a href="{{ $href }}" class="{{ request()->is($href) ? "text-white" : "text-black" }}"
    aria-current="{{ $active ? "page" : false }}"
    {{ $attributes }}>
    {{ $slot }}
</a>

<x-link href="/" :active="request()->is("/")">home</x-link>
<x-link href="/about" :active="request()->is("about")">about</x-link>
<x-link href="/blog" :active="request()->is("blog")">blog</x-link>
<x-link href="/contact" :active="request()->is("contact")">contact</x-link>