<!DOCTYPE html>
<html>
<head>
    <title>Create Outcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Create New Outcome</h1>

    @include('outcomes.form', [
        'action' => route('outcomes.store'),
        'update' => false,
        'outcome' => new \App\Models\Outcome(),
        'projects' => $projects
    ])
</div>

</body>
</html>
