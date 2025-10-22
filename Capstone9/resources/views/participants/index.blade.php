<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.min.js" defer></script>
    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(to right, #f9fafb, #f3f4f6); }
        .table-row:hover { background-color: #f8fafc; transform: translateY(-1px); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .action-btn { transition: all 0.2s ease; }
        .action-btn:hover { transform: scale(1.05); }
        .filter-card { transition: all 0.3s ease; }
        .pagination .page-item.active .page-link { background-color: #4f46e5; color: white; border-color: #4f46e5; }
        .pagination .page-link { color: #4f46e5; }
        .pagination .page-link:hover { background-color: #eef2ff; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen" x-data="{ 
        showFilters: window.innerWidth > 768,
        searchQuery: '',
        institutionFilter: '{{ request('institution') }}',
        crossSkillFilter: '{{ request('crossSkillTrained') }}',
        participants: [],
        init() {
            this.participants = [
                @foreach($participants as $participant)
                {
                    id: {{ $participant->ParticipantId }},
                    name: '{{ $participant->FullName }}',
                    email: '{{ $participant->Email }}',
                    affiliation: '{{ $participant->Affiliation }}',
                    specialization: '{{ $participant->Specialization }}',
                    institution: '{{ $participant->Institution }}',
                    crossSkillTrained: {{ $participant->CrossSkillTrained ? 'true' : 'false' }},
                    description: '{{ $participant->Description }}'
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
                    <i class="fas fa-users mr-2"></i>Participants
                </h1>
                <p class="text-sm text-gray-600 mt-1">Manage all project participants</p>
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
                    <i class="fas fa-users text-indigo-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Participants</p>
                    <h3 class="font-bold text-xl">{{ $participants->total() }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-green-100 px-3 py-1 mr-4">
                    <i class="fas fa-check-double text-green-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Cross-Skilled</p>
                    <h3 class="font-bold text-xl">{{ $participants->where('CrossSkillTrained', true)->count() }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-blue-100 px-3 py-1 mr-4">
                    <i class="fas fa-university text-blue-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">SCIT</p>
                    <h3 class="font-bold text-xl">{{ $participants->where('Institution', 'SCIT')->count() }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-purple-100 px-3 py-1 mr-4">
                    <i class="fas fa-university text-purple-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">CEDAT</p>
                    <h3 class="font-bold text-xl">{{ $participants->where('Institution', 'CEDAT')->count() }}</h3>
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
                            placeholder="Search participants..." 
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
                        href="{{ route('participants.create') }}" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center action-btn"
                    >
                        <i class="fas fa-plus mr-2"></i> Add Participant
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">Institution</label>
                        <input 
                            type="text" 
                            name="institution" 
                            x-model="institutionFilter"
                            placeholder="Filter by Institution" 
                            class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cross-Skill Trained</label>
                        <select 
                            name="crossSkillTrained" 
                            x-model="crossSkillFilter"
                            class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                            <option value="">All</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Affiliation</label>
                        <input 
                            type="text" 
                            name="affiliation" 
                            placeholder="Filter by Affiliation" 
                            class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                    </div>
                    <div class="md:col-span-3 flex justify-end gap-2">
                        <a 
                            href="{{ route('participants.index') }}" 
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

        <!-- Participants Table -->
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Affiliation</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Specialization</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase tracking-wider">Institution</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-indigo-700 uppercase tracking-wider">Cross-Skilled</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-indigo-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($participants as $participant)
                        <tr class="table-row transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">{{ $participant->FullName }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($participant->Description, 30) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $participant->Email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $participant->Affiliation }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $participant->Specialization }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    {{ $participant->Institution }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($participant->CrossSkillTrained)
                                    <i class="fas fa-check text-green-600"></i>
                                @else
                                    <i class="fas fa-times text-red-600"></i>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('participants.show', $participant) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 action-btn" 
                                       title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('participants.edit', $participant) }}" 
                                       class="text-green-600 hover:text-green-900 action-btn" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('participants.destroy', $participant) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 action-btn" 
                                                onclick="return confirm('Are you sure you want to delete this participant?')"
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
            @if($participants->hasPages())
            <div class="px-6 py-4 bg-white border-t border-gray-200">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="text-sm text-gray-700 mb-4 md:mb-0">
                        Showing <span class="font-medium">{{ $participants->firstItem() }}</span>
                        to <span class="font-medium">{{ $participants->lastItem() }}</span>
                        of <span class="font-medium">{{ $participants->total() }}</span> results
                    </div>
                    <div class="pagination">
                        {{ $participants->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </main>

    <!-- Empty State (if no participants) -->
    @if($participants->count() == 0)
    <div class="max-w-6xl mx-auto px-4 py-10">
        <div class="text-center bg-white rounded-lg shadow p-10">
            <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-700 mb-2">No participants found</h3>
            <p class="text-gray-500 mb-6">Get started by adding your first participant</p>
            <a href="{{ route('participants.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                <i class="fas fa-plus mr-2"></i> Add Participant
            </a>
        </div>
    </div>
    @endif

<br>
<br>
<br>
<br>
<br>
    <!-- Footer -->
<<<<<<< HEAD
    <footer class="mt-12 bg-gray-800 py-8">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <p class="text-black">&copy; {{ date('Y') }} Projects Platform. All rights reserved.</p>
            <p class="text-black text-sm mt-2">A unified system to manage Programs, Facilities, Services, Equipment, and more—driving Uganda's digital transformation.</p>
=======
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
>>>>>>> 3ed14a2a434c486574846c39240a37ea3347721e
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
