

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
    <label class="block font-semibold">Nature of Project</label>
        <select name="nature_of_project" class="w-full border rounded px-3 py-2" required>
            <option value="">-- Select Nature --</option>
            <option value="research" @selected(old('nature_of_project', $project->nature_of_project ?? '') === 'research')>Research</option>
            <option value="prototype" @selected(old('nature_of_project', $project->nature_of_project ?? '') === 'prototype')>Prototype</option>
            <option value="applied" @selected(old('nature_of_project', $project->nature_of_project ?? '') === 'applied')>Applied</option>
        </select>
    </div>


    <label class="block font-semibold">Facility</label>
    <select name="facility_id" class="w-full border rounded px-3 py-2" required>
        @foreach($facilities as $facility)
            <option value="{{ $facility->id }}" 
                @selected((string) old('facility_id', (string) ($project->facility_id ?? $facilities->first()->id)) === (string) $facility->id)>
                {{ $facility->Name }}
            </option>
        @endforeach
    </select>
    @error('facility_id')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror


    <label class="block font-semibold">Program</label>
    <select name="program_id" class="w-full border rounded px-3 py-2" required>
        @foreach($programs as $program)
            <option value="{{ $program->id }}" 
                @selected((string) old('program_id', (string) ($project->program_id ?? $programs->first()->id)) === (string) $program->id)>
                {{ $program->Name }}
            </option>
        @endforeach
    </select>
    @error('program_id')
        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
    @enderror




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
