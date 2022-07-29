<?php 
    $g = mysqli_query($conn, "SELECT * FROM user
                            JOIN pemberkasan ON user.id=pemberkasan.user_id
                            WHERE user.id='$_GET[id]'");
    $data = mysqli_fetch_array($g);
?>
<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Detail User Pendaftar</h3>
                    <p class="panel-subtitle"></p>
                </div>
                <div class="pull-right">
                    <a href="?page=user" class="btn btn-success"><i class="fa fa-chevron-circle-left"></i> kembali</a>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <img src="<?= $data['image_url'] !== null ? 'file/gambar/'.$data['image_url'] : 'assets/img/admin.png'  ?>" class="img-circle" width="200">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <label>Nama Lengkap</label>
                            <p><?= $data['nama_lengkap'] !== null ? $data['nama_lengkap'] : '-' ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <label>Tanggal Lahir</label>
                            <p><?= $data['tgl_lahir'] !== null ? date('d F Y', strtotime($data['tgl_lahir'])) : '-' ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <label>Alamat</label>
                            <p><?= $data['alamat'] !== null ? $data['alamat'] : '-' ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <label>Jenis Kelamin</label>
                            <p><?= $data['jenis_kelamin'] !== null ? $data['jenis_kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan' : '-' ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <label>Email</label>
                            <p><?= $data['email'] !== null ? $data['email'] : '-' ?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <label>No Hp</label>
                            <p><?= $data['no_hp'] !== null ? $data['no_hp'] : '-' ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <label>File KTP Upload</label>
                            <?= $data[13] !== null ? '<p><a target="_blank" href="file/pemberkasan/'.$data[13].'">'.$data[13].'</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">ktp belum ada <i class="fa fa-remove"></i></span>' ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <label>File Kartu Keluarga Upload</label>
                            <?= $data[14] !== null ? '<p><a target="_blank" href="file/pemberkasan/'.$data[14].'">'.$data[14].'</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">kartu keluarga belum ada <i class="fa fa-remove"></i></span>' ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <label>File Ijazah / SKL Upload</label>
                            <?= $data[15] !== null ? '<p><a target="_blank" href="file/pemberkasan/'.$data[15].'">'.$data[15].'</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">ijazah / skl belum ada <i class="fa fa-remove"></i></span>' ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <label>File SKCK Upload</label>
                            <?= $data[16] !== null ? '<p><a target="_blank" href="file/pemberkasan/'.$data[16].'">'.$data[16].'</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">skck belum ada <i class="fa fa-remove"></i></span>' ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <label>File Surat Domisili Upload</label>
                            <?= $data[17] !== null ? '<p><a target="_blank" href="file/pemberkasan/'.$data[17].'">'.$data[17].'</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">surat domisili belum ada <i class="fa fa-remove"></i></span>' ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div clas="form-group">
                            <label>File CV Upload</label>
                            <?= $data[18] !== null ? '<p><a target="_blank" href="file/pemberkasan/'.$data[18].'">'.$data[18].'</a> <i class="fa fa-check"></i></p>' : '<br /><span class="label label-danger">cv belum ada <i class="fa fa-remove"></i></span>' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>