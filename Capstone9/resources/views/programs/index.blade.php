<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programs Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e7eb 100%);
        }
        
        .program-card {
            transition: all 0.3s ease;
            border-left: 4px solid;
        }
        
        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 5px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .tag {
            transition: all 0.2s ease;
        }
        
        .tag:hover {
            transform: scale(1.05);
        }
        
        .stats-card {
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-3px);
        }
        
        .action-btn {
            transition: all 0.2s ease;
        }
        
        .action-btn:hover {
            transform: scale(1.05);
        }
        
        .filter-toggle {
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
<body class="min-h-screen" x-data="{ showFilters: false }">

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-2xl font-bold text-indigo-700">
                    <i class="fas fa-project-diagram mr-2"></i>Programs
                </h1>
                <p class="text-sm text-gray-600 mt-1">Manage all programs and their alignment with national goals</p>
            </div>
            <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-800 mt-4 md:mt-0">
                <i class="fas fa-home mr-1"></i> Back to Home
            </a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-6">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="stats-card bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-indigo-100 px-3 py-1 mr-4">
                    <i class="fas fa-project-diagram text-indigo-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Programs</p>
                    <h3 class="font-bold text-xl">{{ $programs->total() }}</h3>
                </div>
            </div>
            <div class="stats-card bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-green-100 px-3 py-1 mr-4">
                    <i class="fas fa-play-circle text-green-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Active Programs</p>
                    <h3 class="font-bold text-xl">{{ $programs->where('Status', 'Active')->count() }}</h3>
                </div>
            </div>
            <div class="stats-card bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-blue-100 px-3 py-1 mr-4">
                    <i class="fas fa-pause-circle text-blue-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Inactive Programs</p>
                    <h3 class="font-bold text-xl">{{ $programs->where('Status', 'Inactive')->count() }}</h3>
                </div>
            </div>
            <div class="stats-card bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-purple-100 px-3 py-1 mr-4">
                    <i class="fas fa-tasks text-purple-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Avg. Phases</p>
                    <h3 class="font-bold text-xl">{{ round($programs->avg('phase_count'), 1) }}</h3>
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
                            placeholder="Search programs..." 
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
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 flex items-center filter-toggle"
                    >
                        <i class="fas fa-filter mr-2"></i> Filters
                        <template x-if="alignmentFilter || statusFilter || focusAreaFilter">
                            <span class="ml-2 bg-indigo-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center" x-text="(alignmentFilter?1:0) + (statusFilter?1:0) + (focusAreaFilter?1:0)"></span>
                        </template>
                    </button>
                    <a 
                        href="{{ route('programs.create') }}" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center action-btn"
                    >
                        <i class="fas fa-plus mr-2"></i> Add Program
                    </a>
                </div>
            </div>

            <!-- Filters Card -->
            <div 
                x-show="showFilters" 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform -translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0"
                class="mt-4 bg-gray-50 p-4 rounded-lg"
                style="display: none;"
            >
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">National Alignment</label>
                        <select 
                            x-model="alignmentFilter" 
                            class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="">All Alignments</option>
                            <option value="NDPIII">NDPIII</option>
                            <option value="Digital Transformation">Digital Transformation</option>
                            <option value="4IR Strategy">4IR Strategy</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select 
                            x-model="statusFilter" 
                            class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="">All Statuses</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Planning">Planning</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Focus Area</label>
                        <select 
                            x-model="focusAreaFilter" 
                            class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="">All Focus Areas</option>
                            <option value="Agriculture">Agriculture</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Education">Education</option>
                            <option value="Infrastructure">Infrastructure</option>
                            <option value="Technology">Technology</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button 
                        @click="alignmentFilter = ''; statusFilter = ''; focusAreaFilter = ''; filterPrograms();" 
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 mr-2"
                    >
                        Clear Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Programs Grid -->
        <template x-if="filteredPrograms.length > 0">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <template x-for="program in filteredPrograms" :key="program.id">
                    <div class="program-card bg-white rounded-lg shadow p-6" :class="program.colorClass">
                        <div class="flex justify-between items-start mb-2">
                            <h2 class="text-xl font-bold text-gray-900" x-text="program.name"></h2>
                            <span class="text-xs font-semibold px-2 py-1 rounded-full" 
                                :class="program.status === 'Active' ? 'bg-green-100 text-green-800' : 
                                        program.status === 'Inactive' ? 'bg-red-100 text-red-800' : 
                                        program.status === 'Planning' ? 'bg-blue-100 text-blue-800' : 
                                        'bg-gray-100 text-gray-800'" 
                                x-text="program.status">
                            </span>
                        </div>
                        
                        <p class="text-gray-600 mb-4" x-text="program.description"></p>
                        
                        <div class="mb-3">
                            <div class="flex items-center text-sm text-gray-500 mb-1">
                                <i class="fas fa-bullseye mr-2"></i>
                                <strong>Alignment:</strong>
                                <span class="ml-1" x-text="program.alignment"></span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <strong class="text-sm text-gray-700">Focus Areas:</strong>
                            <div class="mt-1 flex flex-wrap gap-2">
                                <template x-for="fa in program.focusAreas" :key="fa">
                                    <span class="tag bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded" x-text="fa"></span>
                                </template>
                            </div>
                        </div>

                        <div class="mb-4">
                            <strong class="text-sm text-gray-700">Phases:</strong>
                            <div class="mt-1 flex flex-wrap gap-2">
                                <template x-for="ph in program.phases" :key="ph">
                                    <span class="tag bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded" x-text="ph"></span>
                                </template>
                            </div>
                        </div>

                        <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-100">
                            <span class="text-xs text-gray-500" x-text="new Date(program.createdAt).toLocaleDateString()"></span>
                            <div class="flex space-x-3">
                                <a :href="'{{ url('programs') }}/' + program.id" class="text-blue-600 hover:text-blue-800 action-btn" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a :href="'{{ url('programs') }}/' + program.id + '/edit'" class="text-green-600 hover:text-green-800 action-btn" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form :action="'{{ url('programs') }}/' + program.id" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 action-btn" title="Delete" onclick="return confirm('Are you sure you want to delete this program?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </template>

        <!-- Empty State -->
        <template x-if="filteredPrograms.length === 0">
            <div class="bg-white rounded-lg shadow p-10 text-center">
                <i class="fas fa-project-diagram text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-medium text-gray-700 mb-2">No programs found</h3>
                <p class="text-gray-500 mb-6" x-text="searchQuery || alignmentFilter || statusFilter || focusAreaFilter ? 
                    'Try adjusting your search or filters to find what you are looking for.' : 
                    'Get started by adding your first program.'"></p>
                <a href="{{ route('programs.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    <i class="fas fa-plus mr-2"></i> Add Program
                </a>
                <template x-if="searchQuery || alignmentFilter || statusFilter || focusAreaFilter">
                    <button @click="searchQuery = ''; alignmentFilter = ''; statusFilter = ''; focusAreaFilter = ''; filterPrograms();" class="ml-3 inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Clear Filters
                    </button>
                </template>
            </div>
        </template>

        <!-- Programs Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alignment</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Focus Areas</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($programs as $program)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                {{ $program->Name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                {{ $program->NationalAlignment }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $program->Status === 'Active' ? 'bg-green-100 text-green-800' :
                                    ($program->Status === 'Inactive' ? 'bg-red-100 text-red-800' :
                                    'bg-gray-100 text-gray-800') }}">
                                    {{ $program->Status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">
                                @if(is_array($program->FocusAreas))
                                    @foreach($program->FocusAreas as $fa)
                                        <span class="bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded mr-1">{{ $fa }}</span>
                                    @endforeach
                                @else
                                    {{ $program->FocusAreas }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-sm">
                                {{ $program->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('programs.show', $program) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('programs.edit', $program) }}" class="text-green-600 hover:text-green-800 mr-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('programs.destroy', $program) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this program?')" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No programs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <!-- Pagination (for server-side) -->
        @if($programs->hasPages())
        <div class="mt-6 bg-white rounded-lg shadow px-6 py-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="text-sm text-gray-700 mb-4 md:mb-0">
                    Showing <span class="font-medium">{{ $programs->firstItem() }}</span>
                    to <span class="font-medium">{{ $programs->lastItem() }}</span>
                    of <span class="font-medium">{{ $programs->total() }}</span> results
                </div>
                
                <div class="pagination">
                    {{ $programs->links() }}
                </div>
            </div>
        </div>
        @endif
    </main>

    <!-- Footer -->
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

    <script>
        // Initialize Alpine.js when the page loads
        document.addEventListener('alpine:init', () => {
            Alpine.data('programs', () => ({
                // Data and functions are defined in the x-data attribute
            }));
        });
    </script>
</body>
</html>