<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kle Blog</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 min-h-screen flex flex-col">
    <header class="bg-gray-800 shadow-sm sticky top-0 z-50">
        <nav class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a class="text-2xl font-bold text-gray-300">Blog</a>

                <div class="flex items-center gap-6">
                    <div class="hidden md:flex items-center bg-gray-700 rounded-full p-1 space-x-1">
                        <a href="?filter=yeni" 
                        class="px-5 py-2 text-sm font-medium rounded-full {{ request('filter') !== 'popüler' ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-600' }}">
                            En Yeniler
                        </a>
                        <a href="?filter=popüler" 
                        class="px-5 py-2 text-sm font-medium rounded-full {{ request('filter') === 'popüler' ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-600' }}">
                            En Popüler
                        </a>
                    </div>

                    <div class="relative">
    <button id="menuButton" class="flex items-center space-x-1 text-gray-300 hover:text-white">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
        </svg>
    </button>

    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-gray-700 text-white rounded-md shadow-lg py-1">
        <!-- Profil ve Çıkış Üstte -->
        <form method="GET" action="{{ route('profile.update') }}" class="w-full">
            <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-800 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                </svg>
                <span>Profil</span>
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full border-b border-gray-600">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-800 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                </svg>
                <span>Çıkış Yap</span>
            </button>
        </form>

        <!-- Kategoriler Altta -->
        <div class="pt-2">
            <div class="px-4 py-2 text-xs text-gray-400 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5"/>
                </svg>
                <span>Kategoriler</span>
            </div>
            @foreach($post['categories'] ?? [] as $category)
                <a  href="?category={{ $category->slug }}"
                   class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5"/>
                    </svg>
                    <span>{{ $category['name'] }}</span>
                </a>
            @endforeach
        </div>

        <!-- Etiketler Altta -->
        <div class="pt-2">
            <div class="px-4 py-2 text-xs text-gray-400 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5"/>
                </svg>
                <span>Etiketler</span>
            </div>
            @foreach($post['tags'] ?? [] as $tag)
                <a  href="?tag={{ $tag->slug }}"
                   class="flex items-center space-x-2 px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5"/>
                    </svg>
                    <span>{{ $tag['name'] }}</span>
                </a>
            @endforeach
        </div>

    </div>
</div>

                </div>
            </div>

            <div class="md:hidden px-4 py-3 bg-gray-800 border-t border-gray-700 mt-4">
                <div class="flex gap-2">
                    <a href="?filter=yeni" 
                    class="flex-1 text-center px-4 py-2 text-sm font-medium rounded-full {{ request('filter') !== 'popüler' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                        En Yeniler
                    </a>
                    <a href="?filter=popüler" 
                    class="flex-1 text-center px-4 py-2 text-sm font-medium rounded-full {{ request('filter') === 'popüler' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                        En Popüler
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-8 flex-1 w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if(!empty($posts) && count($posts) > 0)
            @foreach($posts as $post)
                <article class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <a href="{{ route('post.show', $post['id']) }}">
                    <img src="{{ ('http://localhost:8000' .'/'.$post['image']) }}"  class="w-full h-48 object-cover">
                    </a>
                    <div class="p-4">
                        <span class="inline-block px-2 py-1 bg-gray-700 text-gray-300 text-sm rounded-full mb-2">
                            {{ $post['categories']['name'] ?? '' }}
                        </span>
                        
                        <h2 class="text-xl font-bold text-gray-100 mb-2">
                            <a href="{{ route('post.show', $post['id']) }}" class="hover:text-gray-300">{{ $post ['title'] }}</a>
                        </h2>
                        
                        <p class="text-gray-400 text-sm mb-4 line-clamp-3">
                            <a href="{{ route('post.show', $post['id']) }}">
                            {{ $post ['content'] }}
                            </a>
                        </p>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($post['categories'] ?? [] as $category)
                                <span class="text-xs px-2 py-1 bg-gray-700 text-gray-300 rounded-full">
                                    #{{ $category['name'] ?? '' }}
                                </span>
                            @endforeach
                            
                            @foreach($post['tags'] ?? [] as $tag)
                                <span class="text-xs px-2 py-1 bg-gray-700 text-gray-300 rounded-full">
                                    #{{ $tag['name'] ?? '' }}
                                </span>
                            @endforeach
                        </div>
                        
               
                    </div>
                </article>
                
            @endforeach

            @else
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600 text-lg">Henüz bir post bulunmamaktadır.</p>
                </div>
            @endif
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-400 mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <div class="text-center">
                <p class="text-sm">
                    © 2025 Blog. Tüm hakları saklıdır.
                </p>
            </div>
        </div>
    </footer>

    <script>
        const menuButton = document.getElementById('menuButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        menuButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (event) => {
            if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>

</body>
</html>