<?php

    include("db.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM seccion WHERE id_seccion = $id";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        $_SESSION['message'] = 'Fila removida exitosamente';
        $_SESSION['message_type'] = 'success';
        header("Location: index.php");
    }

?>