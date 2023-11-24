<?php
    include("db.php");

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM objeto WHERE id_inventario = $id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result);
            $idObjeto = $row['id_inventario'];
            $nombreObjeto = $row['Nombre_obj'];
            $Clasific = $row['Clasificación'];
            $Descrip = $row['Descripción'];
            $fechaAlta = $row['Fecha_alta'];
            $fechaBaja = $row['Fecha_baja'];
            $SeccNombre = $row['SecciónNombre'];
            $SeccVitrina = $row['SecciónVitrina'];
        }
    }

    if (isset($_POST['Update'])) {
        $id = $_GET['id'];
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
        $query = "UPDATE objeto SET id_inventario = '$idObjeto', Nombre_obj = '$nombreObjeto', Clasificación = '$Clasific', Descripción = '$Descrip', Fecha_alta = '$fechaAlta', Fecha_baja = '$fechaBaja', SecciónNombre = '$SeccNombre', SecciónVitrina = '$SeccVitrina' WHERE id_inventario = $id";
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
                    <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
                        <div class="form-group mb-md-3">
                            <label for="identidad">ID:</label>
                            <input type="number" name="identidad" value="<?php echo $idObjeto; ?>" class="form-control" placeholder="Actualizar ID">
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" value="<?php echo $nombreObjeto; ?>" class="form-control" placeholder="Actualizar nombre">
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="clasificacion">Clasificación:</label>
                            <input type="text" name="clasificacion" value="<?php echo $Clasific; ?>" class="form-control" placeholder="Actualizar tipo">
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="descripcion">Descripción:</label>
                            <textarea name="descripcion" rows="4" class="form-control" placeholder="Actualizar descripción"><?php echo $Descrip; ?></textarea>
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="fecha_alta">Fecha de alta:</label>
                            <input type="date" name="fecha_alta" value="<?php echo $fechaAlta; ?>" class="form-control" placeholder="Actualizar fecha alta">
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="fecha_baja">Fecha de baja:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="fechaValor" id="fechaValor1" value="1" checked>
                                <label class="form-check-label" for="fechaValor1">Sin fecha de baja</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="fechaValor" id="fechaValor2">
                                <label class="form-check-label" for="fechaValor2">Añadir valor</label>
                                <input type="date" name="fecha_baja" value="<?php echo $fechaBaja; ?>" class="form-control" id="fechaInput" placeholder="YYYY-MM-DD" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="seccionesNombre">Sección:</label>
                            <select name="seccionesNombre" class="form-select mb-md-1" id="seccionesNombre">
                                <option selected><?php echo $SeccNombre; ?></option>
                                <?php
                                $query = "SELECT * FROM seccion";
                                $result_secciones = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result_secciones)) { ?>
                                    <option value="<?php echo $row['id_seccion']?>"><?php echo $row['seccNombre'] ?></option>
                                <?php } ?>
                            </select>
                            <select name="seccionesVitr" class="form-select mb-md-1" id="seccionesVitr">
                                <option selected><?php echo $SeccVitrina; ?></option>
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