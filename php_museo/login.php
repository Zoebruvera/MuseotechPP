<?php 
include("db.php"); 
?>

<?php

if (isset($_POST['inputUser']) && isset($_POST['inputPassword'])) {
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['inputUser']);
    $password = validate($_POST['inputPassword']);

    if (empty($username)) {
        header("Location: Login_index.php?error=Un nombre de usuario es requerido");
        exit();
    } elseif (empty($password)) {
        header("Location: Login_index.php?error=Una contraseña es requerida");
        exit();
    } else {
        $sql = "SELECT * FROM usuarios WHERE usuarioNombre = '$username' AND usuarioContraseña = '$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['usuarioNombre'] === $username && $row['usuarioContraseña'] === $password) {
                $_SESSION['usuarioNombre'] = $row['usuarioNombre'];
                $_SESSION['usuarioContraseña'] = $row['usuarioContraseña'];
                $_SESSION['login_success'] = true;
                header("Location: index.php");
                exit();
            } else {
                header("Location: Login_index.php?error=Nombre de usuario o contraseña incorrecto");
                exit();
            }
        } else {
            header("Location: Login_index.php?error=Nombre de usuario o contraseña incorrecto");
            exit();
        }
    }

} else {
    $_SESSION['usuarioNombre'] = null;
    $_SESSION['usuarioContraseña'] = null;
    $data = null;
    header("Location: Login_index.php");
    exit();
}

?>