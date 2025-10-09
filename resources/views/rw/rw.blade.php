<!DOCTYPE html>
<html>
<head>
    <title>Data RW - Perangkat & Lembaga</title>
</head>
<body>
    <h1>Daftar RW</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>RW ID</th>
                <th>Nomor RW</th>
                <th>Ketua RW (Warga ID)</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rw as $item)
                <tr>
                    <td>{{ $item['rw_id'] }}</td>
                    <td>{{ $item['nomor_rw'] }}</td>
                    <td>{{ $item['ketua_rw_warga_id'] }}</td>
                    <td>{{ $item['keterangan'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
<q>
</q>