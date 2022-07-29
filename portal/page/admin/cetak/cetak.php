<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Pengaturan Cetak</h3>
                    <p class="panel-subtitle"></p>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form action="./pdf/cetak.php" method="post" enctype="multipart/form-data" target="_blank">
                    <div class="row">
                        <div class="col-md-4">
                            <div clas="form-group">
                                <label>Batas Data Cetak</label>
                                <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                                <input type="number" class="form-control" name="limit" placeholder="<?= "masukkan nilai batas data cetak minimal: ".$_GET['limit'] ?>" value="<?= $_GET['limit'] ?>" min="<?= $_GET['limit'] ?>" autocomplete="OFF" />
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <input type="submit" name="submit" class="btn btn-primary" value="Cetak">
        <a href="?page=metode" class="btn btn-default">kembali</a>
    </div>
    </form>
</div>