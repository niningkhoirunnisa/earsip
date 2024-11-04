<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>E-Arsip | BALAI DESA TAMBAHARJO</title>
</head>
<body>
    <!-- awal nav/menu -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="?" style="font-weight: bold; position:relative;">E-Arsip</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item <?php if(empty($_GET['halaman']) || $_GET['halaman'] == '') echo 'active'; ?>">
                        <a class="nav-link" href="?">Beranda <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item <?php if(isset($_GET['halaman']) && $_GET['halaman'] == 'departemen') echo 'active'; ?>">
                        <a class="nav-link" href="?halaman=departemen">Data Departemen</a>
                    </li>
                    <li class="nav-item <?php if(isset($_GET['halaman']) && $_GET['halaman'] == 'pengirim_surat') echo 'active'; ?>">
                        <a class="nav-link" href="?halaman=pengirim_surat">Data Pengirim Surat</a>
                    </li>
                    <li class="nav-item <?php if(isset($_GET['halaman']) && $_GET['halaman'] == 'arsip_surat') echo 'active'; ?>">
                        <a class="nav-link" href="?halaman=arsip_surat">Arsip Surat Masuk </a>
                    </li>
                    <li class="nav-item <?php if(isset($_GET['halaman']) && $_GET['halaman'] == 'arsip_surat_keluar') echo 'active'; ?>">
                        <a class="nav-link" href="?halaman=arsip_surat_keluar">Arsip Surat Keluar </a>
                    </li>
                </ul>
                <a class="btn btn-outline-light btn-lg" href="index.php" role="button">Logout</a>
                <!-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>
    <!-- akhir nav/menu -->

    <!-- awal container -->
    <div class="container">
        <!-- Isi konten di sini -->
    </div>
    <!-- akhir container -->

    <!-- Bootstrap JS and jQuery (Jangan lupa tambahkan jQuery sebelum Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Script untuk membuat menu yang diklik tetap bold -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
            navLinks.forEach(function(navLink) {
                navLink.addEventListener("click", function() {
                    navLinks.forEach(function(link) {
                        link.classList.remove("active");
                    });
                    this.classList.add("active");
                });
            });
        });
    </script>
</body>
</html>
