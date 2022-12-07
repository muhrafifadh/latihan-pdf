<?php

include("config.php");


if(isset($_POST['simpan'])){

    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah = $_POST['sekolah_asal'];
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    $fotobaru = date('dmYHis').$foto;

    $path = "../crud_upload/images/".$fotobaru;

    if(empty($foto)){
        // tidak upload foto
        // buat query update
        $sql = "UPDATE calon_siswa SET nama='$nama', alamat='$alamat', jenis_kelamin='$jk', agama='$agama', sekolah_asal='$sekolah' WHERE id=$id";
        $query = mysqli_query($db, $sql);

        // apakah query update berhasil?
        if( $query ) {
            // kalau berhasil alihkan ke halaman list-siswa.php
            header('Location: list-siswa.php?status=edsukses');
        } else {
            // kalau gagal tampilkan pesan
            die("Gagal menyimpan perubahan...");
        }      
    }else{

        // upload dulu
        if(move_uploaded_file($tmp, $path)){
            $sql = "SELECT * from calon_siswa WHERE id=$id";
            $query = mysqli_query($db, $sql);
            if(!$query){
                echo "Terjadi kesalahan dalam mengquery: ". $sql;
                return;
            }
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

            // buat query update
            $sql = "UPDATE calon_siswa SET nama='$nama', alamat='$alamat', jenis_kelamin='$jk', agama='$agama', sekolah_asal='$sekolah', path_foto='$path' WHERE id=$id";
            $query = mysqli_query($db, $sql);

            // apakah query update berhasil?
            if( $query ) {
                // kalau berhasil alihkan ke halaman list-siswa.php
                header("Location: list-siswa.php?status=edsukses");
            } else {
                // kalau gagal tampilkan pesan
                die("Gagal menyimpan perubahan...");
            }  
    }
    }





} else {
    die("Akses dilarang...");
}

?>