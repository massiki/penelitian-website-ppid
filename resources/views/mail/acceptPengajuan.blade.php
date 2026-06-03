<x-mail::message>
  # Hallo {{ $nama }}

  <p>
    Kami ingin menginformasikan bahwa pengajuan keberatan yang Anda ajukan telah kami setujui. Untuk bukti
    penerimaan, bisa klik tombol di bawah ini.
  </p>

  <x-mail::button :url="config('app.url') . '/pengajuan-keberatan/' . $id . '/download'" color="success">
    Dapatkan Informasi
  </x-mail::button>

  Terima kasih,<br>
  {{ config('app.name') }}
</x-mail::message>