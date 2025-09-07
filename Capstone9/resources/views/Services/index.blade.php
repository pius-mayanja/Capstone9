<!DOCTYPE html>
<html>
<head>
    <title>Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6 text-center">Registered Services</h1>
    
    <div class="flex items-center justify-between mb-6">
    <a href="{{ url('/') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600">
        ← Back to Home
    </a>

    <div class="mb-4 text-right">
        <a href="{{ route('services.create') }}" 
           class="bg-green-600 text-white px-4 py-2 rounded shadow">+ Add Service</a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2">Facility</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Skill Type</th>
                    <th class="px-4 py-2 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $service->Name }}</td>
                    <td class="px-4 py-2">{{ optional($service->facility)->Name ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $service->Category }}</td>
                    <td class="px-4 py-2">{{ $service->SkillType }}</td>
                    <td class="px-4 py-2 text-right">
                        <a href="{{ route('services.show', $service) }}" class="text-blue-600">View</a> |
                        <a href="{{ route('services.edit', $service) }}" class="text-green-600">Edit</a> |
                        <form method="POST" action="{{ route('services.destroy', $service) }}" 
                              class="inline" onsubmit="return confirm('Delete this service?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4">
            {{ $services->links() }}
        </div>
    </div>
</div>
</body>
</html>
