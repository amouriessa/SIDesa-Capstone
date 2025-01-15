<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Surat Kelahiran</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Javanese:wght@400..700&display=swap" rel="stylesheet">

    <style>
        @page {
            size: A4;
            margin: 20mm 15mm; /* Mengurangi margin agar lebih efisien */
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt; /* Mengatur ukuran font lebih kecil agar lebih pas di halaman */
            line-height: 1.15;
            margin: 0;
            padding: 0;
        }

        #judul {
            text-align: center;
            margin-bottom: 10px;
        }

        #halaman {
            width: 100%;
            height: 100%;
            padding: 15px 10px; /* Menyesuaikan padding agar lebih rapat */
            box-sizing: border-box;
        }

        table {
            width: 100%;
            margin-top: 10px;
            border-spacing: 0;
            margin-bottom: 20px;
            table-layout: fixed;
        }

        td:first-child {
        width: 35%; /* Lebar kolom pertama disesuaikan */
        }

        td:nth-child(2) {
            width: 65%; /* Lebar kolom kedua */
        }

        td {
            padding: 4px 8px;
            vertical-align: top;
            font-size: 12pt;
        }

        .bold {
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        hr {
            border: 0;
            border-top: 1px solid black;
            margin: 10px 0;
        }

        .footer {
            text-align: right;
            margin-top: 30px;
        }

        .signature {
            margin-top: 70px;
        }

        .aksara-jawa {
            font-family: "Noto Sans Javanese", serif;
        }

        #header {
            display: flex;
            justify-content: center; /* Memposisikan elemen secara horizontal di tengah */
            align-items: center; /* Memposisikan elemen secara vertikal di tengah (opsional jika dibutuhkan) */
            margin-bottom: 20px; /* Tambahkan margin bawah jika diperlukan */
        }

        #header img {
        width: 100%; /* Gambar akan menyesuaikan lebar container */
        max-width: 800px; /* Maksimal lebar gambar */
        height: auto; /* Menjaga rasio aspek gambar */
        }

    </style>
</head>
<body>
    <div id="halaman">
        <!-- Header Section -->
        <div id="header" class="items-center justify-center">
            <img src="images/admin/1.jpg" alt="Logo Kabupaten Kulon Progo" class="w-40 mx-auto">
        </div>

        <!-- Surat Header -->
        <div class="center">
            <p><strong><u>SURAT KETERANGAN KELAHIRAN</u></strong><br>
            <span style="font-size: 12pt;">No: {{ $births->nomor_surat }}</span></p>
        </div>

        <p>Yang bertanda tangan di bawah ini Lurah Sidorejo Kapanewon Lendah Kabupaten Kulon Progo<br>
            Daerah Istimewa Yogyakarta menerangkan bahwa telah lahir:</p>

        <!-- Data Table -->
        <table>
            <tr>
                <td>Nama</td>
                <td class="bold">: {{ $births->nama_anak }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $births->jenis_kelamin_anak }}</td>
            </tr>
            <tr>
                <td>Hari</td>
                <td>: {{ $births->hari_kelahiran }}</td>
            </tr>
            <tr>
                <td>Tgl Lahir</td>
                <td>: {{ \Carbon\Carbon::parse($births->tanggal_kelahiran)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Di</td>
                <td>: {{ $births->tempat_kelahiran }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $births->alamat_anak }}</td>
            </tr>
        </table>

        <p>Adalah anak ke {{ $births->urutan_anak }} ({{ angka_ke_teks($births->urutan_anak) }}) dari {{ $births->total_saudara }} ({{ angka_ke_teks($births->total_saudara) }}) bersaudara dengan nama orang tua:</p>

        <!-- Orang Tua Table -->
        <table>
            <tr>
                <td>Nama Orang Tua:</td>
            </tr>
            <tr>
                <td>Nama Ayah</td>
                <td>: {{ $births->nama_ayah }}</td>
            </tr>
            <tr>
                <td>Alamat Ayah</td>
                <td>: {{ $births->alamat_ayah }}</td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td>: {{ $births->nama_ibu }}</td>
            </tr>
            <tr>
                <td>Alamat Ibu</td>
                <td>: {{ $births->alamat_ibu }}</td>
            </tr>
        </table>

        <p>Demikian surat keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya.</p>

        <!-- Footer Section -->
        <div class="footer">
            <p>Sidorejo, {{ \Carbon\Carbon::parse($births->created_at)->translatedFormat('d F Y') }}
                <br>Lurah Sidorejo
            </p>
            <p class="signature"><b>JUWANI</b></p>
            <p><br><br><u></u></p>
        </div>
    </div>
</body>
</html>
