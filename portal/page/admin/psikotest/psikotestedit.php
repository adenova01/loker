<?php 
    $q = mysqli_query($conn, "SELECT psikotest.id as id_psikotest, psikotest.pendaftaran_id as id_daftar, user.id as id_user, user.nama_lengkap as nama_user, psikotest.psikotest_nilai as nilai, psikotest.psikotest_bobot as bobot FROM psikotest
                            JOIN pendaftaran ON psikotest.pendaftaran_id=pendaftaran.id
                            JOIN user ON pendaftaran.user_id=user.id
                            WHERE psikotest.id='$_GET[id]'") or die (mysqli_error($conn));
    $data = mysqli_fetch_array($q);
?>
<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Edit Nilai Psikotest</h3>
                    <p class="panel-subtitle"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form action="?page=psikotesteditpro" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>ID Psikotest</label></br>
                                <span class="label label-success"><?= $data['id_psikotest'] ?></span>
                                <input type="hidden" name="id" value="<?= $data['id_psikotest'] ?>">
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
        <a href="?page=psikotest" class="btn btn-default">kembali</a>
    </div>
    </form>
</div>