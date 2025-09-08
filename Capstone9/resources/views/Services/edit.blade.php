<!DOCTYPE html>
<html>
<head>
    <title>Edit Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Edit Service</h1>
    @include('services.form', ['action' => route('services.update', $service), 'update' => true])
</div>
</body>
</html>
