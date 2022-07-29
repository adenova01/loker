<?php

if ($_SESSION['role'] == 2) {
    $getdatauser = mysqli_query($conn, "SELECT * FROM user WHERE email='$_SESSION[email]'");
    $auth = mysqli_fetch_array($getdatauser);
    $getdataberkas = mysqli_query($conn, "SELECT * FROM pemberkasan WHERE user_id='$auth[id]'");
    $pemberkasan = mysqli_fetch_array($getdataberkas);
} else {
    $getdatauser = mysqli_query($conn, "SELECT * FROM admin WHERE email='$_SESSION[email]'");
    $auth = mysqli_fetch_array($getdatauser);
}

function getDateNow() {
    $tz_object = new DateTimeZone('Asia/Jakarta');
    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    return $datetime->format('m/d/Y');
}

function getActiveJob($tglstart, $tglend, $id, $userid) {
    $val = "";
    include 'lib/koneksi.php';
    $datenow  = new DateTime(getDateNow());
    $datestart  = new DateTime($tglstart);
    $dateend  = new DateTime($tglend);
    $diff   = $datestart->diff($datenow);

    $q = mysqli_query($conn, "SELECT * FROM pendaftaran WHERE lowongan_id='$id' AND user_id='$userid'");
    $count = mysqli_num_rows($q);
    
    if ($count < 1) {
        if ($datestart > $datenow && $dateend >= $datenow) {
            if ($diff->d <= 10) {
                $val = '<span class="label label-info">'.$diff->d.' hari lagi pendaftaran Dibuka</span>';
            } else {
                $val = '<span class="label label-info">Segera Dibuka</span>';
            }
        }
    
        if ($datestart <= $datenow && $dateend >= $datenow) {
            $val = '<a href="?page=lokeradd&id='.$id.'" class="btn btn-primary btn-xs btn-block"><i class="fa fa-check-circle"></i> Pilih</a>';
        }
    } else {
        $val = '<span class="label label-success">Sedang Aktif <i class="fa fa-check"></i></span>';
    }

    return $val;
}

function getIdPendaftaran(){
    include "lib/koneksi.php";
    $get_id = mysqli_query($conn, "SELECT id FROM pendaftaran WHERE SUBSTRING(id,1,6)='DAFTAR'") or die (mysqli_error($conn));
    $trim_id = mysqli_query($conn, "SELECT SUBSTRING(id,-5,5) as hasil FROM pendaftaran WHERE SUBSTRING(id,1,6)='DAFTAR' ORDER BY hasil DESC LIMIT 1") or die (mysqli_error($conn));
    $hit    = mysqli_num_rows($get_id);
    if ($hit == 0){
        $id_k   = "DAFTAR00001";
    } else if ($hit > 0){
        $row    = mysqli_fetch_array($trim_id);
        $kode   = $row['hasil']+1;
        $id_k   = "DAFTAR".str_pad($kode,5,"0",STR_PAD_LEFT); 
    }
    return $id_k;
}

function getIdPsikotest(){
    include "lib/koneksi.php";
    $get_id = mysqli_query($conn, "SELECT id FROM psikotest WHERE SUBSTRING(id,1,5)='PSIKO'") or die (mysqli_error($conn));
    $trim_id = mysqli_query($conn, "SELECT SUBSTRING(id,-5,5) as hasil FROM psikotest WHERE SUBSTRING(id,1,5)='PSIKO' ORDER BY hasil DESC LIMIT 1") or die (mysqli_error($conn));
    $hit    = mysqli_num_rows($get_id);
    if ($hit == 0){
        $id_k   = "PSIKO00001";
    } else if ($hit > 0){
        $row    = mysqli_fetch_array($trim_id);
        $kode   = $row['hasil']+1;
        $id_k   = "PSIKO".str_pad($kode,5,"0",STR_PAD_LEFT); 
    }
    return $id_k;
}

function getIdKesehatan(){
    include "lib/koneksi.php";
    $get_id = mysqli_query($conn, "SELECT id FROM kesehatan WHERE SUBSTRING(id,1,5)='SEHAT'") or die (mysqli_error($conn));
    $trim_id = mysqli_query($conn, "SELECT SUBSTRING(id,-5,5) as hasil FROM kesehatan WHERE SUBSTRING(id,1,5)='SEHAT' ORDER BY hasil DESC LIMIT 1") or die (mysqli_error($conn));
    $hit    = mysqli_num_rows($get_id);
    if ($hit == 0){
        $id_k   = "SEHAT00001";
    } else if ($hit > 0){
        $row    = mysqli_fetch_array($trim_id);
        $kode   = $row['hasil']+1;
        $id_k   = "SEHAT".str_pad($kode,5,"0",STR_PAD_LEFT); 
    }
    return $id_k;
}

function getIdWawancara(){
    include "lib/koneksi.php";
    $get_id = mysqli_query($conn, "SELECT id FROM wawancara WHERE SUBSTRING(id,1,9)='WAWANCARA'") or die (mysqli_error($conn));
    $trim_id = mysqli_query($conn, "SELECT SUBSTRING(id,-5,5) as hasil FROM wawancara WHERE SUBSTRING(id,1,9)='WAWANCARA' ORDER BY hasil DESC LIMIT 1") or die (mysqli_error($conn));
    $hit    = mysqli_num_rows($get_id);
    if ($hit == 0){
        $id_k   = "WAWANCARA00001";
    } else if ($hit > 0){
        $row    = mysqli_fetch_array($trim_id);
        $kode   = $row['hasil']+1;
        $id_k   = "WAWANCARA".str_pad($kode,5,"0",STR_PAD_LEFT); 
    }
    return $id_k;
}

