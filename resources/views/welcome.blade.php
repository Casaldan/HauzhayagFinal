<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hauz Hayag</title>

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

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00A4B8',
                        secondary: '#FFB800',
                        neutral: '#F3F4F6',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'slide-down': 'slideDown 0.5s ease-out',
                        'slide-left': 'slideLeft 0.5s ease-out',
                        'slide-right': 'slideRight 0.5s ease-out',
                        'slide-in-left': 'slideInLeft 0.8s ease-out',
                        'slide-in-right': 'slideInRight 0.8s ease-out',
                        'slide-in-up': 'slideInUp 0.8s ease-out',
                        'bounce-in': 'bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)',
                        'bounce-in-left': 'bounceInLeft 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)',
                        'bounce-in-right': 'bounceInRight 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)',
                        'pulse-slow': 'pulse 3s infinite',
                        'bounce-slow': 'bounce 3s infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'shake': 'shake 0.5s cubic-bezier(.36,.07,.19,.97) both',
                        'elevate': 'elevate 0.3s ease-out forwards',
                        'rotate-3d': 'rotate3d 0.5s ease-out forwards',
                        'stagger-fade': 'staggerFade 0.5s ease-out forwards',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideDown: {
                            '0%': { transform: 'translateY(-20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideLeft: {
                            '0%': { transform: 'translateX(20px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        slideRight: {
                            '0%': { transform: 'translateX(-20px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        slideInLeft: {
                            '0%': { transform: 'translateX(-100%)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        slideInRight: {
                            '0%': { transform: 'translateX(100%)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        slideInUp: {
                            '0%': { transform: 'translateY(100%)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        bounceIn: {
                            '0%': { transform: 'scale(0.3)', opacity: '0' },
                            '50%': { transform: 'scale(1.05)', opacity: '0.8' },
                            '70%': { transform: 'scale(0.9)', opacity: '0.9' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                        bounceInLeft: {
                            '0%': { transform: 'translateX(-100%)', opacity: '0' },
                            '60%': { transform: 'translateX(25%)', opacity: '0.8' },
                            '75%': { transform: 'translateX(-10%)', opacity: '0.9' },
                            '90%': { transform: 'translateX(5%)', opacity: '0.95' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        bounceInRight: {
                            '0%': { transform: 'translateX(100%)', opacity: '0' },
                            '60%': { transform: 'translateX(-25%)', opacity: '0.8' },
                            '75%': { transform: 'translateX(10%)', opacity: '0.9' },
                            '90%': { transform: 'translateX(-5%)', opacity: '0.95' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        float: {
                            '0%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                            '100%': { transform: 'translateY(0px)' },
                        },
                        shake: {
                            '10%, 90%': { transform: 'translate3d(-1px, 0, 0)' },
                            '20%, 80%': { transform: 'translate3d(2px, 0, 0)' },
                            '30%, 50%, 70%': { transform: 'translate3d(-4px, 0, 0)' },
                            '40%, 60%': { transform: 'translate3d(4px, 0, 0)' },
                        },
                        elevate: {
                            '0%': { transform: 'translateY(0)', boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)' },
                            '100%': { transform: 'translateY(-5px)', boxShadow: '0 10px 15px rgba(0, 0, 0, 0.2)' },
                        },
                        rotate3d: {
                            '0%': { transform: 'perspective(1000px) rotateX(0deg) rotateY(0deg)' },
                            '100%': { transform: 'perspective(1000px) rotateX(5deg) rotateY(5deg)' },
                        },
                        staggerFade: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                    },
                }
            }
        }

        // Global variables for event modals - declared early to avoid initialization errors
        var currentEventId = null;
        var currentEventTitle = null;
    </script>
    <style>
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }
        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
        .hover-rotate {
            transition: transform 0.3s ease;
        }
        .hover-rotate:hover {
            transform: rotate(5deg);
        }

        /* Enhanced professional card shadows */
        .shadow-3xl {
            box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
        }

        /* Professional gradient overlays */
        .gradient-overlay {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
        }

        /* Enhanced card hover effects */
        .card-professional {
            position: relative;
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-professional:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(59, 130, 246, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
        }

        /* Professional button effects */
        .btn-professional {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-professional::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-professional:hover::before {
            left: 100%;
        }

        /* Enhanced text gradients */
        .text-gradient {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 50%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Professional loading animation */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        /* Modal Animations */
        .modal-content {
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        /* Form Field Animations */
        .form-group {
            position: relative;
        }

        .form-group input:focus + .absolute svg,
        .form-group textarea:focus + .absolute svg {
            color: #14b8a6;
            transform: scale(1.1);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(20, 184, 166, 0.1), 0 4px 6px -2px rgba(20, 184, 166, 0.05);
        }

        /* Enhanced backdrop blur */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
        }

        /* Button hover effects */
        .btn-hover {
            transition: all 0.3s ease-in-out;
        }

        .btn-hover:hover {
            transform: translateY(-1px);
        }

        .btn-hover:active {
            transform: translateY(0);
        }

        /* Fade-in animation for dropdown */
        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-neutral font-sans">
    <header style="background-color: #667eea;" class="backdrop-blur-md shadow-xl fixed w-full top-0 z-50 animate-slide-down border-b border-primary/10">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-6 group">
                    <div class="relative">
                        <img src="{{ asset('image/logohauzhayag.jpg') }}"
                             alt="Hauz Hayag Logo"
                             class="h-16 w-auto rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-105">
                        <div class="absolute inset-0 bg-primary/20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Hauz Hayag</h1>
                        <p class="text-sm text-white/80 font-medium"></p>
                    </div>
                </div>

                <button id="mobileMenuButton" class="md:hidden text-white hover:text-white/80 p-2 rounded-lg hover:bg-white/10 transition-all duration-300">
                    <i class="fas fa-bars text-2xl"></i>
                </button>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="#home" class="nav-link flex items-center space-x-2 px-4 py-2 rounded-xl text-white hover:text-white/90 hover:bg-white/10 transition-all duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-home text-lg"></i>
                        <span class="font-medium">Home</span>
                    </a>
                    <a href="#scholarships" class="nav-link flex items-center space-x-2 px-4 py-2 rounded-xl text-white hover:text-white/90 hover:bg-white/10 transition-all duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-graduation-cap text-lg"></i>
                        <span class="font-medium">Scholarships</span>
                    </a>
                    <a href="#job-offers" class="nav-link flex items-center space-x-2 px-4 py-2 rounded-xl text-white hover:text-white/90 hover:bg-white/10 transition-all duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-briefcase text-lg"></i>
                        <span class="font-medium">Job Offers</span>
                    </a>
                    <a href="#events" class="nav-link flex items-center space-x-2 px-4 py-2 rounded-xl text-white hover:text-white/90 hover:bg-white/10 transition-all duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-calendar-alt text-lg"></i>
                        <span class="font-medium">Events</span>
                    </a>
                    <a href="#about-us" class="nav-link flex items-center space-x-2 px-4 py-2 rounded-xl text-white hover:text-white/90 hover:bg-white/10 transition-all duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-info-circle text-lg"></i>
                        <span class="font-medium">About Us</span>
                    </a>
                    <a href="#track-application" class="nav-link flex items-center space-x-2 px-4 py-2 rounded-xl text-white hover:text-white/90 hover:bg-white/10 transition-all duration-300 ease-in-out transform hover:scale-105">
                        <i class="fas fa-search text-lg"></i>
                        <span class="font-medium">Track Application</span>
                    </a>
                    <a href="{{ route('login') }}" class="flex items-center space-x-2 bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700/90 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105 font-medium ml-8">
                        <i class="fas fa-sign-in-alt text-lg"></i>
                        <span>Login</span>
                    </a>
                </nav>
            </div>

            <!-- Mobile Navigation -->
            <nav id="mobileMenu" class="lg:hidden hidden backdrop-blur-md border-t border-white/20 rounded-b-2xl shadow-xl" style="background-color: #667eea;">
                <div class="px-4 pt-4 pb-3 space-y-2">
                <a href="#home" class="flex items-center space-x-3 text-white hover:text-white/90 hover:bg-white/10 px-4 py-3 rounded-xl transition-all duration-300 ease-in-out">
                    <i class="fas fa-home text-lg"></i>
                    <span class="font-medium">Home</span>
                </a>
                <a href="#scholarships" class="flex items-center space-x-3 text-white hover:text-white/90 hover:bg-white/10 px-4 py-3 rounded-xl transition-all duration-300 ease-in-out">
                    <i class="fas fa-graduation-cap text-lg"></i>
                    <span class="font-medium">Scholarships</span>
                </a>
                <a href="#job-offers" class="flex items-center space-x-3 text-white hover:text-white/90 hover:bg-white/10 px-4 py-3 rounded-xl transition-all duration-300 ease-in-out">
                    <i class="fas fa-briefcase text-lg"></i>
                    <span class="font-medium">Job Offers</span>
                </a>
                <a href="#events" class="flex items-center space-x-3 text-white hover:text-white/90 hover:bg-white/10 px-4 py-3 rounded-xl transition-all duration-300 ease-in-out">
                    <i class="fas fa-calendar-alt text-lg"></i>
                    <span class="font-medium">Events</span>
                </a>
                <a href="#about-us" class="flex items-center space-x-3 text-white hover:text-white/90 hover:bg-white/10 px-4 py-3 rounded-xl transition-all duration-300 ease-in-out">
                    <i class="fas fa-info-circle text-lg"></i>
                    <span class="font-medium">About Us</span>
                </a>
                <a href="#track-application" class="flex items-center space-x-3 text-white hover:text-white/90 hover:bg-white/10 px-4 py-3 rounded-xl transition-all duration-300 ease-in-out">
                    <i class="fas fa-search text-lg"></i>
                    <span class="font-medium">Track Application</span>
                </a>
                </div>
                <div class="px-4 pb-4 space-y-3">
                    <a href="{{ route('login') }}" class="w-full bg-blue-600 text-white px-4 py-3 rounded-xl hover:bg-blue-700/90 transition-all duration-300 shadow-lg font-medium flex items-center justify-center space-x-2">
                        <i class="fas fa-sign-in-alt text-lg"></i>
                        <span>Login</span>
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <main class="pt-24">
        <!-- Hero Section with enhanced animations -->
        <section id="home" class="relative h-screen">
            <div class="absolute inset-0 overflow-hidden">
                <div id="heroSlides" class="flex h-full">
                    <!-- Slide 1 -->
                    <div class="min-w-full h-full">
                        <img src="{{ asset('image/feedingprogram.jpg') }}" alt="Students Learning" class="w-full h-full object-cover">
                    </div>
                    <!-- Slide 2 -->
                    <div class="min-w-full h-full">
                        <img src="{{ asset('image/firedrill.jpg') }}" alt="Community Support" class="w-full h-full object-cover">
                    </div>
                    <!-- Slide 3 -->
                    <div class="min-w-full h-full">
                        <img src="{{ asset('image/goods.jpg') }}" alt="Education Success" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="absolute inset-0 bg-black/40 animate-fade-in"></div>
            </div>

            <div class="relative z-10 h-full flex items-center justify-center">
                <div class="text-center px-4 animate-slide-up">
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in">Welcome to Hauz Hayag</h1>
                    <p class="text-xl md:text-2xl text-white/90 mb-8 animate-fade-in delay-100">Empowering communities through education and opportunities</p>
                    <div class="flex flex-col md:flex-row gap-4 justify-center animate-slide-up delay-200">
                        <button class="bg-primary text-white px-8 py-3 rounded-lg hover:bg-blue-400 transition hover-scale" onclick="openDonationModal()">
                            <i class="fas fa-heart mr-2 animate-pulse-slow"></i>Donate Now
                        </button>
                    </div>
                </div>
            </div>
        </section>


<!-- <x-test>
    <p>Testing component rendering.</p>
</x-test> -->

        <!-- Scholarships Section with enhanced professional design -->
        <section id="scholarships" class="max-w-7xl mx-auto py-20 px-4 bg-gradient-to-br from-blue-50 via-white to-indigo-50 rounded-3xl shadow-2xl my-16 relative overflow-hidden">
            <!-- Background decoration -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-primary/10 to-secondary/10 rounded-full -translate-y-32 translate-x-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-secondary/10 to-primary/10 rounded-full translate-y-24 -translate-x-24"></div>

            <div class="relative z-10">
                <h2 class="text-4xl font-bold text-center mb-4 text-primary animate-bounce-in">Scholarship & Programs</h2>
                <p class="text-center text-gray-600 mb-16 text-lg">Empowering futures through education and community support</p>

                <div class="grid md:grid-cols-3 gap-10">
                    <!-- Scholarship 1 - Enhanced Design -->
                    <div class="group relative bg-gradient-to-br from-white to-blue-50/50 shadow-2xl p-8 rounded-2xl flex flex-col border border-blue-100 hover:shadow-3xl hover:scale-105 transition-all duration-500 ease-in-out transform animate-bounce-in-left overflow-hidden" style="animation-delay: 0.1s">
                        <!-- Card decoration -->
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-primary/20 to-secondary/20 rounded-full -translate-y-10 translate-x-10"></div>

                        <!-- Icon with enhanced styling -->
                        <div class="relative z-10 flex items-center justify-center w-16 h-16 bg-gradient-to-br from-primary to-blue-600 text-white text-2xl mb-6 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-users"></i>
                        </div>

                        <!-- Content -->
                        <h3 class="text-2xl font-bold mb-3 text-gray-800 group-hover:text-primary transition-colors duration-300">Community-based Scholarship</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Open to all qualified students who demonstrate academic excellence and financial need.</p>

                        <!-- Features list with enhanced styling -->
                        <div class="space-y-3 mb-8 flex-grow">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-gradient-to-r from-primary to-secondary rounded-full"></div>
                                <span class="text-gray-700 font-medium">50% tuition coverage</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-gradient-to-r from-primary to-secondary rounded-full"></div>
                                <span class="text-gray-700 font-medium">Monthly allowance</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-gradient-to-r from-primary to-secondary rounded-full"></div>
                                <span class="text-gray-700 font-medium">Mentorship program</span>
                            </div>
                        </div>

                        <!-- Buttons container -->
                        <div class="space-y-3">
                            <!-- Apply Now button -->
                            <button class="group/btn relative overflow-hidden bg-gradient-to-r from-primary to-blue-600 text-white py-4 px-8 rounded-xl hover:from-blue-600 hover:to-primary shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out font-semibold text-lg w-full" onclick="openScholarshipModal('community_based')">
                                <span class="relative z-10 flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5 group-hover/btn:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                                    Apply Now
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-primary opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
                            </button>

                            <!-- Eligibility button -->
                            <button class="group/btn relative overflow-hidden bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-3 px-6 rounded-xl hover:from-gray-200 hover:to-gray-300 shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300 ease-in-out font-medium text-base w-full border border-gray-300" onclick="openEligibilityModal('community_based')">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Check Eligibility
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Scholarship 2 - Enhanced Design -->
                    <div class="group relative bg-gradient-to-br from-white to-pink-50/50 shadow-2xl p-8 rounded-2xl flex flex-col border border-pink-100 hover:shadow-3xl hover:scale-105 transition-all duration-500 ease-in-out transform animate-bounce-in overflow-hidden" style="animation-delay: 0.2s">
                        <!-- Card decoration -->
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-pink-300/20 to-purple-300/20 rounded-full -translate-y-10 translate-x-10"></div>

                        <!-- Icon with enhanced styling -->
                        <div class="relative z-10 flex items-center justify-center w-16 h-16 bg-gradient-to-br from-pink-500 to-purple-600 text-white text-2xl mb-6 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-female"></i>
                        </div>

                        <!-- Content -->
                        <h3 class="text-2xl font-bold mb-3 text-gray-800 group-hover:text-pink-600 transition-colors duration-300">Residential Scholarship for Girls</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">Exclusive program designed to empower young women through education and leadership.</p>

                        <!-- Features list with enhanced styling -->
                        <div class="space-y-3 mb-8 flex-grow">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full"></div>
                                <span class="text-gray-700 font-medium">Full tuition and housing</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full"></div>
                                <span class="text-gray-700 font-medium">Leadership training</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full"></div>
                                <span class="text-gray-700 font-medium">Career guidance</span>
                            </div>
                        </div>

                        <!-- Buttons container -->
                        <div class="space-y-3">
                            <!-- Apply Now button -->
                            <button class="group/btn relative overflow-hidden bg-gradient-to-r from-pink-500 to-purple-600 text-white py-4 px-8 rounded-xl hover:from-purple-600 hover:to-pink-500 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out font-semibold text-lg w-full" onclick="openScholarshipModal('in_house')">
                                <span class="relative z-10 flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5 group-hover/btn:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"></path></svg>
                                    Apply Now
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-500 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
                            </button>

                            <!-- Eligibility button -->
                            <button class="group/btn relative overflow-hidden bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 py-3 px-6 rounded-xl hover:from-gray-200 hover:to-gray-300 shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-300 ease-in-out font-medium text-base w-full border border-gray-300" onclick="openEligibilityModal('in_house')">
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Check Eligibility
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Scholarship 3 - Enhanced Design -->
                    <div class="group relative bg-gradient-to-br from-white to-green-50/50 shadow-2xl p-8 rounded-2xl flex flex-col border border-green-100 hover:shadow-3xl hover:scale-105 transition-all duration-500 ease-in-out transform animate-bounce-in-right overflow-hidden" style="animation-delay: 0.3s">
                        <!-- Card decoration -->
                        <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-300/20 to-emerald-300/20 rounded-full -translate-y-10 translate-x-10"></div>

                        <!-- Icon with enhanced styling -->
                        <div class="relative z-10 flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 text-white text-2xl mb-6 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-utensils"></i>
                        </div>

                        <!-- Content -->
                        <h3 class="text-2xl font-bold mb-3 text-gray-800 group-hover:text-green-600 transition-colors duration-300">Street Children Care</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">A feeding program for less fortunate children living nearby area.</p>

                        <!-- Features list with enhanced styling -->
                        <div class="space-y-3 mb-8 flex-grow">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full"></div>
                                <span class="text-gray-700 font-medium">Food Every Sunday</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full"></div>
                                <span class="text-gray-700 font-medium">Parent's Orientation about Food Consumption</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full"></div>
                                <span class="text-gray-700 font-medium">Free Check-up</span>
                            </div>
                        </div>

                        <!-- Info badge instead of button for feeding program -->
                        <div class="bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 py-4 px-8 rounded-xl text-center font-semibold text-lg border border-green-200">
                            <i class="fas fa-info-circle mr-2"></i>
                            Community Program
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Job Offers Section with enhanced professional design -->
<section id="job-offers" class="bg-gradient-to-br from-gray-50 to-blue-50/30 py-20 relative overflow-hidden">
    <!-- Background decorations -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-gradient-to-br from-primary/5 to-secondary/5 rounded-full -translate-y-36 -translate-x-36"></div>
    <div class="absolute bottom-0 right-0 w-64 h-64 bg-gradient-to-tl from-secondary/5 to-primary/5 rounded-full translate-y-32 translate-x-32"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4 text-primary animate-bounce-in">Job Opportunities</h2>
            <p class="text-gray-600 text-lg mb-2">Discover all available job opportunities from our community and partners</p>
            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
        </div>

        @if($jobs->count() > 0)
            <div id="jobsGrid" class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($jobs as $index => $job)
                    <div class="group job-card bg-white shadow-xl rounded-2xl p-6 flex flex-col hover:shadow-2xl hover:scale-105 transition-all duration-500 ease-in-out animate-bounce-in-left transform border border-gray-100 relative overflow-hidden" style="animation-delay: {{ ($index * 0.05) + 0.1 }}s">
                        <!-- Card decoration -->
                        <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-primary/10 to-secondary/10 rounded-full -translate-y-8 translate-x-8"></div>

                        <!-- Badges with enhanced styling -->
                        <div class="flex justify-between items-start mb-4 relative z-10">
                            @if($job->employment_type)
                                <span class="bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 text-xs px-3 py-2 rounded-full font-semibold border border-green-200 shadow-sm">{{ ucfirst($job->employment_type) }}</span>
                            @elseif($job->type)
                                <span class="bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 text-xs px-3 py-2 rounded-full font-semibold border border-green-200 shadow-sm">{{ ucfirst($job->type) }}</span>
                            @endif

                            @if($job->is_admin_posted)
                                <span class="bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-800 text-xs px-3 py-2 rounded-full font-semibold border border-blue-200 shadow-sm">
                                    <i class="fas fa-shield-alt mr-1"></i>Admin
                                </span>
                            @else
                                <span class="bg-gradient-to-r from-purple-100 to-pink-100 text-purple-800 text-xs px-3 py-2 rounded-full font-semibold border border-purple-200 shadow-sm">
                                    <i class="fas fa-users mr-1"></i>Community
                                </span>
                            @endif
                        </div>

                        <!-- Job icon -->
                        <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-br from-primary to-blue-600 text-white rounded-xl mb-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                            <i class="fas fa-briefcase text-lg"></i>
                        </div>

                        <!-- Content with enhanced typography -->
                        <h3 class="font-bold text-xl mb-3 line-clamp-2 text-gray-800 group-hover:text-primary transition-colors duration-300">{{ $job->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">{{ Str::limit($job->description, 80) }}</p>

                        <!-- Company info with enhanced styling -->
                        <div class="mb-6 flex-grow">
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="w-2 h-2 bg-gradient-to-r from-primary to-secondary rounded-full"></div>
                                <span class="font-semibold text-gray-700 text-sm">{{ $job->company_name ?? $job->company ?? 'Company Not Specified' }}</span>
                            </div>
                            @if($job->location)
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-map-marker-alt text-gray-400 text-xs"></i>
                                    <span class="text-gray-500 text-sm">{{ $job->location }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Enhanced button -->
                        <button class="group/btn relative overflow-hidden bg-gradient-to-r from-primary to-blue-600 text-white w-full py-3 px-4 rounded-xl hover:from-blue-600 hover:to-primary shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out font-semibold" onclick="openJobDetailsModal({{ $job->id }})">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <span>View Details</span>
                                <i class="fas fa-arrow-right group-hover/btn:translate-x-1 transition-transform duration-300"></i>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-primary opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </div>
                @endforeach
            </div>

            @if($jobs->count() > 12)
                <div class="text-center mt-12">
                    <div class="inline-flex items-center space-x-2 bg-white px-6 py-3 rounded-full shadow-lg border border-gray-200">
                        <i class="fas fa-briefcase text-primary"></i>
                        <span class="text-gray-700 font-medium">Showing {{ $jobs->count() }} job opportunities</span>
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-16">
                <div class="bg-white rounded-2xl shadow-xl p-12 max-w-md mx-auto border border-gray-100">
                    <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">No Job Opportunities</h3>
                    <p class="text-gray-500 mb-6">No job opportunities are available at the moment. Check back later for new opportunities!</p>
                    <div class="w-16 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
                </div>
            </div>
        @endif

    </div>
</section>

        <!-- Events Section with enhanced animations -->
<section id="events" class="py-20 bg-gradient-to-br from-indigo-50 via-white to-purple-50 relative overflow-hidden">
    <!-- Background decorations -->
    <div class="absolute top-0 right-0 w-80 h-80 bg-gradient-to-bl from-indigo-100/50 to-purple-100/50 rounded-full -translate-y-40 translate-x-40"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-purple-100/50 to-indigo-100/50 rounded-full translate-y-32 -translate-x-32"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4 text-primary animate-bounce-in">Upcoming Events</h2>
            <p class="text-gray-600 text-lg mb-2">Join our community events and make a difference</p>
            <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-purple-600 mx-auto rounded-full"></div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($events as $index => $event)
            <div class="group bg-white rounded-2xl shadow-2xl overflow-hidden hover:shadow-3xl hover:scale-105 transition-all duration-500 ease-in-out transform animate-bounce-in-left border border-gray-100 relative" style="animation-delay: {{ ($index * 0.1) + 0.1 }}s">
                <!-- Enhanced header with gradient -->
                <div class="relative h-56 overflow-hidden bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-500">
                    <!-- Decorative pattern -->
                    <div class="absolute inset-0 bg-black/20"></div>
                    <div class="absolute top-4 right-4 w-12 h-12 bg-white/20 rounded-full backdrop-blur-sm"></div>
                    <div class="absolute bottom-4 left-4 w-8 h-8 bg-white/20 rounded-full backdrop-blur-sm"></div>

                    <!-- Event icon -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-20 h-20 bg-white/20 rounded-2xl backdrop-blur-sm flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>

                    <!-- Date badge -->
                    <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm rounded-xl px-3 py-2 shadow-lg">
                        <div class="text-center">
                            <div class="text-xs font-semibold text-gray-600 uppercase">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('M') }}
                            </div>
                            <div class="text-lg font-bold text-gray-800">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content with enhanced styling -->
                <div class="p-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-indigo-600 transition-colors duration-300 line-clamp-2">{{ $event->title }}</h3>

                    <!-- Event details with enhanced icons -->
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y - h:i A') }}
                            </span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700">{{ $event->location }}</span>
                        </div>
                    </div>

                    <p class="text-gray-600 text-sm mb-8 line-clamp-3 leading-relaxed">{{ $event->description }}</p>

                    <!-- Enhanced action buttons -->
                    <div class="flex space-x-3">
                        <button onclick="openEventDetailsModal('{{ $event->id }}')"
                                class="group/btn relative overflow-hidden flex-1 bg-gradient-to-r from-blue-500 to-cyan-600 text-white px-4 py-3 rounded-xl hover:from-cyan-600 hover:to-blue-500 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out font-semibold">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>View Details</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-600 to-blue-500 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
                        </button>
                        <button onclick="openEventRegistrationModal('{{ $event->id }}')"
                                class="group/btn relative overflow-hidden flex-1 bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-4 py-3 rounded-xl hover:from-purple-600 hover:to-indigo-500 shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 ease-in-out font-semibold">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <span>Register Now</span>
                                <svg class="w-4 h-4 group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-indigo-500 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="bg-white rounded-2xl shadow-xl p-12 max-w-md mx-auto border border-gray-100">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">No Upcoming Events</h3>
                    <p class="text-gray-500 mb-6">No events are scheduled at the moment. Check back later for exciting new events!</p>
                    <div class="w-16 h-1 bg-gradient-to-r from-indigo-500 to-purple-600 mx-auto rounded-full"></div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

        <!-- Success Stories Section with enhanced animations -->
        <section id="success-stories" class="py-20 bg-gradient-to-b from-neutral to-white">
            <div class="max-w-7xl mx-auto px-2 sm:px-6">
                <h2 class="text-4xl font-extrabold text-center text-primary mb-12 tracking-tight animate-bounce-in">Our Top Testimony</h2>
                <div class="relative overflow-hidden">
                    <div id="slides" class="flex transition-transform duration-500 ease-in-out" style="width: 100%;">
                        <!-- Slide 1 -->
                        <div class="slide flex flex-col md:flex-row items-center min-w-full gap-8 bg-gray-50 rounded-2xl shadow-xl p-6 md:p-14 hover:shadow-2xl hover:scale-105 transition-all duration-300 ease-in-out transform" style="animation-delay: 0.1s">
                            <div class="relative flex flex-col items-center w-full md:w-1/2">
                                <!-- Large Orange Circle Background -->
                                <div class="absolute z-0 flex justify-center items-center" style="top: 0; left: 50%; transform: translateX(-50%);">
                                    <div class="w-72 h-72 md:w-96 md:h-96 rounded-full bg-blue-400 ring-4 ring-black flex items-center justify-center">
                                        <img src="{{ asset('image/alumni2.jpg') }}"
                                             alt="Daylan Unabia, Scholarship Graduate Alumni"
                                             class="w-48 h-48 md:w-64 md:h-64 object-contain rounded-full transform scale-[1.15]">
                                    </div>
                                </div>
                                <!-- Profile Image (overlapping the bottom of the circle) -->
                                <img src="{{ asset('image/alumni2.jpg') }}"
                                     alt="Daylan Unabia, Scholarship Graduate Alumni"
                                     class="relative z-10 w-48 h-48 md:w-64 md:h-64 object-contain rounded-full mt-10 transform scale-[1.15]" style="margin-bottom: -2.5rem;">
                                <!-- Name and Banner -->
                                <div class="relative z-20 w-64 md:w-80 mt-2">
                                    <div class="bg-yellow-200 text-center py-2 rounded-t-lg font-bold text-xl md:text-2xl shadow" style="transform: skew(-10deg);">
                                        <span style="transform: skew(10deg); display: inline-block;">Daylyn Unabia</span>
                                    </div>
                                    <div class="bg-blue-700 text-white text-center py-1 rounded-b-lg text-sm md:text-base shadow -mt-1" style="transform: skew(-10deg);">
                                        <span style="transform: skew(10deg); display: inline-block;">ALUMNA</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 flex flex-col justify-center mt-4 md:mt-0">
                                <p class="text-lg md:text-2xl text-gray-700 font-medium leading-relaxed">Growing up in a low-income family with eight siblings was
                                    extremely difficult, as we struggled to meet even our basic needs.
                                    Sacrifices were part of our daily life, and the future often felt uncertain.
                                    Being accepted into the Hauz Hayag Scholarship and Training Program
                                    was a life-changing blessing that opened doors to new opportunities.
                                    Now, as a researcher and graduate student, I work hard to uplift my
                                    family and contribute positively to society.</p>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="slide flex flex-col md:flex-row items-center min-w-full gap-8 bg-gray-50 rounded-2xl shadow-xl p-6 md:p-14 hover:shadow-2xl hover:scale-105 transition-all duration-300 ease-in-out transform" style="animation-delay: 0.2s">
                            <div class="relative flex flex-col items-center w-full md:w-1/2">
                                <div class="absolute z-0 flex justify-center items-center" style="top: 0; left: 50%; transform: translateX(-50%);">
                                    <div class="w-72 h-72 md:w-96 md:h-96 rounded-full bg-blue-400 ring-4 ring-black flex items-center justify-center">
                                        <!-- Removed duplicate image -->
                                    </div>
                                </div>
                                <img src="{{ asset('image/employee3.jpg') }}"
                                     alt="Nissan Geagonia, Cebu City Employee"
                                     class="relative z-10 w-48 h-48 md:w-64 md:h-64 object-contain rounded-full mt-10 transform scale-[1.15]" style="margin-bottom: -2.5rem;">
                                <div class="relative z-20 w-64 md:w-80 mt-2">
                                    <div class="bg-yellow-200 text-center py-2 rounded-t-lg font-bold text-xl md:text-2xl shadow" style="transform: skew(-10deg);">
                                        <span style="transform: skew(10deg); display: inline-block;">Geagonia Nissan</span>
                                    </div>
                                    <div class="bg-blue-700 text-white text-center py-1 rounded-b-lg text-sm md:text-base shadow -mt-1" style="transform: skew(-10deg);">
                                        <span style="transform: skew(10deg); display: inline-block;">CEBU CITY EMPLOYEE</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 flex flex-col justify-center mt-4 md:mt-0">
                                <p class="text-lg md:text-2xl text-gray-700 font-medium leading-relaxed">I'm inspired to work at Hayag because I've seen
                                    how it brings real change to people's
                                    lives through scholarships and feeding programs.
                                    Over the past nine years, I've witnessed many families,
                                    including my own, receive the support they need my daughter
                                    even got to go to college. The benefits and financial help make
                                    working here even more meaningful. It's more than just a job and it's a
                                    place where I've grown and found purpose by helping others.</p>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="slide flex flex-col md:flex-row items-center min-w-full gap-8 bg-gray-50 rounded-2xl shadow-xl p-6 md:p-14 hover:shadow-2xl hover:scale-105 transition-all duration-300 ease-in-out transform" style="animation-delay: 0.3s">
                            <div class="relative flex flex-col items-center w-full md:w-1/2">
                                <div class="absolute z-0 flex justify-center items-center" style="top: 0; left: 50%; transform: translateX(-50%);">
                                    <div class="w-72 h-72 md:w-96 md:h-96 rounded-full bg-blue-400 ring-4 ring-black flex items-center justify-center">
                                        <img src="{{ asset('image/student2.jpg') }}"
                                             alt="Gwyne Otida, Current Student"
                                             class="w-48 h-48 md:w-64 md:h-64 object-contain rounded-full transform scale-[1.15]">
                                    </div>
                                </div>
                                <img src="{{ asset('image/student2.jpg') }}"
                                     alt="Gwyne Otida, Current Student"
                                     class="relative z-10 w-48 h-48 md:w-64 md:h-64 object-contain rounded-full mt-10 transform scale-[1.15]" style="margin-bottom: -2.5rem;">
                                <div class="relative z-20 w-64 md:w-80 mt-2">
                                    <div class="bg-yellow-200 text-center py-2 rounded-t-lg font-bold text-xl md:text-2xl shadow" style="transform: skew(-10deg);">
                                        <span style="transform: skew(10deg); display: inline-block;">Gwyne Otida</span>
                                    </div>
                                    <div class="bg-blue-700 text-white text-center py-1 rounded-b-lg text-sm md:text-base shadow -mt-1" style="transform: skew(-10deg);">
                                        <span style="transform: skew(10deg); display: inline-block;">CURRENT STUDENT</span>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-1/2 flex flex-col justify-center mt-4 md:mt-0">
                                <p class="text-lg md:text-2xl text-gray-700 font-medium leading-relaxed">As a child from a less privileged background,
                                    I often felt trapped by poverty and unsure of my purpose. But Hauz Hayag
                                    became the light that helped me escape hopelessness and believe in myself again.
                                    Through their support, I started to rebuild my dreams and see my worth.
                                    I'm grateful for the kind souls behind Hayag who helped me thrive,
                                    and I know the younger me would be proud of how far I've come.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Slider Controls -->
                    <button onclick="prevSlide()" class="absolute left-0 top-1/2 -translate-y-1/2 bg-primary text-white p-3 rounded-full shadow-lg hover:bg-blue-400 transition z-10 focus:outline-none focus:ring-2 focus:ring-primary/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <button onclick="nextSlide()" class="absolute right-0 top-1/2 -translate-y-1/2 bg-primary text-white p-3 rounded-full shadow-lg hover:bg-blue-400 transition z-10 focus:outline-none focus:ring-2 focus:ring-primary/50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                    <!-- Dots -->
                    <div class="flex justify-center mt-8 space-x-3">
                        <button class="dot w-4 h-4 rounded-full bg-gray-300 border-2 border-primary transition" onclick="goToSlide(0)"></button>
                        <button class="dot w-4 h-4 rounded-full bg-gray-300 border-2 border-primary transition" onclick="goToSlide(1)"></button>
                        <button class="dot w-4 h-4 rounded-full bg-gray-300 border-2 border-primary transition" onclick="goToSlide(2)"></button>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us Section with enhanced professional design -->
        <section id="about-us" class="bg-gradient-to-br from-gray-50 to-blue-50/30 py-20 relative overflow-hidden">
    <!-- Background decorations -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-blue-100/30 to-indigo-100/30 rounded-full -translate-y-48 -translate-x-48"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-gradient-to-tl from-indigo-100/30 to-blue-100/30 rounded-full translate-y-40 translate-x-40"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4 text-primary animate-bounce-in">About Us</h2>
            <p class="text-gray-600 text-lg mb-2">Empowering communities through education and opportunity</p>
            <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
        </div>

        <!-- Mission and Goals Section -->
        <div class="mb-20">
            <!-- Mission Card -->
            <div class="group relative bg-white p-10 rounded-2xl shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-500 ease-in-out transform animate-bounce-in border border-gray-100 overflow-hidden mb-12" style="animation-delay: 0.1s">
                <!-- Card decoration -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-100/50 to-indigo-100/50 rounded-full -translate-y-16 translate-x-16"></div>

                <!-- Icon with enhanced styling -->
                <div class="relative z-10 flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 text-white text-3xl mb-6 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300 mx-auto">
                    <i class="fas fa-bullseye"></i>
                </div>

                <div class="text-center">
                    <h3 class="text-4xl font-bold mb-6 text-gray-800 group-hover:text-blue-600 transition-colors duration-300">MISSION</h3>
                    <p class="text-gray-700 leading-relaxed text-lg max-w-4xl mx-auto">
                        We commit ourselves as all our efforts and resources to effectively facilitate various means of developing and
                        empowering the educational programs and services to foster sustainable them to rise above material, physical and cultural
                        barriers and to achieve spiritual excellence in accordance with God's plan for man.
                    </p>
                    <!-- Decorative element -->
                    <div class="mt-6 w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mx-auto"></div>
                </div>
            </div>

            <!-- Vision Card -->
            <div class="group relative bg-white p-10 rounded-2xl shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-500 ease-in-out transform animate-bounce-in border border-gray-100 overflow-hidden mb-12" style="animation-delay: 0.2s">
                <!-- Card decoration -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-purple-100/50 to-indigo-100/50 rounded-full -translate-y-16 translate-x-16"></div>

                <!-- Icon with enhanced styling -->
                <div class="relative z-10 flex items-center justify-center w-20 h-20 bg-gradient-to-br from-purple-500 to-indigo-600 text-white text-3xl mb-6 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300 mx-auto">
                    <i class="fas fa-eye"></i>
                </div>

                <div class="text-center">
                    <h3 class="text-4xl font-bold mb-6 text-gray-800 group-hover:text-purple-600 transition-colors duration-300">VISION</h3>
                    <p class="text-gray-700 leading-relaxed text-lg max-w-4xl mx-auto">
                        To be a leading organization in empowering marginalized communities through comprehensive educational programs,
                        sustainable development initiatives, and spiritual guidance, creating lasting positive change that transforms
                        lives and builds stronger, more resilient communities across the Philippines.
                    </p>
                    <!-- Decorative element -->
                    <div class="mt-6 w-24 h-1 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full mx-auto"></div>
                </div>
            </div>

            <!-- Goals Card -->
            <div class="group relative bg-white p-10 rounded-2xl shadow-2xl hover:shadow-3xl hover:scale-105 transition-all duration-500 ease-in-out transform animate-bounce-in border border-gray-100 overflow-hidden mb-12" style="animation-delay: 0.3s">
                <!-- Card decoration -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-100/50 to-emerald-100/50 rounded-full -translate-y-16 translate-x-16"></div>

                <!-- Icon with enhanced styling -->
                <div class="relative z-10 flex items-center justify-center w-20 h-20 bg-gradient-to-br from-green-500 to-emerald-600 text-white text-3xl mb-6 rounded-2xl shadow-lg group-hover:scale-110 transition-transform duration-300 mx-auto">
                    <i class="fas fa-target"></i>
                </div>

                <div class="text-center">
                    <h3 class="text-4xl font-bold mb-6 text-gray-800 group-hover:text-green-600 transition-colors duration-300">GOALS</h3>

                    <!-- Goals Grid -->
                    <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">
                        <!-- Goal 1 -->
                        <div class="group/goal relative bg-gray-50 p-6 rounded-xl border border-gray-200 hover:border-green-300 hover:bg-white transition-all duration-300">
                            <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 text-white text-lg mb-4 rounded-lg shadow-md group-hover/goal:scale-110 transition-transform duration-300 mx-auto">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-bold mb-4 mx-auto">1</div>
                            <p class="text-gray-700 leading-relaxed text-sm">
                                To promote the integral development of indigent, abandoned, orphaned and marginalized youngsters.
                            </p>
                        </div>

                        <!-- Goal 2 -->
                        <div class="group/goal relative bg-gray-50 p-6 rounded-xl border border-gray-200 hover:border-green-300 hover:bg-white transition-all duration-300">
                            <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 text-white text-lg mb-4 rounded-lg shadow-md group-hover/goal:scale-110 transition-transform duration-300 mx-auto">
                                <i class="fas fa-heart"></i>
                            </div>
                            <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-bold mb-4 mx-auto">2</div>
                            <p class="text-gray-700 leading-relaxed text-sm">
                                To promote the integrity of God's creation especially on the issues dealing with the congregational, personal and social transformation of the environment.
                            </p>
                        </div>

                        <!-- Goal 3 -->
                        <div class="group/goal relative bg-gray-50 p-6 rounded-xl border border-gray-200 hover:border-green-300 hover:bg-white transition-all duration-300">
                            <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-br from-orange-500 to-red-600 text-white text-lg mb-4 rounded-lg shadow-md group-hover/goal:scale-110 transition-transform duration-300 mx-auto">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-bold mb-4 mx-auto">3</div>
                            <p class="text-gray-700 leading-relaxed text-sm">
                                To produce graduates at least ten (10) beneficiaries of the Hauz Hayag programs, projects and activities in a decade.
                            </p>
                        </div>
                    </div>

                    <!-- Decorative element -->
                    <div class="mt-6 w-24 h-1 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full mx-auto"></div>
                </div>
            </div>
        </div>

        <!-- Core Values Section -->
        <div class="mb-20">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-primary animate-bounce-in">Hauz Hayag Core Values</h2>
                <p class="text-gray-600 text-lg mb-2">The principles that guide our mission and vision</p>
                <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Spirituality -->
                <div class="group relative bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-500 ease-in-out transform border border-gray-100 overflow-hidden" style="animation-delay: 0.1s">
                    <!-- Card decoration -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-purple-100/50 to-indigo-100/50 rounded-full -translate-y-10 translate-x-10"></div>

                    <!-- Icon -->
                    <div class="relative z-10 flex items-center justify-center w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-600 text-white text-2xl mb-6 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-praying-hands"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-purple-600 transition-colors duration-300">SPIRITUALITY</h3>
                    <p class="text-gray-700 leading-relaxed text-sm">
                        We live with the presence of our God and we have integrity and compassion in making to the clients we are working with and to the community.
                    </p>

                    <!-- Decorative element -->
                    <div class="mt-6 w-12 h-1 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-full"></div>
                </div>

                <!-- Commitment -->
                <div class="group relative bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-500 ease-in-out transform border border-gray-100 overflow-hidden" style="animation-delay: 0.2s">
                    <!-- Card decoration -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-pink-100/50 to-rose-100/50 rounded-full -translate-y-10 translate-x-10"></div>

                    <!-- Icon -->
                    <div class="relative z-10 flex items-center justify-center w-16 h-16 bg-gradient-to-br from-pink-500 to-rose-600 text-white text-2xl mb-6 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-handshake"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-pink-600 transition-colors duration-300">COMMITMENT</h3>
                    <p class="text-gray-700 leading-relaxed text-sm">
                        We have integrity and compassion in making to the clients we are working with and to the community.
                    </p>

                    <!-- Decorative element -->
                    <div class="mt-6 w-12 h-1 bg-gradient-to-r from-pink-500 to-rose-600 rounded-full"></div>
                </div>

                <!-- Trustworthy -->
                <div class="group relative bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-500 ease-in-out transform border border-gray-100 overflow-hidden" style="animation-delay: 0.3s">
                    <!-- Card decoration -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-100/50 to-cyan-100/50 rounded-full -translate-y-10 translate-x-10"></div>

                    <!-- Icon -->
                    <div class="relative z-10 flex items-center justify-center w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 text-white text-2xl mb-6 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-shield-alt"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-blue-600 transition-colors duration-300">TRUSTWORTHY</h3>
                    <p class="text-gray-700 leading-relaxed text-sm">
                        We live up to our promises to our clients and we are honest in our services to the community.
                    </p>

                    <!-- Decorative element -->
                    <div class="mt-6 w-12 h-1 bg-gradient-to-r from-blue-500 to-cyan-600 rounded-full"></div>
                </div>

                <!-- Teamwork -->
                <div class="group relative bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-500 ease-in-out transform border border-gray-100 overflow-hidden" style="animation-delay: 0.4s">
                    <!-- Card decoration -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-100/50 to-emerald-100/50 rounded-full -translate-y-10 translate-x-10"></div>

                    <!-- Icon -->
                    <div class="relative z-10 flex items-center justify-center w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 text-white text-2xl mb-6 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-users"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-green-600 transition-colors duration-300">TEAMWORK</h3>
                    <p class="text-gray-700 leading-relaxed text-sm">
                        We recognize and contribute and collaborate with each other in academic and social mission and goals.
                    </p>

                    <!-- Decorative element -->
                    <div class="mt-6 w-12 h-1 bg-gradient-to-r from-green-500 to-emerald-600 rounded-full"></div>
                </div>

                <!-- Empowerment -->
                <div class="group relative bg-white p-8 rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-500 ease-in-out transform border border-gray-100 overflow-hidden md:col-span-2 lg:col-span-1" style="animation-delay: 0.5s">
                    <!-- Card decoration -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-orange-100/50 to-yellow-100/50 rounded-full -translate-y-10 translate-x-10"></div>

                    <!-- Icon -->
                    <div class="relative z-10 flex items-center justify-center w-16 h-16 bg-gradient-to-br from-orange-500 to-yellow-600 text-white text-2xl mb-6 rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-rocket"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-4 text-gray-800 group-hover:text-orange-600 transition-colors duration-300">EMPOWERMENT</h3>
                    <p class="text-gray-700 leading-relaxed text-sm">
                        We foster an environment where all are empowered to become their best potential.
                    </p>

                    <!-- Decorative element -->
                    <div class="mt-6 w-12 h-1 bg-gradient-to-r from-orange-500 to-yellow-600 rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Track Application Section with enhanced professional design -->
        <section id="track-application" class="py-12 bg-gradient-to-br from-slate-50 via-white to-gray-50 relative overflow-hidden">
            <!-- Background decorations -->
            <div class="absolute top-0 right-0 w-72 h-72 bg-gradient-to-bl from-slate-100/40 to-gray-100/40 rounded-full -translate-y-36 translate-x-36"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-gray-100/40 to-slate-100/40 rounded-full translate-y-32 -translate-x-32"></div>

            <div class="max-w-4xl mx-auto px-4 relative z-10">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold mb-4 text-primary animate-bounce-in">Track Your Application</h2>
                    <p class="text-gray-600 text-lg mb-2">Enter your tracking code to check your application status</p>
                    <div class="w-24 h-1 bg-gradient-to-r from-primary to-secondary mx-auto rounded-full"></div>
                </div>

                <!-- Enhanced Application Type Tabs -->
                <div class="flex justify-center mb-12">
                    <div class="bg-white rounded-2xl p-2 shadow-xl border border-gray-100">
                        <button onclick="switchTrackingTab('scholarship')" id="scholarshipTab" class="px-8 py-4 rounded-xl font-semibold transition-all duration-300 bg-gradient-to-r from-primary to-blue-600 text-white shadow-lg">
                            <i class="fas fa-graduation-cap mr-2"></i>
                            Scholarship Application
                        </button>
                        <button onclick="switchTrackingTab('volunteer')" id="volunteerTab" class="px-8 py-4 rounded-xl font-semibold transition-all duration-300 text-gray-600 hover:text-primary hover:bg-gray-50">
                            <i class="fas fa-hands-helping mr-2"></i>
                            Volunteer Application
                        </button>
                    </div>
                </div>

                <!-- Enhanced Scholarship Tracking Form -->
                <div id="scholarshipTracking" class="bg-white/95 backdrop-blur-sm p-12 rounded-3xl shadow-2xl border border-primary/20 animate-fade-in relative overflow-hidden">
                    <!-- Card decoration -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-primary/10 to-secondary/10 rounded-full -translate-y-16 translate-x-16"></div>

                    <div class="text-center mb-8 relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-search text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Track Scholarship Application</h3>
                        <p class="text-gray-600 text-lg">Enter your 8-digit scholarship tracking code</p>
                    </div>

                    <form method="POST" action="{{ route('scholarship.track') }}" class="space-y-8 relative z-10">
                        @csrf
                        <div>
                            <label for="scholarship_tracking_code" class="block text-lg font-semibold mb-4 text-gray-700">Tracking Code</label>
                            <div class="relative">
                                <input type="text" name="tracking_code" id="scholarship_tracking_code"
                                    class="w-full px-6 py-4 border-2 border-primary/30 rounded-2xl focus:ring-4 focus:ring-primary/20 focus:border-primary transition-all text-xl placeholder-gray-400 shadow-lg text-center font-mono bg-gray-50 hover:bg-white"
                                    placeholder="Enter your 8-digit tracking code"
                                    maxlength="8"
                                    required>
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-hashtag text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        @if(session('error'))
                            <div class="flex items-center bg-red-50 border-l-4 border-red-400 p-6 rounded-2xl shadow-lg animate-fade-in">
                                <svg class="h-8 w-8 text-red-400 mr-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-lg text-red-700 font-medium">{{ session('error') }}</span>
                            </div>
                        @endif

                        <div class="flex justify-center">
                            <button type="submit"
                                class="group/btn relative overflow-hidden inline-flex items-center px-10 py-4 border border-transparent text-xl font-bold rounded-2xl shadow-xl text-white bg-gradient-to-r from-primary to-blue-600 hover:from-blue-600 hover:to-primary focus:outline-none focus:ring-4 focus:ring-primary/30 transition-all gap-3">
                                <svg class="w-7 h-7 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <span>Track Scholarship</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-primary opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Enhanced Volunteer Event Tracking Form -->
                <div id="volunteerTracking" class="bg-white/95 backdrop-blur-sm p-12 rounded-3xl shadow-2xl border border-primary/20 animate-fade-in hidden relative overflow-hidden">
                    <!-- Card decoration -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-100/50 to-teal-100/50 rounded-full -translate-y-16 translate-x-16"></div>

                    <div class="text-center mb-8 relative z-10">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-hands-helping text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-3">Track Volunteer Application</h3>
                        <p class="text-gray-600 text-lg">Enter your 8-digit volunteer event tracking code</p>
                    </div>

                    <form method="POST" action="{{ route('volunteer.event-application.track') }}" class="space-y-8 relative z-10">
                        @csrf
                        <div>
                            <label for="volunteer_tracking_code" class="block text-lg font-semibold mb-4 text-gray-700">Tracking Code</label>
                            <div class="relative">
                                <input type="text" name="tracking_code" id="volunteer_tracking_code"
                                    class="w-full px-6 py-4 border-2 border-green-300 rounded-2xl focus:ring-4 focus:ring-green-200 focus:border-green-500 transition-all text-xl placeholder-gray-400 shadow-lg text-center font-mono bg-gray-50 hover:bg-white"
                                    placeholder="Enter your 8-digit tracking code"
                                    maxlength="8"
                                    required>
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4">
                                    <i class="fas fa-hashtag text-gray-400"></i>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center">
                            <button type="submit"
                                class="group/btn relative overflow-hidden inline-flex items-center px-10 py-4 border border-transparent text-xl font-bold rounded-2xl shadow-xl text-white bg-gradient-to-r from-green-500 to-teal-600 hover:from-teal-600 hover:to-green-500 focus:outline-none focus:ring-4 focus:ring-green-300 transition-all gap-3">
                                <svg class="w-7 h-7 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <span>Track Volunteer Application</span>
                                <div class="absolute inset-0 bg-gradient-to-r from-teal-600 to-green-500 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Enhanced Quick Links -->
                <div class="mt-12 text-center">
                    <p class="text-gray-600 mb-6 text-lg">Don't have a tracking code?</p>
                    <div class="flex flex-wrap justify-center gap-6">
                        <a href="#scholarships" class="group inline-flex items-center px-6 py-3 bg-white text-primary border-2 border-primary rounded-xl hover:bg-primary hover:text-white transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-graduation-cap mr-3 group-hover:scale-110 transition-transform"></i>
                            <span class="font-semibold">Apply for Scholarship</span>
                        </a>
                        <a href="#events" class="group inline-flex items-center px-6 py-3 bg-white text-green-600 border-2 border-green-600 rounded-xl hover:bg-green-600 hover:text-white transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <i class="fas fa-hands-helping mr-3 group-hover:scale-110 transition-transform"></i>
                            <span class="font-semibold">Volunteer for Events</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <footer class="bg-[#e6f4ea] text-gray-800 py-10 px-6 mt-12 animate-fade-in">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
              <!-- About Section -->
              <div>
                <h2 class="text-lg font-semibold mb-4">Hauz Hayag Scholarship and Training Program Inc</h2>
                <p class="text-sm leading-relaxed">
                  Supporting education through scholarship and nourishment. Hauz Hayag believes in empowering the youth for a brighter future.
                </p>
              </div>

              <!-- Quick Links -->
              <div>
                <h2 class="text-lg font-semibold mb-4">Quick Links</h2>
                <ul class="space-y-2 text-sm">
                  <li><a href="#home" class="hover:underline">Home</a></li>
                  <li><a href="#scholarships" class="hover:underline">Programs</a></li>
                  <li><a href="#about-us" class="hover:underline">About Us</a></li>                </ul>
              </div>

              <!-- Contact Info -->
              <div>
                <h2 class="text-lg font-semibold mb-4">Contact Us</h2>
                <p class="text-sm">📍 Carlock Street, San Nicolas Proper, Cebu City, Philippines</p>
                <p class="text-sm">📧 hauzhayag143@gmail.com</p>
                <p class="text-sm">📞 (032) 384 6594</p>
                <p class="text-sm">🌐 <a href="https://www.hayag-project.com/?fbclid=IwY2xjawK7hdhleHRuA2FlbQIxMABicmlkETFlb2l4d3RjU0szbkdGcDB1AR6M3X6DyPm0O0IXAQzESl6Ou3T8MpEIPHYsifFwfvxi_YJQv_sEkdQi73T4OQ_aem_wgT4PQyVdfilaQakFyVSjA" target="_blank" class="text-primary hover:underline">hayag-project.com</a></p>
              </div>
            </div>

            <div class="border-t mt-10 pt-4 text-center text-sm text-gray-500">
              &copy; 2025 Hauz Hayag Scholarship and Training Program Inc. All rights reserved.
            </div>
          </footer>
    </main>

    <!-- Job Details Modal -->
    <div id="jobDetailsModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex justify-center items-center z-50 hidden p-4">
        <div class="bg-white p-4 lg:p-6 rounded-xl shadow-2xl w-full max-w-2xl mx-auto relative transform transition-all duration-300 scale-95 modal-content max-h-[90vh] overflow-y-auto">
            <!-- Close Button -->
            <button onclick="closeJobDetailsModal()" class="absolute top-3 right-3 w-6 h-6 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-700 transition-all duration-200">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Header -->
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2m-8 0V6a2 2 0 00-2 2v6"/>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Job Details</h2>
            </div>

            <div id="jobDetailsContent" class="space-y-4">
                <div class="text-center text-gray-500">Loading...</div>
            </div>
        </div>
    </div>

    <!-- Event Registration Modal -->
    <div id="eventRegistrationModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex justify-center items-center z-50 hidden p-4">
        <div class="bg-white p-4 lg:p-6 rounded-xl shadow-2xl w-full max-w-lg mx-auto relative transform transition-all duration-300 scale-95 modal-content max-h-[90vh] overflow-y-auto">
            <!-- Close Button -->
            <button onclick="closeEventRegistrationModal()" class="absolute top-3 right-3 w-6 h-6 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-700 transition-all duration-200">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Header -->
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-teal-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Event Registration</h2>
                <p class="text-xs text-gray-600">Join us for an amazing experience!</p>
            </div>

            <!-- Form -->
            <form id="eventRegistrationForm" class="space-y-4" enctype="multipart/form-data" onsubmit="submitEventRegistration(event)">
                <input type="hidden" id="event_id" name="event_id">

                <!-- Full Name -->
                <div class="form-group">
                    <label for="volunteer_full_name" class="block text-xs font-medium text-gray-700 mb-2">Full Name</label>
                    <div class="relative">
                        <input type="text" id="volunteer_full_name" name="full_name"
                               class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm"
                               placeholder="Enter your full name" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="volunteer_email" class="block text-xs font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" id="volunteer_email" name="email"
                               class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm"
                               placeholder="your.email@gmail.com" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="form-group">
                    <label for="volunteer_phone" class="block text-xs font-medium text-gray-700 mb-2">Phone Number</label>
                    <div class="relative">
                        <input type="tel" id="volunteer_phone" name="phone_number"
                               class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm"
                               placeholder="09123456789" maxlength="11" pattern="[0-9]{11}" inputmode="numeric" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Application Reason -->
                <div class="form-group">
                    <label for="application_reason" class="block text-xs font-medium text-gray-700 mb-2">Why would you like to participate? <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <textarea id="application_reason" name="application_reason" rows="3"
                                  class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 bg-gray-50 hover:bg-white resize-none text-sm"
                                  placeholder="Tell us why you're interested in this event..." required></textarea>
                        <div class="absolute top-2 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Volunteer Description -->
                <div class="form-group">
                    <label for="volunteer_description" class="block text-xs font-medium text-gray-700 mb-2">Describe yourself as a volunteer <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <textarea id="volunteer_description" name="volunteer_description" rows="3"
                                  class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 bg-gray-50 hover:bg-white resize-none text-sm"
                                  placeholder="Tell us about your skills, experience, and what makes you a good volunteer..." required></textarea>
                        <div class="absolute top-2 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Valid ID Upload -->
                <div class="form-group">
                    <label for="valid_id" class="block text-xs font-medium text-gray-700 mb-2">Upload Valid ID <span class="text-red-500">*</span></label>
                    <input type="file" id="valid_id" name="valid_id" required accept="image/*,.pdf"
                           class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                    <p class="text-xs text-gray-500 mt-1">Please upload a clear photo or scan of your valid government-issued ID. Accepted formats: JPG, PNG, PDF. Max size: 5MB.</p>
                </div>

                <!-- Terms and Conditions -->
                <div class="form-group">
                    <div class="bg-gradient-to-r from-gray-50 to-slate-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex items-start space-x-3">
                            <div class="flex items-center h-5 mt-1">
                                <input type="checkbox" id="event_terms_agreement" name="terms_agreement" required
                                       class="h-4 w-4 rounded border-2 border-gray-300 text-teal-500 focus:ring-2 focus:ring-teal-100 focus:border-teal-400 transition-all duration-300">
                            </div>
                            <div class="flex-1">
                                <label for="event_terms_agreement" class="block text-xs font-semibold text-gray-800 mb-2 cursor-pointer">
                                By checking this box,I agree to the <a href="{{ route('terms.volunteer') }}" target="_blank" class="text-teal-600 hover:underline font-medium">Terms and Conditions</a> and <a href="{{ route('privacy.policy') }}" target="_blank" class="text-teal-600 hover:underline font-medium">Privacy Policy</a> <span class="text-red-500">*</span>
                                </label>
                                <div class="text-xs text-gray-600 leading-relaxed">
                                    <!-- <p class="mb-2">By checking this box, I acknowledge that:</p>
                                    <ul class="list-disc list-inside space-y-1 ml-2">
                                        <li>All information provided is accurate and complete</li>
                                        <li>I understand the event requirements and guidelines</li>
                                        <li>I agree to comply with all event policies and procedures</li>
                                        <li>I consent to the processing of my personal data for event registration purposes</li>
                                        <li>False information may result in registration rejection or event exclusion</li>
                                        <li>I understand that event details may be subject to change</li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-teal-500 to-blue-500 hover:from-teal-600 hover:to-blue-600 text-white py-2.5 rounded-lg font-medium text-sm shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center">
                    <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Register Now
                </button>
            </form>
        </div>
    </div>

    <!-- Event Details Modal -->
    <div id="eventDetailsModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex justify-center items-center z-50 hidden p-4">
        <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-2xl mx-auto relative transform transition-all duration-300 scale-95 modal-content max-h-[90vh] overflow-y-auto">
            <!-- Close Button -->
            <button onclick="closeEventDetailsModal()" class="absolute top-3 right-3 w-6 h-6 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-700 transition-all duration-200">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Header -->
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-cyan-600 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Event Details</h2>
                <p class="text-xs text-gray-600">Complete event information</p>
            </div>

            <!-- Event Details Content -->
            <div id="eventDetailsContent" class="space-y-4 mb-6">
                <!-- Event details will be loaded here -->
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-3 pt-4 border-t border-gray-200">
                <button onclick="closeEventDetailsModal()" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                    Close
                </button>
                <button onclick="registerFromDetails()" class="flex-1 px-4 py-2 bg-gradient-to-r from-teal-500 to-blue-500 text-white rounded-lg hover:from-teal-600 hover:to-blue-600 transition-all duration-200 font-medium">
                    Register for this Event
                </button>
            </div>
        </div>
    </div>

    <!-- Scholarship Application Modal -->
    <div id="scholarshipApplicationModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex justify-center items-center z-50 hidden p-4" onclick="backgroundCloseDonationModal(event)">
        <div class="bg-white p-4 lg:p-6 rounded-xl shadow-2xl w-full max-w-lg mx-auto relative transform transition-all duration-300 scale-95 modal-content max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
            <!-- Close Button -->
            <button onclick="closeScholarshipModal()" class="absolute top-3 right-3 w-6 h-6 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-700 transition-all duration-200">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Header -->
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-800">Scholarship Application</h2>
            </div>

            @if ($errors->scholarship->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-300">
                    <p class="font-semibold">Please fix the following errors:</p>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->scholarship->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/scholarship/apply" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="welcome_full_name" class="block text-xs font-medium mb-1 text-gray-700">Full Name</label>
                    <input type="text" id="welcome_full_name" name="full_name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary text-sm" value="{{ old('full_name') }}" required>
                </div>
                <div>
                    <label for="welcome_email" class="block text-xs font-medium mb-1 text-gray-700">Email Address</label>
                    <input type="email" id="welcome_email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary text-sm" value="{{ old('email') }}" placeholder="example@gmail.com" required>
                </div>
                <div>
                    <label for="welcome_phone_number" class="block text-xs font-medium mb-1 text-gray-700">Phone Number</label>
                    <input type="tel" id="welcome_phone_number" name="phone_number" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary focus:border-primary text-sm" value="{{ old('phone_number') }}" placeholder="09123456789" maxlength="11" pattern="[0-9]{11}" inputmode="numeric" required>
                </div>
                <!-- Hidden field for scholarship type - will be set dynamically -->
                <input type="hidden" name="scholarship_type" id="welcome_scholarship_type_hidden" value="community_based">
                <div>
                    <label for="welcome_transcript" class="block text-xs font-medium mb-1 text-gray-700">Upload your Latest Grade Slip (JPG, PNG - Max 5MB)</label>
                    <input type="file" id="welcome_transcript" name="transcript" class="w-full text-xs text-gray-500 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-primary/10 file:text-primary hover:file:bg-primary/20" required accept=".pdf,.jpg,.jpeg,.png">
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start space-x-2">
                    <input type="checkbox" id="welcome_terms" name="terms" class="mt-1 h-3 w-3 text-primary focus:ring-primary border-gray-300 rounded" required>
                    <label for="welcome_terms" class="text-xs text-gray-600 leading-relaxed">
                       By checking this box, I agree to the <a href="{{ route('terms.scholarship') }}" target="_blank" class="text-primary hover:underline font-medium">Terms and Conditions</a> and <a href="{{ route('privacy.policy') }}" target="_blank" class="text-primary hover:underline font-medium">Privacy Policy</a>.
                    </label>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg hover:bg-blue-400 transition-colors duration-200 text-sm font-medium">
                    Submit Application
                </button>
            </form>
        </div>
    </div>

          <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex justify-center items-center z-50 hidden">
        <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-sm mx-4 relative transform transition-all duration-300 scale-95 modal-content">
            <!-- Close Button -->
            <button onclick="closeLoginModal()" class="absolute top-3 right-3 w-6 h-6 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-700 transition-all duration-200">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Header -->
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Welcome Back</h2>
                <p class="text-xs text-gray-600">Sign in to your account</p>
            </div>

            <!-- Form -->
            <form id="loginForm" class="space-y-4" onsubmit="handleLogin(event)">
                <!-- Email -->
                <div class="form-group">
                    <label for="loginEmail" class="block text-xs font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" id="loginEmail" name="email"
                               class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm"
                               placeholder="your.email@example.com" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="loginPassword" class="block text-xs font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="loginPassword" name="password"
                               class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm"
                               placeholder="Enter your password" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white py-2.5 rounded-lg font-medium text-sm shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center">
                    <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Sign In
                </button>

                <div id="loginError" class="text-red-500 text-xs text-center hidden"></div>
            </form>
        </div>
    </div>

    <!-- Donation Modal -->
    <div id="donationModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex justify-center items-center z-50 hidden" onclick="backgroundCloseDonationModal(event)">
        <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-sm mx-4 relative transform transition-all duration-300 scale-95 modal-content" onclick="event.stopPropagation()">
            <!-- Close Button -->
            <button onclick="closeDonationModal()" class="absolute top-3 right-3 w-6 h-6 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-700 transition-all duration-200">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Header -->
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Make a Donation</h2>
                <p class="text-xs text-gray-600">Support our mission</p>
            </div>

            <!-- Form -->
            <form id="donationForm" class="space-y-4">
                <!-- Amount -->
                <div class="form-group">
                    <label class="block text-xs font-medium text-gray-700 mb-2">Amount</label>
                    <div class="relative">
                        <input type="number" class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-100 focus:border-green-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm" placeholder="0.00" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Name -->
                <div class="form-group">
                    <label class="block text-xs font-medium text-gray-700 mb-2">Full Name</label>
                    <div class="relative">
                        <input type="text" class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-100 focus:border-green-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm" placeholder="Your full name" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="block text-xs font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-100 focus:border-green-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm" placeholder="your.email@example.com" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white py-2.5 rounded-lg font-medium text-sm shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center">
                    <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    Donate Now
                </button>
            </form>
        </div>
    </div>

    <!-- Registration Modal -->
    <div id="registrationModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex justify-center items-center z-50 hidden">
        <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-md mx-4 relative transform transition-all duration-300 scale-95 modal-content">
            <!-- Close Button -->
            <button onclick="closeRegistrationModal()" class="absolute top-3 right-3 w-6 h-6 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-700 transition-all duration-200">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Header -->
            <div class="text-center mb-6">
                <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-800 mb-1">Create Account</h2>
                <p class="text-xs text-gray-600">Join our community today</p>
            </div>

            <!-- Form -->
            <form id="registrationForm" class="space-y-4" onsubmit="handleRegister(event)">
                <!-- Full Name -->
                <div class="form-group">
                    <label class="block text-xs font-medium text-gray-700 mb-2">Full Name</label>
                    <div class="relative">
                        <input type="text" name="name" class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-100 focus:border-purple-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm" placeholder="Enter your full name" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="block text-xs font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="relative">
                        <input type="email" name="email" class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-100 focus:border-purple-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm" placeholder="your.email@example.com" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="block text-xs font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-100 focus:border-purple-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm" placeholder="Create a password" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="block text-xs font-medium text-gray-700 mb-2">Confirm Password</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" class="w-full px-3 py-2 pl-8 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-100 focus:border-purple-400 transition-all duration-300 bg-gray-50 hover:bg-white text-sm" placeholder="Confirm your password" required>
                        <div class="absolute inset-y-0 left-0 flex items-center pl-2">
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white py-2.5 rounded-lg font-medium text-sm shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center">
                    <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Create Account
                </button>

                <div id="registerError" class="text-red-500 text-xs text-center hidden"></div>
            </form>

            <!-- Footer -->
            <div class="text-center mt-4">
                <span class="text-xs text-gray-600">Already have an account?</span>
                <button class="text-xs text-purple-600 font-medium hover:underline ml-1" onclick="switchToLogin()">Sign in here</button>
            </div>
        </div>
    </div>





    <!-- Eligibility Modal -->
    <div id="eligibilityModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm flex justify-center items-center z-50 hidden p-4">
        <div class="bg-white p-4 lg:p-6 rounded-xl shadow-2xl w-full max-w-2xl mx-auto relative transform transition-all duration-300 scale-95 modal-content max-h-[90vh] overflow-y-auto">
            <!-- Close Button -->
            <button onclick="closeEligibilityModal()" class="absolute top-3 right-3 w-8 h-8 bg-gray-100 hover:bg-gray-200 rounded-full flex items-center justify-center text-gray-500 hover:text-gray-700 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Modal Header -->
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Scholarship Eligibility</h2>
                <p class="text-gray-600">Review the requirements and benefits for this scholarship program</p>
            </div>

            <!-- Modal Content -->
            <div id="eligibilityContent" class="mb-6">
                <!-- Content will be dynamically populated by JavaScript -->
            </div>

            <!-- Modal Footer -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                <button onclick="closeEligibilityModal()" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 font-medium">
                    Close
                </button>
                <button onclick="closeEligibilityModal(); openScholarshipModal(document.querySelector('#eligibilityModal h2').textContent.includes('Residential') ? 'in_house' : 'community_based');" class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-200 font-medium">
                    Apply Now
                </button>
            </div>
        </div>
    </div>
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        });

        // Modal Functions
        function openLoginModal() {
            document.getElementById('loginModal').classList.remove('hidden');
        }

        function closeLoginModal() {
            document.getElementById('loginModal').classList.add('hidden');
        }

        function openDonationModal() {
            document.getElementById('donationModal').classList.remove('hidden');
        }

        function closeDonationModal() {
            document.getElementById('donationModal').classList.add('hidden');
        }

        function openScholarshipModal(scholarshipType = 'community_based') {
            // Set the scholarship type in the hidden field
            document.getElementById('welcome_scholarship_type_hidden').value = scholarshipType;

            // Update modal title based on scholarship type
            const modalTitle = document.querySelector('#scholarshipApplicationModal h2');
            if (scholarshipType === 'in_house') {
                modalTitle.textContent = 'Residential Scholarship Application';
            } else {
                modalTitle.textContent = 'Community-Based Scholarship Application';
            }

            document.getElementById('scholarshipApplicationModal').classList.remove('hidden');
        }

        function closeScholarshipModal() {
            document.getElementById('scholarshipApplicationModal').classList.add('hidden');
        }

        function openEligibilityModal(scholarshipType = 'community_based') {
            // Update modal content based on scholarship type
            const modalTitle = document.querySelector('#eligibilityModal h2');
            const modalContent = document.querySelector('#eligibilityContent');

            if (scholarshipType === 'in_house') {
                modalTitle.textContent = 'Residential Scholarship for Girls - Eligibility Requirements';
                modalContent.innerHTML = `
                    <div class="space-y-6">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-800 mb-2">Eligibility Requirements</h3>
                            <ul class="text-gray-700 text-sm space-y-2">
                                <li>• Female, 18 and above</li>
                                <li>• Senior High School Graduate</li>
                                <li>• Living below poverty threshold</li>
                                <li>• Must be in GOOD HEALTH and of GOOD MORAL character</li>
                                <li>• Preferably with GOOD SCHOLASTIC RECORD</li>
                                <li>• Must come from depressed areas in Cebu Province and Provinces in Visayas and Mindanao</li>
                            </ul>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-800 mb-2">Education Level</h3>
                            <p class="text-gray-700 text-sm">Must be pursuing college education or planning to enroll in college.</p>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-800 mb-2">Geographic Eligibility</h3>
                            <p class="text-gray-700 text-sm">Open to girls from Mindanao and Visayas regions.</p>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-800 mb-2">Program Benefits</h3>
                            <ul class="text-gray-700 text-sm space-y-1">
                                <li>• Full tuition coverage</li>
                                <li>• Housing at Hauz Hayag center</li>
                                <li>• Leadership training programs</li>
                                <li>• Career guidance and mentorship</li>
                            </ul>
                        </div>
                    </div>
                `;
            } else {
                modalTitle.textContent = 'Community-Based Scholarship - Eligibility Requirements';
                modalContent.innerHTML = `
                    <div class="space-y-6">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-800 mb-2">Eligibility Requirements</h3>
                            <ul class="text-gray-700 text-sm space-y-2">
                                <li>• Applicants must be an identified resident within Cebu City, Philippines.</li>
                                <li>• Applicants must be of ages 6 years old and above. Must be willing to pursue his/her studies.</li>
                                <li>• Applicants must be of good moral character and preferably with good scholastic records as per school records.</li>
                                <li>• Only those who are living below poverty threshold indigent, disadvantaged and marginalized are accepted into the Educational Assistance Program of Hauz Hayag.</li>
                                <li>• Families with 2-4 children, only 1 scholar may be accepted. For families with 5 or more children, 1-3 scholars may be accepted depending on thorough assessment for qualification of scholarship.</li>
                                <li>• Applicants must be enrolled in a public school.</li>
                            </ul>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-800 mb-2">Living Arrangement</h3>
                            <p class="text-gray-700 text-sm">Students live with their families while receiving support for school materials, uniforms, and educational expenses.</p>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-800 mb-2">Requirements</h3>
                            <ul class="text-gray-700 text-sm space-y-1">
                                <li>• Regular attendance at organizational meetings</li>
                                <li>• Participation in Saturday tutoring sessions</li>
                                <li>• Commitment to community involvement</li>
                            </ul>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="font-semibold text-gray-800 mb-2">Support Provided</h3>
                            <ul class="text-gray-700 text-sm space-y-1">
                                <li>• School materials and supplies</li>
                                <li>• School uniforms</li>
                                <li>• Educational expenses coverage</li>
                                <li>• Saturday tutoring by HAYAG girls</li>
                                <li>• Daily holiday tutoring sessions</li>
                            </ul>
                        </div>
                    </div>
                `;
            }

            document.getElementById('eligibilityModal').classList.remove('hidden');
        }

        function closeEligibilityModal() {
            document.getElementById('eligibilityModal').classList.add('hidden');
        }

        function openJobDetailsModal(jobId) {
            const modal = document.getElementById('jobDetailsModal');
            const content = document.getElementById('jobDetailsContent');

            // Show modal
            modal.classList.remove('hidden');

            // Show loading state
            content.innerHTML = '<div class="text-center text-gray-500">Loading...</div>';

            // Fetch job details
            if (jobId) {
                fetch(`/api/job-listings/${jobId}`)
                    .then(response => response.json())
                    .then(job => {
                        content.innerHTML = `
                            <div class="bg-white rounded-xl border border-gray-200 p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">${job.title}</h3>
                                        <p class="text-gray-600 font-medium">${job.company_name || job.company || 'Company Not Specified'}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            ${job.employment_type || job.type || 'Full-time'}
                                        </span>
                                    </div>
                                </div>

                                <div class="space-y-3 mb-4">
                                    ${job.location ? `
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            <span class="text-sm">${job.location}</span>
                                        </div>
                                    ` : ''}

                                    ${job.salary_min && job.salary_max ? `
                                        <div class="flex items-center text-gray-600">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                            </svg>
                                            <span class="text-sm">₱${parseFloat(job.salary_min).toLocaleString()} - ₱${parseFloat(job.salary_max).toLocaleString()}</span>
                                        </div>
                                    ` : ''}

                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-sm">Posted ${new Date(job.created_at).toLocaleDateString()}</span>
                                    </div>
                                </div>

                                <div class="border-t border-gray-200 pt-4">
                                    <h4 class="font-semibold text-gray-800 mb-2">Description</h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">${job.description || 'No description available.'}</p>
                                </div>

                                ${job.qualifications ? `
                                    <div class="border-t border-gray-200 pt-4 mt-4">
                                        <h4 class="font-semibold text-gray-800 mb-2">Qualifications</h4>
                                        <p class="text-gray-600 text-sm leading-relaxed">${job.qualifications}</p>
                                    </div>
                                ` : ''}

                                ${job.contact_person || job.contact_email || job.contact_phone ? `
                                    <div class="border-t border-gray-200 pt-4 mt-4">
                                        <h4 class="font-semibold text-gray-800 mb-2">Contact Information</h4>
                                        <div class="space-y-1">
                                            ${job.contact_person ? `<p class="text-gray-600 text-sm"><span class="font-medium">Person:</span> ${job.contact_person}</p>` : ''}
                                            ${job.contact_email ? `<p class="text-gray-600 text-sm"><span class="font-medium">Email:</span> ${job.contact_email}</p>` : ''}
                                            ${job.contact_phone ? `<p class="text-gray-600 text-sm"><span class="font-medium">Phone:</span> ${job.contact_phone}</p>` : ''}
                                        </div>
                                    </div>
                                ` : ''}

                                <div class="border-t border-gray-200 pt-4 mt-4 flex justify-end">
                                    <button onclick="closeJobDetailsModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-200 text-sm font-medium">
                                        Close
                                    </button>
                                </div>
                            </div>
                        `;
                    })
                    .catch(error => {
                        console.error('Error fetching job details:', error);
                        content.innerHTML = '<div class="text-center text-red-500">Error loading job details</div>';
                    });
            } else {
                content.innerHTML = '<div class="text-center text-gray-500">No job details available</div>';
            }
        }

        function closeJobDetailsModal() {
            document.getElementById('jobDetailsModal').classList.add('hidden');
        }

        function openEventModal() {
            document.getElementById('eventRegistrationModal').classList.remove('hidden');
        }

        function closeEventModal() {
            document.getElementById('eventRegistrationModal').classList.add('hidden');
        }



        // Close modals when clicking outside
        document.addEventListener('click', function(event) {
            const loginModal = document.getElementById('loginModal');
            const donationModal = document.getElementById('donationModal');
            const scholarshipModal = document.getElementById('scholarshipApplicationModal');
            const jobDetailsModal = document.getElementById('jobDetailsModal');
            const eventModal = document.getElementById('eventRegistrationModal');
            const eligibilityModal = document.getElementById('eligibilityModal');

            if (event.target === loginModal) {
                closeLoginModal();
            }
            if (event.target === donationModal) {
                closeDonationModal();
            }
            if (event.target === scholarshipModal) {
                closeScholarshipModal();
            }
            if (event.target === jobDetailsModal) {
                closeJobDetailsModal();
            }
            if (event.target === eventModal) {
                closeEventModal();
            }
            if (event.target === eligibilityModal) {
                closeEligibilityModal();
            }
        });

        // Close modals when pressing Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeLoginModal();
                closeDonationModal();
                closeScholarshipModal();
                closeJobDetailsModal();
                closeEventModal();
                closeEligibilityModal();
            }
        });

        // Improved Slider functionality
        let currentSlide = 0;
        let slideInterval;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        const slidesContainer = document.getElementById('slides');

        function showSlide(index) {
            // Update slide position
            slidesContainer.style.transform = `translateX(-${index * 100}%)`;

            // Update dots
            dots.forEach((dot, i) => {
                dot.classList.toggle('bg-primary', i === index);
                dot.classList.toggle('bg-gray-300', i !== index);
            });

            currentSlide = index;
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        function goToSlide(index) {
            showSlide(index);
        }

        // Auto-advance slides every 5 seconds
        function startAutoSlide() {
            slideInterval = setInterval(nextSlide, 5000);
        }

        function stopAutoSlide() {
            clearInterval(slideInterval);
        }

        // Initialize slider
        showSlide(0);
        startAutoSlide();

        // Pause auto-slide when hovering over slides
        slidesContainer.addEventListener('mouseenter', stopAutoSlide);
        slidesContainer.addEventListener('mouseleave', startAutoSlide);

        // Touch support for mobile devices
        let touchStartX = 0;
        let touchEndX = 0;

        slidesContainer.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        slidesContainer.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            if (touchEndX < touchStartX - swipeThreshold) {
                nextSlide();
            } else if (touchEndX > touchStartX + swipeThreshold) {
                prevSlide();
            }
        }

        // Scholarship Form Submission
        function handleScholarshipSubmit(event) {
            event.preventDefault();
            alert('Thank you for your interest! Scholarship applications will be available soon.');
            closeScholarshipModal();
        }

        // Tracking Form Submission
        function handleTrackingSubmit(event) {
            event.preventDefault();
            const trackingCode = document.querySelector('input[name="tracking_code"]').value;

            // Show a demo tracking result
            const trackingResult = document.getElementById('trackingResult');
            const statusMessage = document.getElementById('statusMessage');

            trackingResult.classList.remove('hidden');
            statusMessage.textContent = 'Demo Status: Application is under review';
            trackingResult.className = 'mt-4 p-4 rounded-lg bg-yellow-50 text-yellow-700';
        }

        // Registration Modal Functions
        function openRegistrationModal() {
            document.getElementById('registrationModal').classList.remove('hidden');
        }

        function closeRegistrationModal() {
            document.getElementById('registrationModal').classList.add('hidden');
        }

        function switchToLogin() {
            closeRegistrationModal();
            openLoginModal();
        }

        // Add registration modal to the click-outside handler
        document.addEventListener('click', function(event) {
            const registrationModal = document.getElementById('registrationModal');
            if (event.target === registrationModal) {
                closeRegistrationModal();
            }
        });

        // Add registration modal to the escape key handler
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeRegistrationModal();
            }
        });

        // Registration form submission
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('/register', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Registration successful! Please check your email to verify your account.');
                    closeRegistrationModal();
                    openLoginModal();
                } else {
                    alert(data.message || 'Registration failed. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });

        // Update the "No account?" link in login modal to open registration
        document.querySelector('#loginModal .text-primary').addEventListener('click', function(e) {
            e.preventDefault();
            closeLoginModal();
            openRegistrationModal();
        });

        // Impact Slider functionality
        let currentImpactSlide = 0;
        const impactSlides = document.getElementById('impactSlides');
        const totalImpactSlides = 3;

        function showImpactSlide(index) {
            impactSlides.style.transform = `translateX(-${index * 100}%)`;
            impactSlides.style.transition = 'transform 0.7s cubic-bezier(0.4, 0, 0.2, 1)';
            currentImpactSlide = index;
        }

        function nextImpactSlide() {
            currentImpactSlide = (currentImpactSlide + 1) % totalImpactSlides;
            showImpactSlide(currentImpactSlide);
        }

        function prevImpactSlide() {
            currentImpactSlide = (currentImpactSlide - 1 + totalImpactSlides) % totalImpactSlides;
            showImpactSlide(currentImpactSlide);
        }

        function goToImpactSlide(index) {
            showImpactSlide(index);
        }

        // Auto-advance impact slides
        setInterval(nextImpactSlide, 5000);

        // Hero Slider functionality - Enhanced and Fixed
        let currentHeroSlide = 0;
        let heroSlides;
        const totalHeroSlides = 3;
        let heroSliderInterval;

        function showHeroSlide(index) {
            console.log('Showing hero slide:', index); // Debug log
            if (heroSlides) {
                heroSlides.style.transform = `translateX(-${index * 100}%)`;
                heroSlides.style.transition = 'transform 0.5s ease-in-out';
                currentHeroSlide = index;
            }
        }

        function nextHeroSlide() {
            currentHeroSlide = (currentHeroSlide + 1) % totalHeroSlides;
            showHeroSlide(currentHeroSlide);
        }

        // Initialize hero slider when DOM is ready
        function initHeroSlider() {
            console.log('Initializing hero slider...'); // Debug log
            heroSlides = document.getElementById('heroSlides');
            console.log('Hero slides element:', heroSlides); // Debug log

            if (heroSlides) {
                console.log('Hero slider found, starting...'); // Debug log
                // Clear any existing interval
                if (heroSliderInterval) {
                    clearInterval(heroSliderInterval);
                }

                // Start the slider
                showHeroSlide(0);

                // Auto-advance every 2 seconds
                heroSliderInterval = setInterval(nextHeroSlide, 2000);
                console.log('Hero slider interval set for 2 seconds'); // Debug log
            } else {
                console.error('Hero slides element not found!'); // Debug log
            }
        }

        // Initialize hero slider on page load - Multiple approaches for reliability
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded - initializing hero slider');
            initHeroSlider();
        });

        // Backup initialization
        window.addEventListener('load', function() {
            console.log('Window loaded - backup hero slider initialization');
            if (!heroSliderInterval) {
                initHeroSlider();
            }
        });

        // Immediate initialization if DOM is already ready
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            console.log('DOM already ready - immediate hero slider initialization');
            setTimeout(initHeroSlider, 100);
        }

        // Enhanced Event registration functions
        function openEventRegistrationModal(eventId) {
            currentEventId = eventId;
            document.getElementById('event_id').value = eventId;
            const modal = document.getElementById('eventRegistrationModal');
            const modalContent = modal.querySelector('.modal-content');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // Add entrance animation
            setTimeout(() => {
                modalContent.style.transform = 'scale(1)';
                modalContent.style.opacity = '1';
            }, 10);

            // Add form field animations
            const inputs = modal.querySelectorAll('input, textarea');
            inputs.forEach((input, index) => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focused');
                });

                input.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.add('border-teal-300', 'bg-white');
                        this.classList.remove('border-gray-200', 'bg-gray-50');
                    } else {
                        this.classList.remove('border-teal-300', 'bg-white');
                        this.classList.add('border-gray-200', 'bg-gray-50');
                    }
                });
            });
        }

        function closeEventRegistrationModal() {
            const modal = document.getElementById('eventRegistrationModal');
            if (!modal) return;

            const modalContent = modal.querySelector('.modal-content');
            if (modalContent) {
                // Add exit animation
                modalContent.style.transform = 'scale(0.95)';
                modalContent.style.opacity = '0';
            }

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                // Reset form
                const form = document.getElementById('eventRegistrationForm');
                if (form) form.reset();
            }, 300);
        }

        function openEventDetailsModal(eventId) {
            currentEventId = eventId;
            // Fetch event details
            fetch(`/api/events/${eventId}`)
                .then(response => response.json())
                .then(event => {
                    currentEventTitle = event.title;
                    const content = `
                        <div class="space-y-6">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">${event.title}</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span><strong>Start:</strong> ${new Date(event.start_date).toLocaleDateString('en-US', {
                                            year: 'numeric',
                                            month: 'long',
                                            day: 'numeric',
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        })}</span>
                                    </div>
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span><strong>End:</strong> ${new Date(event.end_date).toLocaleDateString('en-US', {
                                            year: 'numeric',
                                            month: 'long',
                                            day: 'numeric',
                                            hour: '2-digit',
                                            minute: '2-digit'
                                        })}</span>
                                    </div>
                                </div>
                                <div class="flex items-center text-gray-600 mb-4">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span><strong>Location:</strong> ${event.location}</span>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-2">Description</h4>
                                <p class="text-gray-700 leading-relaxed">${event.description}</p>
                            </div>
                            ${event.what_are_we_looking_for ? `
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    What Are We Looking For?
                                </h4>
                                <div class="bg-orange-50 border border-orange-200 rounded-lg p-4">
                                    <p class="text-gray-700 leading-relaxed">${event.what_are_we_looking_for}</p>
                                </div>
                            </div>
                            ` : ''}
                        </div>
                    `;
                    document.getElementById('eventDetailsContent').innerHTML = content;
                    const detailsModal = document.getElementById('eventDetailsModal');
                    detailsModal.classList.remove('hidden');
                    detailsModal.classList.add('flex');
                })
                .catch(error => {
                    console.error('Error fetching event details:', error);
                    alert('Error loading event details. Please try again.');
                });
        }

        function closeEventDetailsModal() {
            const detailsModal = document.getElementById('eventDetailsModal');
            detailsModal.classList.add('hidden');
            detailsModal.classList.remove('flex');
        }

        function registerFromDetails() {
            closeEventDetailsModal();
            openEventRegistrationModal(currentEventId);
        }

        // Add validation for event registration form and scholarship modal
        document.addEventListener('DOMContentLoaded', function() {
            const eventPhoneInput = document.getElementById('volunteer_phone');
            const eventEmailInput = document.getElementById('volunteer_email');
            const scholarshipPhoneInput = document.getElementById('welcome_phone_number');
            const scholarshipEmailInput = document.getElementById('welcome_email');

            // Event registration phone number validation
            if (eventPhoneInput) {
                // Prevent non-numeric input
                eventPhoneInput.addEventListener('keypress', function(e) {
                    // Allow only digits (0-9)
                    if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'Tab', 'Enter', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                        e.preventDefault();
                    }
                });

                eventPhoneInput.addEventListener('input', function(e) {
                    // Remove any non-digit characters
                    let value = e.target.value.replace(/\D/g, '');

                    // Limit to 11 digits
                    if (value.length > 11) {
                        value = value.slice(0, 11);
                    }

                    e.target.value = value;
                });

                eventPhoneInput.addEventListener('blur', function(e) {
                    const phone = e.target.value.replace(/\D/g, '');
                    if (phone.length !== 11) {
                        alert('Phone number must be exactly 11 digits.');
                        e.target.focus();
                    }
                });

                // Prevent paste of non-numeric content
                eventPhoneInput.addEventListener('paste', function(e) {
                    e.preventDefault();
                    let paste = (e.clipboardData || window.clipboardData).getData('text');
                    let numericOnly = paste.replace(/\D/g, '');
                    if (numericOnly.length <= 11) {
                        e.target.value = numericOnly;
                    }
                });
            }

            // Event registration email validation
            if (eventEmailInput) {
                eventEmailInput.addEventListener('blur', function(e) {
                    const email = e.target.value;
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (!emailRegex.test(email)) {
                        alert('Please enter a valid email address.');
                        e.target.focus();
                    }
                });
            }

            // Scholarship modal phone number validation
            if (scholarshipPhoneInput) {
                // Prevent non-numeric input
                scholarshipPhoneInput.addEventListener('keypress', function(e) {
                    // Allow only digits (0-9)
                    if (!/[0-9]/.test(e.key) && !['Backspace', 'Delete', 'Tab', 'Enter', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                        e.preventDefault();
                    }
                });

                scholarshipPhoneInput.addEventListener('input', function(e) {
                    // Remove any non-digit characters
                    let value = e.target.value.replace(/\D/g, '');

                    // Limit to 11 digits
                    if (value.length > 11) {
                        value = value.slice(0, 11);
                    }

                    e.target.value = value;
                });

                scholarshipPhoneInput.addEventListener('blur', function(e) {
                    const phone = e.target.value.replace(/\D/g, '');
                    if (phone.length !== 11) {
                        alert('Phone number must be exactly 11 digits.');
                        e.target.focus();
                    }
                });

                // Prevent paste of non-numeric content
                scholarshipPhoneInput.addEventListener('paste', function(e) {
                    e.preventDefault();
                    let paste = (e.clipboardData || window.clipboardData).getData('text');
                    let numericOnly = paste.replace(/\D/g, '');
                    if (numericOnly.length <= 11) {
                        e.target.value = numericOnly;
                    }
                });
            }

            // Scholarship modal email validation
            if (scholarshipEmailInput) {
                scholarshipEmailInput.addEventListener('blur', function(e) {
                    const email = e.target.value;
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (!emailRegex.test(email)) {
                        alert('Please enter a valid email address.');
                        e.target.focus();
                    }
                });
            }

            // Scholarship form submission validation
            const scholarshipForm = document.querySelector('#scholarshipApplicationModal form');
            if (scholarshipForm) {
                scholarshipForm.addEventListener('submit', function(e) {
                    const phone = scholarshipPhoneInput.value.replace(/\D/g, '');
                    const email = scholarshipEmailInput.value;
                    const termsCheckbox = document.getElementById('welcome_terms');
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    if (phone.length !== 11) {
                        e.preventDefault();
                        alert('Phone number must be exactly 11 digits.');
                        scholarshipPhoneInput.focus();
                        return;
                    }

                    if (!emailRegex.test(email)) {
                        e.preventDefault();
                        alert('Please enter a valid email address.');
                        scholarshipEmailInput.focus();
                        return;
                    }

                    if (!termsCheckbox.checked) {
                        e.preventDefault();
                        alert('You must agree to the Terms and Conditions to submit your application.');
                        termsCheckbox.focus();
                        return;
                    }
                });
            }
        });

        function submitEventRegistration(event) {
            event.preventDefault();

            // Validate before submission
            const phoneInput = document.getElementById('volunteer_phone');
            const emailInput = document.getElementById('volunteer_email');
            const termsCheckbox = document.getElementById('event_terms_agreement');

            const phone = phoneInput.value.replace(/\D/g, '');
            const email = emailInput.value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (phone.length !== 11) {
                alert('Phone number must be exactly 11 digits.');
                phoneInput.focus();
                return;
            }

            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                emailInput.focus();
                return;
            }

            if (!termsCheckbox.checked) {
                alert('You must agree to the Terms and Conditions to submit your registration.');
                termsCheckbox.focus();
                return;
            }

            // Validate file upload
            const fileInput = document.getElementById('valid_id');
            if (!fileInput.files || fileInput.files.length === 0) {
                alert('Please upload a valid ID.');
                fileInput.focus();
                return;
            }

            // Check file size (5MB limit)
            const file = fileInput.files[0];
            if (file.size > 5 * 1024 * 1024) {
                alert('File size must be less than 5MB.');
                fileInput.focus();
                return;
            }

            const form = event.target;
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnContent = submitBtn.innerHTML;

            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Submitting...
            `;

            const formData = new FormData(form);

            // Send to backend
            fetch('/volunteer/event-registration', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    // Show success animation
                    submitBtn.innerHTML = `
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Success!
                    `;

                    setTimeout(() => {
                        alert('Registration submitted successfully! You will be notified about the status.');
                        closeEventRegistrationModal();
                    }, 1000);
                } else {
                    alert('Error: ' + result.message);
                    // Reset button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnContent;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
                // Reset button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnContent;
            });
        }

        // Add scroll animation observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.animate-on-scroll').forEach((el) => observer.observe(el));

        // Enhanced slider animations
        function showSlide(index) {
            slidesContainer.style.transform = `translateX(-${index * 100}%)`;
            slidesContainer.style.transition = 'transform 0.7s cubic-bezier(0.4, 0, 0.2, 1)';

            dots.forEach((dot, i) => {
                dot.classList.toggle('bg-primary', i === index);
                dot.classList.toggle('bg-gray-300', i !== index);
            });

            currentSlide = index;
        }

        // Enhanced impact slider animations
        function showImpactSlide(index) {
            impactSlides.style.transform = `translateX(-${index * 100}%)`;
            impactSlides.style.transition = 'transform 0.7s cubic-bezier(0.4, 0, 0.2, 1)';
            currentImpactSlide = index;
        }



        async function handleLogin(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const loginError = document.getElementById('loginError');
            loginError.classList.add('hidden');

            try {
                const response = await fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify({
                        email: formData.get('email'),
                        password: formData.get('password'),
                        _token: document.querySelector('meta[name="csrf-token"]').content
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    // Redirect to dashboard on successful login
                    window.location.href = '/dashboard';
                } else {
                    // Show error message
                    loginError.textContent = data.message || 'Invalid credentials';
                    loginError.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Login error:', error);
                loginError.textContent = 'An error occurred. Please try again.';
                loginError.classList.remove('hidden');
            }
        }

        async function handleRegister(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            try {
                const response = await fetch('/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(Object.fromEntries(formData))
                });

                if (response.ok) {
                    window.location.href = '/dashboard';
                } else {
                    const data = await response.json();
                    const errorDiv = document.getElementById('registerError');
                    errorDiv.textContent = data.message || 'Registration failed';
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                console.error('Registration error:', error);
            }
        }

        // Tracking tab switching function
        function switchTrackingTab(type) {
            const scholarshipTab = document.getElementById('scholarshipTab');
            const volunteerTab = document.getElementById('volunteerTab');
            const scholarshipTracking = document.getElementById('scholarshipTracking');
            const volunteerTracking = document.getElementById('volunteerTracking');

            if (type === 'scholarship') {
                // Update tab styles
                scholarshipTab.classList.add('bg-primary', 'text-white');
                scholarshipTab.classList.remove('text-gray-600');
                volunteerTab.classList.remove('bg-primary', 'text-white');
                volunteerTab.classList.add('text-gray-600');

                // Show/hide forms
                scholarshipTracking.classList.remove('hidden');
                volunteerTracking.classList.add('hidden');
            } else {
                // Update tab styles
                volunteerTab.classList.add('bg-primary', 'text-white');
                volunteerTab.classList.remove('text-gray-600');
                scholarshipTab.classList.remove('bg-primary', 'text-white');
                scholarshipTab.classList.add('text-gray-600');

                // Show/hide forms
                volunteerTracking.classList.remove('hidden');
                scholarshipTracking.classList.add('hidden');
            }
        }

        // Auto-format tracking code inputs
        document.addEventListener('DOMContentLoaded', function() {
            const trackingInputs = document.querySelectorAll('#scholarship_tracking_code, #volunteer_tracking_code');
            trackingInputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    e.target.value = e.target.value.toUpperCase();
                });
            });

            // Counter animation for statistics
            const counters = document.querySelectorAll('.counter');
            const animateCounter = (counter) => {
                const target = parseInt(counter.getAttribute('data-target'));
                const increment = target / 100;
                let current = 0;

                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.ceil(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };

                updateCounter();
            };

            // Intersection Observer for counter animation
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        if (!counter.classList.contains('animated')) {
                            counter.classList.add('animated');
                            animateCounter(counter);
                        }
                    }
                });
            }, {
                threshold: 0.5
            });

            counters.forEach(counter => {
                counterObserver.observe(counter);
            });
        });




    </script>
</body>
</html>