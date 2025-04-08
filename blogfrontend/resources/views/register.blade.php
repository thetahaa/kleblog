<!DOCTYPE html>
<html lang="tr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kle | Kayıt Ol</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 transition-colors duration-300">
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-2">Hesap Oluştur</h3>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ad Soyad</label>
                        <input type="text" name="name" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400">
                        @error('name')
                            <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">E-Posta</label>
                        <input type="email" name="email" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Şifre</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400 pr-12">
                            <span id="toggle-password" class="absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-blue-500 dark:hover:text-blue-400 transition-colors">
                                <i class="fa fa-eye-slash"></i>
                            </span>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Şifre Tekrarı</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation" required 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all dark:bg-gray-700 dark:text-gray-100 dark:placeholder-gray-400 pr-12">
                            <span id="toggle-password-confirmation" class="absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-blue-500 dark:hover:text-blue-400 transition-colors">
                                <i class="fa fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 p-3 rounded-lg text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition-colors dark:bg-blue-700 dark:hover:bg-blue-600">
                    Kayıt Ol
                </button>

                <p class="text-center text-gray-600 dark:text-gray-400 text-sm">
                    Zaten hesabın var mı?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 font-medium ml-1 transition-colors">
                        Giriş Yap
                    </a>
                </p>
            </form>
        </div>
    </div>

    <button onclick="toggleDarkMode()" class="fixed bottom-4 right-4 p-3 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 shadow-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
        <i id="theme-icon" class="fas fa-moon"></i>
    </button>

    <script>
        function toggleDarkMode() {
            const html = document.documentElement;
            const themeIcon = document.getElementById('theme-icon');
            
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            
            themeIcon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.getElementById('theme-icon').className = 'fas fa-sun';
        } else {
            document.documentElement.classList.remove('dark');
            document.getElementById('theme-icon').className = 'fas fa-moon';
        }

        document.getElementById('toggle-password').addEventListener('click', function() {
            togglePasswordVisibility('password', this);
        });

        document.getElementById('toggle-password-confirmation').addEventListener('click', function() {
            togglePasswordVisibility('password_confirmation', this);
        });

        function togglePasswordVisibility(fieldId, button) {
            const field = document.getElementById(fieldId);
            const icon = button.querySelector('i');
            field.type = field.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye-slash');
            icon.classList.toggle('fa-eye');
        }
    </script>
</body>
</html>