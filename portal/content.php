<?php 

switch($_SESSION['role']){
    case 1:
        if (isset($_GET['page'])) $page=$_GET['page'];
        else $page="admin/beranda";

        if ($page == "beranda")                 include("page/admin/beranda.php");
        elseif ($page == "logout")              include("page/logout.php");

        //------------------------------------ PROFIL ------------------------------------
        elseif ($page == 'profil')              include("page/admin/profil/profil.php");

        //------------------------------------ LOKER ------------------------------------
        elseif ($page == 'loker')               include("page/admin/loker/loker.php");
        elseif ($page == 'lokeradd')            include("page/admin/loker/lokeradd.php");
        elseif ($page == 'lokeraddpro')         include("page/admin/loker/lokeraddpro.php");
        elseif ($page == 'lokeredit')           include("page/admin/loker/lokeredit.php");
        elseif ($page == 'lokereditpro')        include("page/admin/loker/lokereditpro.php");
        elseif ($page == 'lokerdelete')         include("page/admin/loker/lokerdelete.php");

        //------------------------------------ PENDAFTARAN ------------------------------------
        elseif ($page == 'pendaftaran')         include("page/admin/pendaftaran/pendaftaran.php");

        //------------------------------------ METODE ------------------------------------
        elseif ($page == 'metode')              include("page/admin/metode/metode.php");

        //------------------------------------ PEMBERKASAN ------------------------------------
        elseif ($page == 'pemberkasan')         include("page/admin/pemberkasan/pemberkasan.php");

        //------------------------------------ PSIKOTEST ------------------------------------
        elseif ($page == 'psikotest')           include("page/admin/psikotest/psikotest.php");
        elseif ($page == 'psikotestedit')       include("page/admin/psikotest/psikotestedit.php");
        elseif ($page == 'psikotesteditpro')    include("page/admin/psikotest/psikotesteditpro.php");
        elseif ($page == 'psikotestdelete')     include("page/admin/psikotest/psikotestdelete.php");

        //------------------------------------ WAWANCARA ------------------------------------
        elseif ($page == 'wawancara')           include("page/admin/wawancara/wawancara.php");
        elseif ($page == 'wawancaraedit')       include("page/admin/wawancara/wawancaraedit.php");
        elseif ($page == 'wawancaraeditpro')    include("page/admin/wawancara/wawancaraeditpro.php");
        elseif ($page == 'wawancaradelete')     include("page/admin/wawancara/wawancaradelete.php");

        //------------------------------------ KESEHATAN ------------------------------------
        elseif ($page == 'kesehatan')           include("page/admin/kesehatan/kesehatan.php");
        elseif ($page == 'kesehatanedit')       include("page/admin/kesehatan/kesehatanedit.php");
        elseif ($page == 'kesehataneditpro')    include("page/admin/kesehatan/kesehataneditpro.php");
        elseif ($page == 'kesehatandelete')     include("page/admin/kesehatan/kesehatandelete.php");

        //------------------------------------ USER ------------------------------------
        elseif ($page == 'user')                include("page/admin/user/user.php");
        elseif ($page == 'userdetail')          include("page/admin/user/userdetail.php");

        //------------------------------------ CETAK ------------------------------------
        elseif ($page == 'cetak')               include("page/admin/cetak/cetak.php");

        else include("page/404.php");
    break;
    default:
        if (isset($_GET['page'])) $page=$_GET['page'];
        else $page="pendaftar/beranda";

        if ($page == "beranda")                 include("page/pendaftar/beranda.php");
        elseif ($page == "logout")              include("page/logout.php");

        //------------------------------------ PROFIL ------------------------------------
        elseif ($page == 'profil')              include("page/pendaftar/profil/profil.php");

        //------------------------------------ LOKER ------------------------------------
        elseif ($page == 'loker')               include("page/pendaftar/loker/loker.php");
        elseif ($page == 'lokeradd')            include("page/pendaftar/loker/lokeradd.php");
        elseif ($page == 'lokeractive')         include("page/pendaftar/loker/lokeractive.php");

        //------------------------------------ HISTORY ------------------------------------
        elseif ($page == 'historyloker')        include("page/pendaftar/historyloker/historyloker.php");

        else include("page/404.php");
    break;
}

?>