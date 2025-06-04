<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo4.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kle | {{ $posts['title'] }}</title>
    @vite('resources/css/app.css')
    
    <style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>
</head>

<body class="bg-gray-900 min-h-screen flex flex-col">
    <header class="bg-gray-800 shadow-sm sticky top-0 z-50">
        <nav class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="/" class="text-2xl font-bold text-gray-300 hover:text-white transition-colors">Blog</a>
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
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                </svg>
                                <span>Profil</span>
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
        </nav>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-8 flex-1 w-full">
        <div class="grid grid-cols-1 gap-6">
            <article class="bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <img src="{{ 'http://localhost:8000' . '/' . $posts['image'] }}" alt="{{ $posts['title'] }}" class="w-full h-56 md:h-96 object-cover">
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-start">
                        <div class="space-y-2">
                            <div class="flex flex-wrap gap-2">
                                @foreach($posts['categories'] ?? ['Kategori Yok'] as $category)
                                <span class="inline-block px-3 py-1 bg-gray-700 text-gray-300 text-sm rounded-full">
                                    {{ $category['name'] }}
                                </span>
                                @endforeach
                            </div>
                            <h1 class="text-3xl font-bold text-gray-100">{{ $posts['title'] }}</h1>
                        </div>
                        <a href="/posts" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-md transition-colors flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
                            </svg>
                        </a>
                    </div>
                    <div class="prose prose-invert max-w-none">
                        <pre class="text-gray-400 font-sans whitespace-pre-wrap">{{ $posts['content'] }}</pre>
                    </div>
                    <div class="flex flex-wrap gap-2 pt-4">
                        @foreach($posts['tags'] ?? [] as $tag)
                        <span class="text-sm px-3 py-1.5 bg-gray-700 text-gray-300 rounded-full flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/>
                            </svg>
                            {{ $tag['name'] }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </article>

            <section class="bg-gray-800 rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-bold text-gray-100 mb-6 border-b border-gray-700 pb-3">
                    Yorumlar ({{ count(array_filter($posts['comments'], fn($c) => $c['status'] == 1)) }})
                </h2>

                <div class="relative group/comment-section">
                    <form action="{{ route('comments.store', $posts['id']) }}" method="POST" class="mb-8">
                        @csrf
                        <div class="mb-4 relative">
                            <textarea name="content" id="commentInput" rows="3" 
                                class="w-full bg-gray-700 text-gray-100 rounded-lg p-4 pr-12 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 resize-none hover:shadow-lg hover:shadow-purple-500/10 textarea-auto-resize"
                                placeholder="Yorum fikirlerini paylaş..."></textarea>
                        </div>
                        <button type="submit" id="submitButton" 
                            class="px-6 py-3.5 bg-gradient-to-r from-blue-500 via-purple-600 to-purple-700 text-white rounded-xl font-medium transition-all duration-500 flex items-center gap-2 group/btn relative overflow-hidden disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 disabled:hover:shadow-none hover:from-blue-600 hover:via-purple-700 hover:to-purple-800 hover:scale-[1.02] hover:shadow-2xl hover:shadow-purple-500/20 active:scale-95">
                            <div class="absolute inset-0 overflow-hidden">
                                <div class="absolute -inset-full group-hover/btn:animate-shine opacity-30 bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6 transition-transform group-hover/btn:rotate-[360deg] duration-700">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785c0 .002-.002.003-.003.002l-.025.024m0 0A.75.75 0 0 1 5.4 21c.001-.005.002-.01.003-.015l.025-.025m0 0a.75.75 0 0 1 1.05 0l.01.01c.041.047.092.1.154.155.208.209.46.452.753.728.586.556 1.396 1.33 2.496 1.807.847.364 1.81.549 2.834.549Z"/>
                            </svg>
                            <span class="tracking-wide group-hover/btn:translate-x-1 transition-transform duration-300">Yorumu Gönder</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 opacity-0 group-hover/btn:opacity-100 transition-all -translate-x-2 group-hover/btn:translate-x-0 duration-300">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="space-y-0">
                    @forelse($posts['comments'] as $comment)
                        @if($comment['status'] == 1)
                        <div class="rounded-lg p-4 animate-fade-in">
                            <div class="flex items-center justify-between mb-0">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-500 flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">{{ strtoupper(substr($comment['user']['name'], 0, 1)) }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <span class="font-medium text-gray-100">{{ $comment['user']['name'] }}</span>
                                        <span class="text-gray-400 text-sm">{{ \Carbon\Carbon::parse($comment['created_at'])->locale('tr')->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-content pl-11">
                                <p class="text-gray-300 line-clamp-3 transition-all duration-300">{{ $comment['content'] }}</p>
                                <button class="text-purple-400 text-sm mt-1 read-more-btn hidden">Devamını oku</button>
                            </div>
                        </div>
                        @endif
                    @empty
                        <div class="text-center py-6">
                            <p class="text-gray-400 mb-2">Henüz yorum yok</p>
                            <p class="text-sm text-gray-500">İlk yorumu sen yaparak tartışmayı başlat!</p>
                        </div>
                    @endforelse
                </div>
            </section>
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

        const commentInput = document.getElementById('commentInput');
        const submitButton = document.getElementById('submitButton');

        commentInput.style.height = `${commentInput.scrollHeight}px`;
        commentInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = `${this.scrollHeight}px`;
            updateButtonState();
        });

        function updateButtonState() {
            submitButton.disabled = commentInput.value.trim().length === 0;
        }
        updateButtonState();

        document.querySelectorAll('.comment-content').forEach(comment => {
            const content = comment.querySelector('p');
            const button = comment.querySelector('.read-more-btn');
            
            const checkOverflow = () => {
                button.classList.toggle('hidden', content.scrollHeight <= content.clientHeight);
            };
            
            checkOverflow();
            window.addEventListener('resize', checkOverflow);
            
            button.addEventListener('click', () => {
                content.classList.toggle('line-clamp-3');
                button.textContent = content.classList.contains('line-clamp-3') 
                    ? 'Devamını oku' 
                    : 'Daha az göster';
            });
        });
    </script>
</body>
</html>