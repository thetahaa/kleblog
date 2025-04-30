<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo4.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        .post-card {
            animation: cardEntrance 0.6s ease-out forwards;
            opacity: 0;
        }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
    </style>
    <title>Kle | Blog</title>
</head>
<body class="bg-gray-900 min-h-screen flex flex-col">
    <header class="bg-gray-800 shadow-sm sticky top-0 z-50">
        <nav class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a class="text-2xl font-bold text-gray-300">Blog</a>
                <div class="flex items-center gap-6">
                    <div class="hidden md:flex items-center gap-4">
                        <div class="flex items-center bg-gray-700 rounded-full p-1 space-x-1">
                            <a href="?{{ http_build_query(array_merge(request()->except('filter'), ['filter' => 'yeni'])) }}" 
                               class="px-5 py-2 text-sm font-medium rounded-full {{ request('filter') !== 'popüler' ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-600' }}">
                                En Yeniler
                            </a>
                            <a href="?{{ http_build_query(array_merge(request()->except('filter'), ['filter' => 'popüler'])) }}" 
                               class="px-5 py-2 text-sm font-medium rounded-full {{ request('filter') === 'popüler' ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-600' }}">
                                En Popüler
                            </a>
                        </div>
                    </div>

                    <button id="filterToggle" class="hidden md:flex items-center gap-2 px-4 py-2 bg-gray-800 text-gray-300 rounded-lg hover:bg-gray-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                        </svg>
                    </button>

                    <div class="relative">
                        <button id="menuButton" class="flex items-center space-x-1 text-gray-300 hover:text-white">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                            </svg>
                        </button>

                        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-gray-700 text-white rounded-md shadow-lg py-1">
                            <form method="GET" action="{{ route('profile.update') }}" class="w-full">
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-800 flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                    </svg>
                                    <span>{{ Auth::user()->name ?? 'Profil' }}</span>
                                </button>
                            </form>

                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-800 flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                                    </svg>
                                    <span>Çıkış Yap</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:hidden px-4 py-3 bg-gray-800 border-t border-gray-700 mt-4">
                <button id="mobileFilterToggle" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 transition-colors mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <span>Filtrele</span>
                </button>

                <div id="mobileFilterContent" class="max-h-0 overflow-hidden transition-all duration-900 space-y-4">
                    <div class="flex gap-2">
                        <a href="?{{ http_build_query(array_merge(request()->except('filter'), ['filter' => 'yeni'])) }}" 
                           class="flex-1 text-center px-4 py-2 text-sm font-medium rounded-full {{ request('filter') !== 'popüler' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                            En Yeniler
                        </a>
                        <a href="?{{ http_build_query(array_merge(request()->except('filter'), ['filter' => 'popüler'])) }}" 
                           class="flex-1 text-center px-4 py-2 text-sm font-medium rounded-full {{ request('filter') === 'popüler' ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                            En Popüler
                        </a>
                    </div>

                    @if(request()->has('category') || request()->has('tag'))
                    <div class="flex justify-end">
                        <a href="?{{ http_build_query(request()->except(['category', 'tag'])) }}" 
                           class="px-3 py-1 text-sm text-red-400 hover:text-red-300 transition-colors">
                            Kategori/Etiket Temizle
                        </a>
                    </div>
                    @endif

                    <div>
                        <h3 class="text-gray-400 text-sm font-medium mb-2">Kategoriler</h3>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $allCategories = [];
                                foreach($posts as $post) {
                                    if(isset($post['categories'])) {
                                        foreach($post['categories'] as $category) {
                                            $allCategories[$category['slug']] = $category;
                                        }
                                    }
                                }
                            @endphp
                            @foreach($allCategories as $category)
                                <a href="?{{ http_build_query(array_merge(request()->query(), ['category' => $category['slug']])) }}" 
                                   class="px-3 py-1 text-sm rounded-full {{ request('category') == $category['slug'] ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                                    {{ $category['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h3 class="text-gray-400 text-sm font-medium mb-2">Etiketler</h3>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $allTags = [];
                                foreach($posts as $post) {
                                    if(isset($post['tags'])) {
                                        foreach($post['tags'] as $tag) {
                                            $allTags[$tag['slug']] = $tag;
                                        }
                                    }
                                }
                            @endphp
                            @foreach($allTags as $tag)
                                <a href="?{{ http_build_query(array_merge(request()->query(), ['tag' => $tag['slug']])) }}" 
                                   class="px-3 py-1 text-sm rounded-full {{ request('tag') == $tag['slug'] ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                                    {{ $tag['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div id="filterDropdown" class="bg-gray-800 border-t border-gray-700 overflow-hidden transition-all duration-300 max-h-0">
            <div class="max-w-6xl mx-auto px-4 py-4">
                @if(request()->has('category') || request()->has('tag'))
                <div class="mb-4 flex justify-end">
                    <a href="?{{ http_build_query(request()->except(['category', 'tag'])) }}" 
                       class="px-3 py-1 text-sm text-red-400 hover:text-red-300 transition-colors">
                        Kategori/Etiket Temizle
                    </a>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-gray-400 text-sm font-medium mb-3">Kategoriler</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($allCategories as $category)
                                <a href="?{{ http_build_query(array_merge(request()->query(), ['category' => $category['slug']])) }}" 
                                   class="px-3 py-1 text-sm rounded-full {{ request('category') == $category['slug'] ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                                    {{ $category['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-gray-400 text-sm font-medium mb-3">Etiketler</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($allTags as $tag)
                                <a href="?{{ http_build_query(array_merge(request()->query(), ['tag' => $tag['slug']])) }}" 
                                   class="px-3 py-1 text-sm rounded-full {{ request('tag') == $tag['slug'] ? 'bg-indigo-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }}">
                                    {{ $tag['name'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-8 flex-1 w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if(!empty($posts) && count($posts) > 0)
                @foreach($posts as $index => $post)
                    <article class="post-card bg-gray-800 rounded-lg shadow-md overflow-hidden 
                                  transform transition-all duration-200 hover:scale-[0.90]
                                  @if($index % 3 == 1) delay-1 @endif
                                  @if($index % 3 == 2) delay-2 @endif">
                        <a href="{{ route('post.show', $post['id']) }}" class="block relative group">
                            <div class="relative overflow-hidden">
                                <img src="{{ ('http://localhost:8000' .'/'.$post['image']) }}" 
                                     class="w-full h-48 object-cover transition-transform duration-200 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t"></div>
                            </div>
                            <div class="p-4">
                                @if(isset($post['categories']) && count($post['categories']) > 0)
                                    <span class="inline-block px-2 py-1 bg-gray-700 text-gray-300 text-sm rounded-full mb-2 
                                              transition-all duration-300 hover:bg-indigo-600">
                                        {{ $post['categories'][0]['name'] ?? '' }}
                                    </span>
                                @endif
                                
                                <h2 class="text-xl font-bold text-gray-100 mb-2 transition-colors duration-300 group-hover:text-indigo-400">
                                    {{ $post['title'] }}
                                </h2>
                                
                                <p class="text-gray-400 text-sm mb-4 line-clamp-3 transition-opacity duration-300 group-hover:opacity-80">
                                    {{ strip_tags($post['content']) }}
                                </p>
                                
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach($post['tags'] ?? [] as $tag)
                                        <span class="text-xs px-2 py-1 bg-gray-700 text-gray-300 rounded-full 
                                                  inline-flex items-center gap-1 transition-all duration-300 
                                                  hover:bg-indigo-600 hover:scale-105">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                                            </svg>
                                            {{ $tag['name'] ?? '' }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            @else
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600 text-lg">Henüz bir post bulunmamaktadır.</p>
                </div>
            @endif
        </div>
    </main>

    <footer class="bg-gray-800 border-t border-gray-700 mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-6">
            <div class="flex flex-col items-center space-y-2">
                <p class="text-xs text-gray-400 text-center">
                    © {{ now()->year }} Blog. Tüm hakları saklıdır.
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
        // Animasyonları tetikleme
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = "1";
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.post-card').forEach((card) => {
            observer.observe(card);
        });

        // Filtreleme fonksiyonları
        const filterToggle = document.getElementById('filterToggle');
        const filterDropdown = document.getElementById('filterDropdown');
        let isForceOpened = false;

        if(filterToggle && filterDropdown) {
            filterToggle.addEventListener('mouseenter', () => {
                if(!isForceOpened) {
                    filterDropdown.classList.remove('max-h-0');
                    filterDropdown.classList.add('max-h-[500px]', 'py-4');
                }
            });

            const handleHoverClose = (e) => {
                if(!isForceOpened && 
                !filterDropdown.contains(e.relatedTarget) && 
                !filterToggle.contains(e.relatedTarget)) {
                    filterDropdown.classList.add('max-h-0');
                    filterDropdown.classList.remove('max-h-[500px]', 'py-4');
                }
            };
            
            filterToggle.addEventListener('mouseleave', handleHoverClose);
            filterDropdown.addEventListener('mouseleave', handleHoverClose);

            filterToggle.addEventListener('click', (e) => {
                isForceOpened = !isForceOpened;
                if(isForceOpened) {
                    filterDropdown.classList.remove('max-h-0');
                    filterDropdown.classList.add('max-h-[500px]', 'py-4');
                } else {
                    filterDropdown.classList.add('max-h-0');
                    filterDropdown.classList.remove('max-h-[500px]', 'py-4');
                }
                e.stopPropagation();
            });

            document.addEventListener('click', (e) => {
                if(!filterToggle.contains(e.target) && 
                !filterDropdown.contains(e.target)) {
                    isForceOpened = false;
                    filterDropdown.classList.add('max-h-0');
                    filterDropdown.classList.remove('max-h-[500px]', 'py-4');
                }
            });
        }

        // Mobil filtre
        const mobileFilterToggle = document.getElementById('mobileFilterToggle');
        const mobileFilterContent = document.getElementById('mobileFilterContent');
        if(mobileFilterToggle) {
            mobileFilterToggle.addEventListener('click', () => {
                const isOpen = mobileFilterContent.classList.contains('max-h-0');
                mobileFilterContent.classList.toggle('max-h-0');
                mobileFilterContent.classList.toggle('max-h-[1000px]');
            });
        }

        // Menü toggle
        const menuButton = document.getElementById('menuButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        if(menuButton && dropdownMenu) {
            menuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
            });
            
            document.addEventListener('click', (event) => {
                if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>