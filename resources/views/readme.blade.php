<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DokCik Documentation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h1, h2, h3 {
            color: #0073e6;
        }
        code {
            background-color: #eee;
            padding: 2px 6px;
            border-radius: 4px;
            font-family: monospace;
        }
        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 6px;
            overflow-x: auto;
        }
        a {
            color: #0073e6;
        }
    </style>
</head>
<body>

<h1>📄 DokCik - Dokumen Cerdas & Praktis</h1>

<p><strong>DokCik</strong> adalah API & antarmuka web modern berbasis Laravel 12 untuk membuat dokumen otomatis dari template <code>.docx</code> dan <code>.xlsx</code>. Cocok digunakan oleh kantor desa, kelurahan, disdukcapil, dan instansi administrasi lainnya.</p>

<hr>

<h2>✨ Fitur Utama</h2>
<ul>
    <li>Mendukung format <code>.docx</code> dan <code>.xlsx</code></li>
    <li>Pengguna bisa mengunggah dan mengelola template sendiri</li>
    <li>Integrasi API untuk generate dokumen otomatis</li>
    <li>Dukungan autentikasi Laravel Sanctum</li>
    <li>Dukungan tampilan antarmuka web</li>
    <li>Template default juga disediakan</li>
</ul>

<h2>🚀 Instalasi</h2>

<pre><code>git clone https://github.com/your-username/dokcik.git
cd dokcik
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
</code></pre>

<h3>Tambahkan Storage Folder</h3>
<pre><code>mkdir -p storage/app/templates
mkdir -p storage/app/documents</code></pre>

<h2>🔐 Autentikasi</h2>
<p>Pastikan sudah setup <code>Laravel Sanctum</code> untuk API dan Laravel Breeze atau Fortify untuk web login.</p>

<h2>🌐 API Endpoint</h2>

<h3>POST /api/documents/generate</h3>
<p>Generate dokumen dari template (autentikasi token diperlukan)</p>

<pre><code>POST /api/documents/generate
Headers:
Authorization: Bearer &lt;token&gt;

Body (JSON):
{
    "template_name": "template.docx",
    "data": {
        "nama": "Budi",
        "alamat": "Jalan Mawar"
    }
}</code></pre>

<h3>GET /api/documents/list</h3>
<p>Melihat daftar dokumen yang telah digenerate.</p>

<hr>

<h2>🖥️ Antarmuka Web</h2>

<ul>
    <li><code>/templates</code> → Daftar template yang diunggah</li>
    <li><code>/templates/upload</code> → Upload template baru</li>
    <li><code>/documents/form</code> → Form untuk generate dokumen dari web</li>
</ul>

<h2>📁 Lokasi Penyimpanan Template</h2>

<ul>
    <li><code>storage/app/templates/{user_id}/</code> → untuk template pengguna</li>
    <li><code>public/templates_default/</code> → untuk template default bawaan sistem</li>
</ul>

<h2>📎 Contoh File Template</h2>
<ul>
    <li><code>template.docx</code> dengan tag seperti <code>${nama}</code>, <code>${alamat}</code></li>
    <li><code>template.xlsx</code> dengan tag pada sel seperti <code>${tanggal}</code></li>
</ul>

<h2>⚠️ Catatan</h2>
<ul>
    <li>Gunakan penamaan variabel sesuai dengan data yang akan di-inject ke dalam template.</li>
    <li>Untuk penggunaan tag di .docx dan .xlsx, pastikan menggunakan format <code>${namavariabel}</code></li>
</ul>

<h2>📬 Lisensi</h2>
<p><strong>MIT License</strong> – Bebas digunakan, dimodifikasi, dan dikembangkan lebih lanjut.</p>

<hr>

<p style="text-align: center;"><strong>Made with ❤️ for public service documentation – DokCik</strong></p>

</body>
</html>
