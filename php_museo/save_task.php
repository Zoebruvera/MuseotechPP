<?php

include("db.php");

if (isset($_POST['save_task'])) {
    $idObjeto = htmlspecialchars($_POST['identidad']);
    $nombreObjeto = htmlspecialchars($_POST['nombre']);
    $Clasific = htmlspecialchars($_POST['clasificacion']);
    $Descrip = htmlspecialchars($_POST['descripcion']);
    $fechaAlta = htmlspecialchars($_POST['fecha_alta']);
    if (isset($_POST['fechaValor1']) && $_POST['fechaValor1'] == 1) {
        $fechaBaja = '';
    } else {
        $fechaBaja = htmlspecialchars($_POST['fecha_baja']);
    }
    $SeccNombre = htmlspecialchars($_POST['seccionesNombre']);
    $SeccVitrina = htmlspecialchars($_POST['seccionesVitr']);
    $file = $_FILES['objetoImagen'];
    $fileName = $_FILES['objetoImagen']['name'];
    $fileTmpName = $_FILES['objetoImagen']['tmp_name'];
    $fileSize = $_FILES['objetoImagen']['size'];
    $fileError = $_FILES['objetoImagen']['error'];
    $fileType = $_FILES['objetoImagen']['type'];
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

    $query = "INSERT INTO objeto(fotoObjeto, id_inventario, Nombre_obj, Clasificación, Descripción, Fecha_alta, Fecha_baja, SecciónNombre, SecciónVitrina) 
    VALUES('$fileNameNew', '$idObjeto', '$nombreObjeto', '$Clasific', '$Descrip', '$fechaAlta', '$fechaBaja', '$SeccNombre', '$SeccVitrina');";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $_SESSION['message'] = 'Nueva fila introducida';
    $_SESSION['message_type'] = 'success';
    header("Location: index.php");
}
?>