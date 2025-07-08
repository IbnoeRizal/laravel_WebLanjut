# Aplikasi Kasir Sederhana
> [!IMPORTANT]
> setting file .env untuk konfigurasi database
>  dan run command dibawah ini sebelum memulai

```bash
    composer install
```
```bash
    npm install
```
```bash
    npm run build
```
```bash
    php artisan migrate
```
```bash
    php artisan key:generate
```
---

## jalankan lokal

```bash
     php artisan serve
```

---


# 📦 Struktur Database Kasir Sederhana

struktur database untuk aplikasi kasir sederhana, terdiri dari tiga tabel utama: `categories`, `products`, dan `transactions`.

---

## 🗄️ Struktur Tabel `users`

merupakan template buatan laravel saat menggunakan command

``` bash
php artisan migrate
```

---

## 🗂️ Tabel: `categories`

| Kolom        | Tipe Data   | Keterangan                                      |
|--------------|-------------|-------------------------------------------------|
| `id`         | BIGINT      | Primary key, auto increment                     |
| `nama`       | VARCHAR(50) | Nama kategori                                   |
| `created_at` | DATETIME    | Tanggal dibuat (default: now)                   |
| `updated_at` | DATETIME    | Tanggal update terakhir (otomatis saat update)  |

---

## 📦 Tabel: `products`

| Kolom        | Tipe Data   | Keterangan                                      |
|--------------|-------------|-------------------------------------------------|
| `id`         | BIGINT      | Primary key, auto increment                     |
| `nama`       | VARCHAR(50) | Nama produk                                     |
| `harga`      | INTEGER     | Harga produk                                    |
| `stock`      | INTEGER     | Stok produk                                     |
| `created_at` | DATETIME    | Tanggal dibuat (default: now)                   |
| `updated_at` | DATETIME    | Tanggal update terakhir (otomatis saat update)  |

---

## 🧾 Tabel: `transactions`

| Kolom              | Tipe Data | Keterangan                                                       |
|--------------------|-----------|------------------------------------------------------------------|
| `id`               | BIGINT    | Primary key, auto increment                                      |
| `id_penjual`       | BIGINT    | Foreign key ke `users.id`, nullable, null saat user dihapus      |
| `id_product`       | BIGINT    | Foreign key ke `products.id`, nullable, null saat product dihapus|
| `id_category`      | BIGINT    | Foreign key ke `categories.id`, nullable, null saat category dihapus |
| `jumlah_pembelian` | INTEGER   | Jumlah produk yang dibeli                                        |
| `created_at`       | TIMESTAMP | Tanggal dan waktu transaksi dibuat                               |
| `updated_at`       | TIMESTAMP | Tanggal dan waktu terakhir diubah                                |

---

## 🔗 Relasi Antar Tabel

- `transactions.id_penjual` → `users.id`
- `transactions.id_product` → `products.id`
- `transactions.id_category` → `categories.id`

---

## 📝 Catatan

- Semua tabel menggunakan kolom `created_at` dan `updated_at` untuk pencatatan waktu.
- Foreign key bersifat `nullable` dan menggunakan `nullOnDelete()` agar tidak menyebabkan error jika relasi dihapus.
