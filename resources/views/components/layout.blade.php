@props(
    [
        "class" => "",
        "title" => "Document",
    ]
)

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title }}</title>
        @vite('resources/css/app.css')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Scheherazade+New:wght@400;700&display=swap');
            .arabic-text {
                font-family: 'Scheherazade New', serif;
            }
        </style>
    </head>
    <body class="{{ $class }} ">
        {{ $slot }}
    </body>
</html>