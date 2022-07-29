<?php

include "../../lib/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $query_cek = mysqli_query($conn, "SELECT * FROM user WHERE id='$id'");
    $data = mysqli_fetch_object($query_cek);
    
    echo json_encode([
        'status' => 'sukses',
        'pesan'  => 'Data Ada',
        'code'   => 200,
        'data'   => $data
    ]);

} else {
    echo json_encode([
        'status' => 'gagal',
        'pesan'  => 'Method tidak di ijinkan',
        'code'   => 403
    ]);
}