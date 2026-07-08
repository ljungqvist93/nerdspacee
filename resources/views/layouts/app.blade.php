<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>pengar.</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <link rel="stylesheet" href="https://nerdspace.cashsmash.app/css/app.css">
    <script src="https://nerdspace.cashsmash.app/js/app.js" defer></script>

    <link rel="icon" href="https://nerdspace.cashsmash.app/media/favicon.PNG" type="image/x-icon">


    @livewireStyles
    @livewireScripts

    <link rel="stylesheet" href="https://nerdspace.cashsmash.app/fontawesome/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">

    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#09090b">

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Nerdspace">

    <link rel="apple-touch-icon" href="/icons/icon-192.PNG">

    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>


</head>
<style>
    * {
        font-family: "Roboto Mono", monospace;
    }

    ul li {
        list-style-type: none;
    }
</style>

<body class="dark:bg-zinc-900 bg-white ">

    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="">
        <div class="max-w-[800px] mx-auto ">{{ $slot }}</div>
    </main>

</body>

</html>