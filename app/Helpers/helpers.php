<?php

if (!function_exists('angka_ke_teks')) {
    function angka_ke_teks($angka) {
        $teks = [
            'nol', 'satu', 'dua', 'tiga', 'empat', 'lima',
            'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh',
            'sebelas', 'dua belas', 'tiga belas', 'empat belas',
            'lima belas', 'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas'
        ];

        if ($angka < 20) {
            return $teks[$angka];
        } elseif ($angka < 100) {
            return $teks[floor($angka / 10)] . ' puluh' . ($angka % 10 ? ' ' . $teks[$angka % 10] : '');
        } else {
            return $angka; // Jika lebih dari 99, kembalikan angka (bisa ditambah logika lain jika diperlukan)
        }
    }
}
