<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects Management</title>
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
    </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen" 
      x-data="{ showFilters: window.innerWidth > 768, searchQuery: '' }">

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-indigo-700">
                    <i class="fas fa-tasks mr-2"></i> Projects
                </h1>
                <p class="text-sm text-gray-600 mt-1">Manage all projects and their details</p>
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
                    <i class="fas fa-tasks text-indigo-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Projects</p>
                    <h3 class="font-bold text-xl">{{ $projects->total() }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-yellow-100 px-3 py-1 mr-4">
                    <i class="fas fa-lightbulb text-yellow-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Prototypes</p>
                    <h3 class="font-bold text-xl">{{ $projects->where('prototype_stage','prototype')->count() }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-blue-100 px-3 py-1 mr-4">
                    <i class="fas fa-flask text-blue-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Concepts</p>
                    <h3 class="font-bold text-xl">{{ $projects->where('prototype_stage','concept')->count() }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-green-100 px-3 py-1 mr-4">
                    <i class="fas fa-rocket text-green-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Launched</p>
                    <h3 class="font-bold text-xl">{{ $projects->where('prototype_stage','market_launch')->count() }}</h3>
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
                            placeholder="Search projects..." 
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
                        href="{{ route('projects.create') }}" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center action-btn"
                    >
                        <i class="fas fa-plus mr-2"></i> Add Project
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">Facility</label>
                        <input type="text" name="facility" value="{{ request('facility') }}"
                               placeholder="Filter by Facility"
                               class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Program</label>
                        <input type="text" name="program" value="{{ request('program') }}"
                               placeholder="Filter by Program"
                               class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Stage</label>
                        <select name="stage" class="w-full border rounded px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Stages</option>
                            <option value="concept" @selected(request('stage')==='concept')>Concept</option>
                            <option value="prototype" @selected(request('stage')==='prototype')>Prototype</option>
                            <option value="mvp" @selected(request('stage')==='mvp')>MVP</option>
                            <option value="market_launch" @selected(request('stage')==='market_launch')>Launched</option>
                        </select>
                    </div>
                    <div class="md:col-span-3 flex justify-end gap-2">
                        <a href="{{ route('projects.index') }}" 
                           class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Reset</a>
                        <button type="submit" 
                                class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Apply Filters</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Projects Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase">Facility</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase">Program</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase">Stage</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-indigo-700 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($projects as $project)
                        <tr class="table-row transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $project->title }}</td>
                            <td class="px-6 py-4">{{ $project->facility->Name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $project->program->Name ?? '-' }}</td>
                            <td class="px-6 py-4 capitalize">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($project->prototype_stage=='concept') bg-blue-100 text-blue-800
                                    @elseif($project->prototype_stage=='prototype') bg-yellow-100 text-yellow-800
                                    @elseif($project->prototype_stage=='mvp') bg-purple-100 text-purple-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ $project->prototype_stage }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 hover:text-indigo-900 action-btn" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('projects.edit', $project) }}" class="text-green-600 hover:text-green-900 action-btn" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ route('projects.destroy', $project) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this project?')" class="text-red-600 hover:text-red-900 action-btn" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($projects->hasPages())
            <div class="px-6 py-4 bg-white border-t border-gray-200">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="text-sm text-gray-700 mb-4 md:mb-0">
                        Showing <span class="font-medium">{{ $projects->firstItem() }}</span>
                        to <span class="font-medium">{{ $projects->lastItem() }}</span>
                        of <span class="font-medium">{{ $projects->total() }}</span> results
                    </div>
                    <div class="pagination">
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </main>

    <!-- Empty State -->
    @if($projects->count() == 0)
    <div class="max-w-6xl mx-auto px-4 py-10">
        <div class="text-center bg-white rounded-lg shadow p-10">
            <i class="fas fa-tasks text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-medium text-gray-700 mb-2">No projects found</h3>
            <p class="text-gray-500 mb-6">Get started by adding your first project</p>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                <i class="fas fa-plus mr-2"></i> Add Project
            </a>
        </div>
    </div>
    @endif

    <!-- Footer -->
    <footer class="mt-12 bg-gray-800 text-white py-8 text-center">
        <p>&copy; {{ date('Y') }} Projects Platform. All rights reserved.</p>
    </footer>
</body>
</html>
