@extends('layouts.bootstrap')
@section('content')
<style>
/* Modern styling for text-heavy pages */
.legal-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 60px 20px;
}
.legal-header {
    text-align: center;
    margin-bottom: 40px;
}
.legal-header h1 {
    font-size: 2.5rem;
    font-weight: 800;
    color: #0053C5;
}
.legal-header p {
    color: #757575;
}
.legal-content h2 {
    font-size: 1.5rem;
    color: #212121;
    margin-top: 30px;
    margin-bottom: 15px;
}
.legal-content p {
    color: #757575;
    line-height: 1.8;
    margin-bottom: 15px;
}
</style>
<div class="legal-container">
    <div class="legal-header">
        <h1>Kebijakan Privasi</h1>
        <p>Terakhir diperbarui: {{ date('d F Y') }}</p>
    </div>
    <div class="legal-content">
        <h2>1. Pendahuluan</h2>
        <p>Selamat datang di TaarufV2. Kami menghargai privasi Anda dan berkomitmen untuk melindungi informasi pribadi yang Anda bagikan dengan kami. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan menjaga data Anda.</p>

        <h2>2. Informasi yang Kami Kumpulkan</h2>
        <p>Kami mengumpulkan informasi yang Anda berikan langsung kepada kami saat mendaftar, membuat profil, atau menggunakan layanan kami. Ini mungkin termasuk nama, alamat email, foto profil, dan informasi kriteria pencarian pasangan.</p>

        <h2>3. Penggunaan Informasi</h2>
        <p>Informasi Anda digunakan untuk memfasilitasi proses ta'aruf, memberikan rekomendasi pasangan yang relevan, dan berkomunikasi dengan Anda mengenai layanan kami.</p>

        <h2>4. Perlindungan Data</h2>
        <p>Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi data pribadi Anda dari akses yang tidak sah, kehilangan, atau penyalahgunaan.</p>

        <h2>5. Perubahan pada Kebijakan Privasi</h2>
        <p>Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Kami akan memberi tahu pengguna tentang perubahan material melalui email atau pemberitahuan di situs web.</p>
    </div>
</div>
@endsection
