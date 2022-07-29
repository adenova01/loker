<?php

include "../../lib/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $e = $_POST['email'];
    $p = $_POST['password'];

    $ceklogin1 = mysqli_query($conn, "SELECT * FROM user WHERE email='$e' AND password='$p'");
    $data1 = mysqli_fetch_array($ceklogin1);
    $hit1 = mysqli_num_rows($ceklogin1);

    if ($hit1 > 0) {
        $now = date('Y-m-d h:i:s');
        mysqli_query($conn, "UPDATE user SET login_terakhir = '$now' WHERE id='$data1[id]'");
        echo json_encode([
            'status' => 'sukses',
            'pesan'  => 'Login Sukses',
            'code'   => 200,
            'data'   => [
                'id' => $data1[0],
                'email' => $data1[6]
            ]
        ]);
    } else {
        echo json_encode([
            'status' => 'gagal',
            'pesan'  => 'Login Gagal',
            'code'   => 403
        ]);
    }

} else {
    echo json_encode([
        'status' => 'gagal',
        'pesan'  => 'Method tidak di ijinkan',
        'code'   => 403
    ]);
}