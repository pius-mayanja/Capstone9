<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment & Tools</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
        }
        .equipment-card {
            transition: all 0.3s ease;
            border-left: 4px solid #4f46e5;
        }
        .equipment-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 5px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .action-btn {
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: scale(1.05);
        }
        .search-btn {
            transition: all 0.2s ease;
        }
        .search-btn:hover {
            background-color: #2563eb;
        }
        .pagination .page-item.active .page-link {
            background-color: #4f46e5;
            color: white;
            border-color: #4f46e5;
        }
        .pagination .page-link {
            color: #4f46e5;
        }
        .pagination .page-link:hover {
            background-color: #eef2ff;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen">

<div class="max-w-7xl mx-auto p-6">
    <!-- Header Section -->
    <header class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-indigo-700 mb-2">
                    <i class="fas fa-tools mr-2"></i>Equipment & Tools
                </h1>
                <p class="text-gray-600">Manage and explore available equipment and tools</p>
            </div>
            <a href="{{ url('/') }}" class="text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-home mr-1"></i> Back to Home
            </a>
        </div>
    </header>

    <!-- Search and Actions Section -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <!-- Search Form -->
            <form method="GET" action="{{ route('equipment.index') }}" class="flex-1 w-full">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search by name, capability, domain..."
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <div class="absolute left-3 top-3.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                    <button type="submit" class="absolute right-0 top-0 h-full bg-indigo-600 text-white px-4 rounded-r-lg search-btn">
                        Search
                    </button>
                </div>
            </form>
            
            <!-- Add Button -->
            <a href="{{ route('equipment.create') }}"
               class="bg-green-600 text-white px-4 py-3 rounded-lg shadow hover:bg-green-500 flex items-center action-btn">
                <i class="fas fa-plus mr-2"></i> Add Equipment
            </a>
        </div>
    </div>

    <!-- Equipment Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse($equipment as $item)
            <div class="equipment-card bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-bold text-indigo-700">{{ $item->Name }}</h2>
                    <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-2 py-1 rounded">
                        {{ $item->Type }}
                    </span>
                </div>
                
                <div class="space-y-3 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-bolt text-indigo-500 mr-2 w-5"></i>
                        <strong class="text-gray-700 w-24">Capability:</strong>
                        <span class="text-gray-600">{{ $item->Capability }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-layer-group text-indigo-500 mr-2 w-5"></i>
                        <strong class="text-gray-700 w-24">Domain:</strong>
                        <span class="text-gray-600">{{ $item->Domain ?? '-' }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-building text-indigo-500 mr-2 w-5"></i>
                        <strong class="text-gray-700 w-24">Facility:</strong>
                        <span class="text-gray-600">{{ $item->facility->Name ?? 'Global' }}</span>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                    <div class="flex space-x-3">
                        <a href="{{ route('equipment.show', $item) }}" class="text-blue-600 hover:text-blue-800 action-btn" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('equipment.edit', $item) }}" class="text-green-600 hover:text-green-800 action-btn" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('equipment.destroy', $item) }}" onsubmit="return confirm('Delete this item?')" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:text-red-800 action-btn" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    <span class="text-xs text-gray-500">{{ $item->created_at->diffForHumans() }}</span>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12">
                <i class="fas fa-tools text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500 text-lg">No equipment found.</p>
                <p class="text-gray-400 mt-2">Try adjusting your search or add new equipment.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($equipment->hasPages())
    <div class="bg-white rounded-lg shadow px-6 py-4">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="text-sm text-gray-700 mb-4 md:mb-0">
                Showing <span class="font-medium">{{ $equipment->firstItem() }}</span>
                to <span class="font-medium">{{ $equipment->lastItem() }}</span>
                of <span class="font-medium">{{ $equipment->total() }}</span> results
            </div>
            
            <div class="pagination">
                {{ $equipment->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    // Add some subtle animations
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.equipment-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
        
        // Enhance pagination styling
        const paginationLinks = document.querySelectorAll('.pagination a');
        paginationLinks.forEach(link => {
            link.classList.add('px-3', 'py-2', 'border', 'rounded');
        });
    });
</script>

</body>
</html>