# Kosan

Kosan adalah sebuah website manajemen kos (boarding house) yang terdiri dari **landing page publik** untuk calon penghuni dan **panel admin** untuk pengelola kos. Sistem ini membantu pemilik kos mengelola kamar, penghuni, pembayaran, hingga laporan keuangan secara digital dan terintegrasi.

## Teknologi yang digunakan

Berikut teknologi yang digunakan untuk membuat website ini:

- Laravel 11
- Filament 3 (admin panel)
- Livewire 3
- Tailwind CSS v3
- Alpine.js
- MySQL
- Spatie Laravel Permission (role & permission)
- Laravel DomPDF (export PDF)
- Maatwebsite Laravel Excel (export Excel)

## Instalasi

1. Clone repository ini ke dalam folder project Anda.
2. Jalankan `composer install` untuk menginstal dependency PHP.
3. Jalankan `npm install` untuk menginstal dependency frontend.
4. Salin file `.env.example` menjadi `.env`.
5. Generate application key dengan `php artisan key:generate`.
6. Jalankan migrasi dan seeder database dengan `php artisan migrate --seed`.
7. Buat symbolic link storage dengan `php artisan storage:link`.
8. Jalankan `npm run dev` (atau `npm run build` untuk production) untuk compile asset.
9. Jalankan server dengan `php artisan serve`.
10. Buka browser dan akses:
    - Landing page: `http://localhost:8000`
    - Panel admin: `http://localhost:8000/admin`

## Akun

1. Super Admin

```
super.admin@kosan.id
password: super123
```

2. Admin

```
admin@kosan.id
password: admin123
```

3. Staff

```
staff@kosan.id
password: staff123
```

## Fitur

### Landing Page (Publik)

- Hero section dengan statistik kamar (total, tersedia, premium, standard)
- Section keunggulan/fasilitas kos
- Listing kamar tersedia dengan filter Standard/Premium
- Halaman detail kamar lengkap dengan fasilitas dan kamar serupa
- Halaman semua kamar dengan filter tipe dan status
- FAQ (accordion)
- Form kontak
- Dark/Light mode dengan sinkronisasi tema ke seluruh halaman (termasuk halaman login admin)

### Panel Admin

**Super Admin**

- Akses penuh ke seluruh fitur sistem
- Mengelola data user dan hak akses (role & permission)

**Admin**

- Mengelola data kamar (CRUD), termasuk tipe, harga, status, fasilitas, dan foto
- Mengelola data penghuni (CRUD), termasuk validasi satu kamar hanya untuk satu penghuni aktif
- Mengelola data pembayaran (CRUD), dengan status otomatis (pending, jatuh tempo, terlambat, lunas)
- Tandai pembayaran lunas (per item maupun bulk)
- Mengelola data fasilitas kamar (CRUD)
- Update status pembayaran otomatis terjadwal (H-3 jatuh tempo, H+1 terlambat)
- Dashboard dengan statistik (total kamar, penghuni aktif, pendapatan bulan ini, pembayaran perlu perhatian)
- Grafik pendapatan 12 bulan terakhir
- Notifikasi internal (lonceng notifikasi) untuk pembayaran jatuh tempo dan terlambat
- Laporan & analitik dengan filter per tahun (ringkasan pendapatan, tingkat hunian, top penghuni)
- Export laporan ke PDF dan Excel
- Riwayat pembayaran per penghuni

**Staff**

- Akses operasional dasar: melihat data kamar, mengelola data penghuni, mengelola pembayaran, melihat laporan, dan notifikasi

### Lainnya

- Tema dark/light pada halaman login admin, sinkron dengan landing page
- Manajemen role & permission menggunakan Spatie Laravel Permission
