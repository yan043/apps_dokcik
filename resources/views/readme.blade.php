<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>DokCik - Document Creator Kit</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: auto;
            padding: 2rem;
            background: #f9f9f9;
            color: #333;
        }

        h1, h2, h3 {
            color: #2c3e50;
        }

        pre {
            background: #f0f0f0;
            padding: 1em;
            overflow-x: auto;
        }

        code {
            background: #eee;
            padding: 0.2em 0.4em;
            border-radius: 4px;
            font-family: monospace;
        }

        a {
            color: #2980b9;
        }

        hr {
            margin: 2rem 0;
        }
    </style>
</head>
<body>
    <h1>📄 DokCik – Document Creator Kit</h1>

    <p><strong>DokCik</strong> adalah API & Website generator dokumen otomatis berbasis template <code>.docx</code> dan <code>.xlsx</code>. Cocok digunakan untuk keperluan <strong>kantor desa, kelurahan, disdukcapil, back-office admin</strong>, dan instansi lainnya yang membutuhkan sistem pembuatan surat atau laporan cepat dan efisien.</p>

    <hr>

    <h2>✨ Fitur Unggulan</h2>
    <ul>
        <li>✅ Upload & simpan template pribadi per user</li>
        <li>✅ Mendukung format Microsoft Word (<code>.docx</code>) dan Excel (<code>.xlsx</code>)</li>
        <li>✅ Mendukung template default dari sistem</li>
        <li>✅ Dukungan Web UI dan RESTful API</li>
        <li>✅ Proteksi dengan autentikasi (Laravel Sanctum)</li>
    </ul>

    <hr>

    <h2>🚀 Instalasi</h2>
    <pre><code>git clone https://github.com/username/dokcik.git
cd dokcik

composer install

cp .env.example .env
php artisan key:generate

# Set konfigurasi database di file .env
php artisan migrate

php artisan serve
</code></pre>

    <hr>

    <h2>📂 Struktur Template</h2>
    <ul>
        <li>Template pribadi pengguna: <code>storage/app/templates/{user_id}/</code></li>
        <li>Template default sistem: <code>public/templates_default/</code></li>
    </ul>
    <p><strong>Catatan:</strong> Template harus menggunakan placeholder seperti <code>{name}</code>, <code>{date}</code>, dll.</p>

    <hr>

    <h2>🌐 Penggunaan Website</h2>
    <ol>
        <li>Login terlebih dahulu</li>
        <li>Upload template di menu <strong>Templates</strong></li>
        <li>Buka menu <strong>Generate Document</strong></li>
        <li>Isi form sesuai isian placeholder dalam template</li>
        <li>Klik <strong>Generate</strong> untuk membuat dokumen</li>
    </ol>

    <hr>

    <h2>📡 Penggunaan API</h2>

    <h3>🔒 Auth via Sanctum</h3>
    <p>Login terlebih dahulu dan gunakan token sebagai <code>Bearer</code> di header.</p>

    <h3>🔧 Generate Dokumen</h3>
    <p><strong>Endpoint:</strong></p>
    <pre><code>POST /api/documents/generate</code></pre>

    <p><strong>Headers:</strong></p>
    <pre><code>Authorization: Bearer {your_token}
Accept: application/json
</code></pre>

    <p><strong>Contoh Body (JSON):</strong></p>
    <pre><code>{
    "template_name": "template.docx",
    "data": {
        "name": "Siti Aminah",
        "date": "2025-05-19"
    }
}</code></pre>

    <h3>📥 Ambil Daftar Dokumen</h3>
    <pre><code>GET /api/documents/list</code></pre>

    <hr>

    <h2>🧪 Contoh Template</h2>
    <p>Kamu bisa menggunakan template default berikut sebagai referensi:</p>
    <ul>
        <li><a href="/templates_default/template.docx" download>📄 template.docx</a></li>
        <li><a href="/templates_default/template.xlsx" download>📊 template.xlsx</a></li>
    </ul>

    <hr>

    <h2>🤝 Kontribusi</h2>
    <p>Ingin ikut bantu pengembangan DokCik? Silakan fork dan ajukan pull request. Semua kontribusi sangat dihargai!</p>

    <hr>

    <h2>📛 Lisensi</h2>
    <p>MIT License © 2025 - Mahdian & Kontributor DokCik</p>

    <hr>

    <p><em>Dibangun dengan ❤️ dan Laravel 11</em></p>
</body>
</html>
