<!DOCTYPE html>
<html>
<head>
    <title>List Dokumen</title>
</head>
<body>
    <h2>Daftar Dokumen Anda</h2>

    <ul>
        @foreach($documents as $doc)
            <li>
                <a href="{{ route('documents.download', ['filename' => $doc]) }}">{{ $doc }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>
