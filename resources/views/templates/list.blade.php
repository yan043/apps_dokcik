<!DOCTYPE html>
<html>
<head>
    <title>Daftar Template</title>
</head>
<body>
    <h2>Template Anda</h2>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color: red">{{ session('error') }}</p>
    @endif

    <ul>
        @forelse ($templates as $template)
            <li>
                <a href="{{ $template['url'] }}" target="_blank">{{ $template['name'] }}</a>
                ({{ strtoupper($template['extension']) }})
                <form action="{{ route('templates.delete', $template['name']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </li>
        @empty
            <li>Tidak ada template.</li>
        @endforelse
    </ul>

    <a href="{{ route('templates.form') }}">Upload Template Baru</a>
</body>
</html>
