<x-mail::message>
# Halo, {{ $senderName }} baru saja mengirim pesan!

Seseorang telah mengirimkan pesan baru kepada Anda di fitur Chat Taaruf.

<x-mail::panel>
"{{ Str::limit($messageExcerpt, 100) }}"
</x-mail::panel>

Klik tombol di bawah ini untuk melihat pesan lengkap dan membalasnya:

<x-mail::button :url="$chatUrl" color="primary">
Lihat Pesan
</x-mail::button>

Semoga proses taaruf Anda dimudahkan oleh Allah SWT.

Wassalam,<br>
{{ config('app.name') }}
</x-mail::message>
