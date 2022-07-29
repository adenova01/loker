<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Pilih Lowongan Pekerjaan</h3>
                    <p class="panel-subtitle"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
					Apakah anda yakin ingin untuk memilih lowongan pekerjaan ini ?
                    <form action="?page=lokeradd" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                        <input type="hidden" name="user_id" value="<?= $auth['id'] ?>">
                        <input type="submit" name="submit" class="btn btn-danger" value="Ya">
                        <a href="?page=loker" class="btn btn-primary">Tidak</a>
                    </form>
                </div>
                <?php 
                if (isset($_POST['submit'])){
                    $id = $_POST['id'];
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
                        echo    '<div class="alert alert-success" role="alert">'.
                                    '<i class="fa fa-check-circle"></i> Pendaftaran Lowongan Pekerjaan berhasil'.
                                '</div>';
                        echo "<meta http-equiv='refresh' content='1;
                        url=?page=lokeractive'>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>