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
                                    <a href="{{ route('services.show', $service) }}" 
                                       class="text-indigo-600 hover:text-indigo-900" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('services.edit', $service) }}" 
                                       class="text-green-600 hover:text-green-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
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

    <!-- Footer -->
    <footer class="mt-12 bg-gray-800 text-white py-6">
        <div class="max-w-6xl mx-auto text-center">
            <p>&copy; {{ date('Y') }} Projects Platform. All rights reserved.</p>
            <p class="text-gray-400 text-sm mt-1">Empowering innovation through collaboration</p>
        </div>
    </footer>

</body>
</html>
