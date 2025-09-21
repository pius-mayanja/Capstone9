<form method="POST" action="{{ $action }}">
    @csrf
    @if($update) @method('PUT') @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Name -->
        <div>
            <label class="block font-semibold">Name</label>
            <input type="text" name="Name" value="{{ old('Name', $equipment->Name ?? '') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Type -->
        <div>
            <label class="block font-semibold">Type</label>
            <input type="text" name="Type" value="{{ old('Type', $equipment->Type ?? '') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Capability -->
        <div>
            <label class="block font-semibold">Capability</label>
            <input type="text" name="Capability" value="{{ old('Capability', $equipment->Capability ?? '') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <!-- Domain -->
        <div>
            <label class="block font-semibold">Domain</label>
            <input type="text" name="Domain" value="{{ old('Domain', $equipment->Domain ?? '') }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <!-- Facility -->
        <div class="mb-4">
            <label class="block font-semibold">Facility</label>
            <select name="facility_id" class="w-full border rounded px-3 py-2">
                <option value="">-- Select Facility --</option>
                @foreach($facilities as $facility)
                    <option value="{{ $facility->id }}" 
                        @selected(old('facility_id', $project->facility_id ?? '') == $facility->id)>
                        {{ $facility->Name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Description -->
        <div class="md:col-span-2">
            <label class="block font-semibold">Description</label>
            <textarea name="Description" class="w-full border rounded px-3 py-2">{{ old('Description', $equipment->Description ?? '') }}</textarea>
        </div>
    </div>

    <!-- Submit -->
    <div class="mt-6">
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded shadow hover:bg-indigo-500">
            Save
        </button>
    </div>
</form>
