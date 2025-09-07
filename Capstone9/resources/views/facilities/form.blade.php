<form method="POST" action="{{ $action }}">
    @csrf
    @if($update) @method('PUT') @endif

    <div class="mb-4">
        <label class="block font-semibold">Name</label>
        <input type="text" name="Name" value="{{ old('Name', $facility->Name ?? '') }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Location</label>
        <input type="text" name="Location" value="{{ old('Location', $facility->Location ?? '') }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Description</label>
        <textarea name="Description" class="w-full border rounded px-3 py-2">{{ old('Description', $facility->Description ?? '') }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Partner Organization</label>
        <input type="text" name="PartnerOrganization" value="{{ old('PartnerOrganization', $facility->PartnerOrganization ?? '') }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Facility Type</label>
        <select name="FacilityType" class="w-full border rounded px-3 py-2" required>
            <option value="Lab" @selected(old('FacilityType', $facility->FacilityType ?? '') === 'Lab')>Lab</option>
            <option value="Workshop" @selected(old('FacilityType', $facility->FacilityType ?? '') === 'Workshop')>Workshop</option>
            <option value="Testing Center" @selected(old('FacilityType', $facility->FacilityType ?? '') === 'Testing Center')>Testing Center</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Capabilities (comma separated)</label>
        <input type="text" name="Capabilities" 
               value="{{ old('Capabilities', isset($facility->Capabilities) ? implode(',', $facility->Capabilities) : '') }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
        Save Facility
    </button>
</form>
