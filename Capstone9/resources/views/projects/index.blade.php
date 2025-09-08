<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">

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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
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
                    <h3 class="font-bold text-xl">{{ $projects->where('prototype_stage', 'prototype')->count() }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 flex items-center">
                <div class="rounded-full bg-green-100 px-3 py-1 mr-4">
                    <i class="fas fa-rocket text-green-600 text-lg"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Launched</p>
                    <h3 class="font-bold text-xl">{{ $projects->where('prototype_stage', 'market_launch')->count() }}</h3>
                </div>
            </div>
        </div>

        <!-- Table -->
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
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $project->title }}</td>
                            <td class="px-6 py-4">{{ $project->facility->Name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $project->program->Name ?? '-' }}</td>
                            <td class="px-6 py-4 capitalize">{{ $project->prototype_stage }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 hover:text-indigo-900" title="View"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('projects.edit', $project) }}" class="text-green-600 hover:text-green-900" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ route('projects.destroy', $project) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this project?')" class="text-red-600 hover:text-red-900" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($projects->hasPages())
            <div class="px-6 py-4 border-t">{{ $projects->links() }}</div>
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
