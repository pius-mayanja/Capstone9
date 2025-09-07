<!DOCTYPE html>
<html>
<head>
    <title>Create Facility</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Create New Facility</h1>
    @include('facilities.form', [
        'action' => route('facilities.store'),
        'update' => false
    ])
</div>

</body>
</html>
