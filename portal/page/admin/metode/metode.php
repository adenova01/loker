<div class="panel panel-headline">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h3 class="panel-title">Data Proses Metode</h3>
                    <p class="panel-subtitle"></p>
                </div>
                <div class="pull-right">
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <form action="?page=metode" method="post" enctype="multipart/form-data">
                <div class="col-md-8">
                    <select class="form-control" name="loker">
                    <option style="display:none;">-- pilih salah satu pendaftaran --</option>
                        <?php 
                            $q = mysqli_query($conn, "SELECT * from pendaftaran
                                                    JOIN lowongan ON pendaftaran.lowongan_id=lowongan.id
                                                    GROUP BY pendaftaran.lowongan_id");
                            while($datas = mysqli_fetch_array($q)){
                                echo '<option value='.$datas[1].'>('.$datas[1].') '.$datas['judul'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="submit" name="submit" class="btn btn-primary" value="proses">
                </div>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                $idloker = $_POST['loker'];
                $r = mysqli_query($conn, "SELECT * FROM lowongan WHERE id='$idloker'");
                $getdata = mysqli_fetch_array($r);
                $kuota = $getdata['kuota'];
                $q = mysqli_query($conn, "SELECT * FROM pendaftaran
                                        JOIN user ON pendaftaran.user_id=user.id
                                        JOIN pemberkasan ON user.id=pemberkasan.user_id
                                        JOIN psikotest ON pendaftaran.id=psikotest.pendaftaran_id
                                        JOIN wawancara ON pendaftaran.id=wawancara.pendaftaran_id
                                        JOIN kesehatan ON pendaftaran.id=kesehatan.pendaftaran_id
                                        WHERE pendaftaran.lowongan_id='$idloker'")
                                        or die (mysqli_error($conn));

                $maxcol1 = [];
                $maxcol2 = [];
                $maxcol3 = [];
                $maxcol4 = [];
                $allmax = [];
                $nilai_preferensi = []; 
                $nilai_kriteria = [25, 30, 20, 25];

                while($data = mysqli_fetch_array($q)) {
                    $q[] = [
                        "id_daftar" => $data[0],
                        "id_loker" => $data[1],
                        "id_user" => $data['user_id'],
                        "nama" => $data['nama_lengkap'],
                        "kriteria" => [
                            $data['pemberkasan_bobot'],
                            $data['psikotest_bobot'],
                            $data['wawancara_bobot'],
                            $data['kesehatan_bobot']
                        ],
                    ];
                }

                for ($d=0;$d<count($isi);$d++){
                    $nilai_preferensi[$d] = 0;
                }

                for ($d=0;$d<count($isi);$d++){
                    for ($e=0;$e<1;$e++){
                        array_push($maxcol1, $isi[$d]['kriteria'][$e]);
                    }   
                }

                for ($d=0;$d<count($isi);$d++){
                    for ($e=1;$e<2;$e++){
                        array_push($maxcol2, $isi[$d]['kriteria'][$e]);
                    }   
                }

                for ($d=0;$d<count($isi);$d++){
                    for ($e=2;$e<3;$e++){
                        array_push($maxcol3, $isi[$d]['kriteria'][$e]);
                    }   
                }

                for ($d=0;$d<count($isi);$d++){
                    for ($e=3;$e<4;$e++){
                        array_push($maxcol4, $isi[$d]['kriteria'][$e]);
                    }   
                }

                $allmax = [
                    max($maxcol1),
                    max($maxcol2),
                    max($maxcol3),
                    max($maxcol4),
                ];

                for ($d=0;$d<count($isi);$d++){
                    for ($e=0;$e<count($isi[$d]['kriteria']);$e++){
                        $isi[$d]['alternatif'][] = round(($isi[$d]['kriteria'][$e]/$allmax[$e]),2);
                    }   
                }

                for ($d=0;$d<count($isi);$d++){
                    for ($e=0;$e<count($isi[$d]['alternatif']);$e++){
                        $nilai_preferensi[$d] += round(($isi[$d]['alternatif'][$e]*$nilai_kriteria[$e]),2);
                    }   
                }

                for ($d=0;$d<count($isi);$d++){
                    $isi[$d]['nilai_preferensi'] = $nilai_preferensi[$d];
                }

                foreach($isi as $val) {
                    insertRanking($val['id_daftar'],$val['nilai_preferensi']);
                }

                $b = mysqli_query($conn, "SELECT * FROM pendaftaran
                                        JOIN ranking ON pendaftaran.id=ranking.pendaftaran_id
                                        WHERE pendaftaran.lowongan_id='$idloker'
                                        ORDER BY ranking.ranking_nilai DESC");
                $no = 1;
                while($data = mysqli_fetch_array($b)) {
                    if ($no <= $kuota) {
                        updateRegister($data[0],'lulus');
                    } else {    
                        updateRegister($data[0],'gagal');
                    }
                    $no++;
                }

                ?>
                <div class="col-md-12" style="margin-top: 15px;">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        Rating Kecocokan Kriteria
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Daftar</th>
                                    <th>ID Loker</th>
                                    <th>ID User</th>
                                    <th>Nama User</th>
                                    <th>Pemberkasan Bobot</th>
                                    <th>Psikotest Bobot</th>
                                    <th>Wawancara Bobot</th>
                                    <th>Kesehatan Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                for ($a=0; $a<count($isi); $a++) {
                                    echo '<tr>';
                                    echo '<td>'.$no.'</td>';
                                    echo '<td><span class="label label-info">'.$isi[$a]['id_daftar'].'</span></td>';
                                    echo '<td><span class="label label-info">'.$isi[$a]['id_loker'].'</span></td>';
                                    echo '<td><span class="label label-info"><i class="fa fa-user"></i> '.$isi[$a]['id_user'].'</span></td>';
                                    echo '<td>'.$isi[$a]['nama'].'</td>';
                                    for ($b=0; $b<count($isi[$a]['kriteria']); $b++) {
                                        echo '<td>'.$isi[$a]['kriteria'][$b].'</td>';
                                    }
                                    echo '</tr>';
                                    $no++;
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 15px;">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        Matriks Keputusan Ternormalisasi
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Daftar</th>
                                    <th>ID Loker</th>
                                    <th>ID User</th>
                                    <th>Nama User</th>
                                    <th>Pemberkasan</th>
                                    <th>Psikotest</th>
                                    <th>Wawancara</th>
                                    <th>Kesehatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                for ($a=0; $a<count($isi); $a++) {
                                    echo '<tr>';
                                    echo '<td>'.$no.'</td>';
                                    echo '<td><span class="label label-info">'.$isi[$a]['id_daftar'].'</span></td>';
                                    echo '<td><span class="label label-info">'.$isi[$a]['id_loker'].'</span></td>';
                                    echo '<td><span class="label label-info"><i class="fa fa-user"></i> '.$isi[$a]['id_user'].'</span></td>';
                                    echo '<td>'.$isi[$a]['nama'].'</td>';
                                    for ($b=0; $b<count($isi[$a]['alternatif']); $b++) {
                                        echo '<td>'.$isi[$a]['alternatif'][$b].'</td>';
                                    }
                                    echo '</tr>';
                                    $no++;
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 15px;">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        Nilai Preferensi dan Ranking
                    </div>
                    <a href="?page=cetak&id=<?= $idloker ?>&limit=<?= $kuota ?>" class="btn btn-info" style="margin-bottom: 15px;"> <i class="fa fa-print"></i> Cetak</a>
                    <div class="table-responsive">
                        <table class="table table-bordered example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Daftar</th>
                                    <th>ID Loker</th>
                                    <th>ID User</th>
                                    <th>Nama User</th>
                                    <th>Nilai Preferensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $q = mysqli_query($conn, "SELECT * FROM pendaftaran
                                            JOIN user ON pendaftaran.user_id=user.id
                                            JOIN ranking ON pendaftaran.id=ranking.pendaftaran_id
                                            WHERE pendaftaran.lowongan_id='$idloker'
                                            ORDER BY ranking.ranking_nilai DESC");
                                while($datafinal = mysqli_fetch_array($q)){
                                    echo '<tr>';
                                    echo '<td>'.$no.'</td>';
                                    echo '<td><span class="label label-info">'.$datafinal[0].'</span></td>';
                                    echo '<td><span class="label label-info">'.$datafinal['lowongan_id'].'</span></td>';
                                    echo '<td><span class="label label-info"><i class="fa fa-user"></i> '.$datafinal[5].'</span></td>';
                                    echo '<td>'.$datafinal['nama_lengkap'].'</td>';
                                    echo '<td>'.$datafinal['ranking_nilai'].'</td>';
                                    echo '</tr>';
                                    $no++;
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>