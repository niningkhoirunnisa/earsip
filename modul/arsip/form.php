<?php

    //panggil function.php untuk upload file
    include "config/function.php";

    //uji jika klik tombol edit / hapus
    if(isset($_GET['hal']))
    {
      
      if($_GET['hal'] == "edit")
      {
        //tampil data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT
        tbl_arsip.*,
        tbl_departemen.nama_departemen,
        tbl_pengirim_surat.nama_pengirim_surat,
        tbl_pengirim_surat.no_hp
        FROM 
          tbl_arsip
        INNER JOIN tbl_departemen ON tbl_arsip.id_departemen = tbl_departemen.id_departemen
        INNER JOIN tbl_pengirim_surat ON tbl_arsip.id_pengirim = tbl_pengirim_surat.id_pengirim
         WHERE tbl_arsip.id_arsip='$_GET[id]'");
        


        $data = mysqli_fetch_array($tampil);
        if($data)
        {
          //jika data ditemukan, maka data ditampung ke dalam variabel 
          $vno_surat             = $data['no_surat'];
          $vtanggal_surat        = $data['tanggal_surat'];
          $vtanggal_diterima     = $data['tanggal_diterima'];
          $vperihal              = $data['perihal'];
          $vid_departemen        = $data['id_departemen'];
          $vnama_departemen      = $data['nama_departemen'];
          $vid_pengirim          = $data['id_pengirim'];
          $vnama_pengirim_surat  = $data['nama_pengirim_surat'];
          $vfile                 = $data['file'];
        }

      }
      elseif($_GET['hal'] == 'hapus')
      {
        $hapus = mysqli_query($koneksi, "DELETE FROM tbl_arsip WHERE id_arsip='$_GET[id]'");
        if($hapus){
            echo "<script>
                  alert('Hapus Data Sukses');
                  document.location='?halaman=arsip_surat'; 
                </script>";
        }
      }
      
    }
    //uji jika tombol simpan diklik
    if(isset($_POST['bsimpan']))
    {

      //pengujian apakah data akan diedit / simpan data baru
      if(@$_GET['hal'] == "edit"){
        //perintah edit data
        //ubah data

        //CEK APAKAH USER PILIH FILE/GAMBAR ATAU TIDAK
        if($_FILES['file']['error'] == 4){
          $file =$vfile;
        }else{
          $file = upload();
        }
        
        $ubah = mysqli_query($koneksi, "UPDATE tbl_arsip SET 
                                            no_surat         = '$_POST[no_surat]',
                                            tanggal_surat    = '$_POST[tanggal_surat]',
                                            tanggal_diterima = '$_POST[tanggal_diterima]',
                                            perihal          = '$_POST[perihal]',
                                            id_departemen    = '$_POST[id_departemen]',
                                            id_pengirim      = '$_POST[id_pengirim]',
                                            file             = '$file'
                                        WHERE id_arsip       = '$_GET[id]' ");

        if($ubah)
        {
            echo "<script>
                    alert('Ubah Data Sukses');
                    document.location='?halaman=arsip_surat'; 
                  </script>";
        }
        else
        {
            echo "<script>
                    alert('Ubah Data Gagal!!');
                    document.location='?halaman=arsip_surat'; 
                  </script>";
        }
      }
      else
      {
        //perintah simpan data baru
        //simpan data
        $file = upload();
        $simpan = mysqli_query($koneksi, "INSERT INTO tbl_arsip
                                VALUES ( '', '$_POST[no_surat]', 
                                            '$_POST[tanggal_surat]',
                                            '$_POST[tanggal_diterima]',
                                            '$_POST[perihal]',
                                            '$_POST[id_departemen]',
                                            '$_POST[id_pengirim]',
                                            '$file'
                                            )");
        if($simpan)
        {
            echo "<script>
                    alert('Simpan Data Sukses');
                    document.location='?halaman=arsip_surat'; 
                  </script>";
        }else{
            echo "<script>
                    alert('Simpan Data Gagal!');
                    document.location='?halaman=arsip_surat'; 
                </script>";  
        }

      }

      
            
    }

    
    
   
?>

<div class="container mt-3">
  <div class="card-header bg-info text-white">
    Form Data Arsip Surat
  </div>
  <div class="card-body">
    <form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="no_surat">No. Surat</label>
        <input type="text" class="form-control" id="no_surat" name="no_surat" value="<?=@$vno_surat?>" required>
    </div>

    <div class="form-group">
        <label for="tanggal_surat">Tanggal Surat</label>
        <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" value="<?=@$vtanggal_surat?>" required>
    </div>

    <div class="form-group">
        <label for="tanggal_diterima">Tanggal Diterima</label>
        <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" value="<?=@$vtanggal_diterima?>" required> 
    </div>

    <div class="form-group">
        <label for="perihal">Perihal</label>
        <input type="perihal" class="form-control" id="perihal" name="perihal" value="<?=@$vperihal?>" required>    
    </div>

    <div class="form-group">
        <label for="id_departemen">Departemen / Tujuan</label>
        <select class="form-control" name="id_departemen">
            <option value="<?=@$vid_departemen?>"><?=@$vnama_departemen?></option>
            <?php
              $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_departemen order by nama_departemen asc");
              while($data = mysqli_fetch_array($tampil)){
                echo "<option value = '$data[id_departemen]'> $data[nama_departemen]</option>";
              }
            ?>
        </select>    
    </div>

    <div class="form-group">
        <label for="id_pengirim">Pengirim Surat</label>
        <select class="form-control" name="id_pengirim">
            <option value="<?=@$vid_pengirim?>"><?=@$vnama_pengirim_surat?></option>
            <?php
              $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengirim_surat order by nama_pengirim_surat asc");
              while($data = mysqli_fetch_array($tampil)){
                echo "<option value = '$data[id_pengirim]'> $data[nama_pengirim_surat]</option>";
              }
            ?>
        </select>    
    </div>

    <div class="form-group">
        <label for="file">Pilih File</label>
        <input type="file" class="form-control" id="file" name="file" value="<?=@$vfile?>" required>    
    </div>

    <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
    <!-- <button type="reset" name="bbatal" class="btn btn-danger">Batal</button> -->
    </form>
  </div>
</div>