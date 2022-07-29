<?php 
    $g = mysqli_query($conn, "SELECT * FROM lowongan WHERE id='$_GET[id]'");
    $data = mysqli_fetch_array($g);
?>
<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Edit Lowongan Pekerjaan</h3>
                    <p class="panel-subtitle"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form action="?page=lokereditpro" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <a class="btn btn-success"><i class="fa fa-briefcase"></i> <?= $data['id'] ?></a>
                                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Judul</label>
                                <textarea class="form-control" name="judul" placeholder="masukkan judul lowongan pekerjaan" autocomplete="OFF" required><?= $data['judul'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Deksripsi</label>
                                <textarea class="form-control" name="deskripsi" placeholder="masukkan deskripsi lowongan pekerjaan" autocomplete="OFF"><?= $data['deskripsi'] ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Kuota</label>
                                <input type="number" class="form-control" name="kuota" placeholder="masukkan kuota lowongan pekerjaan" autocomplete="OFF" value="<?= $data['kuota'] ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Lokasi Pendaftaran</label>
                                <select class="form-control" name="lokasi">
                                <?php 
                                    $prov = mysqli_query($conn, "SELECT * FROM provinsi");
                                    while($value = mysqli_fetch_array($prov)) { ?>
                                    <option value="<?= $value['id'] ?>" <?= $data['provinsi_id'] == $value['id'] ? 'selected' : '' ?>><?= $value['nama'] ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Tipe</label>
                                <select class="form-control" name="tipe">
                                    <option value="fulltime" <?= $data['tipe'] == 'fulltime' ? 'selected' : '' ?>>Fulltime</option>
                                    <option value="kontrak" <?= $data['tipe'] == 'kontrak' ? 'selected' : '' ?>>Kontrak</option>
                                    <option value="magang" <?= $data['tipe'] == 'magang' ? 'selected' : '' ?>>Magang</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Tanggal Mulai Pendaftaran</label>
                                <input type="date" class="form-control" name="tglmulaidaftar" value="<?= date('Y-m-d', strtotime($data['mulai_pendaftaran'])) ?>" autocomplete="OFF" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label>Tanggal Akhir Pendaftaran</label>
                                <input type="date" class="form-control" name="tglakhirdaftar" value="<?= date('Y-m-d', strtotime($data['akhir_pendaftaran'])) ?>" autocomplete="OFF" required>
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