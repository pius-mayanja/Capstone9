<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Service</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-500 via-indigo-500 to-purple-500 text-gray-800">

  <div class="relative max-w-3xl w-full mx-4 p-8 rounded-2xl shadow-2xl bg-white/20 backdrop-blur-lg border border-white/30 animate-[fadeIn_0.8s_ease-in-out]">
    <a href="{{ url('/') }}" 
     class="absolute top-4 left-4 flex items-center text-white hover:text-yellow-200 font-semibold transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Back to Home
    </a>

    <!-- Decorative top circle -->
    <div class="absolute -top-8 -left-8 w-20 h-20 bg-white/30 rounded-full blur-2xl"></div>
    <div class="absolute -bottom-10 -right-10 w-28 h-28 bg-pink-400/30 rounded-full blur-3xl"></div>

    <!-- Header -->
    <h1 class="text-3xl font-extrabold text-white mb-6 text-center drop-shadow-md">
       Register New Service
    </h1>

    <!--  Flash & Error Messages -->
    @if (session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-100/80 border border-green-300 text-green-800 text-sm backdrop-blur-md shadow">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 rounded-lg bg-red-100/80 border border-red-300 text-red-800 text-sm backdrop-blur-md shadow">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-4 p-4 rounded-lg bg-yellow-100/80 border border-yellow-300 text-yellow-800 text-sm backdrop-blur-md shadow">
            <strong> Please fix the following:</strong>
            <ul class="list-disc list-inside mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card content -->
    <div class="bg-white/80 backdrop-blur-md rounded-xl p-6 shadow-inner">
      @include('services.form', ['action' => route('services.store'), 'update' => false])
    </div>

    <!-- Footer text -->
    <p class="text-sm text-center text-white/80 mt-6">
      Need help? <a href="#" class="text-yellow-200 hover:text-yellow-300 font-medium">Contact Support</a>
    </p>
  </div>

</body>
</html>
