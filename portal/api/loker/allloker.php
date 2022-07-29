<?php

include '../../lib/koneksi.php';

$q = mysqli_query($conn, "SELECT lowongan.id as idloker, lowongan.judul, lowongan.kuota, lowongan.tipe, lowongan.mulai_pendaftaran, lowongan.akhir_pendaftaran, provinsi.nama FROM lowongan
                                                        JOIN provinsi ON lowongan.provinsi_id=provinsi.id");

try {
    $data = [];
    while($res=mysqli_fetch_assoc($q)){
        $datenow  = new \DateTime(date('Y-m-d'));
        $datestart  = new \DateTime($res['mulai_pendaftaran']);
        $dateend  = new \DateTime($res['akhir_pendaftaran']);

        if ($datestart == $datenow || $datestart >= $datenow || $dateend >= $datenow) {
            $data[] = $res;
        }
    }
    
    echo json_encode([
        'status' => 'sukses',
        'pesan'  => 'data tersedia',
        'data'   => $data
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        'status' => 'error',
        'pesan'  => 'Error : '.$th->getMessage()
    ]);
}
