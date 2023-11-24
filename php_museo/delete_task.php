<?php

    include("db.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $imagequery = "SELECT fotoObjeto FROM objeto WHERE id_inventario = $id";
        $result_image = mysqli_query($conn, $imagequery);
        if (!$result_image) {
            die("Query failed: " . mysqli_error($conn));
        }
        $row = mysqli_fetch_assoc($result_image);
        $fileName = $row['fotoObjeto'];
        $query = "DELETE FROM objeto WHERE id_inventario = $id";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        $fileDestination = 'includes/Images/' . $fileName;
        if (file_exists($fileDestination)) {
            unlink($fileDestination);
        }
        $_SESSION['message'] = 'Fila removida exitosamente';
        $_SESSION['message_type'] = 'success';
        header("Location: index.php");
    }

?>