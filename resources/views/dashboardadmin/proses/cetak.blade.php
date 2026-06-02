<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Cetak Proses Ta'aruf</title>

  <!-- Normalize dan paper.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <style>
    @page { size: A4; margin: 15mm; }
    body { font-family: "Times New Roman", Times, serif; color: #222; }

    /* Header */
    .kop-surat {
      display: flex;
      align-items: center;
      border-bottom: 3px double #00783e;
      padding-bottom: 6px;
      margin-bottom: 10px;
    }

    .kop-logo img {
      width: 90px;
    }

    .kop-info {
      flex: 1;
      text-align: center;
      color: #00783e;
    }

    .kop-info h1 {
      font-size: 18px;
      margin: 0;
      font-weight: bold;
    }

    .kop-info h2 {
      font-size: 26px;
      margin: 2px 0;
      font-weight: bold;
    }

    .kop-info p {
      font-size: 12px;
      margin: 0;
      color: #00783e;
    }

    hr.garis-tipis {
      border: none;
      height: 1px;
      background: #00783e;
      margin: 1px 0;
    }

    /* Konten surat */
    .konten {
      font-size: 14px;
      line-height: 1.6;
      text-align: justify;
      margin-top: 10px;
    }

    .konten p {
      margin: 8px 0;
    }

    /* Tanggal */
    .tanggal {
      text-align: right;
      margin-top: 10px;
      margin-bottom: 15px;
    }

    /* Tanda tangan */
    .ttd {
      margin-top: 30px;
      text-align: right;
    }

    /* Gambar pasangan */
    .pasangan {
      display: flex;
      justify-content: center;
      gap: 40px;
      margin-top: 20px;
    }

    .pasangan img {
      width: 100px;
      height: 120px;
      object-fit: cover;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    /* Warna dan highlight */
    .hijau { color: #00783e; }

    /* Garis footer */
    .footer {
      border-top: 2px solid #00783e;
      margin-top: 40px;
      padding-top: 4px;
      font-size: 11px;
      text-align: center;
      color: #555;
    }
  </style>
</head>

<body class="A4 potrait">
  <section class="sheet padding-15mm">

    <!-- Kop Surat -->
    <div class="kop-surat">
      <div class="kop-logo">
        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo Al Azhar">
      </div>
      <div class="kop-info">
        <h1>Yayasan Pesantren Islam Al Azhar</h1>
        <h2>Direktorat Dakwah dan Sosial</h2>
        <p>Jl. Sisingamangaraja, Kebayoran Baru, Jakarta Selatan 12110 | Telp. 021-72783683</p>
        <p>Website: www.masjidagungalazhar.com | Email: masjidagungalazhar@gmail.com</p>
      </div>
    </div>

    <!-- Tanggal -->
    <div class="tanggal">
      <p><b>Jakarta, {{ \Carbon\Carbon::parse(now())->isoFormat('DD MMMM YYYY') }}</b></p>
    </div>

    <!-- Salam pembuka -->
    <div class="konten">
      <p><i>Assalamu’alaikum Warahmatullahi Wabarakatuh,</i></p>
      <p>Salam ta'zim kami sampaikan, semoga Allah SWT senantiasa melimpahkan rahmat, taufiq, dan hidayah-Nya kepada kita semua dalam menjalankan aktivitas sehari-hari.</p>

      @foreach ($allDataProgress as $data)
      <p>Direktorat YPI Al Azhar memberikan rekomendasi atas pasangan <b>{{ $data->nama_auth }}</b> dan <b>{{ $data->nama_profile }}</b> yang telah ditetapkan dalam aplikasi Ta’aruf. Kami berharap pasangan ini memiliki tujuan yang sama untuk segera melangkah ke jenjang pernikahan.</p>
      @endforeach
    </div>

    <!-- Foto pasangan -->
    <div class="pasangan">
      @foreach ($allDataProgress as $data)
      <div>
        @php $path = Storage::url('uploads/karyawan/img/' . $data->foto_auth); @endphp
        <img src="{{ $path }}" alt="{{ $data->nama_auth }}">
      </div>
      <div>
        @php $path = Storage::url('uploads/karyawan/img/' . $data->foto_profile); @endphp
        <img src="{{ $path }}" alt="{{ $data->nama_profile }}">
      </div>
      @endforeach
    </div>

    <!-- Isi surat -->
    <div class="konten">
      <p>Untuk melanjutkan proses Ta’aruf ini, kami jadwalkan sesi konsultasi/bimbingan bagi pasangan tersebut pada hari ..........., tanggal .............. pukul ....... WIB di Ruang Takmir Masjid Agung Al Azhar.</p>
      <p>Untuk informasi lebih lanjut, pasangan dapat menghubungi Whatsapp Center kami di nomor <b>0882-1211-4771</b>.</p>
      <p>Semoga Allah SWT memberkahi dan memudahkan perjalanan hidup pasangan ini.</p>

      <p><i>Wassalamu’alaikum Warahmatullahi Wabarakatuh.</i></p>
    </div>

    <!-- Tanda tangan -->
    <div class="ttd">
      <p>Hormat kami,</p>
      <p><b>Dirat Daksos YPI Al Azhar</b></p>
      <br><br>
      <p>(.................................)<br>
      <span class="hijau">Ka. Dirat Daksos</span></p>
    </div>

    <!-- Footer -->
    <div class="footer">
      <p>Dicetak otomatis oleh Sistem Informasi Ta’aruf - Masjid Agung Al Azhar</p>
    </div>

  </section>
</body>
</html>
