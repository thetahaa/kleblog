<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kle | Anasayfa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
            <div class="text-center">
                <h3 class="text-3xl font-bold text-gray-800 mb-2">Hoş Geldiniz</h3>
                <p class="text-gray-500">Verilerinizi görmek için lütfen giriş yapın veya kayıt olun.</p>
            </div>

            <div class="space-y-6 mt-6">
                <div class="text-center">
                    <p class="text-gray-600">Hesabınız yoksa kayıt olarak başlayabilirsiniz.</p>
                </div>

                <div class="flex flex-col space-y-4">
                    <a href="{{ url('/register') }}" class="w-full">
                        <button type="button" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition-colors">
                            Kayıt Ol
                        </button>
                    </a>
                    <a href="{{ url('/login') }}" class="w-full">
                        <button type="button" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 rounded-lg transition-colors">
                            Giriş Yap
                        </button>
                    </a>
                </div>

                <p class="text-center text-gray-600 text-sm">
                    Zaten bir hesabınız var mı?
                    <a href="{{ url('/login') }}" class="text-blue-600 hover:text-blue-500 font-medium ml-1">
                        Giriş Yap
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>