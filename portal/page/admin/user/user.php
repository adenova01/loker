<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Data User Pendaftar</h3>
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
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Login Terakhir</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $q = mysqli_query($conn, "SELECT * FROM user");
                            while($data=mysqli_fetch_array($q)){ ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><span class="label label-success"><i class="fa fa-user"></i> <?= $data['id'] ?></span></td>
                                    <td><?= $data['nik'] !== null ? $data['nik'] : '-'  ?></td>
                                    <td><?= $data['nama_lengkap'] !== null ? $data['nama_lengkap'] : '-'  ?></td>
                                    <td><?= date('d F Y', strtotime($data['tgl_lahir'])) ?></td>
                                    <td><?= $data['alamat'] ?></td>
                                    <td><?= $data['jenis_kelamin'] !== null ? $data['jenis_kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan' : '-' ?></td>
                                    <td><?= $data['email'] !== null ? $data['email'] : '-'  ?></td>
                                    <td><?= $data['no_hp'] !== null ? $data['no_hp'] : '-'  ?></td>
                                    <td><?= $data['login_terakhir'] !== null ? $data['login_terakhir'] : '-'  ?></td>
                                    <td>
                                        <a href="?page=userdetail&id=<?= $data['id'] ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> detail</a>
                                    </td>
                                </tr>
                            <?php $no++; } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>