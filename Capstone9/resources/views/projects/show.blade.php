<!DOCTYPE html>
<html>
<head>
    <title>{{ $project->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4">{{ $project->title }}</h1>
    <p class="text-gray-600 mb-2"><strong>Stage:</strong> {{ ucfirst($project->prototype_stage) }}</p>
    <p class="text-gray-600 mb-2"><strong>Facility:</strong> {{ $project->facility->Name ?? '-' }}</p>
    <p class="text-gray-600 mb-2"><strong>Program:</strong> {{ $project->program->Name ?? '-' }}</p>
    <p class="text-gray-600 mb-4"><strong>Description:</strong> {{ $project->description }}</p>

    <div class="mt-6">
        <a href="{{ route('projects.edit', $project) }}" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded shadow">Edit</a>
        <a href="{{ route('projects.index') }}" class="ml-2 bg-gray-300 text-gray-900 px-4 py-2 rounded shadow">Back</a>
    </div>
</div>

</body>
</html>
