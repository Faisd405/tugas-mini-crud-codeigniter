# 📚 Digital Library System - CodeIgniter 4

Sistem Perpustakaan Digital menggunakan CodeIgniter 4 dan MySQL dengan fitur lengkap untuk manajemen buku dan pencarian.

## 🚀 Fitur Utama

### a. CRUD Operations (Create, Read, Update, Delete)
- **Create**: Menambah buku baru dengan informasi lengkap
- **Read**: Menampilkan daftar buku dengan detail lengkap
- **Update**: Mengedit informasi buku yang sudah ada
- **Delete**: Menghapus buku dari sistem

### b. Session Management
- Sistem login admin dengan session handling
- Proteksi route admin menggunakan authentication filter
- Session timeout dan logout functionality

### c. Search & Pagination
- **Search**: Pencarian buku berdasarkan judul, penulis, kategori, atau penerbit
- **Pagination**: Membagi hasil pencarian dan daftar buku per halaman
- **Filter**: Filter berdasarkan kategori dan status buku

## 🛠️ Teknologi yang Digunakan

- **Framework**: CodeIgniter 4
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Font Awesome
- **Authentication**: Session-based authentication
- **Styling**: Custom CSS dengan Bootstrap components

## 📋 Struktur Database

### Tabel `books`
- `id` (INT, Primary Key, Auto Increment)
- `title` (VARCHAR 255) - Judul buku
- `author` (VARCHAR 255) - Penulis
- `isbn` (VARCHAR 20, Unique) - ISBN buku
- `publisher` (VARCHAR 255) - Penerbit
- `year_published` (INT) - Tahun terbit
- `pages` (INT) - Jumlah halaman
- `category` (VARCHAR 100) - Kategori buku
- `description` (TEXT) - Deskripsi buku
- `stock` (INT) - Jumlah stok
- `status` (ENUM: available, borrowed, maintenance) - Status buku
- `cover_image` (VARCHAR 255) - Path gambar cover
- `digital_file` (VARCHAR 255) - Path file digital
- `created_at` (DATETIME) - Tanggal dibuat
- `updated_at` (DATETIME) - Tanggal diupdate

### Tabel `users` (untuk admin)
- `id` (INT, Primary Key, Auto Increment)
- `username` (VARCHAR 100, Unique) - Username admin
- `password` (VARCHAR 255) - Password terenkripsi
- `email` (VARCHAR 100, Unique) - Email admin
- `name` (VARCHAR 100) - Nama lengkap
- `created_at` (DATETIME) - Tanggal dibuat
- `updated_at` (DATETIME) - Tanggal diupdate

## 🔧 Instalasi

1. **Clone atau download project ini**
2. **Setup database**:
   ```sql
   CREATE DATABASE tugas_perpustakaan;
   ```

3. **Konfigurasi database** di `app/Config/Database.php`:
   ```php
   'hostname' => 'localhost',
   'username' => 'root',
   'password' => '',
   'database' => 'tugas_perpustakaan',
   ```

4. **Jalankan migrasi dan seeder**:
   ```bash
   php spark migrate
   php spark db:seed DatabaseSeeder
   ```

5. **Jalankan server**:
   ```bash
   php spark serve
   ```

6. **Akses aplikasi**:
   - Library (Public): `http://localhost:8080/`
   - Admin Panel: `http://localhost:8080/admin/dashboard`

## 👤 Default Admin Login

- **Username**: `admin`
- **Password**: `admin123`

## 🌟 Fitur Aplikasi

### Area Public (Library)
- **Homepage**: Menampilkan daftar buku tersedia
- **Search**: Pencarian buku dengan kata kunci
- **Filter**: Filter berdasarkan kategori
- **Book Details**: Halaman detail buku dengan informasi lengkap
- **Pagination**: Navigasi halaman untuk daftar buku
- **Responsive Design**: Tampilan yang responsive di semua device

### Area Admin
- **Dashboard**: Statistik buku dan akses cepat
- **Book Management**: 
  - Daftar semua buku dengan search dan pagination
  - Tambah buku baru
  - Edit informasi buku
  - Hapus buku
  - Lihat detail buku
- **Session Management**: Login/logout dengan validasi
- **Protected Routes**: Semua route admin dilindungi authentication

## 🎨 Interface Features

### Search & Pagination
- **Real-time search**: Search buku berdasarkan berbagai field
- **Category filter**: Filter dropdown untuk kategori
- **Pagination**: Navigasi halaman dengan informasi jumlah data
- **Results counter**: Menampilkan jumlah hasil pencarian

### CRUD Operations
- **Create**: Form tambah buku dengan validasi lengkap
- **Read**: List view dengan search dan detail view
- **Update**: Form edit dengan pre-filled data
- **Delete**: Konfirmasi delete untuk keamanan

### Session Handling
- **Login form**: Form login dengan validasi
- **Session persistence**: Session tersimpan selama browser aktif
- **Auto-redirect**: Redirect ke halaman login jika tidak authenticated
- **Logout**: Clear session dengan redirect

## 📱 Responsive Design

- **Mobile-first approach**: Desain dimulai dari mobile
- **Bootstrap 5**: Framework CSS yang responsive
- **Card-based layout**: Layout kartu untuk tampilan yang clean
- **Sidebar navigation**: Navigation sidebar untuk admin panel

## 🔒 Security Features

- **Password hashing**: Password di-hash menggunakan bcrypt
- **CSRF protection**: Perlindungan terhadap CSRF attack
- **Input validation**: Validasi input di server-side
- **XSS prevention**: Escape output untuk mencegah XSS
- **SQL injection prevention**: Menggunakan query builder CodeIgniter

## 🚀 Penggunaan

### Mengakses Library (Public)
1. Buka browser dan akses `http://localhost:8080/`
2. Browse buku yang tersedia
3. Gunakan search untuk mencari buku tertentu
4. Filter berdasarkan kategori
5. Klik buku untuk melihat detail

### Mengakses Admin Panel
1. Akses `http://localhost:8080/admin/dashboard`
2. Login menggunakan kredensial admin
3. Kelola buku melalui menu Books
4. Lihat statistik di dashboard

## 📊 Sample Data

Aplikasi sudah dilengkapi dengan sample data yang mencakup:
- 12 buku dari berbagai kategori
- 1 admin user
- Berbagai status buku (available, borrowed, maintenance)
- Kategori yang beragam (Classic Literature, Computer Science, Programming, dll.)

## 🎯 Kesimpulan

Aplikasi Digital Library ini telah memenuhi semua requirements yang diminta:
- ✅ **CRUD Operations**: Create, Read, Update, Delete untuk buku
- ✅ **Session Management**: Login/logout admin dengan session handling
- ✅ **Search & Pagination**: Pencarian dan pagination untuk buku

Aplikasi ini siap digunakan dan dapat dikembangkan lebih lanjut sesuai kebutuhan.
