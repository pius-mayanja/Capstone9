<!DOCTYPE html>
<html>
<head>
    <title>Facilities</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6 text-center">Facilities</h1>

    <!-- Filters -->
    <form method="GET" class="flex gap-4 mb-6">
        <input type="text" name="partner" placeholder="Filter by Partner" class="border rounded px-3 py-2" value="{{ request('partner') }}">
        <input type="text" name="capability" placeholder="Filter by Capability" class="border rounded px-3 py-2" value="{{ request('capability') }}">
        <select name="type" class="border rounded px-3 py-2">
            <option value="">All Types</option>
            <option value="Lab" @selected(request('type')==='Lab')>Lab</option>
            <option value="Workshop" @selected(request('type')==='Workshop')>Workshop</option>
            <option value="Testing Center" @selected(request('type')==='Testing Center')>Testing Center</option>
        </select>
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">Search</button>
    </form>

    <!-- Add Button -->
    <div class="mb-4">
        <a href="{{ route('facilities.create') }}" class="bg-green-600 text-white px-4 py-2 rounded shadow">+ Add Facility</a>
    </div>

    <!-- Facility Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2">Location</th>
                    <th class="px-4 py-2">Type</th>
                    <th class="px-4 py-2">Partner</th>
                    <th class="px-4 py-2 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facilities as $facility)
                <tr class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2 font-semibold">{{ $facility->Name }}</td>
                    <td class="px-4 py-2">{{ $facility->Location }}</td>
                    <td class="px-4 py-2">{{ $facility->FacilityType }}</td>
                    <td class="px-4 py-2">{{ $facility->PartnerOrganization }}</td>
                    <td class="px-4 py-2 text-right">
                        <a href="{{ route('facilities.show', $facility) }}" class="text-blue-600">View</a> |
                        <a href="{{ route('facilities.edit', $facility) }}" class="text-green-600">Edit</a> |
                        <form method="POST" action="{{ route('facilities.destroy', $facility) }}" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600" onclick="return confirm('Delete this facility?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $facilities->links() }}
        </div>
    </div>
</div>

</body>
</html>
