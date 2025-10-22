<form method="POST" action="{{ $action }}">
    @csrf
    @if($update) @method('PUT') @endif

    <div class="space-y-4">
        <div>
            <label class="block font-semibold">Service Name</label>
            <input type="text" name="Name" value="{{ old('Name', $service->Name ?? '') }}"
                   class="w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block font-semibold">Description</label>
            <textarea name="Description" class="w-full border rounded px-3 py-2"
                      rows="3">{{ old('Description', $service->Description ?? '') }}</textarea>
        </div>

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

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">Category</label>
                <select name="Category" class="w-full border rounded px-3 py-2" required>
                    <option value="Machining" @selected(old('Category', $service->Category ?? '')==='Machining')>Machining</option>
                    <option value="Testing" @selected(old('Category', $service->Category ?? '')==='Testing')>Testing</option>
                    <option value="Training" @selected(old('Category', $service->Category ?? '')==='Training')>Training</option>
                    <option value="Consultancy" @selected(old('Category', $service->Category ?? '')==='Consultancy')>Consultancy</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold">Skill Type</label>
                <select name="SkillType" class="w-full border rounded px-3 py-2" required>
                    <option value="Hardware" @selected(old('SkillType', $service->SkillType ?? '')==='Hardware')>Hardware</option>
                    <option value="Software" @selected(old('SkillType', $service->SkillType ?? '')==='Software')>Software</option>
                    <option value="Integration" @selected(old('SkillType', $service->SkillType ?? '')==='Integration')>Integration</option>
                </select>
            </div>
        </div>

        <div>
            <button type="submit" class="bg-indigo-600 text-white px-5 py-2 rounded shadow hover:bg-indigo-500">
                Save Service
            </button>
        </div>
    </div>
</form>
