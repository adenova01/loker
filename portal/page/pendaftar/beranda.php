<div class="panel panel-headline">
    <div class="panel-heading">
        <h3 class="panel-title">Beranda</h3>
        <p class="panel-subtitle"></p>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="metric">
                    <span class="icon"><i class="fa fa-briefcase"></i></span>
                    <p>
                        <span class="number"><?= getCountAllById('pendaftaran',$auth['id']) ?></span>
                        <span class="title">Pekerjaan Aktif</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>