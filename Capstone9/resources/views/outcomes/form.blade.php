<form method="POST" action="{{ $action }}">
    @csrf
    @if($update)
        @method('PUT')
    @endif

    <div class="mb-4">
        <label class="block font-semibold">Title</label>
        <input type="text" name="title"
               value="{{ old('title', $outcome->title ?? '') }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Description</label>
        <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $outcome->description ?? '') }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Outcome Type</label>
        <select name="outcome_type" class="w-full border rounded px-3 py-2" required>
            <option value="">-- Select Type --</option>
            @foreach(['cad','pcb','prototype','report','business_plan'] as $type)
                <option value="{{ $type }}" @selected(old('outcome_type', $outcome->outcome_type ?? '') === $type)>{{ ucfirst(str_replace('_',' ',$type)) }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Project</label>
        <select name="project_id" class="w-full border rounded px-3 py-2" required>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" @selected((string) old('project_id', (string) ($outcome->project_id ?? $projects->first()->id)) === (string) $project->id)>
                    {{ $project->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Artifact Link</label>
        <input type="url" name="artifact_link" 
               value="{{ old('artifact_link', $outcome->artifact_link ?? '') }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Quality Certification</label>
        <input type="text" name="quality_certification"
               value="{{ old('quality_certification', $outcome->quality_certification ?? '') }}"
               class="w-full border rounded px-3 py-2">
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Commercialization Status</label>
        <select name="commercialization_status" class="w-full border rounded px-3 py-2" required>
            @foreach(['demoed','market_linked','launched'] as $status)
                <option value="{{ $status }}" @selected(old('commercialization_status', $outcome->commercialization_status ?? '') === $status)>{{ ucfirst(str_replace('_',' ',$status)) }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
        {{ $update ? 'Update Outcome' : 'Save Outcome' }}
    </button>
</form>