function getNilaiBobot($params) {
    $tmp = 0;
    if (!empty($params)) {
        $tmp = $params;
    } else {
        $tmp = '<span class="label label-danger">belum ada</span>';
    }
    return $tmp;
}

function getNilaiBobotKesehatan($params) {
    if ($params !== null) {
        $tmp = $params.' penyakit';
    } else {
        $tmp = '<span class="label label-danger">belum ada</span>';
    }
    return $tmp;
}

function getNilaiBerkas($params) {
    if ($params !== null) {
        $tmp = $params.' berkas';
    } else {
        $tmp = '<span class="label label-danger">belum ada</span>';
    }
    return $tmp;
}

function getPendaftaran($params) {
    if (!empty($params)) {
        include './lib/koneksi.php';
        $d = mysqli_query($conn, "SELECT pendaftaran.id as id_daftar, lowongan.judul as lowongan_judul FROM pendaftaran
                                JOIN lowongan ON pendaftaran.lowongan_id=lowongan.id
                                WHERE pendaftaran.id='$params'");
        $data = mysqli_fetch_array($d);
        foreach ($d as $data) {
            return '<h4>'.$data['lowongan_id'].'</h4><p>'.$data['lowongan_judul'].'</p>';
        }
        
    }
}

function getStatus($params) {
    if (!empty($params)) {
        $tmp = '';
        if ($params == 100) {
            $tmp = '<span class="label label-success">sangat baik</span>';
        } else if ($params == 75) {
            $tmp = '<span class="label label-info">baik</span>';
        } else if ($params == 50) {
            $tmp = '<span class="label label-warning">cukup</span>';
        } else if ($params == 25) {
            $tmp = '<span class="label label-danger">kurang baik</span>';
        }
        return $tmp;
    } else {
        return '<span class="label label-danger">belum ada</span>';
    }
}

function getStatusKesehatan($params) {
    if (!empty($params)) {
        $tmp = '';
        if ($params == 25) {
            $tmp = '<span class="label label-success">sangat baik</span>';
        } else if ($params == 50) {
            $tmp = '<span class="label label-info">baik</span>';
        } else if ($params == 75) {
            $tmp = '<span class="label label-warning">cukup</span>';
        } else if ($params >= 100) {
            $tmp = '<span class="label label-danger">kurang baik</span>';
        }
        return $tmp;
    } else {
        return '<span class="label label-danger">belum ada</span>';
    }
}

function getCountAll($params){
    include './lib/koneksi.php';
    $num = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ".$params.""));
    return $num;
}

function getCountAllById($params1,$params2){
    include './lib/koneksi.php';
    $num = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM ".$params1." WHERE user_id='$params2'"));
    return $num;
}

function stepRecruitment($params) {
    $tmp = '';
    include './lib/koneksi.php';
    $step1 = mysqli_query($conn, "SELECT * FROM psikotest WHERE pendaftaran_id='$params'");
    $data1 = mysqli_fetch_array($step1);
    if ($data1['psikotest_nilai'] !== null) {
        $tmp = '<button class="btn btn-success btn-block">Psikotest <i class="fa fa-check"></i></button>';
    } else {
        $tmp = '<button class="btn btn-primary btn-block" disabled>Psikotest <i class="fa fa-spinner fa-spin"></i></button>';
    }

    $step2 = mysqli_query($conn, "SELECT * FROM wawancara WHERE pendaftaran_id='$params'");
    $data2 = mysqli_fetch_array($step2);
    if ($data2['wawancara_nilai'] !== null) {
        $tmp .= '<button class="btn btn-success btn-block">Wawancara <i class="fa fa-check"></i></button>';
    } else {
        $tmp .= '<button class="btn btn-primary btn-block" disabled>Wawancara <i class="fa fa-spinner fa-spin"></i></button>';
    }

    $step3 = mysqli_query($conn, "SELECT * FROM kesehatan WHERE pendaftaran_id='$params'");
    $data3 = mysqli_fetch_array($step3);
    if ($data3['kesehatan_nilai'] !== null) {
        $tmp .= '<button class="btn btn-success btn-block">Kesehatan <i class="fa fa-check"></i></button>';
    } else {
        $tmp .= '<button class="btn btn-primary btn-block" disabled>Kesehatan <i class="fa fa-spinner fa-spin"></i></button>';
    }

    return $tmp;
} 

function statusPendaftaran($params) {
    $tmp = '';
    if ($params == 'proses') {
        $tmp = '<span class="label label-info">Proses</span>';
    } else if ($params == 'lulus') {
        $tmp = '<span class="label label-success">Lulus</span>';
    } else {
        $tmp = '<span class="label label-danger">Gagal</span>';
    }
    return $tmp;
}

function insertRanking($params1, $params2) {
    include './lib/koneksi.php';
    $q = mysqli_query($conn, "SELECT * FROM ranking WHERE pendaftaran_id='$params1'");
    $hit = mysqli_num_rows($q);
    if ($hit > 0) {
        mysqli_query($conn, "UPDATE ranking SET ranking_nilai=$params2 WHERE pendaftaran_id='$params1'");
    } else {
        mysqli_query($conn, "INSERT INTO ranking SET pendaftaran_id='$params1', ranking_nilai=$params2");
    }
}

function updateRegister($params1, $params2) {
    include './lib/koneksi.php';
    mysqli_query($conn, "UPDATE pendaftaran SET pendaftaran_status='$params2' WHERE id='$params1'");
}

?>