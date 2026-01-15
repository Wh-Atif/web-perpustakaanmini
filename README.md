# 📚 Sistem Informasi Perpustakaan Mini

Aplikasi manajemen perpustakaan sederhana berbasis web yang dibangun menggunakan **Laravel**. Aplikasi ini menangani sirkulasi peminjaman buku dengan sistem validasi stok dan pemisahan hak akses antara **Admin** dan **Anggota (User)**.

---

## 🚀 Fitur Utama

### 🔐 Otentikasi & Keamanan
- **Login & Register Manual** (Tanpa Starter Kit Breeze/Jetstream).
- **Multi-Role:** Pembedaan akses Admin dan User menggunakan Middleware & Gate.
- **Keamanan:** Route Admin terproteksi, User tidak bisa akses halaman Admin.

### 👤 Role: User (Anggota)
- Melihat **Katalog Buku** dengan informasi stok real-time.
- **Pencarian & Filter** buku berdasarkan Judul, Pengarang, atau Kategori.
- **Peminjaman Mandiri** (Maksimal 3 buku, Stok berkurang otomatis).
- Melihat **Riwayat Peminjaman** pribadi dan status pengembalian.

### 🛠 Role: Admin (Pustakawan)
- **Dashboard Statistik:** Ringkasan total buku, anggota, dan transaksi aktif.
- **Manajemen Buku (CRUD):** Tambah, Edit, Hapus buku dan stok.
- **Manajemen Sirkulasi:** Validasi pengembalian buku (Stok bertambah otomatis saat dikembalikan).
- Filter data transaksi berdasarkan status (Dipinjam/Dikembalikan).

---

## ⚙️ Persyaratan Sistem (Requirements)

Sebelum menjalankan, pastikan komputer Anda memiliki:
- **PHP** >= 8.1
- **Composer**
- **MySQL** (via XAMPP/Laragon/DBngin)
- **Web Browser** (Chrome/Firefox/Edge)
- *Koneksi Internet* (Diperlukan untuk memuat Tailwind CSS via CDN).

---



## 📥 Langkah Instalasi

Ikuti langkah-langkah berikut secara berurutan di Terminal / Command Prompt:

### 1. Clone Repository & Masuk Folder
```bash
git clone https://github.com/Wh-Atif/web-perpustakaanmini.git laravel_minilib
cd web-perpustakaanmini

```

### 2. Install Dependency

Mengunduh pustaka Laravel yang dibutuhkan.

```bash
composer install

```

### 3. Konfigurasi Environment (.env)

Menyalin file konfigurasi contoh menjadi file konfigurasi aktif.

```bash
cp .env.example .env

```

### 4. Generate Key Aplikasi

Membuat kunci enkripsi unik untuk sesi aplikasi.

```bash
php artisan key:generate

```

### 5. Konfigurasi Database

1. Buka aplikasi database manager Anda (phpMyAdmin / HeidiSQL).
2. Buat database baru dengan nama: **`perpustakaan_mini`**
3. Buka file **`.env`** di text editor, pastikan konfigurasi database sesuai:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan_mini
DB_USERNAME=root
DB_PASSWORD=

```

### 6. Migrasi & Seeding Data (PENTING) ⚠️

Langkah ini akan membuat tabel di database sekaligus mengisi **Data Dummy** dan **Akun Login**.

```bash
php artisan migrate:fresh --seed

```

---



## 🧪 Pengujian Sistem (Automated Testing)

- **Skenario Utama:** Memastikan sistem **menolak peminjaman** (gagal akses) jika stok buku bernilai **0**.

Untuk menjalankan pengujian, jalankan perintah berikut di terminal:

```bash
php artisan test

```

## ▶️ Jalankan Aplikasi

Jalankan server lokal Laravel dengan perintah:

```bash
php artisan serve

```



## 🔑 Akun Demo (Credentials)

Gunakan akun berikut untuk menguji fitur aplikasi:

### 👨‍💼 Akun Administrator

*Akses penuh ke menu Admin (Dashboard, CRUD Buku, Validasi Pengembalian).*

* **Email:** `admin@perpus.com`
* **Password:** `12345678`

### 🧑‍🎓 Akun Anggota (User)

*Akses ke Katalog Buku dan Peminjaman Saya.*

* **Email:** `user@perpus.com`
* **Password:** `12345678`



## 💻 Teknologi yang Digunakan

* **Backend:** Laravel Framework (PHP).
* **Frontend:** Blade Templating Engine.
* **Styling:** Tailwind CSS (CDN Version).
* **Database:** MySQL.
* **Icons:** FontAwesome.

---



**Dibuat untuk memenuhi tugas UAS Pemrograman Web.**

**Anggota Kelompok**
* *2402310223 – Moh. Hasrul Hidayah Tullah*
* *2402310225 – Moh. Atif Fauzan*
* *2402310233 – Qorin Sifa Eka Fasba*

2026 - 01 - 14