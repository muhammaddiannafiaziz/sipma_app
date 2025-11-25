<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? "SIPMA - Pendaftaran" }}</title>

        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700&family=IBM+Plex+Mono:wght@400;600&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        
        <style>
            body { font-family: 'IBM Plex Sans', sans-serif; }
        </style>
    </head>
    <body class="bg-gray-50">
        {{ $slot }}
    </body>
</html>