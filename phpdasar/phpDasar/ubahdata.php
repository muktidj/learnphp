<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once "config/functions.php";

// Ambiil Data diURL
$id = $_GET['id'];
// var_dump($id);

// Query Ubah data Mahasiswa Berdasarkan ID
$queryUpdateData = query("SELECT * FROM mahasiswa WHERE id = $id")[0];
var_dump($queryUpdateData["nim"]);

// Cek apakah tombol submit sudah ditekan || belum
if (isset($_POST['submit'])) {
    // var_dump($_POST);

    // <div style=position:absolute; top:0; bottom:0 left:0; right:0; background-color:black; font-size:100px; color:red; text-align:center;> HAHAHAHA ANDA TELAH DIHACK</div>




    // apakah data berhasil diubah || tidak
    if (ubah($_POST) > 0) {
        echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'index.php';
			</script>
		";
    } else {
        echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'index.php';
			</script>
		";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> </title>
</head>

<body>
    <h1>Ubah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $queryUpdateData["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $queryUpdateData["gambar"]; ?>">
        <ul>
            <li>
                <label for="nim">NIM :</label>

                <input type="text" name="nim" id="nim" value="<?= $queryUpdateData['nim'] ?>">
            </li>
            <li>
                <label for="nama">Nama :</label>

                <input type="text" name="nama" id="nama" value="<?= $queryUpdateData['nama'] ?>">
            </li>
            <li>
                <label for="email">Email :</label>

                <input type="text" name="email" id="email" value="<?= $queryUpdateData['email'] ?>">
            </li>
            <li>
                <label for=" jurusan">Jurusan :</label>

                <input type="text" name="jurusan" id="jurusan" value="<?= $queryUpdateData['jurusan'] ?>">
            </li>
            <li>
                <label for="gambar">Gambar :</label><br>
                <img src="../img/<?= $queryUpdateData['gambar'] ?>" width="40" height="40"><br>

                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <button type=" submit" name="submit">ubah</button>
            </li>
        </ul>
    </form>

</body>

</html>