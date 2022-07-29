<?php 
    $q = mysqli_query($conn, "SELECT wawancara.id as id_wawancara, wawancara.pendaftaran_id as id_daftar, user.id as id_user, user.nama_lengkap as nama_user, wawancara.wawancara_nilai as nilai, wawancara.wawancara_bobot as bobot FROM wawancara
                            JOIN pendaftaran ON wawancara.pendaftaran_id=pendaftaran.id
                            JOIN user ON pendaftaran.user_id=user.id
                            WHERE wawancara.id='$_GET[id]'") or die (mysqli_error($conn));
    $data = mysqli_fetch_array($q);
?>
<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Edit Nilai Wawancara</h3>
                    <p class="panel-subtitle"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form action="?page=wawancaraeditpro" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>ID Wawancara</label></br>
                                <span class="label label-success"><?= $data['id_wawancara'] ?></span>
                                <input type="hidden" name="id" value="<?= $data['id_wawancara'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>ID Daftar</label></br>
                                <span class="label label-success"><?= $data['id_daftar'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>ID Daftar</label></br>
                                <span class="label label-success"><?= $data['id_user'] ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Nama User</label>
                                <p><?= $data['nama_user'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div clas="form-group">
                                <label>Nilai</label>
                                <input class="form-control" name="nilai" placeholder="masukkan nilai ..." value="<?= $data['nilai'] ?>" autocomplete="OFF" />
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <input type="submit" name="submit" class="btn btn-primary" value="simpan">
        <a href="?page=wawancara" class="btn btn-default">kembali</a>
    </div>
    </form>
</div>