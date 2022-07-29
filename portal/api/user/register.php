<?php

include '../../lib/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "lib/koneksi.php";

    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $password = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM user WHERE email='$email'");
    $hit = mysqli_num_rows($cek);

    if ($hit > 0) {
        echo json_encode([
            'status' => 'gagal',
            'pesan'  => 'Email sudah pernah terdaftar',
            'code'   => 403
        ]);
    } else {
        $get_id = mysqli_query($conn, "SELECT id FROM user WHERE SUBSTRING(id,1,4)='USER'") or die(mysqli_error($conn));
        $trim_id = mysqli_query($conn, "SELECT SUBSTRING(id,-6,6) as hasil FROM user WHERE SUBSTRING(id,1,4)='USER' ORDER BY hasil DESC LIMIT 1") or die(mysqli_error($conn));
        $hit    = mysqli_num_rows($get_id);
        if ($hit == 0) {
            $id_k   = "USER000001";
        } else if ($hit > 0) {
            $row    = mysqli_fetch_array($trim_id);
            $kode   = $row['hasil'] + 1;
            $id_k   = "USER" . str_pad($kode, 6, "0", STR_PAD_LEFT);
        }

        $insert1 = mysqli_query($conn, "INSERT INTO user SET id='$id_k', email='$email', no_hp='$nohp', password='$password'") or die(mysqli_error($conn));
        $insert2 = mysqli_query($conn, "INSERT INTO pemberkasan SET user_id='$id_k', pemberkasan_nilai=0, pemberkasan_bobot=25") or die(mysqli_error($conn));

        if ($insert1 && $insert2) {
            echo json_encode([
                'status' => 'sukses',
                'pesan'  => 'Register berhasil di lakukan',
                'code'   => 200
            ]);
        }
    }
} else {
    echo json_encode([
        'status' => 'gagal',
        'pesan'  => 'Method tidak di ijinkan',
        'code'   => 403
    ]);
}