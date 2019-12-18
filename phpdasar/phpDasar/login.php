<?php


session_start();
require_once "config/functions.php";
// set cookie

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }

}

// if (isset($_COOKIE['login'])) {
//     if ($_COOKIE['login'] == 'true') {
//         $_SESSION['login'] = true;
//     }
// }

// Set Session
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;

    // End Set Session
}


if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // Cek Password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {

            // Set Session
            $_SESSION["login"] = true;

            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']), time()+60);
                // setcookie('login', 'true', time() + 60);
            }
            header("Location: index.php");
            exit;
        }
    }

    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        body {

            text-align: center;
            margin: 0 auto;
        }

        li {
            display: inline-block;
            list-style: none;
        }
    </style>
</head>

<body>

    <h1>Halaman Login</h1>

    <?php if (isset($error)) : ?>
        <p style="color:red; font-style:italic;">Username/Password Salah</p>

    <?php endif; ?>


    <form action="" method="post">

        <ul>
            <li>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
            </li>


        </ul>
        <ul>
            <li class="remem">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </li>

        </ul>
        <ul>
            <li class="butt">
                <button type="submit" name="login">Login</button>
            </li>
            <li class="butt">
               <a href="registrasi.php">Belum punya akun</a>
            </li>
        </ul>
    </form>

</body>

</html>