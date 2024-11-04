<?php
// Proses pencarian
$keyword = ""; // Definisikan variabel $keyword
if (isset($_POST['bcari'])) {
    $keyword = $_POST['keyword'];
    $query = "SELECT * FROM tbl_keluar WHERE no_surat1 LIKE '%$keyword%' OR tanggal_surat1 LIKE '%$keyword%' OR perihal1 LIKE '%$keyword%' OR id_departemen1 LIKE '%$keyword%' ORDER BY id_arsip1 DESC";
    $result = mysqli_query($koneksi, $query);
} else {
    // Jika tidak ada pencarian, tampilkan semua data
    $query = "SELECT * FROM tbl_keluar ORDER BY id_arsip1 DESC";
    $result = mysqli_query($koneksi, $query);
}
?>

<!-- Tambahkan kode HTML untuk menampilkan hasil pencarian di sini -->

<div class="container mt-3">
    <div class="card">
        <div class="card-header bg-info text-white">Data Surat Keluar</div>
        <div class="card-body">
            <form method="post" action="" class="form-inline">
                <!-- <div class="form-group mb-2">
                    <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Masukkan kata kunci" style="min-width: 300px;">
                </div> -->
                <!-- <button type="submit" name="bcari" class="btn btn-primary mb-2 ml-2">Cari</button> -->
                <div class="card-body">
                    <form method="POST" action="" class="text-center">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Dari Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal1" value="<?= isset($_POST['tanggal1']) ? $_POST['tanggal1'] : date('Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sampai Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal2" value="<?= isset($_POST['tanggal2']) ? $_POST['tanggal2'] : date('Y-m-d') ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-2">
                                <button class="btn btn-primary form-control" name="btampilkan"><i class="fa fa-search"></i> Tampilkan</button>
                            </div>
                            <div class="col-md-2">
                                <a href="dashboard.php" class="btn btn-danger form-control"><i class="fa fa-backward"></i> Kembali</a>
                            </div>
                        </div>
                    </form>

                    <?php
                    if (isset($_POST['btampilkan'])) :
                    ?>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat</th>
                                        <th>Tanggal Surat</th>
                                        <th>Perihal</th>
                                        <th>Departemen / Tujuan</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'config/koneksi.php';

                                    $tgl1 = $_POST['tanggal1'];
                                    $tgl2 = $_POST['tanggal2'];

                                    $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_keluar WHERE (no_surat1 LIKE '%$keyword%' OR tanggal_surat1 LIKE '%$keyword%' OR perihal1 LIKE '%$keyword%' OR id_departemen1 LIKE '%$keyword%') AND tanggal_surat1 BETWEEN '$tgl1' AND '$tgl2' ORDER BY id_arsip1 DESC");

                                    // Memeriksa apakah ada data yang ditemukan sebelum memulai perulangan
                                    if (mysqli_num_rows($tampil) > 0) {
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($tampil)) {
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $data['no_surat1'] ?></td>
                                                <td><?= $data['tanggal_surat1'] ?></td>
                                                <td><?= $data['perihal1'] ?></td>
                                                <td><?= $data['id_departemen1'] ?></td>
                                                <td><?= $data['file'] ?></td>
                                            </tr>
                                    <?php
                                        }
                                    } else { ?>
                                        <div class="alert alert-info">Data tidak ditemukan.</div>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <div class="container">
                                <div class="row">
                                   

                                    <!-- Export PDF Button -->
                                    <div class="col-md-6">
                                        <form method="POST" action="cetak.php">
                                            <input type="hidden" name="tanggal1b" value="<?= isset($_POST['tanggal1']) ? $_POST['tanggal1'] : '' ?>">
                                            <input type="hidden" name="tanggal2b" value="<?= isset($_POST['tanggal2']) ? $_POST['tanggal2'] : '' ?>">
                                            <button class="btn btn-danger form-control" name="bexport">
                                                <i class="fa fa-download"></i> Cetak
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body">
        <a href="?halaman=arsip_surat_keluar&hal=tambahdata" class="btn btn-info mb-3">Tambah Data</a>
        <?php if (mysqli_num_rows($result) > 0) : ?>
            <table class="table table-bordered table-hover">
                <tr>
                    <th>No</th>
                    <th>No Surat</th>
                    <th>Tanggal Surat</th>
                    <th>Perihal</th>
                    <th>Departemen / Tujuan</th>
                    <th>File</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($result)) :
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['no_surat1'] ?></td>
                        <td><?= $data['tanggal_surat1'] ?></td>
                        <td><?= $data['perihal1'] ?></td>
                        <td><?= $data['id_departemen1'] ?></td>
                        <td><?= $data['file'] ?></td>
                        <td>
                            <?php if (!empty($data['file'])) : ?>
                                <a href="file/<?= $data['file'] ?>" target="_blank" class="btn btn-warning"> Lihat File</a>
                            <?php endif; ?>
                            <a href="?halaman=arsip_surat_keluar&hal=edit&id=<?= $data['id_arsip1'] ?>" class="btn btn-warning">Edit</a>
                            <a href="?halaman=arsip_surat_keluar&hal=hapus&id=<?= $data['id_arsip1'] ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else : ?>
            <div class="alert alert-info">Data tidak ditemukan.</div>
        <?php endif; ?>
    </div>
</div>
<?php
// Tutup koneksi database
mysqli_close($koneksi);
?>
