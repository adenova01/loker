<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Data Nilai Pemberkasan</h3>
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
                                <th>ID User</th>
                                <th>Nama User</th>
                                <th>Total Berkas</th>
                                <th>Bobot</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            $q = mysqli_query($conn, "SELECT * FROM pemberkasan
                                                    JOIN user ON pemberkasan.user_id=user.id") or die (mysqli_error($conn));
                            while($data=mysqli_fetch_array($q)){ ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><span class="label label-info"><?= $data[1] ?></span></td>
                                    <td><?= $data['nama_lengkap'] ?></td>
                                    <td><?= getNilaiBerkas($data['pemberkasan_nilai']) ?></td>
                                    <td><?= getNilaiBobot($data['pemberkasan_bobot']) ?></td>
                                    <td><?= getStatus($data['pemberkasan_bobot']) ?></td>
                                    <td>
                                        <a href="?page=userdetail&id=<?= $data[1] ?>" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> lihat</a>
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