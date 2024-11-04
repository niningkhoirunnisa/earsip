<?php

if(isset($_GET['halaman'])) {
    $halaman = $_GET['halaman'];

    if($halaman == "departemen") {
        //tampil halaman departemen
        // echo "tampil halaman departemen";
        include "modul/departemen/departemen.php";
    }
    elseif($halaman == "pengirim_surat") {
        //tampil halaman pengirim surat
        include "modul/pengirim_surat/pengirim_surat.php";
    }
    elseif($halaman == "arsip_surat") { 
        //tampil halaman arsip surat
        if(@$_GET['hal'] == "tambahdata" || @$_GET['hal'] == "edit" || @$_GET['hal'] == "hapus"){
            include "modul/arsip/form.php";
        }else{
            include "modul/arsip/data.php";
        }
    }
    elseif($halaman == "arsip_surat_keluar"){
        if(@$_GET['hal'] == "tambahdata" || @$_GET['hal'] == "edit" || @$_GET['hal'] == "hapus"){
            include "modul/keluar/form.php";
        }else{
            include "modul/keluar/data.php";
        }
    }
   
} else {
    // echo "tampil halaman home";
    include "modul/home.php";
}
?>
 