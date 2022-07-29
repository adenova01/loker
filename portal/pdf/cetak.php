<?php
use Dompdf\Dompdf;
require '../vendor/autoload.php';
$dompdf = new Dompdf();

if (isset($_POST['submit'])){
    $id = $_POST['id'];
    $limit = $_POST['limit'];
    $html = file_get_contents("http://localhost:80/loker-apps/portal/pdf/template.php?id=".$id."&limit=".$limit."");
}
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Cetak",array("Attachment"=>0));
