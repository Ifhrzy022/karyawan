<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$op = $_GET['op'];

if ($op == "in") {

    if (empty($username) && empty($password)) {
        header('location:index.php?error=1');
        return;
    } elseif (empty($username)) {
        header('location:index.php?error=2');
        return;
    } elseif (empty($password)) {
        header('location:index.php?error=3');
        return;
    } else {
        $cek = mysqli_query($koneksi, "SELECT * FROM tbl_pns WHERE nip='$username' AND pwd=md5(md5('$password'))");

        if (mysqli_num_rows($cek) == 1) {
            $c = mysqli_fetch_array($cek);
            $_SESSION['userid'] = $c['nip'];
            $_SESSION['level'] = $c['level'];
            $_SESSION['name'] = $c['nama_pns'];
            $_SESSION['jab'] = $c['id_jabatan'];
            $_SESSION['pal'] = $c['id_palru'];

            if ($c['level'] == "admin") {
                header("location:panel_admin.php");
            } elseif ($c['level'] == "atasan") {
                header("location:panel_atasan.php");
            } elseif ($c['level'] == "pegawai") {
                header("location:panel_pegawai.php");
            } elseif ($c['level'] == "penilai") {
                header("location:panel_penilai.php");
            }
        } else {
            if (!$c['nip'] && !$c['level']) {
                header('location:index.php?error=4');
                return;
            } else {
                header('location:index.php?error=5');
                return;
            }
        }
    }

} elseif ($op == "out") {
    session_destroy();
    header("location:index.php");
    exit();
}
?>
