<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <title>Unciano Colleges Antipolo, Inc. | Official Website</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
        .carousel-container { overflow: hidden; position: relative; }
        .carousel-track { display: flex; transition: transform 0.5s ease-in-out; }
        .carousel-slide { min-width: 100%; }
        .events-track { display: flex; transition: transform 0.5s ease-in-out; gap: 1.5rem; }
        .event-card { min-width: calc(25% - 1.125rem); }
        @media (max-width: 1024px) { .event-card { min-width: calc(50% - 0.75rem); } }
        @media (max-width: 640px) { .event-card { min-width: 100%; } }
        .gradient-overlay { background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.7)); }
        .nav-link { position: relative; }
        .nav-link::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 2px; background: #1e40af; transition: width 0.3s; }
        .nav-link:hover::after { width: 100%; }
    </style>
</head>
<body class="bg-white">

    <!-- Header Navigation -->
    <header id="header" class="sticky top-0 z-50 bg-white backdrop-blur-sm shadow-md transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="School Logo" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <h1 class="text-lg font-bold text-blue-900 leading-tight">Unciano Colleges</h1>
                        <p class="text-xs text-gray-500">Antipolo, Inc.</p>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center gap-8">
                    <a href="#home" class="nav-link text-gray-700 hover:text-blue-800 font-medium transition-colors">Home</a>
                    <a href="#events" class="nav-link text-gray-700 hover:text-blue-800 font-medium transition-colors">Events</a>
                    <a href="#about" class="nav-link text-gray-700 hover:text-blue-800 font-medium transition-colors">About</a>
                    <a href="#programs" class="nav-link text-gray-700 hover:text-blue-800 font-medium transition-colors">Programs</a>
                    <a href="#contact" class="nav-link text-gray-700 hover:text-blue-800 font-medium transition-colors">Contact</a>
                    <a href="{{ route('navigate') }}" class="text-gray-700 hover:text-blue-800 font-medium transition-colors">Portal</a>
                </nav>

                <!-- Apply Now Button -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('applicant.form') }}" class="hidden sm:inline-flex px-6 py-2.5 bg-blue-800 hover:bg-blue-900 text-white font-semibold rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Apply Now
                    </a>
                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuBtn" class="md:hidden p-2 text-gray-700 hover:text-blue-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobileMenu" class="md:hidden hidden pb-4">
                <nav class="flex flex-col gap-2">
                    <a href="#home" class="px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg">Home</a>
                    <a href="#events" class="px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg">Events</a>
                    <a href="#about" class="px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg">About</a>
                    <a href="#programs" class="px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg">Programs</a>
                    <a href="#contact" class="px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg">Contact</a>
                    <a href="{{ route('navigate') }}" class="px-4 py-2 text-gray-700 hover:bg-blue-50 rounded-lg">Portal</a>
                    <a href="{{ route('applicant.form') }}" class="mx-4 mt-2 px-4 py-2 bg-blue-800 text-white text-center rounded-full">Apply Now</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Section 1: Hero Carousel -->
    <section id="home" class="">
        <div class="carousel-container relative h-[600px] lg:h-[700px]">
            <div class="carousel-track h-full" id="heroCarousel">
                <!-- Slide 1 -->
                <div class="carousel-slide relative h-full">
                    <img src="{{ asset('images/hero1.jpg') }}" alt="Campus" class="w-full h-full object-cover">
                    <div class="absolute inset-0 gradient-overlay flex items-center justify-center">
                        <div class="text-center text-white px-4">
                            <h2 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-4 drop-shadow-lg">Unciano Colleges Antipolo, Inc.</h2>
                            <p class="text-xl md:text-2xl font-light mb-8">Empowering Minds, Building Futures</p>
                            <a href="{{ route('applicant.form') }}" class="inline-block px-8 py-4 bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-bold rounded-full text-lg transition-all transform hover:scale-105">
                                Start Your Journey
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-slide relative h-full">
                    <img src="{{ asset('images/hero2.jpg') }}" alt="Graduation" class="w-full h-full object-cover">
                    <div class="absolute inset-0 gradient-overlay flex items-center justify-center">
                        <div class="text-center text-white px-4">
                            <h2 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-4 drop-shadow-lg">Excellence in Education</h2>
                            <p class="text-xl md:text-2xl font-light mb-8">Quality Learning Experience Since 1985</p>
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-slide relative h-full">
                    <img src="{{ asset('images/hero3.jpg') }}" alt="Event" class="w-full h-full object-cover">
                    <div class="absolute inset-0 gradient-overlay flex items-center justify-center">
                        <div class="text-center text-white px-4">
                            <h2 class="text-4xl md:text-6xl lg:text-7xl font-extrabold mb-4 drop-shadow-lg">Your Future Starts Here</h2>
                            <p class="text-xl md:text-2xl font-light mb-8">Join Our Growing Community of Achievers</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Carousel Controls -->
            <button id="prevHero" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 p-3 rounded-full backdrop-blur-sm transition-all">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button id="nextHero" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/30 hover:bg-white/50 p-3 rounded-full backdrop-blur-sm transition-all">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
            <!-- Carousel Indicators -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
                <button class="hero-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all" data-slide="0"></button>
                <button class="hero-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all" data-slide="1"></button>
                <button class="hero-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all" data-slide="2"></button>
            </div>
        </div>
    </section>

    <!-- Section 2: Recent Events -->
    <section id="events" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">Recent Events</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Stay updated with the latest happenings and activities at Unciano Colleges</p>
            </div>

            <div class="relative">
                <div class="overflow-hidden">
                    <div class="events-track" id="eventsTrack">
                        <!-- Event Card 1 -->
                        <div class="event-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <img src="{{ asset('images/event1.jpg') }}" alt="Event" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <span class="text-sm text-blue-600 font-semibold">November 5, 2025</span>
                                <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">35th Commencement Exercises</h3>
                                <p class="text-gray-600 text-sm line-clamp-3">Celebrating the achievements of our graduates as they receive their diplomas and embark on new journeys.</p>
                            </div>
                        </div>
                        <!-- Event Card 2 -->
                        <div class="event-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <img src="{{ asset('images/event2.jpg') }}" alt="Event" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <span class="text-sm text-blue-600 font-semibold">September 4, 2025</span>
                                <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">Capping, White Coat, Pinning, and Candle Lighting Ceremonies 2025</h3>
                                <p class="text-gray-600 text-sm line-clamp-3">A sacred tradition honoring our healthcare students as they transition into clinical practice.</p>
                            </div>
                        </div>
                        <!-- Event Card 3 -->
                        <div class="event-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <img src="{{ asset('images/event3.jpg') }}" alt="Event" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <span class="text-sm text-blue-600 font-semibold">December 19, 2024</span>
                                <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">Uncianian's Sports Event 2024</h3>
                                <p class="text-gray-600 text-sm line-clamp-3">Annual intramurals featuring basketball, volleyball, and other sports competitions among departments.</p>
                            </div>
                        </div>
                        <!-- Event Card 4 -->
                        <div class="event-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <img src="{{ asset('images/event4.jpg') }}" alt="Event" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <span class="text-sm text-blue-600 font-semibold">November 8, 2024</span>
                                <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">The 34th Commencement Exercises</h3>
                                <p class="text-gray-600 text-sm line-clamp-3">Honoring the Class of 2024 as they complete their academic journey and step into new beginnings.</p>
                            </div>
                        </div>
                        <!-- Event Card 5 -->
                        <div class="event-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <img src="{{ asset('images/event5.jpg') }}" alt="Event" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <span class="text-sm text-blue-600 font-semibold">September 19, 2018</span>
                                <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">Dental Check Up with Dr. Audie Equila (S.Y. 2018-2019)</h3>
                                <p class="text-gray-600 text-sm line-clamp-3">Free dental consultation and check-up for students promoting oral health awareness on campus.</p>
                            </div>
                        </div>
                        <!-- Event Card 6 -->
                        <div class="event-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            <img src="{{ asset('images/event6.jpg') }}" alt="Event" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <span class="text-sm text-blue-600 font-semibold">August 31, 2018</span>
                                <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">College Night Masquerade</h3>
                                <p class="text-gray-600 text-sm line-clamp-3">An elegant evening of mystery and celebration where students showcase their creativity through masquerade.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Event Navigation -->
                <button id="prevEvent" class="absolute -left-4 top-1/2 -translate-y-1/2 bg-white shadow-lg hover:shadow-xl p-3 rounded-full transition-all z-10">
                    <svg class="w-5 h-5 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button id="nextEvent" class="absolute -right-4 top-1/2 -translate-y-1/2 bg-white shadow-lg hover:shadow-xl p-3 rounded-full transition-all z-10">
                    <svg class="w-5 h-5 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Section 3 & 4: Mission & Vision -->
    <section id="about" class="py-20 bg-blue-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Mission -->
                <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 lg:p-12 border border-white/20">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-4 bg-yellow-500 rounded-2xl">
                            <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-white">Our Mission</h2>
                    </div>
                    <p class="text-white/90 text-lg leading-relaxed">
                        To provide quality and affordable education that develops competent, morally upright, and socially responsible individuals who are equipped with the knowledge, skills, and values necessary for lifelong learning and global competitiveness.
                    </p>
                </div>
                <!-- Vision -->
                <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 lg:p-12 border border-white/20">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-4 bg-yellow-500 rounded-2xl">
                            <svg class="w-8 h-8 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-white">Our Vision</h2>
                    </div>
                    <p class="text-white/90 text-lg leading-relaxed">
                        To be a leading institution of higher learning in the region, recognized for academic excellence, innovative research, and community service, producing graduates who are catalysts of positive change in society.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Goals for Students -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">What We Develop in Our Students</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Building well-rounded individuals ready to lead and succeed</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Leadership -->
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto mb-6 bg-blue-100 rounded-2xl flex items-center justify-center group-hover:bg-blue-800 transition-colors duration-300">
                        <svg class="w-10 h-10 text-blue-800 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Leadership</h3>
                    <p class="text-gray-600">Inspiring others to achieve shared goals and make a positive impact.</p>
                </div>
                <!-- Critical Thinking -->
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto mb-6 bg-green-100 rounded-2xl flex items-center justify-center group-hover:bg-green-600 transition-colors duration-300">
                        <svg class="w-10 h-10 text-green-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Critical Thinking</h3>
                    <p class="text-gray-600">Analyzing situations and making informed, logical decisions.</p>
                </div>
                <!-- Innovation -->
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto mb-6 bg-purple-100 rounded-2xl flex items-center justify-center group-hover:bg-purple-600 transition-colors duration-300">
                        <svg class="w-10 h-10 text-purple-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Innovation</h3>
                    <p class="text-gray-600">Creating new solutions and embracing technological advancement.</p>
                </div>
                <!-- Integrity -->
                <div class="text-center group">
                    <div class="w-20 h-20 mx-auto mb-6 bg-orange-100 rounded-2xl flex items-center justify-center group-hover:bg-orange-500 transition-colors duration-300">
                        <svg class="w-10 h-10 text-orange-500 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Integrity</h3>
                    <p class="text-gray-600">Upholding honesty, ethics, and moral values in all endeavors.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6: Programs Offered -->
    <section id="programs" class="relative py-20">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero1.jpg') }}" alt="Campus" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-white gradient-overlay"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-yellow-500 mb-4">Programs Offered</h2>
                <p class="text-white max-w-2xl mx-auto">Choose from our wide range of academic programs designed for your success</p>
            </div>

            <div class="space-y-6">
                <!-- Program 1 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="flex flex-col lg:flex-row">
                        <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400&h=300&fit=crop" alt="IT Program" class="w-full lg:w-80 h-48 lg:h-auto object-cover">
                        <div class="p-6 lg:p-8 flex-1">
                            <h3 class="text-2xl font-bold text-blue-900 mb-3">Bachelor of Science in Nursing</h3>
                            <p class="text-gray-600 mb-4">Prepare for a rewarding healthcare career with our comprehensive nursing program featuring clinical rotations, hands-on patient care, and board exam preparation.</p>
                        </div>
                    </div>
                </div>

                <!-- Program 2 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="flex flex-col lg:flex-row">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=400&h=300&fit=crop" alt="Business Program" class="w-full lg:w-80 h-48 lg:h-auto object-cover">
                        <div class="p-6 lg:p-8 flex-1">
                            <h3 class="text-2xl font-bold text-blue-900 mb-3">Bachelor of Science in Physical Therapy</h3>
                            <p class="text-gray-600 mb-4">Master rehabilitation sciences and help patients recover mobility through evidence-based therapeutic interventions and clinical practice.</p>
                        </div>
                    </div>
                </div>

                <!-- Program 3 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="flex flex-col lg:flex-row">
                        <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=400&h=300&fit=crop" alt="Education Program" class="w-full lg:w-80 h-48 lg:h-auto object-cover">
                        <div class="p-6 lg:p-8 flex-1">
                            <h3 class="text-2xl font-bold text-blue-900 mb-3">Bachelor in Science in Medical Technology</h3>
                            <p class="text-gray-600 mb-4">Become a clinical laboratory scientist skilled in diagnostic testing, laboratory procedures, and medical analysis to support healthcare delivery.</p>
                        </div>
                    </div>
                </div>

                <!-- Program 4 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="flex flex-col lg:flex-row">
                        <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop" alt="Nursing Program" class="w-full lg:w-80 h-48 lg:h-auto object-cover">
                        <div class="p-6 lg:p-8 flex-1">
                            <h3 class="text-2xl font-bold text-blue-900 mb-3">Bachelor of Science in Radiologic Technology</h3>
                            <p class="text-gray-600 mb-4">Specialize in medical imaging technologies including X-ray, CT scan, and MRI to diagnose and treat patients through radiological procedures.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 7: Location Map -->
    <section id="location" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">Visit Our Campus</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">We are conveniently located in the heart of Antipolo City</p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 rounded-2xl overflow-hidden shadow-lg h-[400px]">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.2538426850917!2d121.1749!3d14.5847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTTCsDM1JzA0LjkiTiAxMjHCsDEwJzI5LjYiRQ!5e0!3m2!1sen!2sph!4v1614567890123!5m2!1sen!2sph"
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="space-y-6">
                    <div class="bg-blue-50 rounded-2xl p-6">
                        <h3 class="text-lg font-bold text-blue-900 mb-4">Campus Address</h3>
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-600 mt-1 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <p class="text-gray-700">75 L. Sumulong Memorial Circle, Antipolo, Philippines, 1870</p>
                        </div>
                    </div>
                    <div class="bg-green-50 rounded-2xl p-6">
                        <h3 class="text-lg font-bold text-green-900 mb-4">Office Hours</h3>
                        <div class="space-y-2 text-gray-700">
                            <p><span class="font-semibold">Monday - Friday:</span> 8:00 AM - 5:00 PM</p>
                            <p><span class="font-semibold">Saturday:</span> 8:00 AM - 12:00 PM</p>
                            <p><span class="font-semibold">Sunday:</span> Closed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 8: Footer -->
    <footer id="contact" class="bg-blue-950 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12">
                <!-- School Info -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h3 class="font-bold text-lg">Unciano Colleges</h3>
                            <p class="text-sm text-blue-300">Antipolo, Inc.</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-blue-200">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-sm">75 L. Sumulong Memorial Circle, Antipolo, Philippines, 1870</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm">ucai.onlineenrollment@gmail.com</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm">ucai.onlinepayment@gmail.com</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-sm">286970174</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-sm">8697-0174</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-bold text-lg mb-6">Quick Links</h3>
                    <nav class="space-y-3">
                        <a href="#home" class="block text-blue-200 hover:text-white transition-colors">Home</a>
                        <a href="#events" class="block text-blue-200 hover:text-white transition-colors">Events</a>
                        <a href="#about" class="block text-blue-200 hover:text-white transition-colors">About Us</a>
                        <a href="#programs" class="block text-blue-200 hover:text-white transition-colors">Programs</a>
                        <a href="#location" class="block text-blue-200 hover:text-white transition-colors">Location</a>
                        <a href="{{ route('navigate') }}" class="block text-blue-200 hover:text-white transition-colors">Portal Login</a>
                    </nav>
                </div>

                <!-- Programs -->
                <div>
                    <h3 class="font-bold text-lg mb-6">Programs</h3>
                    <nav class="space-y-3">
                        <a href="#programs" class="block text-blue-200 hover:text-white transition-colors">Nursing</a>
                        <a href="#programs" class="block text-blue-200 hover:text-white transition-colors">Physical Therapy</a>
                        <a href="#programs" class="block text-blue-200 hover:text-white transition-colors">Medical Technology</a>
                        <a href="#programs" class="block text-blue-200 hover:text-white transition-colors">Radiologic Technology</a>
                    </nav>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="font-bold text-lg mb-6">Connect With Us</h3>
                    <div class="flex gap-4 mb-6">
                        <a href="https://facebook.com/UncianoCollegesInc" target="_blank" class="p-3 bg-blue-800 hover:bg-blue-700 rounded-full transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                        </a>
                    </div>
                    <a href="{{ route('applicant.form') }}" class="inline-block px-6 py-3 bg-yellow-500 hover:bg-yellow-400 text-blue-900 font-semibold rounded-full transition-colors">
                        Apply Now
                    </a>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-blue-800 mt-12 pt-8 text-center text-blue-300 text-sm">
                <p>&copy; {{ date('Y') }} Unciano Colleges Antipolo, Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu Toggle
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const mobileMenu = document.getElementById('mobileMenu');
            
            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // Hero Carousel
            const heroCarousel = document.getElementById('heroCarousel');
            const heroSlides = heroCarousel.querySelectorAll('.carousel-slide');
            const heroDots = document.querySelectorAll('.hero-dot');
            const prevHero = document.getElementById('prevHero');
            const nextHero = document.getElementById('nextHero');
            let currentHeroSlide = 0;
            let heroInterval;

            function showHeroSlide(index) {
                if (index >= heroSlides.length) index = 0;
                if (index < 0) index = heroSlides.length - 1;
                currentHeroSlide = index;
                heroCarousel.style.transform = `translateX(-${index * 100}%)`;
                heroDots.forEach((dot, i) => {
                    dot.classList.toggle('bg-white', i === index);
                    dot.classList.toggle('bg-white/50', i !== index);
                });
            }

            function nextHeroSlide() {
                showHeroSlide(currentHeroSlide + 1);
            }

            function prevHeroSlide() {
                showHeroSlide(currentHeroSlide - 1);
            }

            function startHeroAutoplay() {
                heroInterval = setInterval(nextHeroSlide, 5000);
            }

            function stopHeroAutoplay() {
                clearInterval(heroInterval);
            }

            prevHero.addEventListener('click', () => { stopHeroAutoplay(); prevHeroSlide(); startHeroAutoplay(); });
            nextHero.addEventListener('click', () => { stopHeroAutoplay(); nextHeroSlide(); startHeroAutoplay(); });
            heroDots.forEach((dot, i) => {
                dot.addEventListener('click', () => { stopHeroAutoplay(); showHeroSlide(i); startHeroAutoplay(); });
            });

            showHeroSlide(0);
            startHeroAutoplay();

            // Events Carousel
            const eventsTrack = document.getElementById('eventsTrack');
            const eventCards = eventsTrack.querySelectorAll('.event-card');
            const prevEvent = document.getElementById('prevEvent');
            const nextEvent = document.getElementById('nextEvent');
            let currentEventPosition = 0;
            let eventAutoplayInterval;

            function getVisibleCards() {
                if (window.innerWidth < 640) return 1;
                if (window.innerWidth < 1024) return 2;
                return 4;
            }

            function getCardWidth() {
                const card = eventCards[0];
                const gap = 24; // 1.5rem gap
                return card.offsetWidth + gap;
            }

            function slideEvents(direction) {
                const maxPosition = eventCards.length - getVisibleCards();
                currentEventPosition += direction;
                if (currentEventPosition < 0) currentEventPosition = maxPosition;
                if (currentEventPosition > maxPosition) currentEventPosition = 0;
                eventsTrack.style.transform = `translateX(-${currentEventPosition * getCardWidth()}px)`;
            }

            function startEventAutoplay() {
                eventAutoplayInterval = setInterval(() => slideEvents(1), 4000);
            }

            function stopEventAutoplay() {
                clearInterval(eventAutoplayInterval);
            }

            prevEvent.addEventListener('click', () => { stopEventAutoplay(); slideEvents(-1); startEventAutoplay(); });
            nextEvent.addEventListener('click', () => { stopEventAutoplay(); slideEvents(1); startEventAutoplay(); });

            startEventAutoplay();

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        const headerHeight = document.getElementById('header').offsetHeight;
                        const targetPosition = target.offsetTop - headerHeight;
                        window.scrollTo({ top: targetPosition, behavior: 'smooth' });
                        // Close mobile menu if open
                        mobileMenu.classList.add('hidden');
                    }
                });
            });

            // Header scroll effect
            let lastScroll = 0;
            window.addEventListener('scroll', function() {
                const header = document.getElementById('header');
                const currentScroll = window.pageYOffset;
                
                if (currentScroll > 100) {
                    header.classList.add('shadow-lg');
                } else {
                    header.classList.remove('shadow-lg');
                }
                
                lastScroll = currentScroll;
            });
        });
    </script>
</body>
</html>
