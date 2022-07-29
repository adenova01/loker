<?php
session_start();
$_SESSION['role'] = 2;
$_SESSION['email'] = $_POST['email'];
include '../../lib/koneksi.php';
include '../../service.php';
date_default_timezone_set("Asia/Jakarta");
try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id']; //loker id
        $userid = $_POST['user_id'];
        $dateNow = date('Y-m-d');
        $idPendaftaran = getIdPendaftaran();
        $idKesehatan = getIdKesehatan();
        $idWawancara = getIdWawancara();
        $idPsikotest = getIdPsikotest();
        $update1 = mysqli_query($conn, "INSERT INTO pendaftaran SET id='$idPendaftaran', lowongan_id='$id', user_id='$userid', tgl_daftar='$dateNow', pendaftaran_status='proses'");
        $update2 = mysqli_query($conn, "INSERT INTO kesehatan SET id='$idKesehatan', pendaftaran_id='$idPendaftaran'");
        $update3 = mysqli_query($conn, "INSERT INTO wawancara SET id='$idWawancara', pendaftaran_id='$idPendaftaran'");
        $update4 = mysqli_query($conn, "INSERT INTO psikotest SET id='$idPsikotest', pendaftaran_id='$idPendaftaran'");
        
        if ($update1 && $update2 && $update3 && $update4) {
            echo json_encode([
                'status' => 'sukses',
                'pesan'  => 'Data berhasil di tambahkan',
                'code'   => 200
            ]);
        }
    }
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'Error',
        'pesan'  => 'Error : '.$th->getMessage(),
        'code'   => 500
    ]);
}
