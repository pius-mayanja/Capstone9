<!DOCTYPE html>
<html>
<head>
    <title>{{ $participant->FullName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4">{{ $participant->FullName }}</h1>
    <p class="text-gray-600 mb-2"><strong>Email:</strong> {{ $participant->Email }}</p>
    <p class="text-gray-600 mb-2"><strong>Affiliation:</strong> {{ $participant->Affiliation }}</p>
    <p class="text-gray-600 mb-2"><strong>Specialization:</strong> {{ $participant->Specialization }}</p>
    <p class="text-gray-600 mb-2"><strong>Institution:</strong> {{ $participant->Institution }}</p>
    <p class="text-gray-600 mb-2"><strong>Cross-Skill Trained:</strong> 
        @if($participant->CrossSkillTrained)
            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Yes</span>
        @else
            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm">No</span>
        @endif
    </p>
    <p class="text-gray-600 mb-4"><strong>Description:</strong> {{ $participant->Description }}</p>

    <div class="mt-6">
        <a href="{{ route('participants.edit', $participant) }}" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded shadow">Edit</a>
        <a href="{{ route('participants.index') }}" class="ml-2 bg-gray-300 text-gray-900 px-4 py-2 rounded shadow">Back</a>
    </div>
</div>

</body>
</html>
