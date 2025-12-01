
# 🕒 PT Absen Terus — Sistem Presensi Karyawan

Aplikasi sistem absensi berbasis web menggunakan **Laravel**, dengan dua role utama yaitu **Admin** dan **Karyawan**.

---

## 📌 Fitur Utama

### 👨‍💻 Admin
- Login sebagai admin
- Mengelola data karyawan (*Tambah, Edit, Hapus*)
- Melihat rekap absensi bulanan
- Ekspor rekap ke **PDF & Excel**
- Dashboard ringkasan (grafik & statistik)

### 👷 Karyawan
- Login sebagai karyawan
- Presensi **Masuk** dan **Pulang**
- Melihat riwayat kehadiran pribadi

---

## 🧑‍💻 Sistem & Kebutuhan
Pastikan perangkat sudah menginstal:

| Software | Dibutuhkan |
|---------|------------|
| PHP 8.1+ | Menjalankan Laravel |
| Composer | Dependency Laravel |
| Node.js + NPM | Vite & Tailwind |
| MySQL / MariaDB | Database |
| Git | Clone project (opsional) |

Disarankan memakai **Laragon atau XAMPP**.

---

## 🚀 Langkah Instalasi

### 1️⃣ Clone atau Download Project

Jika pakai Git:

```sh
git clone https://github.com/nayotamaryaptra/pt-absen-terus.git
cd pt-absen-terus
```

Jika download ZIP → extract foldernya lalu lanjutkan langkah berikut.

---

### 2️⃣ Buka Project di VS Code

Bisa klik kanan folder → **Open with VS Code**  
Atau via terminal:

```sh
code .
```

---

### 3️⃣ Install Dependency Laravel

Jalankan perintah:

```sh
composer install
```

Jika terjadi error, jalankan:

```sh
composer update
```

---

### 4️⃣ Install Dependency Frontend

```sh
npm install
npm run build
```

Setelah selesai, **buka terminal baru** lalu jalankan:

```sh
npm run dev
```

> Biarkan terminal ini **tetap berjalan** karena digunakan untuk kompilasi Tailwind dan Vite.

---

### 5️⃣ Konfigurasi Database

File `.env` sudah tersedia.

Buat database di MySQL dengan nama:

```
presensi_db
```

Pastikan bagian berikut sesuai:

```
DB_DATABASE=presensi_db
DB_USERNAME=root
DB_PASSWORD= (isi jika MySQL kamu memakai password)
```

---

### 6️⃣ Generate App Key

```sh
php artisan key:generate
```

---

### 7️⃣ Migrasi Database + Seeder

```sh
php artisan migrate --seed
```

Seeder ini otomatis membuat akun admin dan contoh data karyawan.

---

### 8️⃣ Jalankan Aplikasi

Gunakan dua terminal berbeda:

| Terminal | Perintah |
|---------|----------|
| Terminal 1 | `npm run dev` |
| Terminal 2 | `php artisan serve` |

Lalu buka browser:

👉 http://localhost:8000

---

## 🔑 Akun Login

Akun default bisa dilihat di file:

```
database/seeders/UsersAndEmployeesSeeder.php
```

Contoh default:

| Role | Email | Password |
|------|--------|----------|
| Admin | admin@absenterus.test | admin123 |
| Karyawan (sample) | otomatis dari seeder | karyawan123 |

---

## 📂 Teknologi Digunakan

- Laravel 11
- TailwindCSS + Vite
- MySQL
- DOMPDF & Excel Export
- Chart.js

---

## 📜 Catatan

- Jangan tutup terminal `npm run dev` saat development.
- Jika tampilan error CSS, jalankan:

```sh
npm run build
```

---

## 👤 Pembuat

**Nayotama Aryaputra Santosa**  
📌 Sistem Presensi Karyawan — PT Absen Terus

---

Jika ingin deploy, silakan konsultasi atau lanjutkan dokumentasi tambahan. 😊

