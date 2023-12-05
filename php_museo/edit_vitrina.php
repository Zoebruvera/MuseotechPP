<?php
    include("db.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM vitrina WHERE id_vitrina = $id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $idVitrina = $row['id_vitrina'];
            $nombreSeccionAlojada = $row['seccionAlojada'];
        }
    }

    if (isset($_POST['Update'])) {
        $id = $_GET['id'];
        $idVitrina = htmlspecialchars($_POST['idVitrina']);
        $nombreSeccionAlojada = htmlspecialchars($_POST['nombredeSeccionAlojada']);
        
        $query = "UPDATE vitrina SET id_vitrina = '$idVitrina', seccionAlojada = '$nombreSeccionAlojada' WHERE id_vitrina = $id";
        mysqli_query($conn, $query);

        $_SESSION['message'] = 'Fila actualizada exitosamente';
        $_SESSION['message_type'] = 'success';
        header("Location: index.php");
    }

    if (isset($_POST['Undo'])) {
        header("Location: index.php");
    }
?>

<?php include("includes/header.php") ?>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand mx-md-2">
            <img src="includes/Images/EscudoOttoKrause.png" width="30" height="30" class="d-inline-block align-top" alt=""> OTTO KRAUSE MUSEO TECNOLÓGICO
        </a>
    </nav>
    <div class="container p-4">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card card-body">
                    <form action="edit_vitrina.php?id=<?php echo $_GET['id']; ?>" method="POST">
                        <div class="form-group mb-md-3">
                            <label for="idVitrina">ID de vitrina:</label>
                            <input type="number" name="idVitrina" class="form-control" value="<?php echo $idVitrina; ?>" placeholder="ID" autofocus>
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="nombredeSeccionAlojada">Nombre de la sección:</label>
                            <select name="nombredeSeccionAlojada" class="form-select" id="nombredeSeccionAlojada">
                                <option selected><?php echo $nombreSeccionAlojada; ?></option>
                                <?php
                                $query = "SELECT seccNombre FROM seccion";
                                $result_secciones = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result_secciones)) { ?>
                                    <option value="<?php echo $row['seccNombre']?>"><?php echo $row['seccNombre'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button class="btn btn-success" name="Update">
                            Actualizar
                        </button>
                        <button class="btn btn-secondary" name="Undo">
                            Volver
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include("includes/footer.php") ?>