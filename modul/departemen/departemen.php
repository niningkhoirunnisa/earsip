<?php

    //uji jika tombol simpan diklik
    if(isset($_POST['bsimpan']))
    {

      //pengujian apakah data akan diedit / simpan data baru
      if($_GET['hal'] == "edit"){
        //perintah edit data
        //ubah data
        $ubah = mysqli_query($koneksi, "UPDATE tbl_departemen SET nama_departemen = '$_POST[nama_departemen]' WHERE id_departemen = '$_GET[id]' ");
        if($ubah)
        {
            echo "<script>
                    alert('Ubah Data Sukses');
                    document.location='?halaman=departemen'; 
                  </script>";
        }
      }
      else
      {
        //perintah simpan data baru
        //simpan data
        $simpan = mysqli_query($koneksi, "INSERT INTO tbl_departemen
                                VALUES ( '', '$_POST[nama_departemen]')");
        if($simpan)
        {
            echo "<script>
                    alert('Simpan Data Sukses');
                    document.location='?halaman=departemen'; 
                  </script>";
        }

      }

      
            
    }

    //uji jika klik tombol edit / hapus
    if(isset($_GET['hal']))
    {
      
      if($_GET['hal'] == "edit")
      {
        //tampil data yang akan diedit
        $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_departemen WHERE id_departemen='$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if($data)
        {
          //jika data ditemukan, maka data ditampung ke dalam variabel 
          $vnama_departemen = $data['nama_departemen'];
        }

      }else{
        $hapus = mysqli_query($koneksi, "DELETE FROM tbl_departemen WHERE id_departemen='$_GET[id]'");
        if($hapus){
            echo "<script>
                  alert('Hapus Data Sukses');
                  document.location='?halaman=departemen'; 
                </script>";
        }
      }
      
    }
    
   
?>

<div class="container mt-3">
  <div class="card-header bg-info text-white">
    Form Data Departemen
  </div>
  <div class="card-body">
    <form method="post" action="">
    <div class="form-group">
        <label for="nama_departemen">Nama Departemen</label>
        <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" value="<?=@$vnama_departemen?>" required>
        
    </div>
    <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
    <!-- <button type="reset" name="bbatal" class="btn btn-danger">Batal</button> -->
    </form>
  </div>
</div>

<div class="container mt-3">
  <div class="card-header bg-info text-white">
    Data Departemen
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hovered table-striped">
        <tr>
            <th>No</th>
            <th>Nama Departemen</th>
            <th>Aksi</th>
        </tr>
        <?php
           $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_departemen order by id_departemen desc");
           $no=1;
           while($data = mysqli_fetch_array($tampil)):
        ?>
        <tr>
            <td><?=$no++?></td>
            <td><?=$data['nama_departemen']?></td>
            <td>
                <!-- membuat button edit -->
                <a href="?halaman=departemen&hal=edit&id=<?=$data['id_departemen']?>" class="btn btn-warning">Edit</a>
                <a href="?halaman=departemen&hal=hapus&id=<?=$data['id_departemen']?>" class="btn btn-danger" 
                  onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
    </table>
  </div>
</div>