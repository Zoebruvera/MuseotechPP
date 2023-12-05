<?php
    include("db.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM seccion WHERE id_seccion = $id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $idSeccion = $row['id_seccion'];
            $nombreSeccion = $row['seccNombre'];
        }
    }

    if (isset($_POST['Update'])) {
        $id = $_GET['id'];
        $idSeccion = htmlspecialchars($_POST['idSeccion']);
        $nombreSeccion = htmlspecialchars($_POST['nombredeSeccion']);
        
        $query = "UPDATE seccion SET id_seccion = '$idSeccion', seccNombre = '$nombreSeccion' WHERE id_seccion = $id";
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
                    <form action="edit_seccion.php?id=<?php echo $_GET['id']; ?>" method="POST">
                        <div class="form-group mb-md-3">
                            <label for="idSeccion">ID de sección:</label>
                            <input type="number" name="idSeccion" class="form-control" value="<?php echo $idSeccion; ?>" placeholder="ID" autofocus>
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="nombredeSeccion">Nombre:</label>
                            <input type="text" name="nombredeSeccion" value="<?php echo $nombreSeccion; ?>" class="form-control" placeholder="Ej.: Informática">
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