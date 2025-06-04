<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo4.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes cardEntrance {
            from { opacity: 0; transform: translateY(50px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        .post-card {
            animation: cardEntrance 0.6s ease-out forwards;
            opacity: 0;
        }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        
        @keyframes featuredEntrance {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .featured-post {
            animation: featuredEntrance 0.8s ease-out;
        }
        .back-to-top {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            width: 3rem;
            height: 3rem;
            background-color: #4f46e5;
            color: white;
            border-radius: 9999px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        .gradient-overlay {
            background: linear-gradient(to top, rgba(17, 24, 39, 0.9) 20%, transparent 100%);
        }
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
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
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-600/50 flex items-center space-x-2 transition-colors rounded-b-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
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
                    <div class="flex justify-end -mt-2">
                        <a href="?{{ http_build_query(request()->except(['category', 'tag'])) }}" class="flex items-center gap-1 text-red-400 hover:text-red-300 text-sm px-2 py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                            </svg>
                            <span>Temizle</span>
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
                    <div class="mb-2 flex justify-end">
                        <a href="?{{ http_build_query(request()->except(['category', 'tag'])) }}" class="flex items-center gap-1 text-red-400 hover:text-red-300 text-sm px-2 py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                            </svg>
                            <span>Temizle</span>
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
        @if(!empty($posts) && count($posts) > 0 && request('filter') === 'popüler')
        <div class="featured-post mb-10">
            <div class="relative rounded-xl overflow-hidden shadow-2xl group">
                <div class="absolute inset-0 gradient-overlay z-10"></div>
                <img src="{{ ('http://localhost:8000' .'/'.$posts[0]['image']) }}" 
                     class="w-full h-96 object-cover transform transition-transform duration-500 group-hover:scale-105">
                
                <div class="absolute bottom-0 left-0 z-20 p-8 w-full">
                    <div class="max-w-3xl">
                        @if(isset($posts[0]['categories']) && count($posts[0]['categories']) > 0)
                            <a href="?{{ http_build_query(array_merge(request()->query(), ['category' => $posts[0]['categories'][0]['slug']])) }}"
                               class="inline-block px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-full mb-4 shadow-lg hover:bg-indigo-500 transition-colors">
                                {{ $posts[0]['categories'][0]['name'] ?? '' }}
                            </a>
                        @endif
                        
                        <h2 class="text-3xl font-bold text-white mb-4">
                            <a href="{{ route('post.show', $posts[0]['id']) }}" class="hover:text-indigo-400 transition-colors">
                                {{ $posts[0]['title'] }}
                            </a>
                        </h2>
                        
                        <div class="flex flex-wrap gap-2">
                            @foreach($posts[0]['tags'] ?? [] as $tag)
                                <span class="text-xs px-3 py-1 bg-gray-800/80 text-gray-300 rounded-full">
                                    #{{ $tag['name'] ?? '' }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if(!empty($posts) && count($posts) > 0)
                @foreach($posts as $index => $post)
                    @if(!(request('filter') === 'popüler' && $index === 0))
                    <article class="post-card bg-gray-800 rounded-lg shadow-md overflow-hidden transform transition-all duration-200 hover:scale-95
                                  @if($index % 3 == 1) delay-1 @endif
                                  @if($index % 3 == 2) delay-2 @endif">
                        <a href="{{ route('post.show', $post['id']) }}" class="block relative group">
                            <div class="relative overflow-hidden">
                                <img src="{{ ('http://localhost:8000' .'/'.$post['image']) }}" 
                                     class="w-full h-48 object-cover transition-transform duration-200 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/50 to-transparent"></div>
                            </div>
                            <div class="p-4">
                                @if(isset($post['categories']) && count($post['categories']) > 0)
                                    <span class="inline-block px-2 py-1 bg-gray-700 text-gray-300 text-sm rounded-full mb-2 transition-all duration-300 hover:bg-indigo-600">
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
                                        <span class="text-xs px-2 py-1 bg-gray-700 text-gray-300 rounded-full inline-flex items-center gap-1 transition-all duration-300 hover:bg-indigo-600 hover:scale-105">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                            </svg>
                                            {{ $tag['name'] ?? '' }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    </article>
                    @endif
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

    <button id="backToTop" class="back-to-top">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>

    <script>
        // Yukarı Çık Butonu
        const backToTop = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTop.classList.add('show');
            } else {
                backToTop.classList.remove('show');
            }
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Animasyonlar
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

        // Filtre Aç/Kapat
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

        // Mobil Filtre
        const mobileFilterToggle = document.getElementById('mobileFilterToggle');
        const mobileFilterContent = document.getElementById('mobileFilterContent');
        if(mobileFilterToggle) {
            mobileFilterToggle.addEventListener('click', () => {
                const isOpen = mobileFilterContent.classList.contains('max-h-0');
                mobileFilterContent.classList.toggle('max-h-0');
                mobileFilterContent.classList.toggle('max-h-[1000px]');
            });
        }

        // Kullanıcı Menüsü
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