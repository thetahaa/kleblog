<!DOCTYPE html>
<html lang="tr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logo4.png') }}">
    <title>kle | Anasayfa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    animation: {
                        'logo-bounce': 'logo-bounce 1.2s ease-in-out infinite',
                    },
                    keyframes: {
                        'logo-bounce': {
                            '0%, 100%': { 
                                transform: 'translateY(0) rotate(0deg)',
                                opacity: 1
                            },
                            '50%': { 
                                transform: 'translateY(-15px) rotate(8deg)',
                                opacity: 0.9
                            }
                        }
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 transition-colors duration-300">
            <div class="text-center">
                <!-- Logo & Başlık -->
                <div class="flex items-center justify-center gap-3 mb-2">
                    <img src="{{ asset('images/logo4.png') }}" 
                         alt="Logo" 
                         class="w-14 h-14 object-contain 
                                animate-logo-bounce
                                hover:animate-none
                                hover:scale-110
                                hover:rotate-12
                                transition-transform
                                duration-300">
                    <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-100">Hoş Geldiniz 👋</h3>
                </div>
                <p class="text-gray-500 dark:text-gray-400">Verilerinizi görmek için lütfen giriş yapın veya kayıt olun.</p>
            </div>

            <div class="space-y-6 mt-6">
                <div class="text-center">
                    <p class="text-gray-600 dark:text-gray-300">Hesabınız yoksa kayıt olarak başlayabilirsiniz.</p>
                </div>

                <div class="flex flex-col space-y-4">
                    <a href="{{ url('/register') }}" class="w-full">
                        <button type="button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition-colors dark:bg-blue-700 dark:hover:bg-blue-600">
                            Kayıt Ol
                        </button>
                    </a>
                    <a href="{{ url('/login') }}" class="w-full">
                        <button type="button" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 rounded-lg transition-colors dark:bg-green-700 dark:hover:bg-green-600">
                            Giriş Yap
                        </button>
                    </a>
                </div>

                <p class="text-center text-gray-600 dark:text-gray-400 text-sm">
                    Zaten bir hesabınız var mı?
                    <a href="{{ url('/login') }}" class="text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300 font-medium ml-1 transition-colors">
                        Giriş Yap
                    </a>
                </p>
            </div>
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
    </script>
</body>
</html>