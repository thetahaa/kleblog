<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kle | Giriş Yap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-gray-800 mb-2">Giriş Yap</h3>
                    <p class="text-gray-500">Hesabına erişmek için bilgilerini gir</p>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">E-Posta</label>
                        <input type="email" name="email" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Şifre</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required 
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all pr-12">
                            <span id="toggle-password" class="absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer text-gray-400 hover:text-blue-500 transition-colors">
                                <i class="fa fa-eye-slash"></i>
                            </span>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 text-red-600 p-3 rounded-lg text-sm">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 rounded-lg transition-colors">
                    Giriş Yap
                </button>

                <p class="text-center text-gray-600 text-sm">
                    Hesabın yok mu?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500 font-medium ml-1">
                        Kayıt Ol
                    </a>
                </p>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passwordField.type = "password";
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        });
    </script>
</body>
</html>