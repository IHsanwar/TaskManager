# 📌 Konsep Aplikasi Task Manager

Aplikasi ini dirancang untuk mempermudah pengelolaan tugas, komunikasi, dan laporan dalam organisasi dengan sistem berbasis **Role-Based Access Control (RBAC)**, yang memiliki dua peran utama: **Admin** dan **User**.

---

## 🎯 1. Tujuan Aplikasi

Meningkatkan efisiensi dalam:

* Pengelolaan tugas harian atau proyek.
* Komunikasi internal organisasi.
* Pelaporan masalah atau informasi penting secara transparan.

---

## 🚀 2. Fitur Utama

### 🔹 A. Manajemen Tugas (Task Management)

**Untuk Admin:**

* Membuat tugas baru dengan atribut:

  * Judul
  * Deskripsi
  * Tenggat waktu (deadline)
  * Prioritas (Rendah, Sedang, Tinggi)
  * Penerima (satu atau banyak user)
* Melihat semua tugas yang telah dibuat.
* Memantau status tugas:

  * Belum Dikerjakan
  * Sedang Dikerjakan
  * Selesai
* Memverifikasi hasil tugas yang diunggah oleh user.

**Untuk User:**

* Hanya melihat tugas yang ditugaskan kepadanya.
* Menyelesaikan tugas dengan:

  * Mengunggah file/lampiran (dokumen, gambar, spreadsheet, dll).
  * Menambahkan catatan/komentar opsional.
* Hasil tugas langsung dikirim ke dashboard Admin untuk verifikasi.

**Alur Tugas:**

```
Admin → Buat Tugas → Tetapkan ke User → 
User Terima Notifikasi → Kerjakan → Upload Hasil → 
Admin Verifikasi
```

---

### 🔹 B. Fitur Pemberitahuan (Announcement)

* Hanya **Admin** yang dapat membuat pengumuman.
* Pengumuman bersifat **global**: muncul di dashboard semua user.
* Konten pengumuman bisa berupa:

  * Informasi penting
  * Aturan baru
  * Instruksi singkat
  * Jadwal kegiatan
* Pengumuman dapat memiliki:

  * Tanggal publikasi
  * Status aktif/nonaktif

---

### 🔹 C. Laporan Publik (Public Report)

* Dapat dibuat oleh **User maupun Admin**.
* Jenis laporan yang didukung:

  * Pengumuman umum (non-admin)
  * Laporan kendala pekerjaan
  * Laporan barang hilang/rusak
  * Masukan atau keluhan operasional
* Laporan bersifat **transparan**: dapat dilihat oleh semua pihak sesuai level akses.
* Admin dapat menindaklanjuti laporan (misal: memberi tanggapan atau status *Selesai*).

**Alur Laporan:**

```
User/Admin → Buat Laporan Publik → Simpan → 
Tampil di Halaman Laporan Umum → 
Dapat Ditanggapi oleh Admin
```

---

## 🛡️ 3. Sistem Berbasis Peran (RBAC)

| Aksi                   | Admin ✅ | User ✅ |
| ---------------------- | ------- | ------ |
| Membuat tugas          | ✅       | ❌      |
| Melihat tugas sendiri  | ✅       | ✅      |
| Melihat semua tugas    | ✅       | ❌      |
| Verifikasi hasil tugas | ✅       | ❌      |
| Membuat pengumuman     | ✅       | ❌      |
| Melihat pengumuman     | ✅       | ✅      |
| Membuat laporan publik | ✅       | ✅      |
| Melihat laporan publik | ✅       | ✅      |

> **Catatan:** Admin dapat melihat semua tugas, termasuk milik user.

---

## 🔄 4. Alur Pengguna (User Flow)

**Alur Tugas:**

1. Admin login → Masuk ke halaman *Buat Tugas*.
2. Isi detail tugas → Pilih penerima → Simpan.
3. Sistem kirim notifikasi ke user terkait.
4. User login → Lihat tugas di dashboard → Kerjakan → Upload hasil + catatan.
5. Admin menerima notifikasi hasil tugas → Verifikasi → Beri status (*Disetujui/Ditolak*).

**Alur Pengumuman:**

1. Admin login → Buat pengumuman → Publikasikan.
2. Semua user melihat pengumuman di dashboard.

**Alur Laporan Publik:**

1. User/Admin login → Masuk ke *Buat Laporan*.
2. Pilih jenis laporan → Isi detail → Kirim.
3. Laporan muncul di halaman publik → Bisa ditanggapi oleh Admin.

---

## 🌟 5. Manfaat Aplikasi

* **Transparansi**: Semua tindakan dan laporan tercatat.
* **Efisiensi**: Pengelolaan tugas terpusat dan terotomatisasi.
* **Akuntabilitas**: Setiap tugas memiliki pemilik dan status jelas.
* **Komunikasi Terbuka**: Pengumuman dan laporan memperkuat kolaborasi.

---

## 🛠️ 6. Teknologi yang Direkomendasikan (Opsional)

* **Frontend**: React.js / Vue.js
* **Backend**: Node.js (Express) / Laravel / Django
* **Database**: PostgreSQL / MySQL
* **Autentikasi**: JWT / Session-based
* **File Storage**: Cloud (AWS S3, Firebase Storage) atau lokal

---

📂 **Dokumen ini dapat digunakan sebagai basis pengembangan, proposal sistem, atau spesifikasi fungsional.**
Jika diperlukan, tambahan yang bisa dibuat:

* Diagram alur (Flowchart)
* ERD (Entity Relationship Diagram)
* Wireframe UI dasar
* Daftar API Endpoints
