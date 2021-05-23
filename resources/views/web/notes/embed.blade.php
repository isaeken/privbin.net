<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-100">
<div class="border rounded-lg">
    <div class="w-full">
        <x-editor readonly="true" :theme="$theme" :highlighted-lines="json_encode($lines)" :language="$note->language" :content="$note->content" style="height: min-content;" />
    </div>
    <div class="w-full py-2 px-2 text-sm flex flex-wrap">
        <div class="w-full md:w-1/2">Hosted by <a href="{{ route('home') }}">{{ config('app.name') }}</a></div>
        <div class="w-full md:w-1/2 md:text-right"><a href="{{ route('notes.show.raw', $note) }}">view raw</a></div>
    </div>
</div>
</body>
</html>
