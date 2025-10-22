<!DOCTYPE html>
<html>
<head>
    <title>{{ $service->Name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-3xl font-bold text-indigo-700">{{ $service->Name }}</h1>
    <p class="mt-2 text-gray-600">{{ $service->Description }}</p>

    <div class="mt-4">
        <p><strong>Facility:</strong> {{ optional($service->facility)->Name ?? '—' }}</p>
        <p><strong>Category:</strong> {{ $service->Category }}</p>
        <p><strong>Skill Type:</strong> {{ $service->SkillType }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('services.edit', $service) }}" 
           class="bg-yellow-400 text-gray-900 px-4 py-2 rounded shadow">Edit</a>
        <a href="{{ route('services.index') }}" 
           class="ml-2 bg-gray-300 text-gray-900 px-4 py-2 rounded shadow">Back</a>
    </div>
</div>
</body>
</html>
