<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>kle | {{ $posts['title'] }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-gray-800 shadow-sm sticky top-0 z-50">
        <nav class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a class="text-2xl font-bold text-gray-300">Blog</a>
                
                <!-- Sağ Menü -->
                <div class="relative">
                    <button id="menuButton" class="flex items-center space-x-1 text-gray-300 hover:text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>

                    <!-- Dropdown Menü -->
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-gray-700 text-white rounded-md shadow-lg py-1">
                        <form method="GET" class="w-full">
                            <button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-800 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                                <span>Profil</span>
                            </button>
                        </form>

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-800 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"/>
                                </svg>
                                <span>Çıkış Yap</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-8 flex-1 w-full">
        <div class="grid grid-cols-1 gap-6">
            <article class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <!-- Post Image -->
                <img src="{{ ('http://localhost:8000' .'/'.$posts['image']) }}" class="w-full h-56 md:h-64 object-cover">                
                <!-- Post Content -->
                <div class="p-4 space-y-4">
                    <!-- Header Section -->
                    <div class="flex justify-between items-start">
                        <div>
                            @foreach($posts['categories'] ?? [] as $category)
                                <span class="inline-block px-2 py-1 bg-gray-700 text-gray-300 text-sm rounded-full mb-2">
                                    {{ $category['name'] ?? 'Kategori Yok' }}
                                </span>
                            @endforeach
                            <h2 class="text-xl font-bold text-gray-100 mb-2">
                                {{ $posts['title'] }}
                            </h2>
                        </div>
                        <!-- Geri Butonu -->
                        @if(isset($page))
                            <a href="{{ url()->previous() . '?page=' . $page }}" class="px-3 py-1 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-md transition-colors">← Geri</a>
                        @else
                            <a href="{{ url()->previous() }}" class="px-3 py-1 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-md transition-colors">← Geri</a>
                        @endif
                    </div>

                    <!-- Post Content -->
                    <p class="text-gray-400 text-sm whitespace-pre-line leading-relaxed">
                        {{ $posts['content'] }}
                    </p>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2">
                        @foreach($posts['tags'] ?? [] as $tag)
                            <span class="text-xs px-2 py-1 bg-gray-700 text-gray-300 rounded-full">
                                #{{ $tag['name'] }}
                            </span>
                        @endforeach
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

    <!-- Düzeltilmiş Menü Scripti -->
    <script>
        const menuButton = document.getElementById('menuButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Menü toggle
        menuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        // Dışarı tıklama kontrolü
        document.addEventListener('click', (e) => {
            if (!menuButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Menü içi tıklamalar
        dropdownMenu.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    </script>
</body>
</html>