<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Data Lowongan Pekerjaan Aktif</h3>
                    <p class="panel-subtitle"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>ID Lowongan</th>
                                <th>Judul Lowongan</th>
                                <th>Tanggal Pendaftaran</th>
                                <th>Proses Rekrutment</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $q = mysqli_query($conn, "SELECT pendaftaran.id AS id, lowongan.id as id_lowongan, lowongan.judul AS judul_lowongan, pendaftaran.tgl_daftar AS tanggal_daftar, pendaftaran.pendaftaran_status as status FROM pendaftaran
                                                        JOIN lowongan ON pendaftaran.lowongan_id=lowongan.id
                                                        WHERE pendaftaran.user_id='$auth[id]'");
                                while($data=mysqli_fetch_array($q)){
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><span class="label label-success"><i class="fa fa-pencil"></i> <?= $data['id'] ?></span></td>
                                    <td><span class="label label-primary"><i class="fa fa-briefcase"></i> <?= $data['id_lowongan'] ?></span></td>
                                    <td><?= $data['judul_lowongan'] ?></td>
                                    <td><?= date('d M Y', strtotime($data['tanggal_daftar'])) ?></td>
                                    <td><?= stepRecruitment($data['id']) ?></td>
                                    <td><?= statusPendaftaran($data['status']) ?></td>
                                </tr>
                            <?php $no++; }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>