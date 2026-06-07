<x-mail::message>
# Assalamu'alaikum,

Ada pembaruan pada status progress taaruf Anda.

<x-mail::panel>
**Status Saat Ini:** {{ $statusUpdate }}
@if($messageText)
<br><br>
**Catatan:** {{ $messageText }}
@endif
</x-mail::panel>

Silakan klik tombol di bawah ini untuk melihat detail progress Anda secara langsung di dashboard:

<x-mail::button :url="$progressUrl" color="success">
Cek Progress Taaruf
</x-mail::button>

Semoga proses taaruf Anda selalu dalam keberkahan.

Wassalam,<br>
Tim {{ config('app.name') }}
</x-mail::message>
