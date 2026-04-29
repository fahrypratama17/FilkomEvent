<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Pesan Baru</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f6f8; font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:20px;">
  <tr>
    <td align="center">

      <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.05);">

        <tr>
          <td style="background:#001d3d; padding:20px; text-align:center;">
            <h1 style="color:#ffffff; margin:0; font-size:24px;">
              Filkom<span style="color:#f97316;">Event</span>
            </h1>
            <p style="color:#ffffff; margin:5px 0 0; font-size:14px;">
              Pesan Baru dari Website
            </p>
            <p style="font-size:12px; color:#999;">
              Dikirim pada: {{ now()->format('d M Y H:i') }}
            </p>
          </td>
        </tr>

        <tr>
          <td style="padding:25px; color:#333333;">

            <p><strong>Nama:</strong><br>{{ $data['nama'] }}</p>

            <p><strong>Email:</strong><br>{{ $data['email'] }}</p>

            <p><strong>NIM:</strong><br>{{ $data['nim'] }}</p>

            <p><strong>Pesan:</strong></p>
            <div style="background:#f9fafb; padding:15px; border-radius:8px; line-height:1.5;">
              {{ $data['pesan'] }}
            </div>

          </td>
        </tr>

        <tr>
          <td style="background:#f4f6f8; padding:15px; text-align:center; font-size:12px; color:#888;">
            © 2026 FilkomEvent • Universitas Brawijaya
          </td>
        </tr>

      </table>

    </td>
  </tr>
</table>

</body>
</html>
