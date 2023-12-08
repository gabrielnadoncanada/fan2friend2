<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://npmcdn.com/flickity@2/dist/flickity.css">
    <script src="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"></script>
    <script src="https://kit.fontawesome.com/8208c06456.js"></script>
</head>
<body>
<x-notifications/>
<livewire:header/>
{{ $slot }}
@include('sections.copyright')
@stack('scripts')
</body>
</html>
