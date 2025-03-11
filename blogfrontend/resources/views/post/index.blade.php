<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kle Blog</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex flex-col" style="background-color: #090911;">
    <!-- Header -->
    <header class="shadow-sm sticky top-0 z-50" style="background-color: #18181B;">
        <nav class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="/" class="text-2xl font-bold text-white">Blog</a>
                
                <!-- Hamburger Menu & Dropdown -->
                <div class="relative">
                    <button @click="isOpen = !isOpen" class="text-gray-300 hover:text-indigo-400 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div x-show="isOpen" @click.away="isOpen = false" 
                         class="absolute right-0 mt-2 w-48 bg-gray-700 rounded-lg  py-2 transition-all duration-300"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95">
                        <a href="#" class="block px-4 py-2 text-gray-200 hover:bg-gray-600">Profil</a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-200 hover:bg-gray-600">Çıkış Yap</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-8 flex-1 w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <article class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <!-- Post Image -->
                    <img class="w-full h-48 object-cover">
                    
                    <!-- Post Content -->
                    <div class="p-4">
                        <!-- Category -->
                        <span class="inline-block px-2 py-1 bg-gray-700 text-indigo-300 text-sm rounded-full mb-2">
                        </span>
                        
                        <!-- Title -->
                        <h2 class="text-xl font-bold text-gray-100 mb-2">
                            <a href="#" class="hover:text-indigo-400"></a>
                        </h2>
                        
                        <!-- Excerpt -->
                        <p class="text-gray-400 text-sm mb-4 line-clamp-3">
                        </p>
                        
                        <!-- Tags -->
                        <div class="flex flex-wrap gap-2 mb-4">
                                <span class="text-xs px-2 py-1 bg-gray-700 text-gray-300 rounded-full">
                                </span>
                        </div>
                        
                        <!-- Meta -->
                        <div class="flex items-center text-sm text-gray-500">
                            <span>📅 </span>
                            <span class="mx-2">•</span>
                            <span>⏳</span>
                        </div>
                    </div>
                </article>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-400 mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <div class="text-center">
                <p class="text-sm">
                    © 2025 Blog. Tüm hakları saklıdır.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>