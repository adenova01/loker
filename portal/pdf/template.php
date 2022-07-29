<?php 
include '../lib/koneksi.php';
$sql = mysqli_query($conn, "SELECT * FROM pendaftaran
                        JOIN user ON pendaftaran.user_id=user.id
                        JOIN ranking ON pendaftaran.id=ranking.pendaftaran_id
                        WHERE pendaftaran.lowongan_id='$_GET[id]'
                        ORDER BY ranking.ranking_nilai DESC
                        LIMIT $_GET[limit]");
$q = mysqli_query($conn, "SELECT * FROM lowongan WHERE id='$_GET[id]'");
$dataq = mysqli_fetch_array($q);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <style>
        body { color: #37383a; font-family: 'Roboto', sans-serif; font-size: 10pt;}
        .title { text-align: center;}
        .long-desc {text-align: justify;}
        .long-desc table {width: 100%;}
        #container { width: 100%; padding: 0px 30px 0px 30px; border-bottom: solid 2px #d3d3d3;}
        .row { display: block; width: 500px; height: 100px;}
        .img { display: inline-block; width: 80px; height: 80px; text-align: center;}
        .text { display: inline-block; line-height: 0.3; width: 400px;}
        .listrik-pintar { margin-top: 10px; display: inline-block; width: 400px;}
        .title h2 { text-decoration: capitalize;}
        .row.desc { line-height: 1.6; text-align: justify;}
        .row.desc table { border-spacing: 5px;}
        table.identitas tr td:first-child { width: 150px;}
        table.pelanggan tr th:first-child { width: 50px;}
        table.pelanggan tr th{height: 40px; border-bottom: solid 2px #d3d3d3; background: #f2f2f2;text-align: center;}
        table.pelanggan tr td{text-align: center;}
        span.acc {display: block; background: #27ae60;color: #f2f2f2;border-radius:5px;text-align: center;}
        span.notacc {display: block; background: #d9534f;color: #f2f2f2;border-radius:5px;text-align: center;}
    </style>
</head>
<body>
    <main>
        <div class="title">
            <h2>REPORT</h2>
        </div>
        <div class="long-desc">
            <table class="identitas">
                <tr>
                    <td>Tanggal</td>
                    <td>: <?= date('d M Y') ?></td>
                </tr>
                <tr>
                    <td>Lowongan</td>
                    <td>: <?= "(".$dataq['id'].") ".$dataq['judul'] ?></td>
                </tr>
                <tr>
                    <td>Limit</td>
                    <td>: <?= $_GET['limit']." Orang" ?></td>
                </tr>
            </table>
        </div><br>
        <div class="long-desc">
            <table class="pelanggan">
                <tr>
                    <th>No</th>
                    <th>ID User</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No Hp</th>
                    <th>Jenis Kelamin</th>
                    <th>Status</th>
                </tr>
                <?php 
                    $no = 1;
                    while($data=mysqli_fetch_array($sql)){ ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $data['user_id'] ?></td>
                            <td><?= $data['nik'] ?></td>
                            <td><?= $data['nama_lengkap'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td><?= $data['no_hp'] ?></td>
                            <td><?= $data['jenis_kelamin'] ?></td>
                            <td><?= $data['pendaftaran_status'] ?></td>
                        </tr>
                    <?php $no++; } ?>
            </table>
        </div>
    </main>
</body>
</html>