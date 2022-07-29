<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Tambah Lowongan Pekerjaan</h3>
                    <p class="panel-subtitle"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <?php 
                    if (isset($_POST['submit'])){
                        $id         = $_POST['id'];
                        $judul      = $_POST['judul'];
                        $deskripsi  = $_POST['deskripsi'];
                        $kuota      = $_POST['kuota'];
                        $lokasi     = $_POST['lokasi'];
                        $tipe       = $_POST['tipe'];
                        $tglmulai   = date('Y-m-d', strtotime($_POST['tglmulaidaftar']));
                        $tglselesai = date('Y-m-d', strtotime($_POST['tglakhirdaftar']));

                        $insert = mysqli_query($conn, "INSERT INTO lowongan SET
                                id                  = '$id',
                                provinsi_id         = '$lokasi',
                                judul               = '$judul',
                                deskripsi           = '$deskripsi',
                                kuota               = $kuota,
                                tipe                = '$tipe',
                                mulai_pendaftaran   = '$tglmulai',
                                akhir_pendaftaran   = '$tglselesai'") or die (mysqli_error($conn));
                        
                        if ($insert){
                            echo    '<div class="alert alert-success alert-dismissible" role="alert">'.
							            '<i class="fa fa-check-circle"></i> Data berhasil disimpan'.
                                    '</div>';
                            echo "<meta http-equiv='refresh' content='1;
                            url=?page=loker'>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>