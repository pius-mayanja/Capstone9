<!DOCTYPE html>
<html>
<head>
    <title>{{ $outcome->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4">{{ $outcome->title }}</h1>
    <p class="text-gray-600 mb-2"><strong>Type:</strong> {{ ucfirst($outcome->outcome_type) }}</p>
    <p class="text-gray-600 mb-2"><strong>Project:</strong> {{ $outcome->project->title ?? '-' }}</p>
    <p class="text-gray-600 mb-2"><strong>Commercialization Status:</strong> {{ ucfirst(str_replace('_',' ',$outcome->commercialization_status)) }}</p>
    <p class="text-gray-600 mb-4"><strong>Description:</strong> {{ $outcome->description ?? '-' }}</p>
    <p class="text-gray-600 mb-4"><strong>Artifact Link:</strong> 
        @if($outcome->artifact_link)
            <a href="{{ $outcome->artifact_link }}" target="_blank" class="text-indigo-600 hover:underline">View Artifact</a>
        @else
            -
        @endif
    </p>

    <div class="mt-6">
        <a href="{{ route('outcomes.edit', $outcome) }}" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded shadow">Edit</a>
        <a href="{{ route('outcomes.index') }}" class="ml-2 bg-gray-300 text-gray-900 px-4 py-2 rounded shadow">Back</a>
    </div>
</div>

</body>
</html>
