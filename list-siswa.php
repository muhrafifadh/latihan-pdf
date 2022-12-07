<?php include("config.php"); ?> 

<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Siswa Baru | SMK Coding</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <h3>Siswa yang sudah mendaftar</h3>
    </header>

    <nav>
        <a href="form-daftar.php">[+] Tambah Baru</a>
        <a href="cetakpdf.php">[+] Unduh PDF</a>
    </nav>

    <br>

    <div>
        <table border="1" class="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Sekolah Asal</th>
                <th>Foto</th>
                <th>Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM calon_siswa";
            $query = mysqli_query($db, $sql);
            if(!$query){
                echo "Terjadi kesalahan dalam mengquery: ". $sql;
                return;
            }
            $total_siswa = 0;
            while($siswa = mysqli_fetch_array($query)){
                echo "<tr>";

                echo "<td>".$siswa['id']."</td>";
                echo "<td>".$siswa['nama']."</td>";
                echo "<td>".$siswa['alamat']."</td>";
                echo "<td>".$siswa['jenis_kelamin']."</td>";
                echo "<td>".$siswa['agama']."</td>";
                echo "<td>".$siswa['sekolah_asal']."</td>";
                echo "<td> <img src='".$siswa['path_foto']."' width='100' height='100' alt='foto".$siswa['nama']."'> </td>";
                echo "<td>";
                echo "<a href='form-edit.php?id=".$siswa['id']."'>Edit</a> | ";
                echo "<a href='hapus.php?id=".$siswa['id']."'>Hapus</a>";
                echo "</td>";

                echo "</tr>";
                $total_siswa+=1;
            }
            ?>

        </tbody>
        </table>
    </div>

    <p>Total: <?php echo $total_siswa ?></p>
    <?php if(isset($_GET['status'])): ?>
    <p>
        <?php
            if($_GET['status'] == 'delsukses'){
                echo "Penghapusan siswa berhasil!";
            } else if($_GET['status'] == 'edsukses'){
                echo "Penyuntingan berhasil";
            } else{
                echo "Tindakan gagal";
            }
        ?>
    </p>
    <?php endif; ?>
    <a href="index.php">Kembali</a>
    </body>
</html>