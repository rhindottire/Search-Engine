<section aria-label="hero-section" class="flex justify-end m-5 gap-5 text-white">
    @php
        $socialLinks = [
            ['url' => 'https://github.com/rhindottire', 'icon' => 'github'],
            ['url' => 'https://www.linkedin.com/in/achmad-ridho-fa-iz-1a2345350/', 'icon' => 'linkedin'],
            ['url' => 'https://www.facebook.com/profile.php?id=100074005363545&locale=id_ID', 'icon' => 'facebook'],
            ['url' => 'https://www.instagram.com/rhindottire/', 'icon' => 'instagram'],
        ];
    @endphp

    @foreach ($socialLinks as $link)
        <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer">
            <x-dynamic-component :component="'lucide-' . $link['icon']" class="w-8 h-8" />
        </a>
    @endforeach

    <img src="{{ asset('dodo.jpg') }}" alt="230411100197@student.trunojoyo.ac.id" class="w-8 h-8 rounded-full" />
</section>