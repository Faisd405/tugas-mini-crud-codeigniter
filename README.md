# Faisal E Library - Sistem Manajemen Artikel

Ini adalah aplikasi web mini yang dibangun dengan CodeIgniter 4 yang menyediakan manajemen artikel, pengumpulan umpan balik pengguna, dan dasbor admin.

## Fitur

- **Landing Page Modern**: Halaman beranda yang bersih dan responsif yang menampilkan fitur aplikasi dan artikel terbaru
- **Manajemen Artikel**: Membuat, membaca, memperbarui, dan menghapus artikel dengan fungsi draft
- **Sistem Umpan Balik**: Memungkinkan pengunjung mengirimkan umpan balik melalui formulir sederhana
- **Dasbor Admin**: Area admin yang aman untuk mengelola artikel dan melihat umpan balik yang dikirimkan
- **Otentikasi Pengguna**: Login yang aman untuk administrator

## Akun Pengguna

### Akun Admin
- **Username**: admin
- **Email**: admin@example.com
- **Password**: password
- **Hak Akses**: Akses penuh ke dasbor admin, dapat mengelola semua artikel dan melihat semua umpan balik

### Akun Pengguna Demo
- **Username**: user
- **Email**: user@example.com
- **Password**: password123
- **Hak Akses**: Akses terbatas untuk membuat dan mengedit artikel milik sendiri saja

## Instalasi & Pengaturan

1. Clone repositori ke lingkungan lokal Anda:
   ```
   git clone https://github.com/yourusername/tugas_ci_crud.git
   ```

2. Navigasi ke direktori proyek:
   ```
   cd tugas_ci_crud
   ```

3. Instal dependensi menggunakan Composer:
   ```
   composer install
   ```

4. Salin `env` ke `.env` dan konfigurasi lingkungan Anda:
   ```
   cp env .env
   ```

5. Perbarui file `.env` dengan pengaturan database Anda:
   ```
   database.default.hostname = localhost
   database.default.database = ci4_crud
   database.default.username = your_username
   database.default.password = your_password
   database.default.DBDriver = MySQLi
   ```

6. Jalankan migrasi database:
   ```
   php spark migrate
   ```

7. Isi database dengan data awal (termasuk pengguna admin):
   ```
   php spark db:seed DatabaseSeeder
   ```

8. Mulai server pengembangan:
   ```
   php spark serve
   ```

9. Akses aplikasi di `http://localhost:8080`

## Penggunaan

### Area Publik

- **Halaman Beranda**: Lihat artikel terbaru dan jelajahi fitur
- **Tampilan Artikel**: Baca artikel lengkap dan jelajahi konten lainnya
- **Formulir Umpan Balik**: Kirimkan umpan balik atau pertanyaan melalui formulir

### Area Admin

1. Login di `/auth/login` menggunakan kredensial admin di atas
2. Dasbor admin menyediakan akses ke:
   - Manajemen artikel (membuat, mengedit, menghapus, mempublikasikan/tidak mempublikasikan)
   - Manajemen umpan balik (melihat dan menghapus umpan balik)
   - Manajemen pengguna

## Struktur Proyek

- `/app/Controllers` - Controller aplikasi termasuk Home, Auth, dan controller Admin
- `/app/Models` - Model data untuk Artikel, Umpan Balik, dan Pengguna
- `/app/Views` - Template tampilan untuk area publik dan admin
- `/app/Config` - File konfigurasi termasuk rute, filter, dan pengaturan database

## Fitur Secara Rinci

### Manajemen Artikel

Aplikasi ini menyediakan sistem manajemen artikel yang komprehensif:

- **Membuat Artikel**: Tulis artikel dengan editor teks kaya fitur
- **Sistem Draft**: Simpan artikel sebagai draft sebelum mempublikasikan
- **Edit & Hapus**: Perbarui atau hapus artikel yang ada
- **Kontrol Publikasi**: Publikasikan atau batalkan publikasi artikel sesuai kebutuhan
- **Slug**: Slug URL yang ramah dan dibuat secara otomatis untuk SEO yang lebih baik

### Sistem Umpan Balik

Kumpulkan dan kelola umpan balik pengguna:

- **Formulir Ramah Pengguna**: Formulir kontak yang mudah digunakan
- **Validasi**: Validasi sisi klien dan server untuk pengiriman
- **Review Admin**: Semua umpan balik disimpan untuk ditinjau admin
- **Manajemen**: Hapus atau arsipkan umpan balik sesuai kebutuhan

### Otentikasi Pengguna

Aplikasi ini mencakup sistem otentikasi yang sederhana namun aman:

- **Login/Logout**: Otentikasi aman untuk pengguna admin
- **Manajemen Sesi**: Penanganan sesi pengguna dengan benar
- **Kontrol Akses**: Izin berbasis peran untuk area yang berbeda

## Persyaratan Sistem

- **PHP**: Versi 8.1 atau lebih tinggi
- **Ekstensi**: intl, mbstring, json, mysqlnd
- **Database**: MySQL 5.7+ atau MariaDB 10.2+
- **Web Server**: Apache dengan mod_rewrite atau Nginx

## Kredit

- Dibangun dengan [CodeIgniter 4](https://codeigniter.com)
- Styling frontend dengan [Bootstrap 5](https://getbootstrap.com)
- Ikon oleh [Font Awesome](https://fontawesome.com)

## Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT - lihat file [LICENSE](LICENSE) untuk detail.

## Kontribusi

Kontribusi untuk meningkatkan Faisal E Library sangat diterima. Berikut cara Anda dapat berkontribusi:

1. Fork repositori
2. Buat branch fitur (`git checkout -b fitur/fitur-luar-biasa`)
3. Buat perubahan Anda
4. Commit perubahan Anda (`git commit -m 'Tambahkan fitur luar biasa'`)
5. Push ke branch (`git push origin fitur/fitur-luar-biasa`)
6. Buka Pull Request

### Standar Koding

Proyek ini mengikuti standar koding [PSR-12](https://www.php-fig.org/psr/psr-12/). Harap pastikan kode Anda mengikuti standar ini sebelum mengirimkan pull request.

### Melaporkan Masalah

Jika Anda menemukan bug atau memiliki saran fitur, silakan buat issue di repositori GitHub.
