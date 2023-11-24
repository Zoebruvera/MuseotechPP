<?php

include("db.php");

if (isset($_POST['save_seccion'])) {
    $idSeccion = htmlspecialchars($_POST['idSeccion']);
    $nombreSeccion = htmlspecialchars($_POST['nombredeSeccion']);

    $query = "INSERT INTO seccion(id_seccion, seccNombre) 
    VALUES('$idSeccion', '$nombreSeccion');";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $_SESSION['message'] = 'Nueva fila introducida';
    $_SESSION['message_type'] = 'success';
    header("Location: index.php");
}
?>