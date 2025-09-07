<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, #f9fafb, #f3f4f6);
        }
        .table-row:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .action-btn {
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: scale(1.05);
        }
        .filter-card {
            transition: all 0.3s ease;
        }
        .pagination .page-item.active .page-link {
            background-color: #4f46e5;
            color: white;
            border-color: #4f46e5;
        }
        .pagination .page-link {
            color: #4f46e5;
        }
        .pagination .page-link:hover {
            background-color: #eef2ff;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen" x-data="{ 
        showFilters: window.innerWidth > 768,
        searchQuery: '',
        partnerFilter: '{{ request('partner') }}',
        capabilityFilter: '{{ request('capability') }}',
        typeFilter: '{{ request('type') }}',
        facilities: [],
        init() {
            // Simulate fetching data (in real app, this would come from server)
            this.facilities = [
                @foreach($facilities as $facility)
                {
                    id: {{ $facility->id }},
                    name: '{{ $facility->Name }}',
                    location: '{{ $facility->Location }}',
                    type: '{{ $facility->FacilityType }}',
                    partner: '{{ $facility->PartnerOrganization }}',
                    capabilities: '{{ $facility->capabilities }}'
                },
                @endforeach
            ];
        }
    }" :class="{ 'overflow-hidden': showFilters && window.innerWidth < 768 }">

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-indigo-700">
                    <i class="fas fa-building mr-2"></i>Facilities
                </h1>
                <p class="text-sm text-gray-600 mt-1">Manage all facilities and their capabilities</p>
            </div>
            <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-home mr-1"></i> Back to Home
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-6">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-indigo-100 px-3 py-1 mr-4">
                    <i class="fas fa-building text-indigo-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Facilities</p>
                    <h3 class="font-bold text-xl">{{ $facilities->total() }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-blue-100 px-3 py-1 mr-4">
                    <i class="fas fa-flask text-blue-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Labs</p>
                    <h3 class="font-bold text-xl">{{ $facilities->where('FacilityType', 'Lab')->count() }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-green-100 px-3 py-1 mr-4">
                    <i class="fas fa-tools text-green-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Workshops</p>
                    <h3 class="font-bold text-xl">{{ $facilities->where('FacilityType', 'Workshop')->count() }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-purple-100 px-3 py-1 mr-4">
                    <i class="fas fa-check-circle text-purple-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Testing Centers</p>
                    <h3 class="font-bold text-xl">{{ $facilities->where('FacilityType', 'Testing Center')->count() }}</h3>
                </div>
            </div>
        </div>

        <!-- Controls Section -->
        <div class="bg-white rounded-lg shadow mb-6 p-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex-1 w-full">
                    <div class="relative">
                        <input 
                            type="text" 
                            x-model="searchQuery" 
                            placeholder="Search facilities..." 
                            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button 
                        @click="showFilters = !showFilters" 
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 flex items-center"
                    >
                        <i class="fas fa-filter mr-2"></i> Filters
                    </button>
                    <a 
                        href="{{ route('facilities.create') }}" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center action-btn"
                    >
                        <i class="fas fa-plus mr-2"></i> Add Facility
                    </a>
                </div>
            </div>

            <!-- Filters Card -->
            <div 
                x-show="showFilters" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="mt-4 bg-gray-50 p-4 rounded-lg filter-card"
                style="display: none;"
            >
                <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Partner Organization</label>
                        <input 
                            type="text" 
                            name="partner" 
                            x-model="partnerFilter"
                            placeholder="Filter by Partner" 
                            class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Capability</label>
                        <input 
                            type="text" 
                            name="capability" 
                            x-model="capabilityFilter"
                            placeholder="Filter by Capability" 
                            class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Facility Type</label>
                        <select 
                            name="type" 
                            x-model="typeFilter"
                            class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="">All Types</option>
                            <option value="Lab">Lab</option>
                            <option value="Workshop">Workshop</option>
                            <option value="Testing Center">Testing Center</option>
                        </select>
                    </div>
                    <div class="md:col-span-3 flex justify-end gap-2">
                        <a 
                            href="{{ route('facilities.index') }}" 
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                        >
                            Reset
                        </a>
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
                        >
                            Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Facilities Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                <div class="flex items-center">
                                    <span>Name</span>
                                    <i class="fas fa-sort ml-1 text-indigo-400"></i>
                                </div>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Location
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Partner
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-indigo-700 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($facilities as $facility)
                        <tr class="table-row transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                        @if($facility->FacilityType == 'Lab')
                                            <i class="fas fa-flask text-indigo-600"></i>
                                        @elseif($facility->FacilityType == 'Workshop')
                                            <i class="fas fa-tools text-indigo-600"></i>
                                        @else
                                            <i class="fas fa-check-circle text-indigo-600"></i>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900">{{ $facility->Name }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($facility->Description, 30) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $facility->Location }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($facility->FacilityType == 'Lab') bg-blue-100 text-blue-800
                                    @elseif($facility->FacilityType == 'Workshop') bg-green-100 text-green-800
                                    @else bg-purple-100 text-purple-800 @endif">
                                    {{ $facility->FacilityType }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $facility->PartnerOrganization }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('facilities.show', $facility) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 action-btn" 
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('facilities.edit', $facility) }}" 
                                       class="text-green-600 hover:text-green-900 action-btn" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('facilities.destroy', $facility) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 action-btn" 
                                                onclick="return confirm('Are you sure you want to delete this facility?')"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($facilities->hasPages())
            <div class="px-6 py-4 bg-white border-t border-gray-200">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="text-sm text-gray-700 mb-4 md:mb-0">
                        Showing <span class="font-medium">{{ $facilities->firstItem() }}</span>
                        to <span class="font-medium">{{ $facilities->lastItem() }}</span>
                        of <span class="font-medium">{{ $facilities->total() }}</span> results
                    </div>
                    
                    <div class="pagination">
                        {{ $facilities->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </main>

    <!-- Empty State (if no facilities) -->
    @if($facilities->count() == 0)
    <div class="max-w-6xl mx-auto px-4 py-10">
        <div class="text-center bg-white rounded-lg shadow p-10">
            <i class="fas fa-building text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-700 mb-2">No facilities found</h3>
            <p class="text-gray-500 mb-6">Get started by adding your first facility</p>
            <a href="{{ route('facilities.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                <i class="fas fa-plus mr-2"></i> Add Facility
            </a>
        </div>
    </div>
    @endif

    <!-- Footer -->
    <footer class="mt-12 bg-gray-800 text-white py-8">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Projects Platform. All rights reserved.</p>
            <p class="text-gray-400 text-sm mt-2">Empowering innovation through collaboration</p>
        </div>
    </footer>

    <script>
        // Simple JavaScript to enhance the pagination styling
        document.addEventListener('DOMContentLoaded', function() {
            // Add classes to pagination elements for better styling
            const paginationLinks = document.querySelectorAll('.pagination a');
            paginationLinks.forEach(link => {
                link.classList.add('page-link');
            });
            
            const paginationSpans = document.querySelectorAll('.pagination span');
            paginationSpans.forEach(span => {
                if (!span.classList.contains('gap')) {
                    span.classList.add('page-item');
                    
                    const link = span.querySelector('a');
                    if (!link && span.textContent.trim() !== '...') {
                        span.classList.add('active');
                        const newSpan = document.createElement('span');
                        newSpan.classList.add('page-link');
                        newSpan.innerHTML = span.innerHTML;
                        span.innerHTML = '';
                        span.appendChild(newSpan);
                    }
                }
            });
        });
    </script>
</body>
</html>