<!DOCTYPE html>
<html>

<head>
    <title>Cetak Rekapitulasi Data Surat Keluar</title>
    <style>
        /* Tambahkan jarak antara tabel dan form tanda tangan */
        .footer {
            margin-block-start: 20px;
        }
    </style>
</head>

<body>
    <div class="header" style="text-align: center;">
        <img src="assets/img/jateng.png" width="90" height="74" style="float: inline-start; margin-inline-end: 5px;">
        <div style="display: inline-block; text-align: start;">
            <center>
                <h3 style="margin: 5px 0;">REKAPITULASI DATA SURAT KELUAR</h3>
                <h3 style="margin: 5px 0;">DESA TAMBAHARJO</h3>
                <h3 style="margin: 5px 0;">KABUPATEN PATI</h3>
            </center>
        </div>
    </div>

    <?php
    include "config/koneksi.php"
    ?>
    <table border="1" cellpadding="3">
        <tr>
            <th>No</th>
            <th>No Surat</th>
            <th>Tanggal Surat</th>
            <th>Perihal</th>
            <th>Departemen / Tujuan</th>
            <th>File</th>
        </tr>
        <?php
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
        $tgl1 = $_POST['tanggal1b'];
        $tgl2 = $_POST['tanggal2b'];
        $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_keluar WHERE (no_surat1 LIKE '%$keyword%' OR tanggal_surat1 LIKE '%$keyword%' OR perihal1 LIKE '%$keyword%' OR id_departemen1 LIKE '%$keyword%') AND tanggal_surat1 BETWEEN '$tgl1' AND '$tgl2' ORDER BY id_arsip1 DESC");
                                        
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
        <?php } ?>
    </table>

   <!-- Tanda Tangan -->
<div class="footer" style="float: inline-end;">
    <div style="display: inline-block; text-align: end; margin-inline-end: 50px;">
        <center>
            <h4 style="margin: 0px;">Pati, <?php echo date('d F Y'); ?></h4>
            <h4 style="margin: 0px;">Mengetahui,</h4>
            <h4 style="margin: 0px;">Kepala Desa</h4>
            <h4 style="margin-block-end: 5px;">&nbsp;</h4>
            <h4 style="margin-block-end: 5px;">&nbsp;</h4>
            <h4 style="margin: 0px;">Supardi</h4>
        </center>
    </div>
</div>


    <script>
        window.print()
    </script>
</body>

</html>
