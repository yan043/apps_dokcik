# 📄 DokCik – Document Creator Kit

**DokCik** adalah API & Website generator dokumen otomatis berbasis template `.docx` dan `.xlsx`. Cocok digunakan untuk:

- Kantor desa, kelurahan, disdukcapil
- Back-office admin
- Instansi lain yang membutuhkan sistem pembuatan surat atau laporan cepat dan efisien

---

## ✨ Fitur

- ✅ Upload & simpan template per pengguna
- ✅ Dukungan format `.docx` dan `.xlsx`
- ✅ Gunakan template default dari sistem
- ✅ Web UI dan RESTful API
- ✅ Autentikasi via Laravel Sanctum

---

## 🚀 Instalasi

```bash
git clone https://github.com/yan043/dokcik.git
cd dokcik

composer install

cp .env.example .env
php artisan key:generate

# Konfigurasi .env sesuai database
php artisan migrate

php artisan serve
```

---

## 📂 Struktur Template

- Template pribadi: `storage/app/templates/{user_id}/`
- Template default: `public/templates_default/`

> Gunakan placeholder seperti `{{name}}`, `{{date}}`, dll. dalam dokumen.

---

## 🌐 Penggunaan Website

1. Login
2. Upload template melalui menu "Templates"
3. Isi data pada form generate
4. Klik "Generate"
5. Dokumen akan terdownload otomatis

---

## 📡 Penggunaan API

### 🔒 Autentikasi

Gunakan token dari Laravel Sanctum sebagai bearer:

```http
Authorization: Bearer {your_token}
Accept: application/json
```

---

### 📝 Generate Dokumen

**Endpoint:**

```http
POST /api/documents/generate
```

**Contoh Request Body:**

```json
{
  "template_name": "template.docx",
  "data": {
    "name": "Mahdian",
    "date": "2025-05-19"
  }
}
```

---

### 📥 Ambil List Dokumen

```http
GET /api/documents/list
```

---

## 🧪 Contoh Template

Template default tersedia di folder `public/templates_default/`:

- [`template.docx`](public/templates_default/template.docx)
- [`template.xlsx`](public/templates_default/template.xlsx)

---

## 🤝 Kontribusi

Silakan fork repo ini dan ajukan pull request. Semua kontribusi sangat kami apresiasi.

---

## 📛 Lisensi

MIT License © 2025 - Mahdian & Kontributor DokCik

> Dibangun dengan ❤️ dan Laravel 12
