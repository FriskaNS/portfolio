
<?php
require_once 'koneksi.php';

echo "<h2>Testing Koneksi Supabase</h2>";

$hasil = supabaseGet('tbl_data_pribadi');

if ($hasil['success']) {
    echo "<p style='color:green;'>Koneksi Supabase berhasil!</p>";

    echo "<h3>Data dari Database:</h3>";
    echo "<pre>";
    print_r($hasil['data']);
    echo "</pre>";
} else {
    echo "<p style='color:red;'>Koneksi gagal!</p>";
    echo "<pre>";
    print_r($hasil['error']);
    echo "</pre>";
}
?>
