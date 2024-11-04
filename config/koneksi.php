<?php

    //koneksi database
    //masukkan identitas server (function)
    $server   = "localhost";
    $user     = "root"; //username database server
    $pass     = "";
    $database = "dbarsip";

    //koneksi database
    $koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));
    $query = "SELECT * FROM tbl_keluar";
$result = mysqli_query($koneksi, $query);
?>
<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "dbarsip";

try {    
    //create PDO connection 
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}
