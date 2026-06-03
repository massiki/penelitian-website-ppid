<x-mail::message>
  # Hallo {{ $nama }}

  <p>
    Kami ingin menginformasikan bahwa pengajuan keberatan yang Anda ajukan telah kami tolak dengan alasan:
    <br>
    {{ $pesan_ditolak }}
  </p>

  Terima kasih,<br>
  {{ config('app.name') }}
</x-mail::message>
