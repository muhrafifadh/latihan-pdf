<?php

include("config.php");

if( isset($_GET['id']) ){

    // ambil id dari query string
    $id = $_GET['id'];

    $sql = "SELECT * FROM calon_siswa WHERE id=$id";
    $query = mysqli_query($db, $sql);
    if($query){
        $siswa = mysqli_fetch_array($query);
        $infodebug='aa';
        // Cek apakah file foto sebelumnya ada di folder images
        if(is_file($siswa['path_foto'])){
            // Jika foto ada
            unlink($siswa['path_foto']); // Hapus file foto sebelumnya yang ada di folder images
            $infodebug="berhasilunlink";
        }else{
            $infodebug="bukanfile".$siswa['path_foto'];
        }
    }

    // buat query hapus
    $sql = "DELETE FROM calon_siswa WHERE id=$id";
    $query = mysqli_query($db, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        header('Location: list-siswa.php?status=delsukses');
    } else {
        die("gagal menghapus...");
    }

} else {
    die("akses dilarang...");
}

?>