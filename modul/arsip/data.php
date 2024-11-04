<?php
// Cek jika tombol pencarian diklik
$where = "";
if (isset($_POST['bcari'])) {
  $keyword = $_POST['keyword'];
  $where = "WHERE 
    tbl_arsip.perihal LIKE '%$keyword%' OR 
    tbl_pengirim_surat.nama_pengirim_surat LIKE '%$keyword%' OR 
    tbl_pengirim_surat.alamat LIKE '%$keyword%' OR
    tbl_arsip.no_surat LIKE '%$keyword%' OR
    tbl_arsip.tanggal_surat LIKE '%$keyword%' OR
    tbl_arsip.tanggal_diterima LIKE '%$keyword%' OR
    tbl_departemen.nama_departemen LIKE '%$keyword%'";
}

// Query untuk menampilkan data arsip surat masuk
$tampil = mysqli_query($koneksi, "
    SELECT
      tbl_arsip.*,
      tbl_departemen.nama_departemen,
      tbl_pengirim_surat.nama_pengirim_surat,
      tbl_pengirim_surat.no_hp
    FROM 
      tbl_arsip
    INNER JOIN tbl_departemen ON tbl_arsip.id_departemen = tbl_departemen.id_departemen
    INNER JOIN tbl_pengirim_surat ON tbl_arsip.id_pengirim = tbl_pengirim_surat.id_pengirim
    $where
  ");

$no = 1;
?>
<div class="container mt-3">
  <div class="card">
    <div class="card-header bg-info text-white">Data Surat Masuk</div>
    <div class="card-body">
      <form method="post" action="" class="form-inline">
        <div class="form-group mb-2">
          <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Masukkan nama atau alamat" style="min-width: 300px;">
        </div>
        <button type="submit" name="bcari" class="btn btn-primary mb-2 ml-2">Cari</button>
      </form>
    </div>
  </div>

  <div class="card-body">
    <a href="?halaman=arsip_surat&hal=tambahdata" class="btn btn-info mb-3">Tambah Data</a>
    <table class="table table-bordered table-hovered table-striped">
      <tr>
        <th>No</th>
        <th>No Surat</th>
        <th>Tanggal Surat</th>
        <th>Tanggal Diterima</th>
        <th>Perihal</th>
        <th>Departemen / Tujuan</th>
        <th>Pengirim</th>
        <th>File</th>
        <th>Aksi</th>
      </tr>
      <?php
      $no = 1; // Reset nomor urut
      // Tampilkan data arsip surat masuk
      while ($data = mysqli_fetch_array($tampil)) :
      ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $data['no_surat'] ?></td>
          <td><?= $data['tanggal_surat'] ?></td>
          <td><?= $data['tanggal_diterima'] ?></td>
          <td><?= $data['perihal'] ?></td>
          <td><?= $data['nama_departemen'] ?></td>
          <td><?= $data['nama_pengirim_surat'] ?> / <?= $data['no_hp'] ?></td>
          <td><?= $data['file'] ?></td>
          <td>
            <?php if (!empty($data['file'])) : ?>
              <a href="file/<?= $data['file'] ?>" target="_blank" class="btn btn-warning">Lihat File</a>
            <?php endif; ?>
            <a href="?halaman=arsip_surat&hal=edit&id=<?= $data['id_arsip'] ?>" class="btn btn-warning">Edit</a>
            <a href="?halaman=arsip_surat&hal=hapus&id=<?= $data['id_arsip'] ?>" class="btn btn-danger mx-2" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>

          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>