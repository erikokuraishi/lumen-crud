# Praktikum Lumen REST CRUD

Nama: Ibrahim hanifa
NIM: D112411052
Mata kuliah: Interoperability (Web Service)

Project ini berisi dua CRUD berbasis Restful API dengan PHP Lumen:
1. **Posts**: praktikum modul
2. **Products**: tantangan (8 field + created_at dan updated_at)

## Endpoint Posts

| Method | Endpoint | Controller function |
|---|---|---|
| GET | /posts | index |
| POST | /posts | store |
| GET | /post/{id} | show |
| PUT | /post/{id} | update |
| DELETE | /post/{id} | destroy |

## Endpoint Products (Tantangan)

| Method | Endpoint | Controller function |
|---|---|---|
| GET | /products | index |
| POST | /products | store |
| GET | /product/{id} | show |
| PUT | /product/{id} | update |
| DELETE | /product/{id} | destroy |

## Struktur tabel products

| Field | Tipe |
|---|---|
| id | increments |
| name | string |
| sku | string |
| description | text |
| category | string |
| brand | string |
| price | unsigned integer |
| stock | unsigned integer |
| status | string |
| created_at | timestamp |
| updated_at | timestamp |

## Fitur Tambahan (Validation dan Error Handling)

- Pagination pada `GET /posts` (response: `total_count`, `limit`, `pagination`, `data`)
- Tabel `users` untuk validasi `user_id`
- Validasi `POST /posts` dan `PUT /post/{id}`:

| Field   | Aturan                                  |
|---------|-----------------------------------------|
| title   | wajib, minimal 5 karakter               |
| content | wajib, minimal 10 karakter              |
| status  | wajib, hanya `draft` atau `published`   |
| user_id | wajib, harus ada di tabel `users`       |

- Response error validasi: **400 Bad Request**
- Error handling JSON untuk 404 (not found) dan 405 (method not allowed)
  (set `APP_DEBUG=false` di `.env`)

## Contoh request (POST /products)

```json
{
    "name": "Kaos Polos",
    "sku": "KS-001",
    "description": "Kaos katun nyaman dipakai sehari-hari",
    "category": "Pakaian",
    "brand": "Uniqlo",
    "price": 75000,
    "stock": 20,
    "status": "active"
}
```

## Cara menjalankan

1. `composer install`
2. Salin `.env.example` menjadi `.env`, lalu atur koneksi database (`DB_DATABASE=lumen_crud`)
3. Buat database `lumen_crud`
4. `php artisan migrate`
5. `php -S localhost:8000 -t public`
6. Tes lewat Postman di `http://localhost:8000`