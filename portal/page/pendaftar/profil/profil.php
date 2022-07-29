<?php 
    $tmp = 0;
    for ($a=2;$a<=7;$a++) {
        if ($pemberkasan[$a] !== null){
            $tmp += 1;
        }
    }
    $presentasi = round(($tmp*100/6), 2);
?>
<div class="panel panel-headline">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-5" style="background: #f8f8f8;">
                <div class="profile-header">
                    <div class="overlay"></div>
                    <div class="profile-main">
                        <img src="<?= $auth['image_url'] !== null ? 'file/gambar/'.$auth['image_url'] : 'assets/img/admin.png'  ?>" class="img-circle" width="100">
                        <h3 class="name"><?= $auth['nama_lengkap'] !== null ? $auth['nama_lengkap'] : $auth['email'] ?></h3>
                        <span class="online-status status-available">Aktif</span>
                    </div>
                </div>
                <div class="profile-detail">
                    <div class="profile-info">
                        <h4><i class="fa fa-user box-circle"></i> Informasi Dasar</h4>
                        <div class="row">
                        <div class="col-md-4">NIK</div>
                        <div class="col-md-8">: <?= $auth['nik'] !== null ? $auth['nik'] : '-' ?></div>
                        <div class="col-md-4">Nama</div>
                        <div class="col-md-8">: <?= $auth['nama_lengkap'] !== null ? $auth['nama_lengkap'] : '-' ?></div>
                        <div class="col-md-4">Tanggal Lahir</div>
                        <div class="col-md-8">: <?= date('d F Y', strtotime($auth['tgl_lahir'])) ?></div>
                        <div class="col-md-4">Alamat</div>
                        <div class="col-md-8">: <?= $auth['alamat'] ?></div>
                        <div class="col-md-4">Jenis Kelamin</div>
                        <div class="col-md-8">: <?= $auth['jenis_kelamin'] !== null ? $auth['jenis_kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan' : '-' ?></div>
                        <div class="col-md-4">Email</div>
                        <div class="col-md-8">: <?= $auth['email'] !== null ? $auth['email'] : '-' ?></div>
                        <div class="col-md-4">No Hp</div>
                        <div class="col-md-8">: <?= $auth['no_hp'] !== null ? $auth['no_hp'] : '-' ?></div>
                        <div class="col-md-4">Last Login</div>
                        <div class="col-md-8">: <?= $auth['login_terakhir'] !== null ? $auth['login_terakhir'] : '-' ?></div>
                        </div>
                    </div>
                    <div class="profile-info">
                        <h4><i class="fa fa-briefcase box-circle"></i> Pemberkasan</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?= $presentasi ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $presentasi ?>%">
                                <?= $presentasi > 0 ? $presentasi.' %' : '' ?>
                            </div>
                        </div>
                        <ul>
                            <li>KTP Upload <?= $pemberkasan[2] === null ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>' : '<span class="label label-success"><i class="fa fa-check"></i><span>' ?></li>
                            <li>Kartu Keluarga Upload <?= $pemberkasan[3] === null ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>' : '<span class="label label-success"><i class="fa fa-check"></i><span>' ?></li>
                            <li>Ijazah / SKL Upload <?= $pemberkasan[4] === null ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>' : '<span class="label label-success"><i class="fa fa-check"></i><span>' ?> </li>
                            <li>SKCK Upload <?= $pemberkasan[5] === null ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>' : '<span class="label label-success"><i class="fa fa-check"></i><span>' ?></li>
                            <li>Surat Keterangan Domisili Upload <?= $pemberkasan[6] === null ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>' : '<span class="label label-success"><i class="fa fa-check"></i><span>' ?></li>
                            <li>CV Upload <?= $pemberkasan[7] === null ? '<span class="label label-danger"><i class="fa fa-remove"></i><span>' : '<span class="label label-success"><i class="fa fa-check"></i><span>' ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
            <?php 
            
            if (isset($_POST['submit'])) {
                $id             = $_POST['id']; 
                $nik            = $_POST['nik']; 
                $nama           = $_POST['namalengkap'];
                $tgllahir       = date('Y-m-d', strtotime($_POST['tgllahir']));
                $alamat         = $_POST['alamat'];
                $jeniskelamin   = $_POST['jeniskelamin'];
                $email          = $_POST['email'];
                $nohp           = $_POST['nohp'];
                $password       = $_POST['password'];
                $nilai          = 0;

                //file upload 
                $imageurlnow         = $_POST['imageurlnow'];
                $imageurlupload      = $_FILES['imageurl']['name'];
                $loc_imageurl        = $_FILES['imageurl']['tmp_name'];
                $explodeimgurl       = explode('.',$imageurlupload);
                $extimgurl           = strtolower(end($explodeimgurl));
                if (!empty($imageurlupload)) {
                    $newimgfile = "'".$id."_image_upload.".$extimgurl."'";
                    $newimgfiles = $id."_image_upload.".$extimgurl;
                    if (!empty($imageurlnow)) {
                        unlink("file/gambar/$imageurlnow");
                        move_uploaded_file($loc_imageurl,"file/gambar/$newimgfiles");
                    } else {
                        move_uploaded_file($loc_imageurl,"file/gambar/$newimgfiles");
                    }
                } else {
                    !empty($imageurlnow) ? $newimgfile = "'".$imageurlnow."'" : $newimgfile = "NULL";   
                }

                $ktpfilenow         = $_POST['ktpfilenow'];
                $ktpfileupload      = $_FILES['ktpfile']['name'];
                $loc_ktpfile        = $_FILES['ktpfile']['tmp_name'];
                $explodektp         = explode('.',$ktpfileupload);
                $extktp             = strtolower(end($explodektp));
                if (!empty($ktpfileupload)) {
                    $newktpfile = "'".$id."_ktpfile_upload.".$extktp."'";
                    $newktpfiles = $id."_ktpfile_upload.".$extktp;
                    if (!empty($ktpfilenow)) {
                        unlink("file/pemberkasan/$ktpfilenow");
                        move_uploaded_file($loc_ktpfile,"file/pemberkasan/$newktpfiles");
                    } else {
                        move_uploaded_file($loc_ktpfile,"file/pemberkasan/$newktpfiles");
                    }
                } else {
                    !empty($ktpfilenow) ? $newktpfile = "'".$ktpfilenow."'" : $newktpfile = "NULL";   
                }

                $kkfilenow          = $_POST['kkfilenow'];
                $kkfileupload       = $_FILES['kkfile']['name'];
                $loc_kkfile         = $_FILES['kkfile']['tmp_name'];
                $explodekk          = explode('.',$kkfileupload);
                $extkk              = strtolower(end($explodekk));
                if (!empty($kkfileupload)) {
                    $newkkfile = "'".$id."_kkfile_upload.".$extkk."'";
                    $newkkfiles = $id."_kkfile_upload.".$extkk;
                    if (!empty($kkfilenow)) {
                        unlink("file/pemberkasan/$kkfilenow");
                        move_uploaded_file($loc_kkfile,"file/pemberkasan/$newkkfiles");
                    } else {
                        move_uploaded_file($loc_kkfile,"file/pemberkasan/$newkkfiles");
                    }
                } else {
                    !empty($kkfilenow) ? $newkkfile = "'".$kkfilenow."'" : $newkkfile = "NULL";   
                }

                $ijazahfilenow      = $_POST['ijazahfilenow'];
                $ijazahfileupload   = $_FILES['ijazahfile']['name'];
                $loc_ijazahfile     = $_FILES['ijazahfile']['tmp_name'];
                $explodeijazah      = explode('.',$ijazahfileupload);
                $extijazah          = strtolower(end($explodeijazah));
                if (!empty($ijazahfileupload)) {
                    $newijazahfile = "'".$id."_ijazahfile_upload.".$extijazah."'";
                    $newijazahfiles = $id."_ijazahfile_upload.".$extijazah;
                    if (!empty($ijazahfilenow)) {
                        unlink("file/pemberkasan/$ijazahfilenow");
                        move_uploaded_file($loc_ijazahfile,"file/pemberkasan/$newijazahfiles");
                    } else {
                        move_uploaded_file($loc_ijazahfile,"file/pemberkasan/$newijazahfiles");
                    }
                } else {
                    !empty($ijazahfilenow) ? $newijazahfile = "'".$ijazahfilenow."'" : $newijazahfile = "NULL";   
                }

                $skckfilenow        = $_POST['skckfilenow'];
                $skckfileupload     = $_FILES['skckfile']['name'];
                $loc_skckfile       = $_FILES['skckfile']['tmp_name'];
                $explodeskck        = explode('.',$skckfileupload);
                $extskck            = strtolower(end($explodeskck));
                if (!empty($skckfileupload)) {
                    $newskckfile = "'".$id."_skckfile_upload.".$extskck."'";
                    $newskckfiles = $id."_skckfile_upload.".$extskck;
                    if (!empty($skckfilenow)) {
                        unlink("file/pemberkasan/$skckfilenow");
                        move_uploaded_file($loc_skckfile,"file/pemberkasan/$newskckfiles");
                    } else {
                        move_uploaded_file($loc_skckfile,"file/pemberkasan/$newskckfiles");
                    }
                } else {
                    !empty($skckfilenow) ? $newskckfile = "'".$skckfilenow."'" : $newskckfile = "NULL";   
                }

                $sdfilenow          = $_POST['sdfilenow'];
                $sdfileupload       = $_FILES['sdfile']['name'];
                $loc_sdfile         = $_FILES['sdfile']['tmp_name'];
                $explodesd          = explode('.',$sdfileupload);
                $extsd              = strtolower(end($explodesd));
                if (!empty($sdfileupload)) {
                    $newsdfile = "'".$id."_sdfile_upload.".$extsd."'";
                    $newsdfiles = $id."_sdfile_upload.".$extsd;
                    if (!empty($sdfilenow)) {
                        unlink("file/pemberkasan/$sdfilenow");
                        move_uploaded_file($loc_sdfile,"file/pemberkasan/$newsdfiles");
                    } else {
                        move_uploaded_file($loc_sdfile,"file/pemberkasan/$newsdfiles");
                    }
                } else {
                    !empty($sdfilenow) ? $newsdfile = "'".$sdfilenow."'" : $newsdfile = "NULL";   
                }

                $cvfilenow          = $_POST['cvfilenow'];
                $cvfileupload       = $_FILES['cvfile']['name'];
                $loc_cvfile         = $_FILES['cvfile']['tmp_name'];
                $explodecv          = explode('.',$cvfileupload);
                $extcv              = strtolower(end($explodecv));
                if (!empty($cvfileupload)) {
                    $newcvfile = "'".$id."_cvfile_upload.".$extcv."'";
                    $newcvfiles = $id."_cvfile_upload.".$extcv;
                    if (!empty($cvfilenow)) {
                        unlink("file/pemberkasan/$cvfilenow");
                        move_uploaded_file($loc_cvfile,"file/pemberkasan/$newcvfiles");
                    } else {
                        move_uploaded_file($loc_cvfile,"file/pemberkasan/$newcvfiles");
                    }
                } else {
                    !empty($cvfilenow) ? $newcvfile = "'".$cvfilenow."'" : $newcvfile = "NULL";   
                }

                $newktpfile !== 'NULL' ? $nilai+=1 : $nilai=0;
                $newkkfile !== 'NULL' ? $nilai+=1 : $nilai;
                $newijazahfile !== 'NULL' ? $nilai+=1 : $nilai;
                $newskckfile !== 'NULL' ? $nilai+=1 : $nilai;
                $newsdfile !== 'NULL' ? $nilai+=1 : $nilai;
                $newcvfile !== 'NULL' ? $nilai+=1 : $nilai;

                if ($nilai == 6) {
                    $bobot = 100;
                } else if ($nilai == 5) {
                    $bobot = 75;
                } else if ($nilai == 4) {
                    $bobot = 50;
                } else if ($nilai <= 3) {
                    $bobot = 25;
                }

                $insert1 = mysqli_query($conn, "UPDATE user SET
                        nik             = '$nik',
                        nama_lengkap    = '$nama',
                        tgl_lahir       = '$tgllahir',
                        alamat          = '$alamat',
                        jenis_kelamin   = '$jeniskelamin',
                        email           = '$email',
                        no_hp           = '$nohp',
                        password        = '$password',
                        image_url       = $newimgfile
                        WHERE id        = '$id'") or die (mysqli_error($conn));

                $insert2 = mysqli_query($conn, "UPDATE pemberkasan SET
                        file_ktp_upload             = $newktpfile,
                        file_kk_upload              = $newkkfile,
                        file_ijazah_skl_upload      = $newijazahfile,
                        file_skck_upload            = $newskckfile,
                        file_surat_domisili_upload  = $newsdfile,
                        file_cv_upload              = $newcvfile,
                        pemberkasan_nilai           = $nilai,
                        pemberkasan_bobot           = $bobot
                        WHERE user_id               = '$id'") or die (mysqli_error($conn));
                
                if ($insert1 && $insert2) {
                    echo    '<div class="alert alert-success alert-dismissible" role="alert">'.
                                '<i class="fa fa-check-circle"></i> Data berhasil disimpan'.
                            '</div>';
                    echo "<meta http-equiv='refresh' content='1;
                    url=?page=profil'>";
                }
            }

            ?>
                <form action="?page=profil" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $auth['id'] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>NIK</label>
                                <input class="form-control" type="text" name="nik" placeholder="isikan nik anda ..." value="<?= $auth['nik'] ?>" maxlength="16" autocomplete="OFF">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Nama Lengkap</label>
                                <input class="form-control" type="text" name="namalengkap" placeholder="isikan nama lengkap anda ..." value="<?= $auth['nama_lengkap'] ?>" autocomplete="OFF">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Tanggal Lahir</label>
                                <input class="form-control" type="date" name="tgllahir" placeholder="isikan nama lengkap anda ..." value="<?= date('Y-m-d', strtotime($auth['tgl_lahir'])) ?>" autocomplete="OFF">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" name="alamat"><?= $auth['alamat'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Jenis Kelamin</label>
                                <select class="form-control" name="jeniskelamin">
                                    <option value="L" <?= $auth['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-Laki</option>
                                    <option value="P" <?= $auth['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="isikan alamat email anda ..." value="<?= $auth['email'] ?>" autocomplete="OFF">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>No HP</label>
                                <input class="form-control" type="text" name="nohp" placeholder="isikan no hp anda ..." value="<?= $auth['no_hp'] ?>" maxlength="12" autocomplete="OFF">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Password</label>
                                <input id="password-field" name="password" maxlength="10" type="password" class="form-control" value="<?= $auth['password'] ?>" autocomplete="OFF" >
                                <span toggle="#password-field" class="fa fa-eye-slash field-icon toggle-password"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Foto Profil</label>
                                <?= $auth['image_url'] !== null ? '<p>'.$auth['image_url'].' <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">foto profil belum ada <i class="fa fa-remove"></i></span>' ?>
                                <input type="hidden" name="imageurlnow" value="<?= $auth['image_url'] ?>">
                                <input class="form-control" type="file" name="imageurl">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Kartu Tanda Penduduk (KTP) Upload</label>
                                <?= $pemberkasan[2] !== null ? '<p><a target="_blank" href="file/pemberkasan/'.$pemberkasan[2].'">'.$pemberkasan[2].'</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">ktp belum ada <i class="fa fa-remove"></i></span>' ?>
                                <input type="hidden" name="ktpfilenow" value="<?= $pemberkasan[2] ?>">
                                <input class="form-control" type="file" name="ktpfile">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Kartu Keluarga Upload</label>
                                <?= $pemberkasan[3] !== null ? '<p><a target="_blank" href="file/pemberkasan/'.$pemberkasan[3].'">'.$pemberkasan[3].'</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">kartu keluarga belum ada <i class="fa fa-remove"></i></span>' ?>
                                <input type="hidden" name="kkfilenow" value="<?= $pemberkasan[3] ?>">
                                <input class="form-control" type="file" name="kkfile">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Ijazah / Surat Keterangan Lulus (SKL) Upload</label>
                                <?= $pemberkasan[4] !== null ? '<p><a target="_blank" href="file/pemberkasan/'.$pemberkasan[4].'">'.$pemberkasan[4].'</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">ijazah / skl belum ada <i class="fa fa-remove"></i></span>' ?>
                                <input type="hidden" name="ijazahfilenow" value="<?= $pemberkasan[4] ?>">
                                <input class="form-control" type="file" name="ijazahfile">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Surat Keterangan Catatan Kepolisian (SKCK) Upload</label>
                                <?= $pemberkasan[5] !== null ? '<p><a target="_blank" href="file/pemberkasan/'.$pemberkasan[5].'">'.$pemberkasan[5].'</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">skck belum ada <i class="fa fa-remove"></i></span>' ?>
                                <input type="hidden" name="skckfilenow" value="<?= $pemberkasan[5] ?>">
                                <input class="form-control" type="file" name="skckfile">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Surat Keterangan Domisili Upload</label>
                                <?= $pemberkasan[6] !== null ? '<p><a target="_blank" href="file/pemberkasan/'.$pemberkasan[6].'">'.$pemberkasan[6].'</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">surat keterangan domisili belum ada <i class="fa fa-remove"></i></span>' ?>
                                <input type="hidden" name="sdfilenow" value="<?= $pemberkasan[6] ?>">
                                <input class="form-control" type="file" name="sdfile">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Curriculum Vitae (CV) Upload</label>
                                <?= $pemberkasan[7] !== null ? '<p><a target="_blank" href="file/pemberkasan/'.$pemberkasan[7].'">'.$pemberkasan[7].'</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">CV belum ada <i class="fa fa-remove"></i></span>' ?>
                                <input type="hidden" name="cvfilenow" value="<?= $pemberkasan[7] ?>">
                                <input class="form-control" type="file" name="cvfile">
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>