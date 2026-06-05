<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CV Ta'aruf - {{ $user->nama }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #2563EB;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #2563EB;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0 0;
            color: #666;
            font-size: 14px;
        }
        .section-title {
            background-color: #EFF6FF;
            color: #1D4ED8;
            padding: 5px 10px;
            font-weight: bold;
            font-size: 14px;
            margin-top: 20px;
            border-left: 4px solid #2563EB;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table td {
            padding: 5px;
            vertical-align: top;
        }
        .label {
            width: 30%;
            font-weight: bold;
            color: #444;
        }
        .value {
            width: 70%;
        }
        .photo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .photo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #2563EB;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>CV TA'ARUF</h1>
        <p>Aplikasi Ta'aruf Karyawan YPI Al Azhar</p>
    </div>

    @if(!empty($user->foto) && file_exists(storage_path('app/public/uploads/karyawan/img/' . $user->foto)))
    <div class="photo-container">
        <img src="{{ storage_path('app/public/uploads/karyawan/img/' . $user->foto) }}" class="photo" alt="Foto Profil">
    </div>
    @endif

    <div class="section-title">A. Biodata Dasar</div>
    <table>
        <tr>
            <td class="label">Nama Lengkap</td>
            <td class="value">: {{ $user->nama }}</td>
        </tr>
        <tr>
            <td class="label">NIP</td>
            <td class="value">: {{ $user->nip }}</td>
        </tr>
        <tr>
            <td class="label">Jenis Kelamin</td>
            <td class="value">: {{ ucfirst($user->jenkel) }}</td>
        </tr>
        <tr>
            <td class="label">Tempat, Tanggal Lahir</td>
            <td class="value">: {{ $biodata->tempatlahir ?? '-' }}, {{ !empty($biodata->tgllahir) ? \Carbon\Carbon::parse($biodata->tgllahir)->format('d F Y') : '-' }}</td>
        </tr>
        <tr>
            <td class="label">Suku Asal</td>
            <td class="value">: {{ $biodata->suku ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Pendidikan Terakhir</td>
            <td class="value">: {{ $biodata->pendidikan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Pekerjaan</td>
            <td class="value">: {{ $biodata->pekerjaan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Status Pernikahan</td>
            <td class="value">: {{ $biodata->statusnikah ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Alamat Lengkap</td>
            <td class="value">: {{ $biodata->alamat ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">B. Informasi Fisik</div>
    <table>
        <tr>
            <td class="label">Tinggi Badan</td>
            <td class="value">: {{ $biodata->tinggi ?? '-' }} cm</td>
        </tr>
        <tr>
            <td class="label">Berat Badan</td>
            <td class="value">: {{ $biodata->berat ?? '-' }} kg</td>
        </tr>
        <tr>
            <td class="label">Golongan Darah</td>
            <td class="value">: {{ $biodata->goldar ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">C. Profil Tambahan</div>
    <table>
        <tr>
            <td class="label">Hobi</td>
            <td class="value">: {{ $biodata->hobi ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Motto Hidup</td>
            <td class="value">: {{ $biodata->motto ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-title">D. Kriteria Pasangan yang Diharapkan</div>
    <table>
        <tr>
            <td class="label">Rentang Usia</td>
            <td class="value">: {{ $kriteria->kriteriaumur ?? 'Tidak ada kriteria khusus' }}</td>
        </tr>
        <tr>
            <td class="label">Rentang Tinggi</td>
            <td class="value">: {{ $kriteria->kriteriatinggi ?? 'Tidak ada kriteria khusus' }}</td>
        </tr>
        <tr>
            <td class="label">Rentang Berat</td>
            <td class="value">: {{ $kriteria->kriteriaberat ?? 'Tidak ada kriteria khusus' }}</td>
        </tr>
        <tr>
            <td class="label">Kriteria Suku</td>
            <td class="value">: {{ $kriteria->kriteriasuku ?? 'Tidak ada kriteria khusus' }}</td>
        </tr>
        <tr>
            <td class="label">Kriteria Umum Lainnya</td>
            <td class="value">: {{ $kriteria->kriteriaumum ?? 'Tidak ada kriteria khusus' }}</td>
        </tr>
    </table>

    <div class="footer">
        Dicetak dari Aplikasi Ta'aruf Jodohku v.2.0 | YPI Al Azhar pada {{ \Carbon\Carbon::now()->format('d M Y H:i') }}
    </div>

</body>
</html>
