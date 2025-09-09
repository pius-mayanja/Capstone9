<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Equipment & Tools</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Equipment & Tools</h1>

    <!-- Search -->
    <form method="GET" action="{{ route('equipment.index') }}" class="flex items-center mb-6">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Search by capability or domain..."
               class="flex-1 border rounded-l px-3 py-2 focus:ring focus:ring-blue-200">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r">Search</button>
    </form>

    <!-- Add -->
    <a href="{{ route('equipment.create') }}"
       class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-500 mb-4 inline-block">
        + Add Equipment
    </a>

    <!-- Equipment Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($equipment as $item)
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                <h2 class="text-xl font-bold text-indigo-700">{{ $item->Name }}</h2>
                <p class="text-gray-600"><strong>Type:</strong> {{ $item->Type }}</p>
                <p class="text-gray-600"><strong>Capability:</strong> {{ $item->Capability }}</p>
                <p class="text-gray-600"><strong>Domain:</strong> {{ $item->Domain ?? '-' }}</p>
                <p class="text-gray-600"><strong>Facility:</strong> {{ $item->facility->Name ?? 'Global' }}</p>

                <div class="mt-4 flex justify-between text-sm">
                    <a href="{{ route('equipment.show', $item) }}" class="text-blue-600">View</a>
                    <a href="{{ route('equipment.edit', $item) }}" class="text-green-600">Edit</a>
                    <form method="POST" action="{{ route('equipment.destroy', $item) }}" onsubmit="return confirm('Delete this item?')" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-gray-500 text-center">No equipment found.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $equipment->links() }}
    </div>
</div>

</body>
</html>
