<!DOCTYPE html>
<html>
<head>
    <title>Balasan Resmi dari Tim Benevita Consulting</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            color: #2c3e50;
            border-bottom: 2px solid #f1c40f;
            padding-bottom: 10px;
        }
        .content {
            padding: 20px 0;
        }
        blockquote {
            background: #f9f9f9;
            border-left: 4px solid #f1c40f;
            margin: 1.5em 0;
            padding: 0.5em 15px;
            font-style: italic;
        }
        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            color: #7f8c8d;
        }
        .signature {
            margin-top: 20px;
            font-weight: bold;
        }
        .service-info {
            background: #e8f4f8;
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-weight: 500;
        }
    </style>
</head>
<body>
<div class="header">
    <h2>Halo, {{ $messageData->full_name }}</h2>
</div>

<div class="content">
    <p>Terima kasih telah menghubungi Benevita.
        Kami menghargai waktu dan perhatian yang Anda berikan untuk menghubungi kami.</p>

    <div class="service-info">
        <p><strong>Layanan yang Anda pilih:</strong> {{ $messageData->subject }}</p>
    </div>

    <p><strong>Pesan Anda:</strong></p>
    <blockquote>{{ $messageData->message ?: '-' }}</blockquote>

    <p><strong>Balasan dari Tim Kami:</strong></p>
    <blockquote>{{ $messageData->reply }}</blockquote>

    <p>Kami berharap informasi di atas dapat membantu menjawab kebutuhan Anda.
        Jika ada hal lain yang perlu diklarifikasi atau Anda membutuhkan bantuan lebih lanjut,
        jangan ragu untuk menghubungi kami kembali melalui:</p>

    <ul>
        <li>Email: {{ $informationContact->email}}</li>
        <li>WhatsApp: {{ $informationContact->phone}}</li>
    </ul>
    <p>Kami selalu berkomitmen untuk memberikan pelayanan terbaik kepada Anda.</p>
</div>

<div class="footer">
    <p class="signature">Salam hormat,</p>
    <p><strong>Tim Customer Service</strong><br>
        Benevita
    </p>
</div>
</body>
</html>
