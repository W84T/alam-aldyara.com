<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
      class="{{ app()->getLocale() == 'ar' ? 'font-arabic' : 'font-sans' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Poppins font for English -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Cairo font for Arabic -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <title>{{ $title ?? 'Alam Aldyara' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>
<body>
@livewire('partial.navbar')
<main>
    {{ $slot }}
</main>
@livewireScripts
</body>
</html>
