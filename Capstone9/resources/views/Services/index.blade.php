<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Services Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-indigo-700">
                    <i class="fas fa-concierge-bell mr-2"></i> Services
                </h1>
                <p class="text-sm text-gray-600 mt-1">Manage all registered services</p>
            </div>
            <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-home mr-1"></i> Back to Home
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-8">

        <!-- Top Controls -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-700">Registered Services</h2>
            <a href="{{ route('services.create') }}" 
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 flex items-center">
                <i class="fas fa-plus mr-2"></i> Add Service
            </a>
        </div>

        <!-- Services Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Facility</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Skill Type</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-indigo-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($services as $service)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $service->Name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ optional($service->facility)->Name ?? '—' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $service->Category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $service->SkillType }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-3">
                                    <!-- View -->
                                    <a href="{{ route('services.show', $service) }}" 
                                       class="text-indigo-600 hover:text-indigo-900" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <!-- Edit -->
                                    <a href="{{ route('services.edit', $service) }}" 
                                       class="text-green-600 hover:text-green-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Delete -->
                                    <form method="POST" action="{{ route('services.destroy', $service) }}" 
                                          class="inline" 
                                          onsubmit="return confirm('Delete this service?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                <i class="fas fa-concierge-bell text-3xl text-gray-300 mb-3"></i>
                                <p class="text-lg font-medium">No services found</p>
                                <p class="text-sm text-gray-400 mb-4">Get started by adding your first service</p>
                                <a href="{{ route('services.create') }}" 
                                   class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 inline-flex items-center">
                                    <i class="fas fa-plus mr-2"></i> Add Service
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($services->hasPages())
            <div class="px-6 py-4 bg-white border-t border-gray-200">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="text-sm text-gray-700 mb-4 md:mb-0">
                        Showing <span class="font-medium">{{ $services->firstItem() }}</span>
                        to <span class="font-medium">{{ $services->lastItem() }}</span>
                        of <span class="font-medium">{{ $services->total() }}</span> results
                    </div>
                    <div>
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </main>
<br>
<br>
<br>
<br>
<br>
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
