<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outcomes Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<!-- <body  class="bg-gray-50 text-gray-800 min-h-screen flex flex-col"> -->
<body class="bg-gray-50 text-gray-800 min-h-screen" 
      x-data="{ showFilters: window.innerWidth > 768, searchQuery: '' }"></body>

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-indigo-700">
                    <i class="fas fa-chart-line mr-2"></i> Outcomes
                </h1>
                <p class="text-sm text-gray-600 mt-1">Track all project outcomes and artifacts</p>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-800">
                    <i class="fas fa-home mr-1"></i> Home
                </a>
                <a href="{{ route('outcomes.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    <i class="fas fa-plus mr-2"></i> Add Outcome
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-6">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-indigo-100 px-3 py-1 mr-4">
                    <i class="fas fa-chart-line text-indigo-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Outcomes</p>
                    <h3 class="font-bold text-xl">{{ $outcomes->total() }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-blue-100 px-3 py-1 mr-4">
                    <i class="fas fa-file-alt text-blue-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Reports</p>
                    <h3 class="font-bold text-xl">{{ $outcomes->where('outcome_type', 'report')->count() }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-green-100 px-3 py-1 mr-4">
                    <i class="fas fa-microchip text-green-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Prototypes</p>
                    <h3 class="font-bold text-xl">{{ $outcomes->where('outcome_type', 'prototype')->count() }}</h3>
                </div>
            </div>
        </div>

        <!-- Table -->
        @if($outcomes->count())
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase">Project</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-indigo-700 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-indigo-700 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($outcomes as $outcome)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <a href="{{ route('outcomes.show', $outcome) }}" class="text-indigo-600 hover:underline">
                                    {{ $outcome->title }}
                                </a>
                            </td>
                            <td class="px-6 py-4 capitalize">{{ $outcome->outcome_type }}</td>
                            <td class="px-6 py-4">{{ $outcome->project->title ?? '-' }}</td>
                            <td class="px-6 py-4 capitalize">{{ str_replace('_', ' ', $outcome->commercialization_status) }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    @if($outcome->artifact_link)
                                    <a href="{{ $outcome->artifact_link }}" target="_blank" class="text-indigo-600 hover:text-indigo-900" title="View Artifact"><i class="fas fa-eye"></i></a>
                                    @endif
                                    <a href="{{ route('outcomes.edit', $outcome) }}" class="text-green-600 hover:text-green-900" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ route('outcomes.destroy', $outcome) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this outcome?')" class="text-red-600 hover:text-red-900" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($outcomes->hasPages())
            <div class="px-6 py-4 border-t">{{ $outcomes->links() }}</div>
            @endif
        </div>
        @else
        <!-- Empty State -->
        <div class="max-w-6xl mx-auto px-4 py-10">
            <div class="text-center bg-white rounded-lg shadow p-10">
                <i class="fas fa-chart-line text-4xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-medium text-gray-700 mb-2">No outcomes found</h3>
                <p class="text-gray-500 mb-6">Get started by adding your first outcome</p>
                <a href="{{ route('outcomes.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    <i class="fas fa-plus mr-2"></i> Add Outcome
                </a>
            </div>
        </div>
        @endif
    </main>

    <!-- Footer -->
    <!-- <footer class="mt-12 bg-gray-800 text-white py-8 text-center">
        <p>&copy; {{ date('Y') }} Projects Platform. All rights reserved.</p>
    </footer> -->
</body>
</html>
