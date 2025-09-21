

<form method="POST" action="{{ $action }}">
    @csrf
    @if($update)
        @method('PUT')
    @endif

    <div class="mb-4">
        <label class="block font-semibold">Title</label>
        <input type="text" name="title" 
               value="{{ old('title', $project->title ?? '') }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Description</label>
        <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $project->description ?? '') }}</textarea>
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

    <div class="mb-4">
        <label class="block font-semibold">Program</label>
        <select name="program_id" class="w-full border rounded px-3 py-2">
            <option value="">-- Select Program --</option>
            @foreach($programs as $program)
                <option value="{{ $program->id }}" 
                    @selected(old('program_id', $project->program_id ?? '') == $program->id)>
                    {{ $program->Name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Prototype Stage</label>
        <select name="prototype_stage" class="w-full border rounded px-3 py-2" required>
            <option value="concept" @selected(old('prototype_stage', $project->prototype_stage ?? '') === 'concept')>Concept</option>
            <option value="prototype" @selected(old('prototype_stage', $project->prototype_stage ?? '') === 'prototype')>Prototype</option>
            <option value="mvp" @selected(old('prototype_stage', $project->prototype_stage ?? '') === 'mvp')>MVP</option>
            <option value="market_launch" @selected(old('prototype_stage', $project->prototype_stage ?? '') === 'market_launch')>Launched</option>
        </select>
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
        {{ $update ? 'Update Project' : 'Save Project' }}
    </button>
</form>
