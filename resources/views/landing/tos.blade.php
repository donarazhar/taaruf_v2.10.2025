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
.legal-content p, .legal-content li {
    color: #757575;
    line-height: 1.8;
    margin-bottom: 15px;
}
</style>
<div class="legal-container">
    <div class="legal-header">
        <h1>Syarat dan Ketentuan</h1>
        <p>Terakhir diperbarui: {{ date('d F Y') }}</p>
    </div>
    <div class="legal-content">
        <h2>1. Penerimaan Syarat</h2>
        <p>Dengan mengakses atau menggunakan platform TaarufV2, Anda menyetujui untuk terikat oleh Syarat dan Ketentuan ini. Jika Anda tidak setuju dengan bagian mana pun dari syarat ini, Anda dilarang menggunakan layanan kami.</p>

        <h2>2. Penggunaan Layanan</h2>
        <p>Anda setuju untuk menggunakan layanan kami hanya untuk tujuan yang sah, yakni untuk proses ta'aruf yang sesuai dengan syariat Islam. Anda tidak diperkenankan menggunakan platform ini untuk tujuan penipuan, pelecehan, atau aktivitas ilegal lainnya.</p>

        <h2>3. Akun Pengguna</h2>
        <p>Anda bertanggung jawab untuk menjaga kerahasiaan kata sandi akun Anda dan atas semua aktivitas yang terjadi di bawah akun Anda. Anda harus memberikan informasi yang akurat dan lengkap saat mendaftar.</p>

        <h2>4. Konten Pengguna</h2>
        <p>Anda mempertahankan hak cipta atas konten yang Anda unggah (seperti foto profil dan biodata). Namun, Anda memberikan kami lisensi untuk menggunakan konten tersebut dalam rangka menyediakan layanan platform TaarufV2.</p>

        <h2>5. Penghentian</h2>
        <p>Kami berhak untuk menghentikan atau menangguhkan akun Anda secara sepihak jika kami menemukan adanya pelanggaran terhadap Syarat dan Ketentuan ini.</p>
    </div>
</div>
@endsection
