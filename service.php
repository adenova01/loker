<?php 

function getDateNow() {
    $tz_object = new DateTimeZone('Asia/Jakarta');
    $datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    return $datetime->format('m/d/Y');
}

function getActiveJob($tglstart, $tglend) {
    $val = "";
    $datenow  = new DateTime(getDateNow());
    $datestart  = new DateTime($tglstart);
    $dateend  = new DateTime($tglend);
    $diff   = $datestart->diff($datenow);
    
    if ($datestart > $datenow && $dateend >= $datenow) {
        if ($diff->d <= 10) {
            $val = '<a href="#" class="btn btn-default btn-block">'.$diff->d.' hari lagi pendaftaran Dibuka</a>';
        } else {
            $val = '<a href="#" class="btn btn-default btn-block">Segera Dibuka</a>';
        }
    }

    if ($datestart <= $datenow && $dateend >= $datenow) {
        $val = '<a href="portal/login.php" class="btn btn-primary btn-block">Pilih <i class="fas fa-check-circle"></i></a>';
    }

    return $val;
}

?>