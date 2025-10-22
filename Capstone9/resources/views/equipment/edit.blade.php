<!DOCTYPE html>
<html>
<head>
    <title>Edit Equipment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Equipment</h1>

    @include('equipment.form', [
        'action' => route('equipment.update', $equipment),
        'update' => true
    ])
</div>

</body>
</html>
