<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capstone Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-50 to-indigo-100 text-gray-800">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-indigo-700 to-blue-600 text-white py-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h1 class="text-5xl font-extrabold mb-6">Projects Management Platform</h1>
            <p class="text-lg max-w-3xl mx-auto leading-relaxed">
                A unified system to manage <span class="font-semibold">Programs, Facilities, Services, Equipment, Projects, Participants, and Outcomes</span>,
                driving Uganda’s NDPIII, Digital Transformation Roadmap (2023–2028), and 4IR Strategy.
            </p>
            <div class="mt-8 space-x-4">
                <a href="{{ route('facilities.index') }}" class="bg-white text-indigo-700 px-6 py-3 rounded-lg shadow hover:bg-gray-100 font-semibold">
                    Explore Facilities
                </a>
                <a href="#" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg shadow hover:bg-yellow-300 font-semibold">
                    View Programs
                </a>
            </div>
        </div>
    </section>

    <!-- Feature Grid -->
    <section class="py-16 max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center mb-12">Core Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="bg-white rounded-2xl shadow p-6 text-center hover:scale-105 transition">
                <h3 class="text-xl font-bold mb-2">Programs</h3>
                <p class="text-gray-600">Organize work under national goals and strategic phases.</p>
            </div>
            
            <a href="{{ route('facilities.index') }}">
                <div class="bg-white rounded-2xl shadow p-6 text-center hover:scale-105 transition">
                <h3 class="text-xl font-bold mb-2">Facilities</h3>
                <p class="text-gray-600">Government labs, workshops, and testing centers as project anchors.</p>
            </div>
            </a>

            <div class="bg-white rounded-2xl shadow p-6 text-center hover:scale-105 transition">
                <h3 class="text-xl font-bold mb-2">Services</h3>
                <p class="text-gray-600">Match project needs with machining, testing, and training services.</p>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 text-center hover:scale-105 transition">
                <h3 class="text-xl font-bold mb-2">Equipment</h3>
                <p class="text-gray-600">Track available machinery and tools for prototyping and testing.</p>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 text-center hover:scale-105 transition">
                <h3 class="text-xl font-bold mb-2">Projects</h3>
                <p class="text-gray-600">Student and lecturer collaboration with clear stages and goals.</p>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 text-center hover:scale-105 transition">
                <h3 class="text-xl font-bold mb-2">Participants</h3>
                <p class="text-gray-600">Manage diverse contributors across institutions and roles.</p>
            </div>

            <div class="bg-white rounded-2xl shadow p-6 text-center hover:scale-105 transition md:col-span-3">
                <h3 class="text-xl font-bold mb-2">Outcomes</h3>
                <p class="text-gray-600">Capture prototypes, CAD files, reports, and commercialization pathways.</p>
            </div>

        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-indigo-700 text-white py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-4">Empowering Students & Innovators</h2>
            <p class="mb-6 max-w-2xl mx-auto">
                Join multidisciplinary teams to build real-world solutions in line with Uganda’s Digital Transformation Roadmap and 4IR Strategy.
            </p>
            <a href="{{ url('/facilities') }}" class="bg-yellow-400 text-gray-900 px-6 py-3 rounded-lg shadow hover:bg-yellow-300 font-semibold">
                Get Started
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-6 text-center">
        <p>&copy; {{ date('Y') }} Projects Platform. Built for innovation and collaboration.</p>
    </footer>

</body>
</html>
