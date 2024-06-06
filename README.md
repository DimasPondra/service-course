# Service Course
Service course adalah bagian dari sebuah microservice yang dibangun untuk membuat API aplikasi crowdfunding, pada service ini digunakan untuk menghandle segala sesuatu tentang course.

## Daftar Isi
1. [Prasyarat](#prasyarat)
2. [Teknologi yang Digunakan](#teknologi-yang-digunakan)
3. [Fitur-fitur](#fitur---fitur)
4. [Pemasangan](#pemasangan)

## Prasyarat
- [GIT](https://www.git-scm.com/downloads)
- [Node 20.14](https://nodejs.org/en/download/package-manager/current)
- [MySQL 8.0](https://dev.mysql.com/downloads/installer/)

## Teknologi yang Digunakan
- Laravel 10
- GuzzleHTTP

## Fitur - fitur
1. **Manajemen Course:**
    - Menampilkan, membuat, dan merubah course.

2. **Manajemen Chapter:**
    - Menampilkan, membuat, merubah, dan menghapus chapter.

3. **Manajemen Lesson:**
    - Menampilkan, membuat, merubah, dan menghapus lesson.

4. **Manajemen Course Image:**
    - Menampilkan, membuat, dan menghapus course image.

5. **Manajemen Review:**
    - Membuat, merubah, dan menghapus review.

6. **Manajemen My Course:**
    - Menampilkan dan membuat my course.
    - Melakukan pengecekan berdasarkan pemilik data.

## Pemasangan
Langkah-langkah untuk menginstall proyek ini.

Clone proyek
```bash
git clone https://github.com/DimasPondra/service-course.git
```

Masuk ke dalam folder proyek
```bash
cd service-course
```

Install depedencies
```bash
composer install
```

Buat konfigurasi file
```bash
cp .env-example .env
```

Rubah `.env` untuk konfigurasi sesuai variabel
- `DB_HOST` - Hostname atau alamat IP server MySQL.
- `DB_DATABASE` - Database yang dibuat untuk aplikasi, default adalah laravel.
- `DB_USERNAME` - Username untuk mengakses database.
- `DB_PASSWORD` - Password untuk mengakses database.
- `URL_SERVICE_MEDIA` - Url untuk mengakses service media.
- `URL_SERVICE_USER` - Url untuk mengakses service user.

Migrasi database tabel awal
```bash
php artisan migrate
```

Generate manual key
```bash
php artisan key:generate
```

Mulai server
```bash
php artisan serve
```

Dengan mengikuti langkah-langkah di atas, Anda akan dapat menjalankan Service course dimana service tersebut bagian dari crowdfunding microservice.
