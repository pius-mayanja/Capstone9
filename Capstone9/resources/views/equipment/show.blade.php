<!DOCTYPE html>
<html>
<head>
    <title>{{ $equipment->Name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4">{{ $equipment->Name }}</h1>
    <p><strong>Type:</strong> {{ $equipment->Type }}</p>
    <p><strong>Capability:</strong> {{ $equipment->Capability }}</p>
    <p><strong>Domain:</strong> {{ $equipment->Domain ?? '-' }}</p>
    <p><strong>Facility:</strong> {{ $equipment->facility->Name ?? 'Global' }}</p>
    <p class="mt-2"><strong>Description:</strong> {{ $equipment->Description }}</p>

    <div class="mt-6">
        <a href="{{ route('equipment.edit', $equipment) }}" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded">Edit</a>
        <a href="{{ route('equipment.index') }}" class="ml-2 bg-gray-300 text-gray-900 px-4 py-2 rounded">Back</a>
    </div>
</div>

</body>
</html>
