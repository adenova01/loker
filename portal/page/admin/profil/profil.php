<div class="panel panel-headline">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-5" style="background: #f8f8f8;">
                <div class="profile-header">
                    <div class="overlay"></div>
                    <div class="profile-main">
                        <img src="assets/img/admin.png" class="img-circle" width="100">
                        <h3 class="name"><?= $auth['nama_lengkap'] !== null ? $auth['nama_lengkap'] : $auth['email'] ?></h3>
                        <span class="online-status status-available">Aktif</span>
                    </div>
                </div>
                <div class="profile-detail">
                    <div class="profile-info">
                        <h4><i class="fa fa-user box-circle"></i> Informasi Dasar</h4>
                        <div class="row">
                        <div class="col-md-4">Nama</div>
                        <div class="col-md-8">: <?= $auth['nama_lengkap'] !== null ? $auth['nama_lengkap'] : '-' ?></div>
                        <div class="col-md-4">Email</div>
                        <div class="col-md-8">: <?= $auth['email'] !== null ? $auth['email'] : '-' ?></div>
                        <div class="col-md-4">Last Login</div>
                        <div class="col-md-8">: <?= $auth['login_terakhir'] !== null ? $auth['login_terakhir'] : '-' ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
            <?php 
            
            if (isset($_POST['submit'])) {
                $id             = $_POST['id']; 
                $nama           = $_POST['namalengkap'];
                $email          = $_POST['email'];
                $password       = $_POST['password'];

                $insert = mysqli_query($conn, "UPDATE admin SET
                        nama_lengkap    = '$nama',
                        email           = '$email',
                        password        = '$password'
                        WHERE id        = '$id'") or die (mysqli_error($conn));  
                
                if ($insert) {
                    echo    '<div class="alert alert-success alert-dismissible" role="alert">'.
                                '<i class="fa fa-check-circle"></i> Data berhasil disimpan'.
                            '</div>';
                    echo "<meta http-equiv='refresh' content='1;
                    url=?page=profil'>";
                }
            }

            ?>
                <form action="?page=profil" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $auth['id'] ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Nama Lengkap</label>
                                <input class="form-control" type="text" name="namalengkap" placeholder="isikan nama lengkap anda ..." value="<?= $auth['nama_lengkap'] ?>" autocomplete="OFF">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" placeholder="isikan alamat email anda ..." value="<?= $auth['email'] ?>" autocomplete="OFF">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <label>Password</label>
                                <input id="password-field" name="password" maxlength="10" type="password" class="form-control" value="<?= $auth['password'] ?>" autocomplete="OFF" >
                                <span toggle="#password-field" class="fa fa-eye-slash field-icon toggle-password"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                        <div class="col-md-12">
                            <div clas="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Simpan">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>