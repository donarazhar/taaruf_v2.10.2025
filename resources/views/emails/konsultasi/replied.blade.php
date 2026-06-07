<x-mail::message>
# Halo {{ $userName }},

Tiket konsultasi Anda telah mendapatkan balasan dari Admin / Murobi kami.

Silakan periksa jawaban dari Murobi untuk mendapatkan arahan lebih lanjut mengenai proses taaruf Anda.

<x-mail::button :url="$konsultasiUrl" color="primary">
Lihat Balasan Konsultasi
</x-mail::button>

Semoga jawaban dari Murobi dapat membantu memberikan pencerahan.

Wassalam,<br>
Murobi & Tim {{ config('app.name') }}
</x-mail::message>
