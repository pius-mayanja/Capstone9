<form method="POST" action="{{ $action }}">
    @csrf
    @if($update) @method('PUT') @endif

    <div class="mb-4">
        <label class="block font-semibold">Name</label>
        <input type="text" name="Name" value="{{ old('Name', $program->Name ?? '') }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Description</label>
        <textarea name="Description" class="w-full border rounded px-3 py-2">{{ old('Description', $program->Description ?? '') }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">National Alignment</label>
        <input type="text" name="NationalAlignment" value="{{ old('NationalAlignment', $program->NationalAlignment ?? '') }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Focus Areas (comma separated)</label>
        <input type="text" name="FocusAreas" value="{{ old('FocusAreas', isset($program->FocusAreas) ? implode(',', $program->FocusAreas) : '') }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Phases (comma separated)</label>
        <input type="text" name="Phases" value="{{ old('Phases', isset($program->Phases) ? implode(',', $program->Phases) : '') }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
        Save Program
    </button>
</form>
