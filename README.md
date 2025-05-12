<h1><img src="https://laravel.com/img/logomark.min.svg" alt="Laravel" width="25" style="vertical-align: middle;"> Laravel + Filament ile Geliştirilmiş Blog Sitesi</h1>

Bu proje, Laravel ve Filament Admin Paneli kullanılarak oluşturulmuş bir blog platformudur. Kullanıcılar yazılar ekleyebilir, yorum yapabilir ve içerikleri kategorilere göre filtreleyebilir. Projede hem güçlü bir CMS (İçerik Yönetim Sistemi) hem de kullanıcı dostu bir frontend yapısı bulunmaktadır.

## 🔧 Proje Yapısı

Bu proje iki ayrı uygulamadan oluşur:

- **blogapi** → Laravel + Filament tabanlı API ve CMS projesi
- **blogfrontend** → Tailwind CSS ile hazırlanmış frontend arayüz projesi

---

## ✨ Özellikler

### 👥 Kullanıcı Yönetimi

- Kullanıcı kaydı, giriş ve çıkış işlemleri
- Profil düzenleme
- Roller:
  - **Yazar**: Yazı ekleme ve düzenleme
  - **Süper Admin**:
    - Kullanıcı ekleme (şifre belirleyerek)
    - Yazı ve yorum yönetimi
    - Kategori yönetimi
    - Gizlilik Politikası ve KVKK sayfalarını yönetme
    - Yorumlar pasif olarak gelir, admin onayından sonra aktif olur
    - Yorum bildirimleri queue ile super admin'e e-posta olarak gider

### 📝 Yazı Yönetimi

- Başlık, içerik ve görsel ile yazı oluşturma (Tüm alanlar zorunludur)
- Yazılar kategorilere ve isteğe bağlı etiketlere göre ayrılır
- Başlangıç ve bitiş tarihi olan zamanlanabilir yayınlar
- Bitiş tarihi gelen yazılar otomatik olarak pasif yapılır
- Her gece cron ile başlangıç tarihi gelen yazılar aktif hale getirilir (`schedule`)
- Aktif/Pasif yazı durumu yönetimi
- Yorum yapılabilirlik ve yorum yönetimi (pasif eklenir, admin onayı gerekir)

### 🌐 Frontend

- Tailwind CSS kullanılarak tasarlanmış sade, modern ve kullanıcı dostu arayüz
- Ana sayfada en yeni ve popüler yazılar listelenir
- Kategorilere göre filtreleme
- Yazı detay sayfasında yorumlar ve yorum formu
- Gizlilik Politikası ve KVKK sayfaları

---

## 🛠 Kullanılan Teknolojiler

- **Laravel 11**
- **Filament Admin Paneli**
- **Laravel Sanctum** (API kimlik doğrulama)
- **Tailwind CSS** (Frontend tasarımı)
- **Laravel Scheduler & Queue** (Zamanlanmış görevler ve e-posta bildirimleri)

---

## <img src="https://www.docker.com/wp-content/uploads/2022/03/Moby-logo.png" alt="Docker" width="30" style="vertical-align: middle;"> Docker ile Hızlı Kurulum

### ⚙️ Ön Koşullar
- Docker ve Docker Compose kurulu olmalıdır

### 1️⃣ API Projesi (blogapi)

```bash
# Projeyi klonlayın
git clone https://github.com/thetahaa/kleblog.git
cd blogapi

# Docker ortamını başlatın
docker-compose up -d

# API Container'a giriş yapın
docker exec -it api_app bash
cd html

# Bağımlılıkların yüklenmesi
composer install

# Migration + Seeder
php artisan migrate:fresh --seed

# Laravel Shield tüm izinleri oluşturur
php artisan shield:generate --all

# Storage link
php artisan storage:link

# Queue çalıştırma
php artisan queue:work

```

### 2️⃣ Frontend Projesi (blogfrontend)
```bash
git clone https://github.com/thetahaa/kleblog.git
cd blogfrontend

# Docker ortamını başlatın
docker-compose up -d

# Bağımlılıkların yüklenmesi
npm install

# Tailwind'i derleyin
npm run dev

```

## 🌍 Tarayıcıda erişim
- PhpMyAdmin: http://localhost:8081
- Admin Panel: http://localhost:8000
- Frontend: http://localhost:8003