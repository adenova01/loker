<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Beranda</h3>
        <p class="panel-subtitle"></p>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-users"></i></span>
                    <p>
                        <span class="number"><?= getCountAll('user') ?></span>
                        <span class="title">User</span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-sticky-note"></i></span>
                    <p>
                        <span class="number"><?= getCountAll('pendaftaran') ?></span>
                        <span class="title">Pendaftar</span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-briefcase"></i></span>
                    <p>
                        <span class="number"><?= getCountAll('lowongan') ?></span>
                        <span class="title">Lowongan</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>