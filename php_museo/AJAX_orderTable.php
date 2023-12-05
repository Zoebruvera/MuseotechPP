<?php

include("db.php");

$selectedColumn = $_POST['selectedColumn'];
$selectedOrder = $_POST['selectedOrder'];
$query = "SELECT * FROM objeto ORDER BY $selectedColumn $selectedOrder";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
?>