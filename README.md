# 🍣 SushiYop - E-Commerce Sushi

Website e-commerce sushi dengan fitur lengkap termasuk payment gateway Midtrans.

## 🚀 Panduan Deploy ke Production

### Langkah 1: Clone Repository
```bash
git clone https://github.com/username/sushi_ecomerce.git
cd sushi_ecomerce
```

### Langkah 2: Install Dependencies
```bash
# Install PHP dependencies (tanpa dev packages)
composer install --optimize-autoloader --no-dev

# Install Node dependencies dan build assets
npm install
npm run build
```

### Langkah 3: Setup Environment
```bash
# Copy template environment
cp .env.example .env

# Edit file .env dengan data production
nano .env
```

**Yang perlu diisi di `.env`:**
- `APP_URL` → URL domain Anda
- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` → Data database server
- `MAIL_USERNAME`, `MAIL_PASSWORD` → Kredensial email SMTP
- `MIDTRANS_SERVER_KEY`, `MIDTRANS_CLIENT_KEY` → Key dari dashboard Midtrans

### Langkah 4: Generate App Key
```bash
php artisan key:generate
```

### Langkah 5: Setup Database
```bash
# Jalankan migrasi database
php artisan migrate

# (Opsional) Seed data produk
php artisan db:seed --class=ProductSeeder
```

### Langkah 6: Buat Akun Admin
```bash
php artisan tinker
```

Jalankan perintah ini di Tinker:
```php
\App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@domain.com',
    'password' => bcrypt('PasswordKuatAnda'),
    'role' => 'admin',
    'email_verified_at' => now(),
]);
```

Ketik `exit` untuk keluar dari Tinker.

### Langkah 7: Optimasi Production
```bash
# Cache konfigurasi
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Link storage
php artisan storage:link
```

### Langkah 8: Set Permissions
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

## ✅ Checklist Deploy

- [ ] Clone/upload code ke server
- [ ] `composer install --no-dev`
- [ ] `npm install && npm run build`
- [ ] Copy `.env.example` → `.env`
- [ ] Isi semua konfigurasi di `.env`
- [ ] `php artisan key:generate`
- [ ] `php artisan migrate`
- [ ] `php artisan db:seed --class=ProductSeeder` (opsional)
- [ ] Buat admin via `php artisan tinker`
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache`
- [ ] `php artisan storage:link`
- [ ] Set permissions folder storage

---

## 📋 Akun Default

| Role | Email | Password |
|------|-------|----------|
| Admin | (buat manual) | (buat manual) |

---

## 🔧 Teknologi

- **Framework**: Laravel 11
- **Frontend**: Livewire, Blade, Vanilla CSS
- **Database**: MySQL
- **Payment**: Midtrans

---

## ⚠️ Catatan Keamanan

- Jangan pernah push file `.env` ke repository
- Gunakan password yang kuat untuk admin
- Set `APP_DEBUG=false` di production
- Gunakan HTTPS untuk domain production
