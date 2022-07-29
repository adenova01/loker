<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Logout</h3>
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
                <?php
                    session_destroy();
                    echo    '<div class="alert alert-danger alert-dismissible" role="alert">'.
                                '<i class="fa fa-check-circle"></i> Logout Berhasil'.
                            '</div>';
                    echo "<meta http-equiv='refresh' content='1;
                    url=login.php'>";
                ?>
            </div>
        </div>
    </div>
</div>