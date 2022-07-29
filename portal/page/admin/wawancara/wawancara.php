<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Data Nilai Wawancara</h3>
                    <p class="panel-subtitle"></p>
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <form action="?page=wawancara" method="post" enctype="multipart/form-data">
                <div class="col-md-8">
                    <select class="form-control" name="pendaftaran">
                    <option style="display:none;">-- pilih salah satu pendaftaran --</option>
                        <?php 
                            $q = mysqli_query($conn, "SELECT * from pendaftaran
                                                    JOIN lowongan ON pendaftaran.lowongan_id=lowongan.id
                                                    GROUP BY pendaftaran.lowongan_id");
                            while($datas = mysqli_fetch_array($q)){
                                echo '<option value='.$datas[1].'>('.$datas[1].') '.$datas['judul'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="submit" name="submit" class="btn btn-primary" value="proses">
                </div>
            </form>
            <div class="col-md-12">
                <div class="table-responsive">
                    <?php 
                    if (isset($_POST['submit'])) {
                        $pendaftaran = $_POST['pendaftaran'];
                        echo getPendaftaran($pendaftaran);
                    ?>
                    <table class="table table-bordered example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>ID Daftar</th>
                                <th>ID User</th>
                                <th>Nama User</th>
                                <th>Nilai</th>
                                <th>Bobot</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $q = mysqli_query($conn, "SELECT wawancara.id as id_wawancara, wawancara.pendaftaran_id as id_daftar, user.id as id_user, user.nama_lengkap as nama_user, wawancara.wawancara_nilai as nilai, wawancara.wawancara_bobot as bobot FROM wawancara
                                                    JOIN pendaftaran ON wawancara.pendaftaran_id=pendaftaran.id
                                                    JOIN user ON pendaftaran.user_id=user.id
                                                    WHERE pendaftaran.lowongan_id='$pendaftaran'") or die (mysqli_error($conn));

                            while($data=mysqli_fetch_array($q)){ ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><span class="label label-info"><?= $data['id_wawancara'] ?></span></td>
                                    <td><span class="label label-info"><?= $data['id_daftar'] ?></span></td>
                                    <td><span class="label label-info"><i class="fa fa-user"></i> <?= $data['id_user'] ?></span></td>
                                    <td><?= $data['nama_user'] ?></td>
                                    <td><?= getNilaiBobot($data['nilai']) ?></td>
                                    <td><?= getNilaiBobot($data['bobot']) ?></td>
                                    <td><?= getStatus($data['bobot']) ?></td>
                                    <td>
                                        <a href="?page=wawancaraedit&id=<?= $data['id_wawancara'] ?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> edit</a>
                                    </td>
                                </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>