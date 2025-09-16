<!DOCTYPE html>
<html>
<head>
    <title>Create Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Create New Project</h1>

    @include('projects.form', [
        'action' => route('projects.store'),
        'update' => false,
        'project' => new \App\Models\Project(),
        'facilities' => $facilities,
        'programs' => $programs
    ])
</div>

</body>
</html>
