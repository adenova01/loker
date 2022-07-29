<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Data Pendaftaran</h3>
                    <p class="panel-subtitle"></p>
                </div>
                <div class="pull-right">
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
                                <th>Lowongan Judul</th>
                                <th>ID User</th>
                                <th>Nama User</th>
                                <th>Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $q = mysqli_query($conn, "SELECT pendaftaran.id as id_daftar, lowongan.judul as lowongan_judul, user.nama_lengkap as nama_user, user.id as id_user, pendaftaran.tgl_daftar as tanggal_daftar FROM pendaftaran
                                                    JOIN lowongan ON pendaftaran.lowongan_id=lowongan.id
                                                    JOIN user ON pendaftaran.user_id=user.id");
                            while($data=mysqli_fetch_array($q)){ ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><span class="label label-success"><?= $data['id_daftar'] ?></span></td>
                                    <td><?= $data['lowongan_judul'] ?></td>
                                    <td><span class="label label-info"><i class="fa fa-user"></i> <?= $data['id_user'] ?></span></td>
                                    <td><?= $data['nama_user'] ?></td>
                                    <td><?= date('d M Y', strtotime($data['tanggal_daftar'])) ?></td>
                                </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>