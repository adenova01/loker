<?php

include "../../lib/koneksi.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id             = $_POST['id'];
    $nik            = $_POST['nik']; 
    $nama           = $_POST['namalengkap'];
    $tgllahir       = date('Y-m-d', strtotime($_POST['tgllahir']));
    $alamat         = $_POST['alamat'];
    $jeniskelamin   = $_POST['jeniskelamin'];
    $nilai          = 0;

    //file upload 
    // $imageurlnow    = $_POST['imageurlnow'];
    $newimgfile = '';

    if($_FILES){
        $imageurlupload = $_FILES['imageurl']['name'];
        $loc_imageurl   = $_FILES['imageurl']['tmp_name'];
        $explodeimgurl  = explode('.',$imageurlupload);
        $extimgurl      = strtolower(end($explodeimgurl));
        if (!empty($imageurlupload)) {
            $newimgfile = "'".$id."_image_upload.".$extimgurl."'";
            $newimgfiles = $id."_image_upload.".$extimgurl;
            if (!empty($imageurlnow)) {
                unlink("file/gambar/$imageurlnow");
                move_uploaded_file($loc_imageurl,"file/gambar/$newimgfiles");
            } else {
                $path = "/file/gambar/$newimgfiles";
                move_uploaded_file($loc_imageurl, $path);
            }
        } else {
            !empty($imageurlnow) ? $newimgfile = "'".$imageurlnow."'" : $newimgfile = "NULL";   
        }
    }

    $query = "UPDATE user SET
    nik             = '$nik',
    nama_lengkap    = '$nama',
    tgl_lahir       = '$tgllahir',
    alamat          = '$alamat',
    jenis_kelamin   = '$jeniskelamin',
    image_url       = ".($newimgfile != '' ? $newimgfile : 'NULL' )." 
    WHERE id        = '$id'";

    $insert1 = mysqli_query($conn, $query) or die (mysqli_error($conn));
    
    echo json_encode([
        'status' => 'sukses',
        'pesan'  => 'Data Berhasil di simpan',
        'code'   => 200
    ]);

} else {
    echo json_encode([
        'status' => 'gagal',
        'pesan'  => 'Method tidak di ijinkan',
        'code'   => 403
    ]);
}
