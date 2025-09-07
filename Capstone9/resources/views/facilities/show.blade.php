<!DOCTYPE html>
<html>
<head>
    <title>{{ $facility->Name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-3xl font-bold text-indigo-700 mb-4">{{ $facility->Name }}</h1>
    <p class="text-gray-600 mb-2"><strong>Location:</strong> {{ $facility->Location }}</p>
    <p class="text-gray-600 mb-2"><strong>Type:</strong> {{ $facility->FacilityType }}</p>
    <p class="text-gray-600 mb-2"><strong>Partner:</strong> {{ $facility->PartnerOrganization }}</p>
    <p class="text-gray-600 mb-4"><strong>Description:</strong> {{ $facility->Description }}</p>

    <div>
        <strong>Capabilities:</strong>
        @foreach($facility->Capabilities ?? [] as $cap)
            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">{{ $cap }}</span>
        @endforeach
    </div>

    <div class="mt-6">
        <a href="{{ route('facilities.edit', $facility) }}" class="bg-yellow-400 text-gray-900 px-4 py-2 rounded shadow">Edit</a>
        <a href="{{ route('facilities.index') }}" class="ml-2 bg-gray-300 text-gray-900 px-4 py-2 rounded shadow">Back</a>
    </div>
</div>

</body>
</html>
