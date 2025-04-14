<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo4.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kle | Gizlilik Politikası</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-900 min-h-screen flex flex-col">
    <header class="bg-gray-800 shadow-sm sticky top-0 z-50">
        <nav class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a class="text-2xl font-bold text-gray-300">Blog</a>
                
                <div class="relative">
                    <button id="menuButton" class="flex items-center space-x-1 text-gray-300 hover:text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>

                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-gray-700 text-white rounded-md shadow-lg py-1">
                        <form method="GET" action="{{ route('post.index') }}" class="w-full">
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-white hover:bg-gray-800 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                <span>Ana Sayfa</span>
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

    <main class="max-w-6xl mx-auto px-4 py-8 flex-1 w-full">
        <div class="bg-gray-800 rounded-lg shadow-xl p-6 md:p-8 lg:p-10 space-y-8 text-gray-300">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-6 border-b border-gray-700 pb-4">Gizlilik Politikası Aydınlatma Metni</h1>
            @if($privacy_policy)
                <p>{{ $privacy_policy['name'] ?? '' }}</p>
            @else
                <p>Gizlilik Politikası metni yüklenemedi.</p>
            @endif

    </main>

    <footer class="bg-gray-800 border-t border-gray-700 mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-6">
            <div class="flex flex-col items-center space-y-2">
                <p class="text-xs text-gray-400 text-center">
                    © 2025 Blog. Tüm hakları saklıdır.
                </p>
                
                <div class="flex space-x-4">
                    <a href="/kvkk" class="text-gray-400 hover:text-gray-300 text-xs transition-colors">
                        KVKK
                    </a>
                    <span class="text-gray-400 text-xs">|</span>
                    <a href="/gizlilik-politikasi" class="text-gray-400 hover:text-gray-300 text-xs transition-colors">
                        Gizlilik Politikası
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const menuButton = document.getElementById('menuButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        menuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!menuButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        dropdownMenu.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    </script>
</body>
</html>