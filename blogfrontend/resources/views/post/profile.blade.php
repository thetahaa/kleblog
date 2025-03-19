<!-- <!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Düzenle | Kle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-900 min-h-screen flex flex-col">
    
    <header class="bg-gray-800 shadow-sm sticky top-0 z-50">
        <nav class="max-w-6xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a class="text-2xl font-bold text-gray-300">Kle</a>
                
                <div class="relative">
                    <button id="menuButton" class="flex items-center space-x-1 text-gray-300 hover:text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </button>

                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-gray-700 text-white rounded-md shadow-lg py-1">
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-800 flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                            <span>Profil</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-white hover:bg-gray-800 flex items-center space-x-2">
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
        <div class="bg-gray-800 rounded-lg shadow-md p-8">
            <h1 class="text-2xl font-bold text-gray-100 mb-6">Profil Düzenle</h1>

            
            <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('PUT')

                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Ad Soyad</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                        class="w-full px-4 py-3 bg-gray-700 text-gray-100 rounded-lg border border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">E-Posta</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                        class="w-full px-4 py-3 bg-gray-700 text-gray-100 rounded-lg border border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Yeni Şifre (Opsiyonel)</label>
                    <div class="relative">
                        <input type="password" name="password"
                            class="w-full px-4 py-3 bg-gray-700 text-gray-100 rounded-lg border border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all pr-12">
                        <span id="toggle-password" class="absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-blue-500 transition-colors">
                            <i class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                </div>

                
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Yeni Şifre Tekrar</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-3 bg-gray-700 text-gray-100 rounded-lg border border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                </div>

                
                @if ($errors->any())
                    <div class="bg-red-600/10 text-red-600 p-3 rounded-lg text-sm">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition-colors">
                    Profili Güncelle
                </button>
            </form>
        </div>
    </main>

    
    <footer class="bg-gray-800 text-gray-400 mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <div class="text-center">
                <p class="text-sm">
                    © 2025 Kle. Tüm hakları saklıdır.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Şifre göster/gizle
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordField = this.previousElementSibling;
            const icon = this.querySelector('i');
            
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passwordField.type = "password";
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        });

        // Açılır menü kontrolü
        const menuButton = document.getElementById('menuButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        menuButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Dışarı tıklamada menüyü kapat
        document.addEventListener('click', (event) => {
            if (!menuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html> -->