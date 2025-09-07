<form method="POST" action="{{ $action }}">
    @csrf
    @if($update) @method('PUT') @endif

    <div class="mb-4">
        <label class="block font-semibold">Full Name</label>
        <input type="text" name="FullName" value="{{ old('FullName', $participant->FullName ?? '') }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Email</label>
        <input type="email" name="Email" value="{{ old('Email', $participant->Email ?? '') }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Affiliation</label>
        <input type="text" name="Affiliation" value="{{ old('Affiliation', $participant->Affiliation ?? '') }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Specialization</label>
        <input type="text" name="Specialization" value="{{ old('Specialization', $participant->Specialization ?? '') }}"
               class="w-full border rounded px-3 py-2" required>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Description</label>
        <textarea name="Description" class="w-full border rounded px-3 py-2">{{ old('Description', $participant->Description ?? '') }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Cross-Skill Trained</label>
        <select name="CrossSkillTrained" class="w-full border rounded px-3 py-2" required>
            <option value="0" @selected(old('CrossSkillTrained', $participant->CrossSkillTrained ?? '') == false)>No</option>
            <option value="1" @selected(old('CrossSkillTrained', $participant->CrossSkillTrained ?? '') == true)>Yes</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block font-semibold">Institution</label>
        <select name="Institution" class="w-full border rounded px-3 py-2" required>
            <option value="SCIT" @selected(old('Institution', $participant->Institution ?? '') === 'SCIT')>SCIT</option>
            <option value="CEDAT" @selected(old('Institution', $participant->Institution ?? '') === 'CEDAT')>CEDAT</option>
            <option value="UniPod" @selected(old('Institution', $participant->Institution ?? '') === 'UniPod')>UniPod</option>
            <option value="UIRI" @selected(old('Institution', $participant->Institution ?? '') === 'UIRI')>UIRI</option>
            <option value="Lwera" @selected(old('Institution', $participant->Institution ?? '') === 'Lwera')>Lwera</option>
        </select>
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
        Save Participant
    </button>
</form>
