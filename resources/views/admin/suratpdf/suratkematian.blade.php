<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Surat Kematian</title>

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
            <p><strong><u>SURAT KETERANGAN KEMATIAN</u></strong><br>
            <span style="font-size: 12pt;">No: {{ $deaths->nomor_surat_kematian }}</span></p>
        </div>

        <p>Yang bertanda tangan di bawah ini Lurah Sidorejo Kapanewon Lendah Kabupaten Kulon Progo<br>
            Daerah Istimewa Yogyakarta menerangkan bahwa telah meninggal dunia:</p>

        <!-- Data Table -->
        <table>
            <tr>
                <td>Nama</td>
                <td class="bold">: {{ $deaths->nama_alm }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $deaths->jenis_kelamin_alm }}</td>
            </tr>
            <tr>
                <td>Umur</td>
                <td>: {{ $deaths->umur_almarhum }}</td>
            </tr>
            <tr>
                <td>Di:</td>
                <td>: Kulon Progo</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>: {{ $deaths->alamat_alm }}</td>
            </tr>
        </table>

        <p>Meninggal Pada</p>

        <!-- Informasi Kematian -->
        <table>
            <tr>
                <td>Hari</td>
                <td>: {{ $deaths->hari_kematian }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: {{ \Carbon\Carbon::parse($deaths->tanggal_kematian)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td>Jam</td>
                <td>: {{ $deaths->pukul_kematian }}</td>
            </tr>
            <tr>
                <td>Tempat</td>
                <td>: {{ $deaths->tempat_kematian }}</td>
            </tr>

            <br>

            <tr>
                <td>Penyebab Kematian</td>
                <td>: {{ $deaths->penyebab_kematian }}</td>
            </tr>
        </table>

        <p>Demikian surat keterangan ini dibuat agar dapat dipergunakan sebagaimana mestinya.</p>

        <!-- Footer Section -->
        <div class="footer">
            <p>Sidorejo, {{ \Carbon\Carbon::parse($deaths->created_at)->translatedFormat('d F Y') }}
                <br>Lurah Sidorejo
            </p>
            <p class="signature"><b>JUWANI</b></p>
            <p><br><br><u></u></p>
        </div>
    </div>
</body>
</html>
