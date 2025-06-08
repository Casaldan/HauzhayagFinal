<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name', 'Hauz Hayag') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('image/logohauzhayag.jpg') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('image/logohauzhayag.jpg') }}">
    <meta name="msapplication-TileImage" content="{{ asset('image/logohauzhayag.jpg') }}">
    <meta name="msapplication-TileColor" content="#1B4B5A">
    <meta name="theme-color" content="#1B4B5A">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1B4B5A',
                        secondary: '#2C5F6E',
                        neutral: '#f8fafc'
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-gray-100 font-['Inter']">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <x-sidebar role="admin" currentRoute="{{ request()->route()->getName() ?? 'dashboard' }}" />
        
        <!-- Main Content -->
        <div class="flex-1 ml-64 overflow-y-auto">
            @yield('content')
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>
