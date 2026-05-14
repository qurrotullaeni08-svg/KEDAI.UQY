# 🍲 Kedai UQY - Sistem Pemesanan Catering Modern

Kedai UQY adalah sebuah platform web aplikasi berbasis Laravel 12 yang dibangun untuk mendigitalisasi proses pemesanan makanan dan catering harian. Sistem ini dirancang untuk memberikan pengalaman terbaik kepada pelanggan (User) dalam memesan hidangan favorit mereka dan memberikan kemudahan bagi pemilik usaha (Admin) untuk mengelola data pesanan dengan cepat, rapi, dan terintegrasi. 

Dengan antarmuka yang sangat modern, premium, serta *mobile-responsive*, sistem ini tidak hanya berfungsi sebagai alat manajemen pesanan, tetapi juga sebagai media promosi visual yang menarik.

---

## 🚀 Fitur Utama

- **Real-time Cart Management**: Manajemen keranjang belanja dengan auto-update AJAX (penambahan/pengurangan kuantitas ter-update instan tanpa reload halaman).
- **Checkout & Tracking Pesanan**: Proses checkout yang terhubung langsung ke WhatsApp Admin dan sistem timeline tracking (Menunggu Konfirmasi -> Diproses -> Dikirim -> Selesai).
- **Manajemen Menu Catering**: Admin dapat secara leluasa menambah, mengubah, atau menghapus daftar menu makanan beserta foto dan harganya.
- **Reporting & Export**: Tampilan dashboard khusus Admin yang dilengkapi ringkasan pendapatan serta fitur cetak Laporan Pesanan berbasis filter periode tanggal.
- **Autentikasi Aman**: Registrasi, Login, dan manajemen Profil Pengguna (Update Password, Email, dll) dengan Laravel Breeze.

---

## 💻 Tech Stack

Aplikasi ini dikembangkan menggunakan teknologi terkini:

- **Framework**: Laravel 12 (PHP 8.2+)
- **Frontend / Styling**: Tailwind CSS, Alpine.js, Blade Components
- **Authentication**: Laravel Breeze
- **Database**: MySQL
- **Local Environment**: XAMPP / Laravel Herd
- **Asset Bundler**: Vite

---

## 👥 Role & Hak Akses

Sistem membagi pengguna ke dalam dua otorisasi utama:

### 1. Admin (Pemilik Usaha)
- Mengakses *Dashboard* Analitik (Total Pesanan, Total Pendapatan, dsb).
- Mengelola (*CRUD*) Katalog Menu Makanan.
- Memantau semua Pesanan Masuk dan memperbarui status pesanan pelanggan.
- Menarik *Laporan Transaksi* bulanan/harian serta mencetaknya ke format PDF.

### 2. User (Pelanggan)
- Melihat daftar menu yang ditawarkan oleh Kedai UQY.
- Memasukkan menu ke dalam *Keranjang Belanja*.
- Melakukan proses *Checkout* pesanan.
- Memantau proses/status pesanan yang sedang berjalan dari menu Dashboard.
- Mengubah informasi profil pribadi.

---

## 🎨 Tampilan Modern & Responsive

- **Glassmorphism & Shadows**: Implementasi kartu (*cards*) elegan dengan *soft shadow* dan *backdrop blur* yang menonjolkan estetika *premium UI*.
- **Mobile-First Approach**: Navigasi dan komponen disesuaikan dengan sempurna di segala ukuran perangkat, mulai dari layar HP yang sempit hingga monitor *desktop* lebar.
- **Smooth Animations**: Transisi perpindahan *state*, tombol *hover*, dan navigasi memuat animasi yang mulus menggunakan *Tailwind* dan *Alpine.js*.

---

## ⚙️ Cara Menjalankan Project

Ikuti langkah-langkah di bawah ini untuk menjalankan aplikasi secara lokal (XAMPP):

### Persyaratan Sistem
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL Database (misal via XAMPP)

### Langkah Instalasi
1. **Clone Repository (atau ekstrak source code)**
   ```bash
   git clone <url-repository>
   cd kedai-uqy
   ```
2. **Install Dependensi PHP & JavaScript**
   ```bash
   composer install
   npm install
   ```
3. **Konfigurasi Environment**
   Salin file environtment dan sesuaikan credential database Anda.
   ```bash
   cp .env.example .env
   ```
   Atur DB_DATABASE:
   ```env
   DB_DATABASE=db_kedai_uqy
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```
5. **Jalankan Migrasi & Storage Link**
   ```bash
   php artisan migrate
   php artisan storage:link
   ```
6. **Jalankan Server Lokal**
   Buka dua jendela terminal untuk menjalankan perintah berikut bersamaan:
   ```bash
   # Terminal 1 (Laravel PHP Server)
   php artisan serve

   # Terminal 2 (Vite Asset Bundler)
   npm run dev
   ```
7. Buka browser dan arahkan ke: `http://localhost:8000`

---
*Dikembangkan oleh Tim Kedai UQY - Mewujudkan catering digital masa kini.*
