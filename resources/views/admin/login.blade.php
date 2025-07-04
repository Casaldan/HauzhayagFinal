<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Hauz Hayag</title>

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
    <meta name="msapplication-TileColor" content="#00A4B8">
    <meta name="theme-color" content="#00A4B8">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00A4B8',
                        dark: '#111827'
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #111827;
        }
        .login-container {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .form-container {
            background: #1F2937;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2), 0 2px 4px -1px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-dark to-gray-800 p-4">
    <div class="login-container p-8 rounded-2xl w-full max-w-md">
        <div class="form-container rounded-xl p-8">
            <!-- Logo or Icon -->
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center">
                <img src="{{ asset('image/logohauzhayag.jpg') }}"
                         alt="Hauz Hayag Logo"
                         class="h-16 w-auto rounded-lg shadow-md">
                </div>
            </div>

            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-white">Welcome Back</h2>
                <p class="text-gray-400 text-sm mt-1">Admin Portal | Hauz Hayag</p>
            </div>

            @if($errors->any())
                <div class="bg-red-900/30 border-l-4 border-red-500 p-4 mb-6 rounded-md" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-400">Invalid credentials</p>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        <input type="email" id="email" name="email" required 
                               class="pl-10 w-full px-4 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-gray-200 placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-primary"
                               placeholder="admin@example.com"
                               value="{{ old('email') }}">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" required 
                               class="pl-10 w-full px-4 py-2.5 bg-gray-700 border border-gray-600 rounded-lg text-sm text-gray-200 placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-primary"
                               placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember_me" name="remember"
                               class="h-4 w-4 bg-gray-700 border-gray-600 text-primary focus:ring-primary rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-300">Remember me</label>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-primary transition duration-150 ease-in-out">
                        Sign in
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="text-sm font-medium text-primary hover:text-primary/80 flex items-center justify-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Return to Homepage
                </a>
            </div>
        </div>
    </div>
</body>
</html>