<!DOCTYPE html>
<html>
<head>
    <title>Programs</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6 text-center">Programs</h1>

    <div class="mb-4 text-right">
        <a href="{{ route('programs.create') }}" class="bg-green-600 text-white px-4 py-2 rounded shadow">+ Add Program</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($programs as $program)
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
            <h2 class="text-xl font-bold text-indigo-700">{{ $program->Name }}</h2>
            <p class="text-gray-600 mb-2">{{ $program->Description }}</p>
            <p class="text-sm text-gray-500"><strong>Alignment:</strong> {{ $program->NationalAlignment }}</p>
            
            <div class="mt-2">
                <strong>Focus Areas:</strong>
                @foreach($program->FocusAreas ?? [] as $fa)
                    <span class="bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded">{{ $fa }}</span>
                @endforeach
            </div>

            <div class="mt-2">
                <strong>Phases:</strong>
                @foreach($program->Phases ?? [] as $ph)
                    <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded">{{ $ph }}</span>
                @endforeach
            </div>

            <div class="mt-4 flex justify-between">
                <a href="{{ route('programs.show', $program) }}" class="text-blue-600">View</a>
                <a href="{{ route('programs.edit', $program) }}" class="text-green-600">Edit</a>
                <form action="{{ route('programs.destroy', $program) }}" method="POST" onsubmit="return confirm('Delete this program?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $programs->links() }}
    </div>
</div>

</body>
</html>
