<?php
    include("db.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $checkQuery = "SELECT COUNT(*) as count FROM vitrina WHERE seccionAlojada = $id";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (!$checkResult) {
            die("Query failed: " . mysqli_error($conn));
        }

        $checkRow = mysqli_fetch_assoc($checkResult);
        $rowCount = $checkRow['count'];

        echo $rowCount;
    }
?>