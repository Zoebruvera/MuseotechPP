<?php
include("db.php");
if (isset($_POST['save_vitrina'])) {
    $idVitrina = htmlspecialchars($_POST['idVitrina']);
    $nombreSeccionAlojada = htmlspecialchars($_POST['nombredeSeccionAlojada']);
    $file = $_FILES['vitrinaImagen'];
    $fileName = $_FILES['vitrinaImagen']['name'];
    $fileTmpName = $_FILES['vitrinaImagen']['tmp_name'];
    $fileSize = $_FILES['vitrinaImagen']['size'];
    $fileError = $_FILES['vitrinaImagen']['error'];
    $fileType = $_FILES['vitrinaImagen']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowedFile = array('jfif', 'jpeg', 'jpg', 'png', 'webp');
    if (in_array($fileActualExt, $allowedFile)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'includes/Images/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            } else {
                echo "El tamaño de la imagen es muy grande! Procura que el tamaño sea menor a 500000 kb (500 mb)";
            }
        } else {
            echo "Hubo un error al subir la imagen!";
        }
    } else {
        echo "No puede subir imagenes con este formato! Los formatos permitidos son .JFIF, .JPEG, .JPG, .PNG y .WEBP";
    }

    $query = "INSERT INTO vitrina(fotoVitrina, id_vitrina, seccionAlojada) 
    VALUES('$fileNameNew', '$idVitrina', '$nombreSeccionAlojada');";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $_SESSION['message'] = 'Nueva fila introducida';
    $_SESSION['message_type'] = 'success';

    header("Location: index.php");
    exit();
}
?>