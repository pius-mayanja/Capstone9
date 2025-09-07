<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KEPHALEN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        .hero-bg {
            background: linear-gradient(120deg, rgba(67, 56, 202, 0.9), rgba(79, 70, 229, 0.85)), url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80');
            background-size: cover;
            background-position: center;
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .feature-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #6366F1, #4F46E5);
            color: white;
            font-size: 1.8rem;
        }
        .counter {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #6366F1, #4F46E5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .animated-bg {
            animation: gradientShift 8s ease infinite;
            background-size: 200% 200%;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .typewriter {
            overflow: hidden;
            border-right: .15em solid #4F46E5;
            white-space: nowrap;
            margin: 0 auto;
            letter-spacing: .05em;
            animation: typing 3.5s steps(40, end), blink-caret .75s step-end infinite;
        }
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: #4F46E5; }
        }
    </style>
</head>
<body class="bg-gradient-to-r from-blue-50 to-indigo-100 text-gray-800" x-data="{ mobileMenuOpen: false }">
    <!-- Header with Navigation -->
    <header class="sticky top-0 z-50 bg-white shadow-md">
        <div class="max-w-6xl mx-auto px-6 py-3 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-indigo-700 flex items-center">
                <i class="fas fa-cubes mr-2"></i> KEPHALEN
            </a>
            
            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-8">
                <a href="#" class="text-indigo-700 font-medium border-b-2 border-indigo-700">Home</a>
                <a href="{{ route('facilities.index') }}" class="hover:text-indigo-700 transition">Facilities</a>
                <a href="{{ route('programs.index') }}" class="hover:text-indigo-700 transition">Programs</a>
                <a href="#" class="hover:text-indigo-700 transition">Projects</a>
                <a href="#" class="hover:text-indigo-700 transition">Participants</a>
                <a href="{{ route('services.index') }}" class="hover:text-indigo-700 transition">Services</a>
                <a href="#" class="hover:text-indigo-700 transition">Equipments</a>
            </nav>
            
            <!-- Mobile menu button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-600">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
        
        <!-- Mobile Navigation -->
        <div x-show="mobileMenuOpen" class="md:hidden bg-white py-4 px-6 shadow-lg" style="display: none;">
            <div class="flex flex-col space-y-4">
                <a href="#" class="text-indigo-700 font-medium">Home</a>
                <a href="{{ route('facilities.index') }}" class="hover:text-indigo-700 transition">Facilities</a>
                <a href="{{ route('programs.index') }}" class="hover:text-indigo-700 transition">Programs</a>
                <a href="#" class="hover:text-indigo-700 transition">Projects</a>
                <a href="#" class="hover:text-indigo-700 transition">About</a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-bg text-white py-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-6 animate-pulse">Projects Management Platform</h1>
            <p class="text-lg max-w-3xl mx-auto leading-relaxed mb-8">
                A unified system to manage <span class="font-semibold bg-indigo-500 px-2 py-1 rounded">Programs</span>, 
                <span class="font-semibold bg-indigo-500 px-2 py-1 rounded">Facilities</span>, 
                <span class="font-semibold bg-indigo-500 px-2 py-1 rounded">Services</span>, 
                <span class="font-semibold bg-indigo-500 px-2 py-1 rounded">Equipment</span>, 
                and more—driving Uganda's digital transformation.
            </p>
            <div class="mt-8 space-x-4">
                <a href="{{ route('facilities.index') }}" class="bg-white text-indigo-700 px-6 py-3 rounded-lg shadow-lg hover:bg-gray-100 font-semibold transform hover:scale-105 transition duration-300">
                    <i class="fas fa-building mr-2"></i> Explore Facilities
                </a>
                <a href="{{ route('programs.index') }}" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg shadow-lg hover:bg-yellow-300 font-semibold transform hover:scale-105 transition duration-300">
                    <i class="fas fa-project-diagram mr-2"></i> View Programs
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-white">
        <div class="max-w-8xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-6 gap-6 text-center">
                <div class="p-4">
                    <div class="counter" x-data="{ count: 0, target: 127 }" x-intersect="() => { 
                        let interval = setInterval(() => { 
                            if (count < target) count++; 
                            else clearInterval(interval); 
                        }, 15); 
                    }" x-text="count">0</div>
                    <p class="text-gray-600">Facilities</p>
                </div>
                <div class="p-4">
                    <div class="counter" x-data="{ count: 0, target: 42 }" x-intersect="() => { 
                        let interval = setInterval(() => { 
                            if (count < target) count++; 
                            else clearInterval(interval); 
                        }, 30); 
                    }" x-text="count">0</div>
                    <p class="text-gray-600">Active Programs</p>
                </div>
                   <div class="p-4">
                    <div class="counter" x-data="{ count: 0, target: 358 }" x-intersect="() => { 
                        let interval = setInterval(() => { 
                            if (count < target) count++; 
                            else clearInterval(interval); 
                        }, 10); 
                    }" x-text="count">0</div>
                    <p class="text-gray-600">Projects</p>
                </div>
                <div class="p-4">
                    <div class="counter" x-data="{ count: 0, target: 358 }" x-intersect="() => { 
                        let interval = setInterval(() => { 
                            if (count < target) count++; 
                            else clearInterval(interval); 
                        }, 10); 
                    }" x-text="count">0</div>
                    <p class="text-gray-600">Participants</p>
                </div>
                <div class="p-4">
                    <div class="counter" x-data="{ count: 0, target: 16 }" x-intersect="() => { 
                        let interval = setInterval(() => { 
                            if (count < target) count++; 
                            else clearInterval(interval); 
                        }, 100); 
                    }" x-text="count">0</div>
                    <p class="text-gray-600">Services</p>
                </div>
                <div class="p-4">
                    <div class="counter" x-data="{ count: 0, target: 16 }" x-intersect="() => { 
                        let interval = setInterval(() => { 
                            if (count < target) count++; 
                            else clearInterval(interval); 
                        }, 100); 
                    }" x-text="count">0</div>
                    <p class="text-gray-600">Equipment</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Grid -->
    <section class="py-16 max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-4">Core Features</h2>
        <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Our platform provides comprehensive tools to manage all aspects of innovation projects in line with Uganda's development goals</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 text-center card-hover">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-list-alt"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Programs</h3>
                <p class="text-gray-600">Organize work under national goals and strategic phases.</p>
            </div>
            
            <a href="{{ route('facilities.index') }}" class="block card-hover">
                <div class="bg-white rounded-2xl shadow-lg p-6 text-center h-full">
                    <div class="feature-icon mx-auto">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Facilities</h3>
                    <p class="text-gray-600">Government labs, workshops, and testing centers as project anchors.</p>
                </div>
            </a>

            <div class="bg-white rounded-2xl shadow-lg p-6 text-center card-hover">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Services</h3>
                <p class="text-gray-600">Match project needs with machining, testing, and training services.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 text-center card-hover">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-tools"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Equipment</h3>
                <p class="text-gray-600">Track available machinery and tools for prototyping and testing.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 text-center card-hover">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-tasks"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Projects</h3>
                <p class="text-gray-600">Student and lecturer collaboration with clear stages and goals.</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 text-center card-hover">
                <div class="feature-icon mx-auto">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">Participants</h3>
                <p class="text-gray-600">Manage diverse contributors across institutions and roles.</p>
            </div>
        </div>
        
        <div class="mt-8">
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-lg p-8 text-center text-white card-hover">
                <div class="feature-icon mx-auto bg-white text-indigo-700">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="text-2xl font-bold mb-2">Outcomes</h3>
                <p class="opacity-90">Capture prototypes, CAD files, reports, and commercialization pathways.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">What Our Users Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-2xl shadow-lg card-hover">
                    <div class="text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"This platform has revolutionized how we manage our capstone projects. The collaboration features are exceptional!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold mr-3">JD</div>
                        <div>
                            <h4 class="font-semibold">John Doe</h4>
                            <p class="text-sm text-gray-500">Professor at Makerere University</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-2xl shadow-lg card-hover">
                    <div class="text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"Finding the right equipment and facilities for our project was never easier. This platform saved us weeks of work!"</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white font-bold mr-3">AS</div>
                        <div>
                            <h4 class="font-semibold">Alice Smith</h4>
                            <p class="text-sm text-gray-500">Engineering Student</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-2xl shadow-lg card-hover">
                    <div class="text-yellow-400 mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="text-gray-600 mb-4">"The outcome tracking system helps us demonstrate the real impact of our projects to stakeholders effectively."</p>
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-3">RJ</div>
                        <div>
                            <h4 class="font-semibold">Robert Johnson</h4>
                            <p class="text-sm text-gray-500">Government Official</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 animated-bg bg-gradient-to-r from-indigo-700 via-purple-700 to-indigo-700 text-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Empowering Students & Innovators</h2>
            <p class="mb-8 max-w-2xl mx-auto text-lg">
                Join multidisciplinary teams to build real-world solutions in line with Uganda's Digital Transformation Roadmap and 4IR Strategy.
            </p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ url('/facilities') }}" class="bg-yellow-400 text-gray-900 px-8 py-3 rounded-lg shadow-lg hover:bg-yellow-300 font-semibold transform hover:scale-105 transition duration-300">
                    Get Started
                </a>
                <a href="#" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg shadow-lg hover:bg-white hover:text-indigo-700 font-semibold transform hover:scale-105 transition duration-300">
                    Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">KEPHALEN</h3>
                    <p class="mb-4">Driving innovation and collaboration for Uganda's digital transformation.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('facilities.index') }}" class="hover:text-white transition">Facilities</a></li>
                        <li><a href="{{ route('programs.index') }}" class="hover:text-white transition">Programs</a></li>
                        <li><a href="#" class="hover:text-white transition">Projects</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Resources</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Documentation</a></li>
                        <li><a href="#" class="hover:text-white transition">Tutorials</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQs</a></li>
                        <li><a href="#" class="hover:text-white transition">Support</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Contact Us</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-2"></i>
                            <span>123 Innovation Drive, Kampala, Uganda</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-phone mt-1 mr-2"></i>
                            <span>+256 750 123 456</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-2"></i>
                            <span>info@capplatform.org</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-sm text-center">
                <p>&copy; {{ date('Y') }} KEPHALEN. Built for innovation and collaboration.</p>
            </div>
        </div>
    </footer>

</body>
</html>