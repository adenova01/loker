<?php 
    $q = mysqli_query($conn, "SELECT kesehatan.id as id_kesehatan, kesehatan.pendaftaran_id as id_daftar, user.id as id_user, user.nama_lengkap as nama_user, kesehatan.kesehatan_nilai as nilai, kesehatan.kesehatan_bobot as bobot FROM kesehatan
                            JOIN pendaftaran ON kesehatan.pendaftaran_id=pendaftaran.id
                            JOIN user ON pendaftaran.user_id=user.id
                            WHERE kesehatan.id='$_GET[id]'") or die (mysqli_error($conn));
    $data = mysqli_fetch_array($q);
?>
<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Edit Nilai kesehatan</h3>
                    <p class="panel-subtitle"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form action="?page=kesehataneditpro" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>ID Kesehatan</label></br>
                                <span class="label label-success"><?= $data['id_kesehatan'] ?></span>
                                <input type="hidden" name="id" value="<?= $data['id_kesehatan'] ?>">
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
                                <label>Penyakit</label>
                                <input class="form-control" name="nilai" placeholder="masukkan nilai ..." value="<?= $data['nilai'] ?>" autocomplete="OFF" />
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <input type="submit" name="submit" class="btn btn-primary" value="simpan">
        <a href="?page=kesehatan" class="btn btn-default">kembali</a>
    </div>
    </form>
</div>