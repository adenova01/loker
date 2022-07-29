<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Data Lowongan Pekerjaan tersedia</h3>
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
                                <th>Judul</th>
                                <th>Lokasi</th>
                                <th>Kuota</th>
                                <th>Tipe</th>
                                <th>Mulai Pendaftaran</th>
                                <th>Akhir Pendaftaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                $q = mysqli_query($conn, "SELECT lowongan.id as idloker, lowongan.judul, lowongan.kuota, lowongan.tipe, lowongan.mulai_pendaftaran, lowongan.akhir_pendaftaran, provinsi.nama FROM lowongan
                                                        JOIN provinsi ON lowongan.provinsi_id=provinsi.id");
                                while($data=mysqli_fetch_array($q)){
                                $datenow  = new DateTime(getDateNow());
                                $datestart  = new DateTime($data['mulai_pendaftaran']);
                                $dateend  = new DateTime($data['akhir_pendaftaran']);
                                if ($datestart == $datenow || $datestart >= $datenow || $dateend >= $datenow) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><span class="label label-success"><i class="fa fa-circle"></i> <?= $data['idloker'] ?></span></td>
                                    <td><?= $data['judul'] ?></td>
                                    <td><?= $data['nama'] ?></td>
                                    <td><?= $data['kuota'] ?></td>
                                    <td><span class="label label-primary" style="text-transform: capitalize;"><i class="fa fa-briefcase"></i> <?= $data['tipe'] ?></span></td>
                                    <td><?= date('d M Y', strtotime($data['mulai_pendaftaran'])) ?></td>
                                    <td><?= date('d M Y', strtotime($data['akhir_pendaftaran'])) ?></td>
                                    <td>
                                    <?= getActiveJob($data['mulai_pendaftaran'], $data['akhir_pendaftaran'], $data['idloker'], $auth['id']) ?>
                                    </td>
                                </tr>
                            <?php $no++; }} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>