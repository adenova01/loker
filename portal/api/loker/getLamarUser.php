<?php
session_start();
include '../../lib/koneksi.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        $select = mysqli_query($conn, "SELECT * FROM pendaftaran as p JOIN lowongan as l ON p.lowongan_id = l.id JOIN provinsi as pr on pr.id = l.provinsi_id WHERE p.user_id='{$_GET['user_id']}'; ");
        $data = [];
        while($res=mysqli_fetch_assoc($select)){
            $data[] = $res;
        }
        echo json_encode($data);
    }
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'Error',
        'pesan'  => 'Error : '.$th->getMessage(),
        'code'   => 500
    ]);
}
