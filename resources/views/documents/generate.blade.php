<!DOCTYPE html>
<html>
<head>
    <title>Generate Dokumen</title>
</head>
<body>
    <h2>Generate Dokumen dari Template</h2>

    @if (session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('documents.generate.web') }}">
        @csrf

        <label for="template">Pilih Template:</label>
        <select name="template_name" required>
            @foreach($templates as $template)
                <option value="{{ $template }}">{{ $template }}</option>
            @endforeach
        </select><br><br>

        <label>Nama:</label>
        <input type="text" name="data[nama]" required><br>

        <label>NIK:</label>
        <input type="text" name="data[nik]" required><br>

        <label>Alamat:</label>
        <input type="text" name="data[alamat]" required><br>

        <button type="submit">Generate & Download</button>
    </form>
</body>
</html>
