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
                <?php 
                    if (isset($_POST['submit'])){
                        $id         = $_POST['id'];
                        $nilai      = $_POST['nilai'];

                        if ($nilai >= 95) {
                            $bobot = 100;
                        } else if ($nilai >= 90 && $nilai < 95) {
                            $bobot = 75;
                        } else if ($nilai >= 75 && $nilai < 90) {
                            $bobot = 50;
                        } else if ($nilai < 75) {
                            $bobot = 25;
                        }

                        $insert = mysqli_query($conn, "UPDATE wawancara SET
                                wawancara_nilai = $nilai,
                                wawancara_bobot = $bobot
                                WHERE id        = '$id'") or die (mysqli_error($conn));
                        
                        if ($insert){
                            echo    '<div class="alert alert-success alert-dismissible" role="alert">'.
							            '<i class="fa fa-check-circle"></i> Data berhasil diedit'.
                                    '</div>';
                            echo "<meta http-equiv='refresh' content='1;
                            url=?page=wawancara'>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>