
<?php

// Konfigurasi Supabase
define('SUPABASE_URL', 'https://ovgiosoduswzarzmmvui.supabase.co');
define('SUPABASE_KEY', 'sb_publishable_sXuL8XlvGaKL4a-0hZ7hTA_zviIDT_C');

// Fungsi mengambil data dari Supabase
function supabaseGet($table)
{
    $allowedTables = [
        'tbl_data_pribadi',
        'tbl_skill',
        'tbl_portofolio',
        'tbl_pendidikan',
        'tbl_kontak'
    ];

    if (!in_array($table, $allowedTables, true)) {
        return [
            'success' => false,
            'data' => [],
            'error' => 'Nama tabel tidak diizinkan.'
        ];
    }

    $url = SUPABASE_URL . '/rest/v1/' . $table . '?select=*';

    $curl = curl_init($url);

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'apikey: ' . SUPABASE_KEY,
            'Accept: application/json'
        ],
        CURLOPT_TIMEOUT => 15,
        CURLOPT_CAINFO => __DIR__ . '/certificates/cacert.pem',
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2
    ]);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $curlError = curl_error($curl);

    curl_close($curl);

    if ($response === false || $curlError !== '') {
        return [
            'success' => false,
            'data' => [],
            'error' => $curlError
        ];
    }

    $data = json_decode($response, true);

    if ($httpCode < 200 || $httpCode >= 300 || !is_array($data)) {
        return [
            'success' => false,
            'data' => [],
            'error' => $response
        ];
    }

    return [
        'success' => true,
        'data' => $data,
        'error' => null
    ];
}

function supabaseInsert($table, $data)
{
    if ($table !== 'tbl_pesan') {
        return [
            'success' => false,
            'error' => 'Tabel tidak diizinkan.'
        ];
    }

    $url = SUPABASE_URL . '/rest/v1/' . $table;

    $curl = curl_init($url);

    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => [
            'apikey: ' . SUPABASE_KEY,
            'Authorization: Bearer ' . SUPABASE_KEY,
            'Content-Type: application/json',
            'Prefer: return=minimal'
        ],
        CURLOPT_TIMEOUT => 15,
        CURLOPT_CAINFO => __DIR__ . '/certificates/cacert.pem',
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2
    ]);

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $curlError = curl_error($curl);

    curl_close($curl);

    if ($response === false || $curlError !== '') {
        return [
            'success' => false,
            'error' => $curlError
        ];
    }

    if ($httpCode < 200 || $httpCode >= 300) {
        return [
            'success' => false,
            'error' => $response
        ];
    }

    return [
        'success' => true,
        'error' => null
    ];
}
