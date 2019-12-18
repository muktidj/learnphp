<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query)
{
	global $conn;
	// var_dump($query);die;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}



function tambah($data)
{
	global $conn;
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	// Upload gambar
	$gambar = upload();
	if (!$gambar) {
		return false;
	}

	$query = "INSERT INTO mahasiswa
				VALUES
			  ('', '$nim', '$nama', '$email', '$jurusan', '$gambar')
			";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function upload()
{
	$namaFileGambar = $_FILES['gambar']['name'];
	$ukuranFileGambar = $_FILES['gambar']['size'];
	$erorFileGambar = $_FILES['gambar']['error'];
	$tmpNameFileGambar = $_FILES['gambar']['tmp_name'];

	// Cek Apakah tidak ada gambar yang diupload
	if ($erorFileGambar === 4) {
		echo "<script>
			alert('Pilih Gambar terlebih dahulu');
		</script>";
		return false;
	}

	// Cek apakah yang diupload gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFileGambar);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "<script>
		 	alert('Yang diupload bukan ektensi gambar!')
		 </script>";
		return false;
	}

	//  cek jika ukurannya terlalu besar
	if ($ukuranFileGambar > 3000000) {
		echo "<script>
		alert('Terlalu Besar Ukuran gambar')
		</script>";
		return false;
	}

	// Lolos pengecekan
	// generate nama gambar baru
	$namaFileGambarBaru = uniqid();
	$namaFileGambarBaru .= '.';
	$namaFileGambarBaru .= $ekstensiGambar;


	move_uploaded_file($tmpNameFileGambar, '../img/' . $namaFileGambarBaru);

	return $namaFileGambarBaru;
}

function hapus($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
	return mysqli_affected_rows($conn);
}
function ubah($data)
{
	global $conn;
	$id = $data["id"];
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);

	$gambarLama = $data['gambarLama'];
	// cek apakah user pilih gambar baru atau tidak
	if ($_FILES['gambar']['error'] === 4) {
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}

	$query = "UPDATE mahasiswa SET
				nim = '$nim',
				nama = '$nama',
				email = '$email',
				jurusan = '$jurusan',
				gambar = '$gambar'
			  WHERE id = $id
			";
	// var_dump($query); die;
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function cari($keyword)
{
	$querySearchMahasiswa = "SELECT * FROM mahasiswa
	WHERE nama LIKE '%$keyword%'
	OR nim LIKE '%$keyword%'
	OR jurusan LIKE '%$keyword%'
	OR email LIKE '%$keyword%'
	";

	return query($querySearchMahasiswa);
}



function registrasi($data)
{
	global $conn;

	$username = strtolower(stripslashes($data['username']));
	$password = mysqli_real_escape_string($conn, $data['password']);
	$password2 = mysqli_real_escape_string($conn, $data['password2']);


	// Cek Username sudah ada atau belum
	$result= mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
	if(mysqli_fetch_assoc($result)) {
		echo "<script>
		alert('username sudah terdaftar, ganti username')
		</script>";
		return false;
	}


	// Cek Konfirmasi Password
	if ($password !== $password2) {
		echo "<script>
		alert('Konfirmasi Password tidak sesuai')
	</script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_ARGON2I);

	// tambahkan userbaru keDB
	$queryUsers = "INSERT INTO users
				VALUES
			  ('', '$username', '$password')
			";
	mysqli_query($conn, $queryUsers);
	return mysqli_affected_rows($conn);

}
