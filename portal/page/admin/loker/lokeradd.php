<?php 
    $get_id = mysqli_query($conn, "SELECT id FROM lowongan WHERE SUBSTRING(id,1,5)='LOKER'") or die (mysqli_error($conn));
    $trim_id = mysqli_query($conn, "SELECT SUBSTRING(id,-5,5) as hasil FROM lowongan WHERE SUBSTRING(id,1,5)='LOKER' ORDER BY hasil DESC LIMIT 1") or die (mysqli_error($conn));
    $hit    = mysqli_num_rows($get_id);
    if ($hit == 0){
        $id_k   = "LOKER00001";
    } else if ($hit > 0){
        $row    = mysqli_fetch_array($trim_id);
        $kode   = $row['hasil']+1;
        $id_k   = "LOKER".str_pad($kode,5,"0",STR_PAD_LEFT); 
    }    
?>
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
                <form action="?page=lokeraddpro" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <a class="btn btn-success"><i class="fa fa-briefcase"></i> <?= $id_k ?></a>
                                <input type="hidden" name="id" value="<?= $id_k ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Judul</label>
                                <textarea class="form-control" name="judul" placeholder="masukkan judul lowongan pekerjaan" autocomplete="OFF" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" placeholder="masukkan deksripsi lowongan pekerjaan" autocomplete="OFF"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Kuota</label>
                                <input type="number" class="form-control" name="kuota" placeholder="masukkan kuota lowongan pekerjaan" autocomplete="OFF" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Provinsi Pendaftaran</label>
                                <select class="form-control" name="lokasi">
                                <?php 
                                    $prov = mysqli_query($conn, "SELECT * FROM provinsi");
                                    while($value = mysqli_fetch_array($prov)) { 
                                        echo '<option value="'.$value['id'].'">'.$value['nama'].'</option>';
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Tipe</label>
                                <select class="form-control" name="tipe">
                                    <option value="fulltime">Fulltime</option>
                                    <option value="fulltime">Kontrak</option>
                                    <option value="fulltime">Magang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Tanggal Mulai Pendaftaran</label>
                                <input type="date" class="form-control" name="tglmulaidaftar" autocomplete="OFF" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Tanggal Akhir Pendaftaran</label>
                                <input type="date" class="form-control" name="tglakhirdaftar" autocomplete="OFF" required>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <input type="submit" name="submit" class="btn btn-primary" value="simpan">
        <a href="?page=loker" class="btn btn-default">kembali</a>
    </div>
    </form>
</div>