@props(
    [
        "id" => null,
        "class" => null,
    ]
)

<button id="" class="" {{ $focus }} {{ $attributes }}>
    {{ $slot }}
</button>

<x-button id="button" class="iniClass" type="submit" :focus="function()"></x-button>