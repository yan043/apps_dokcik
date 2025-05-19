<!DOCTYPE html>
<html>
<head>
    <title>Upload Template Baru</title>
</head>
<body>
    <h2>Upload Template Baru</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('templates.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="template">Pilih file (.docx atau .xlsx):</label><br>
        <input type="file" name="template" id="template" required accept=".docx,.xlsx" /><br><br>
        <button type="submit">Upload</button>
        <a href="{{ route('templates.list') }}">Batal</a>
    </form>
</body>
</html>
