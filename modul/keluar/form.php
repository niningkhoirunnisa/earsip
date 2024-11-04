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
        tbl_keluar.*,
        no_surat1, tanggal_surat1, perihal1, id_departemen1, file
        -- tbl_departemen.nama_departemen
        FROM 
          tbl_keluar
        -- INNER JOIN tbl_departemen ON tbl_keluar.id_departemen1 = tbl_departemen.id_departemen
        -- 
         WHERE tbl_keluar.id_arsip1='$_GET[id]'");
        


        $data = mysqli_fetch_array($tampil);
        if($data)
        {
          //jika data ditemukan, maka data ditampung ke dalam variabel 
          $vno_surat             = $data['no_surat1'];
          $vtanggal_surat        = $data['tanggal_surat1'];
          $vperihal              = $data['perihal1'];
          $vid_departemen        = $data['id_departemen1'];
        
          $vfile                 = $data['file'];
        }

      }
      elseif($_GET['hal'] == 'hapus')
      {
        $hapus = mysqli_query($koneksi, "DELETE FROM tbl_keluar WHERE id_arsip1='$_GET[id]'");
        if($hapus){
            echo "<script>
                  alert('Hapus Data Sukses');
                  document.location='?halaman=arsip_surat_keluar'; 
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
        
        $ubah = mysqli_query($koneksi, "UPDATE tbl_keluar SET 
                                            no_surat1         = '$_POST[no_surat1]',
                                            tanggal_surat1    = '$_POST[tanggal_surat1]',
                                            perihal1          = '$_POST[perihal1]',
                                            id_departemen1    = '$_POST[id_departemen1]',
                                            file             = '$file'
                                        WHERE id_arsip1       = '$_GET[id]' ");

        if($ubah)
        {
            echo "<script>
                    alert('Ubah Data Sukses');
                    document.location='?halaman=arsip_surat_keluar'; 
                  </script>";
        }
        else
        {
            echo "<script>
                    alert('Ubah Data Gagal!!');
                    document.location='?halaman=arsip_surat_keluar'; 
                  </script>";
        }
      }
      else
      {
        //perintah simpan data baru
        //simpan data
        $file = upload();
        $simpan = mysqli_query($koneksi, "INSERT INTO tbl_keluar
                                VALUES ( '', '$_POST[no_surat1]', 
                                            '$_POST[tanggal_surat1]',
                                            '$_POST[perihal1]',
                                            '$_POST[id_departemen1]',
                                            '$file'
                                            )");
        if($simpan)
        {
            echo "<script>
                    alert('Simpan Data Sukses');
                    document.location='?halaman=arsip_surat_keluar'; 
                  </script>";
        }else{
            echo "<script>
                    alert('Simpan Data Gagal!');
                    document.location='?halaman=arsip_surat_keluar'; 
                </script>";  
        }

      }

      
            
    }

    
    
   
?>

<div class="container mt-3">
  <div class="card-header bg-info text-white">
    Form Data Arsip Surat Keluar
  </div>
  <div class="card-body">
    <form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="no_surat1">No. Surat</label>
        <input type="text" class="form-control" id="no_surat1" name="no_surat1" value="<?=@$vno_surat?>" required>
    </div>

    <div class="form-group">
        <label for="tanggal_surat1">Tanggal Surat</label>
        <input type="date" class="form-control" id="tanggal_surat1" name="tanggal_surat1" value="<?=@$vtanggal_surat?>" required>
    </div>

    <div class="form-group">
        <label for="perihal1">Perihal</label>
        <input type="perihal" class="form-control" id="perihal1" name="perihal1" value="<?=@$vperihal?>" required>    
    </div>

    <div class="form-group">
        <label for="id_departemen1">Departemen / Tujuan</label>
        <input type="id_departemen1" class="form-control" id="id_departemen1" name="id_departemen1"
        value="<?=@$vid_departemen?>" required>    
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