<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kle | KVKK</title>
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
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-6 border-b border-gray-700 pb-4">KVKK Aydınlatma Metni</h1>
            
            <!-- 1. Veri Sorumlusu -->
            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-white">1. Veri Sorumlusu</h2>
                <p class="leading-relaxed">Kişisel verileriniz, Kle Blog ("Blog") tarafından, 6698 sayılı Kişisel Verilerin Korunması Kanunu ("KVKK") ve ilgili mevzuat kapsamında veri sorumlusu sıfatıyla işlenecektir.</p>
            </section>

            <!-- 2. Veri İşleme Amaçları -->
            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-white">2. Veri İşleme Amaçları</h2>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Blogumuza üyelik sürecinin yönetilmesi</li>
                    <li>İletişim taleplerinize yanıt verilmesi</li>
                    <li>Yorum, abonelik veya etkileşimlerinizin takibi</li>
                    <li>İstatistiksel analizler ve blog performansının iyileştirilmesi</li>
                    <li>Yasal yükümlülüklerin yerine getirilmesi</li>
                </ul>
            </section>

            <!-- 3. İşlenen Veri Kategorileri -->
            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-white">3. İşlenen Veri Kategorileri</h2>
                <div class="grid gap-4 md:grid-cols-2">
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <h3 class="font-medium text-gray-200 mb-2">Kimlik Bilgileri</h3>
                        <p>Ad-soyad, e-posta adresi (üyelik durumunda)</p>
                    </div>
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <h3 class="font-medium text-gray-200 mb-2">İletişim Bilgileri</h3>
                        <p>E-posta, IP adresi</p>
                    </div>
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <h3 class="font-medium text-gray-200 mb-2">Kullanıcı Davranış Verileri</h3>
                        <p>Ziyaret tarihi/saati, sayfa görüntüleme bilgileri</p>
                    </div>
                    <div class="bg-gray-700 p-4 rounded-lg">
                        <h3 class="font-medium text-gray-200 mb-2">Çerezler (Cookies)</h3>
                        <p>Kullanıcı deneyimini iyileştirmek için teknik çerezler kullanılabilir (<a href="#" class="text-blue-400 hover:text-blue-300 transition-colors">Çerez Politikası</a>)</p>
                    </div>
                </div>
            </section>

            <!-- 4. Veri Toplama Yöntemi -->
            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-white">4. Veri Toplama Yöntemi ve Hukuki Sebep</h2>
                <div class="bg-gray-700 p-4 rounded-lg space-y-3">
                    <p class="font-medium">Toplama Yöntemleri:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Otomatik (çerezler, log dosyaları)</li>
                        <li>Otomatik olmayan (e-posta, iletişim formu)</li>
                    </ul>
                    <p class="font-medium mt-4">Hukuki Dayanaklar:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>KVKK Madde 5/2(c): Hizmet sözleşmesinin kurulması veya ifası</li>
                        <li>KVKK Madde 5/2(f): Meşru menfaatlerimiz</li>
                    </ul>
                </div>
            </section>

            <!-- 5. Veri Paylaşımı -->
            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-white">5. Veri Paylaşımı</h2>
                <div class="bg-gray-700 p-4 rounded-lg space-y-2">
                    <p>Kişisel verileriniz yalnızca:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Yasal zorunluluk halinde resmi kurumlarla</li>
                        <li>Blog altyapı hizmet sağlayıcıları ile sınırlı olarak paylaşılabilir</li>
                    </ul>
                </div>
            </section>

            <!-- 6. Veri Güvenliği -->
            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-white">6. Veri Güvenliği</h2>
                <div class="bg-gray-700 p-4 rounded-lg">
                    <p>Verileriniz aşağıdaki yöntemlerle korunmaktadır:</p>
                    <ul class="list-disc pl-6 mt-2 space-y-2">
                        <li>Şifreleme teknolojileri</li>
                        <li>Erişim kısıtlama sistemleri</li>
                        <li>Düzenli güvenlik denetimleri</li>
                    </ul>
                </div>
            </section>

            <!-- 7. Haklarınız -->
            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-white">7. Haklarınız</h2>
                <div class="bg-gray-700 p-4 rounded-lg">
                    <p class="mb-3">KVKK Madde 11 uyarınca sahip olduğunuz haklar:</p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Veri işlenip işlenmediğini öğrenme</li>
                        <li>Eksik/yanlış verilerin düzeltilmesini talep etme</li>
                        <li>Silinme veya anonimleştirilme isteme</li>
                        <li>İşlenme amaçlarına itiraz etme</li>
                        <li>Kanuni haklarınızı kullanmak için <a href="#" class="text-blue-400 hover:text-blue-300">iletişim</a> kanallarımızı kullanabilirsiniz</li>
                    </ul>
                </div>
            </section>

            <!-- 8. İletişim -->
            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-white">8. İletişim</h2>
                <div class="bg-gray-700 p-4 rounded-lg space-y-2">
                    <p class="font-medium">KVKK kapsamındaki talepleriniz için:</p>
                    <p><span class="text-gray-400">E-posta:</span> <span class="text-blue-400">iletisim@ornek.com</span></p>
                    <p><span class="text-gray-400">Adres:</span> [Blogun fiziksel adresi]</p>
                </div>
            </section>

            <!-- 9. Değişiklikler -->
            <section class="space-y-4">
                <h2 class="text-xl font-semibold text-white">9. Değişiklikler</h2>
                <div class="bg-gray-700 p-4 rounded-lg">
                    <p>Bu metin ihtiyaçlar doğrultusunda güncellenebilir. Güncel versiyon her zaman blogumuzda yayınlanacaktır.</p>
                    <p class="mt-2 text-blue-400">Son güncelleme: 01 Ocak 2024</p>
                </div>
            </section>
        </div>
    </main>

    <footer class="bg-gray-800 text-gray-400 mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-8">
            <div class="text-center">
                <p class="text-sm">© 2025 Blog. Tüm hakları saklıdır.</p>
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