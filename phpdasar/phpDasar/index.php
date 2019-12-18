<?php

session_start();
require_once 'config/functions.php';

if (!isset($_SESSION['login'])) {
	header("Location: login.php");
	exit;
}

// pagination
// konfigurasi
$jumlahDataPerHalaman = 5;
// jumlah halaman = total data / data per halaman
$jumlahDataMahasiswa = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahDataMahasiswa / $jumlahDataPerHalaman);
// $halamanAktif = isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
if(isset($_GET['halaman'])) {
	$halamanAktif = $_GET['halaman'];

} else {
	$halamanAktif = 1;
}
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


// $result = mysqli_query($conn, "SELECT * FROM mahasiswa");
// $jumlahDataMahasiswa = mysqli_num_rows($result);
// var_dump($jumlahData);



$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

// Tombol Cari ditekan
if (isset($_POST["search"])) {
	$mahasiswa = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Halaman Admin</title>
</head>

<body>
	<a href="logout.php">Logout</a>

	<h1>Daftar Mahasiswa</h1>



	<a href="tambahdata.php">Tambah data mahasiswa</a>
	<br><br>

	<form action="" method="post">
		<input type="text" name="keyword" id="keyword" size="40" autofocus placeholder="Cari Mahasiswa" autocomplete="off">
		<button type="submit" name="search" id="search">Cari</button>
	</form>

	<!-- Navigasi Pagination -->
	<?php if($halamanAktif > 1) : ?>
<a href="?halaman=<?= $halamanAktif- 1; ?>">&lt;</a>
	<?php endif; ?>

	<?php for($i = 1; $i <= $jumlahHalaman; $i++): ?>
		<?php if($i == $halamanAktif) : ?>
		<a href="?halaman=<?= $i; ?>" style="font-weight: bold; color:black;"><?= $i; ?></a>
		<?php else : ?>
			<a href="?halaman=<?= $i; ?>" style="color:black;"><?= $i; ?></a>
		<?php endif; ?>
	<?php endfor; ?>

	<?php if($halamanAktif < $jumlahHalaman) : ?>
<a href="?halaman=<?= $halamanAktif+ 1; ?>">&gt;</a>
	<?php endif; ?>
	<!-- End Navigasi Pagination -->
<div id="container">
	<table border="1" cellpadding="10" cellspacing="0">

		<tr>
			<th>No.</th>
			<th>Aksi</th>
			<th>Gambar</th>
			<th>nim</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Jurusan</th>
		</tr>

		<?php $i = 1; ?>
		<?php foreach ($mahasiswa as $row) : ?>
			<tr>
				<td><?= $i; ?></td>
				<td>
					<a href="ubahdata.php?id=<?= $row["id"]; ?>">ubah</a> |
					<a href="hapusdata.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
				</td>
				<td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
				<td><?= $row["nim"]; ?></td>
				<td><?= $row["nama"]; ?></td>
				<td><?= $row["email"]; ?></td>
				<td><?= $row["jurusan"]; ?></td>
			</tr>
			<?php $i++; ?>
		<?php endforeach; ?>

	</table>
	</div>
<script src="js/script.js"></script>
</body>

</html>