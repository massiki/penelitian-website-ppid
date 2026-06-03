<x-mail::message>
  # Hallo {{ $nama }}

  <p>
    Terima kasih atas permohonan Anda. Permohonan tersebut telah kami proses, dan Anda dapat melihat detailnya dengan menekan tombol di bawah ini.
  </p>

  <x-mail::button :url="config('app.url') . '/riwayat?email=' . $email" color="success">
    Cek
  </x-mail::button>

  Terima kasih,<br>
  {{ config('app.name') }}
</x-mail::message>