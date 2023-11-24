<?php

include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $selectedSeccion = $_GET['selectedSeccion'];
    $query = "SELECT * FROM vitrina WHERE seccionAlojada = '$selectedSeccion'";
    $result_secciones = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result_secciones)) { ?>
        <option value="<?php echo $row['id_vitrina']?>"><?php echo $row['id_vitrina'] ?></option>
    <?php }
}
?>