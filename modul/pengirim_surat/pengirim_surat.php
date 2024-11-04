<?php
// Periksa koneksi database
if (!$koneksi) {
  die("Connection failed: " . mysqli_connect_error());
}

// Uji jika tombol simpan diklik
if (isset($_POST['bsimpan'])) {
  // Pengujian apakah data akan diedit atau simpan data baru
  if (@$_GET['hal'] == "edit") {
    // Perintah edit data
    $ubah = mysqli_query($koneksi, "UPDATE tbl_pengirim_surat SET 
                                            nama_pengirim_surat = '$_POST[nama_pengirim_surat]',
                                            alamat              = '$_POST[alamat]',
                                            no_hp               = '$_POST[no_hp]',
                                            email               = '$_POST[email]'
                                        WHERE id_pengirim         = '$_GET[id]'");
    if ($ubah) {
      echo "<script>
                    alert('Ubah Data Sukses');
                    document.location='?halaman=pengirim_surat';
                  </script>";
    } else {
      echo "<script>
                    alert('Ubah Data Gagal!!');
                    document.location='?halaman=pengirim_surat';
                  </script>";
    }
  } else {
    // Perintah simpan data baru
    $simpan = mysqli_query($koneksi, "INSERT INTO tbl_pengirim_surat
                                VALUES ( '', '$_POST[nama_pengirim_surat]', 
                                            '$_POST[alamat]',
                                            '$_POST[no_hp]',
                                            '$_POST[email]')");
    if ($simpan) {
      echo "<script>
                    alert('Simpan Data Sukses');
                    document.location='?halaman=pengirim_surat';
                  </script>";
    } else {
      echo "<script>
                    alert('Simpan Data Gagal!');
                    document.location='?halaman=pengirim_surat';
                </script>";
    }
  }
}

// Uji jika klik tombol edit atau hapus
if (isset($_GET['hal'])) {
  if ($_GET['hal'] == "edit") {
    // Tampil data yang akan diedit
    $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengirim_surat WHERE id_pengirim='$_GET[id]'");
    $data = mysqli_fetch_array($tampil);
    if ($data) {
      // Jika data ditemukan, maka data ditampung ke dalam variabel
      $vnama_pengirim_surat = $data['nama_pengirim_surat'];
      $valamat              = $data['alamat'];
      $vno_hp               = $data['no_hp'];
      $vemail               = $data['email'];
    }
  } else {
    $hapus = mysqli_query($koneksi, "DELETE FROM tbl_pengirim_surat WHERE id_pengirim='$_GET[id]'");
    if ($hapus) {
      echo "<script>
                  alert('Hapus Data Sukses');
                  document.location='?halaman=pengirim_surat';
                </script>";
    }
  }
}
?>

<div class="container mt-3">
  <div class="card-header bg-info text-white">
    Form Data Pengirim Surat
  </div>
  <div class="card-body">
    <form method="post" action="">
      <div class="form-group">
        <label for="nama_pengirim_surat">Nama Pengirim</label>
        <input type="text" class="form-control" id="nama_pengirim_surat" name="nama_pengirim_surat" value="<?= @$vnama_pengirim_surat ?>" required>
      </div>

      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= @$valamat ?>" required>
      </div>

      <div class="form-group">
        <label for="no_hp">No. HP</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= @$vno_hp ?>" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= @$vemail ?>" required>
      </div>

      <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
      <!-- <button type="reset" name="bbatal" class="btn btn-danger">Batal</button> -->
    </form>
  </div>
</div>

<!-- Cari -->
<!-- <div class="container mt-3">
  <div class="card-header bg-info text-white">
    Data Pengirim Surat
  </div>
  <div class="card-body">
    <form method="post" action="">
      <div class="form-group">
        <label for="keyword">Cari Data Pengirim Surat</label>
        <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Masukkan nama atau alamat">
        <button type="submit" name="bcari" class="btn btn-secondary mt-2">Cari</button>
      </div>
    </form>
  </div>
</div> -->
<!-- End Cari -->

<div class="container mt-3">
  <div class="card">
    <div class="card-header bg-info text-white">Data Pengirim Surat</div>
    <div class="card-body">
      <form method="post" action="" class="form-inline">
        <div class="form-group mb-2">
          <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Masukkan nama atau alamat" style="min-width: 300px;">
        </div>
        <button type="submit" name="bcari" class="btn btn-primary mb-2 ml-2">Cari</button>
      </form>
    </div>
  </div>

  <table class="table table-bordered table-hovered table-striped">
    <tr>
      <th>No</th>
      <th>Nama Pengirim Surat</th>
      <th>Alamat</th>
      <th>No HP</th>
      <th>Email</th>
      <th>Aksi</th>
    </tr>
    <?php
    // Logika untuk pencarian
    if (isset($_POST['bcari'])) {
      $keyword = $_POST['keyword'];
      $query = "SELECT * FROM tbl_pengirim_surat WHERE nama_pengirim_surat LIKE '%$keyword%' OR alamat LIKE '%$keyword%' ORDER BY id_pengirim DESC";
    } else {
      $query = "SELECT * FROM tbl_pengirim_surat ORDER BY id_pengirim DESC";
    }

    // Eksekusi query
    $tampil = mysqli_query($koneksi, $query);
    $no = 1;
    while ($data = mysqli_fetch_array($tampil)) :
    ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= $data['nama_pengirim_surat'] ?></td>
        <td><?= $data['alamat'] ?></td>
        <td><?= $data['no_hp'] ?></td>
        <td><?= $data['email'] ?></td>
        <td>
          <!-- Membuat button edit -->
          <a href="?halaman=pengirim_surat&hal=edit&id=<?= $data['id_pengirim'] ?>" class="btn btn-warning">Edit</a>
          <a href="?halaman=pengirim_surat&hal=hapus&id=<?= $data['id_pengirim'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>
  </div>
  </div>