<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include("db.php") ?>

<?php include("includes/header.php") ?>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand mx-md-2">
            <img src="includes/Images/EscudoOttoKrause.png" width="30" height="30" class="d-inline-block align-top" alt=""> OTTO KRAUSE MUSEO TECNOLÓGICO
        </a>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#seccionModal">
            Gestionar sección/vitrina
        </button>
        <div class="modal fade" id="seccionModal" tabindex="-1" aria-labelledby="seccionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="seccionModalLabel">Gestionar secciones y vitrinas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container m-sm-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-body">
                                        <form action="save_seccion.php" method="POST" enctype="multipart/form-data">
                                            <div class="form-group mb-md-3">
                                                <label for="idSeccion">ID de sección:</label>
                                                <input type="number" name="idSeccion" class="form-control" placeholder="ID" autofocus>
                                            </div>
                                            <div class="form-group mb-md-3">
                                                <label for="nombredeSeccion">Nombre:</label>
                                                <input type="text" name="nombredeSeccion" class="form-control" placeholder="Ej.: Informática">
                                            </div>
                                            <input type="submit" class="btn btn-success btn-block" name="save_seccion" value="Guardar">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered" id="dataTable">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>id_seccion</th>
                                                <th>seccNombre</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $seccionquery = "SELECT * FROM seccion ORDER BY id_seccion ASC";
                                            $result_secc = mysqli_query($conn, $seccionquery);
                                            while ($row = mysqli_fetch_array($result_secc)) { ?>
                                                <tr>
                                                    <td><?php echo $row['id_seccion'] ?></td>
                                                    <td><?php echo $row['seccNombre'] ?></td>
                                                    <td>
                                                        <a href="edit_seccion.php?id=<?php echo $row['id_seccion']?>" class="btn btn-secondary btn-sm">
                                                            <i class="fa-solid fa-marker"></i>
                                                        </a>
                                                        <a href="delete_seccion.php?id=<?php echo $row['id_seccion']?>" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="container m-sm-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card card-body">
                                        <form action="save_vitrina.php" method="POST" enctype="multipart/form-data">
                                            <div class="mb-md-3">
                                                <label for="vitrinaImagen">Subir imagen</label>
                                                <input class="form-control" name="vitrinaImagen" type="file" id="subirImagen">
                                            </div>
                                            <div class="form-group mb-md-3">
                                                <label for="idVitrina">ID de vitrina:</label>
                                                <input type="number" name="idVitrina" class="form-control" placeholder="ID" autofocus>
                                            </div>
                                            <div class="form-group mb-md-3">
                                                <label for="nombredeSeccionAlojada">Nombre de la sección:</label>
                                                <select name="nombredeSeccionAlojada" class="form-select" id="nombredeSeccionAlojada">
                                                    <option selected>Nombre de sección</option>
                                                    <?php
                                                    $query = "SELECT * FROM seccion";
                                                    $result_secciones = mysqli_query($conn, $query);
                                                    while ($row = mysqli_fetch_array($result_secciones)) { ?>
                                                        <option value="<?php echo $row['id_seccion']?>"><?php echo $row['seccNombre'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <input type="submit" class="btn btn-success btn-block" name="save_vitrina" value="Guardar">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <table class="table table-bordered" id="dataTable">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>fotoVitrina</th>
                                                <th>id_vitrina</th>
                                                <th>seccionAlojada</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $vitrinaquery = "SELECT * FROM vitrina";
                                            $result_vitr = mysqli_query($conn, $vitrinaquery);
                                            while ($row = mysqli_fetch_array($result_vitr)) { ?>
                                                <tr>
                                                    <td><img src="includes/Images/<?php echo $row['fotoVitrina'] ?>" width=100 title="<?php echo $row['fotoVitrina'] ?>"></td>
                                                    <td><?php echo $row['id_vitrina'] ?></td>
                                                    <td><?php echo $row['seccionAlojada'] ?></td>
                                                    <td>
                                                        <a href="edit_vitrina.php?id=<?php echo $row['id_vitrina']?>" class="btn btn-secondary btn-sm">
                                                            <i class="fa-solid fa-marker"></i>
                                                        </a>
                                                        <a href="delete_vitrina.php?id=<?php echo $row['id_vitrina']?>" class="btn btn-danger btn-sm">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-danger mx-md-2" data-bs-toggle="modal" data-bs-target="#historialModal">
            Ver historial
        </button>
        <div class="modal fade" id="historialModal" tabindex="-1" aria-labelledby="historialModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="historialModalLabel">Historial de movimiento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <table class="table table-bordered">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>id_cambio</th>
                                            <th>Campo</th>
                                            <th>id_objeto</th>
                                            <th>NombreAnt</th>
                                            <th>ValorAnt</th>
                                            <th>ValorNuevo</th>
                                            <th>AñadidoPor</th>
                                            <th>AñadidoFecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $query = "SELECT * FROM historial";
                                        $result_historial = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_array($result_historial)) { ?>
                                            <tr>
                                                <td><?php echo $row['id_cambio'] ?></td>
                                                <td><?php echo $row['Campo'] ?></td>
                                                <td><?php echo $row['id_objeto'] ?></td>
                                                <td><?php echo $row['NombreAnt'] ?></td>
                                                <td><?php echo $row['ValorAnt'] ?></td>
                                                <td><?php echo $row['ValorNuevo'] ?></td>
                                                <td><?php echo $row['AñadidoPor'] ?></td>
                                                <td><?php echo $row['AñadidoFecha'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container m-sm-3">

        <div class="row">

            <div class="col-md-3">

                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
                        <?= $_SESSION['message'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php session_unset(); } ?>

                <div class="card card-body">
                    <form action="save_task.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-md-3">
                            <label for="objetoImagen">Subir imagen</label>
                            <input class="form-control" name="objetoImagen" type="file" id="subirImagen">
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="identidad">ID:</label>
                            <input type="number" name="identidad" class="form-control" placeholder="ID de objeto" autofocus>
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="nombre">Nombre:</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ej.: Declaración de independencia">
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="clasificacion">Clasificación:</label>
                            <input type="text" name="clasificacion" class="form-control" placeholder="Ej.: Documento">
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="descripcion">Descripción:</label>
                            <textarea name="descripcion" rows="4" class="form-control" placeholder="Breve descripción del objeto"></textarea>
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="fecha_alta">Fecha de alta:</label>
                            <input type="date" name="fecha_alta" class="form-control" placeholder="YYYY-MM-DD">
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
                                <input type="date" name="fecha_baja" class="form-control" id="fechaInput" placeholder="YYYY-MM-DD" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-md-3">
                            <label for="seccionesNombre">Sección:</label>
                            <select name="seccionesNombre" class="form-select mb-md-1" id="seccionesNombre">
                                <option selected>Nombre</option>
                                <?php
                                $query = "SELECT * FROM seccion";
                                $result_secciones = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_array($result_secciones)) { ?>
                                    <option value="<?php echo $row['id_seccion']?>"><?php echo $row['seccNombre'] ?></option>
                                <?php } ?>
                            </select>
                            <select name="seccionesVitr" class="form-select mb-md-1" id="seccionesVitr">
                                <option selected>Número de vitrina</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="save_task" value="Guardar">
                    </form>

                </div>

            </div>
            <div class="col-md-8">

                <table class="table table-bordered" id="dataTable">
                    <thead class="table-dark">
                        <tr>
                            <th>fotoObjeto</th>
                            <th>id_inventario</th>
                            <th>Nombre_obj</th>
                            <th>Clasificación</th>
                            <th>Descripción</th>
                            <th>Fecha_alta</th>
                            <th>Fecha_baja</th>
                            <th>SecciónID</th>
                            <th>VitrinaID</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php 
                        $query = "SELECT * FROM objeto";
                        $result_inventario = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_array($result_inventario)) { ?>
                            <tr>
                                <td><img src="includes/Images/<?php echo $row['fotoObjeto'] ?>" width=100 title="<?php echo $row['fotoObjeto'] ?>"></td>
                                <td><?php echo $row['id_inventario'] ?></td>
                                <td><?php echo $row['Nombre_obj'] ?></td>
                                <td><?php echo $row['Clasificación'] ?></td>
                                <td><?php echo $row['Descripción'] ?></td>
                                <td><?php echo $row['Fecha_alta'] ?></td>
                                <td><?php echo $row['Fecha_baja'] ?></td>
                                <td><?php echo $row['SecciónNombre'] ?></td>
                                <td><?php echo $row['SecciónVitrina'] ?></td>
                                
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id_inventario']?>" class="btn btn-secondary btn-sm">
                                        <i class="fa-solid fa-marker"></i>
                                    </a>
                                    <a href="delete_task.php?id=<?php echo $row['id_inventario']?>" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#historialObjetoModal<?php echo $row['id_inventario']?>">
                                        <i class="fa-solid fa-clock"></i>
                                    </button>
                                    <div class="modal fade" id="historialObjetoModal<?php echo $row['id_inventario']?>" tabindex="-1" aria-labelledby="historialObjetoModalLabel<?php echo $row['id_inventario']?>" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="historialObjetoModalLabel<?php echo $row['id_inventario']?>">Historial de movimiento de <?php echo $row['Nombre_obj']?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <table class="table table-bordered">
                                                                <thead class="table-dark">
                                                                    <tr>
                                                                        <th>id_cambio</th>
                                                                        <th>Campo</th>
                                                                        <th>id_objeto</th>
                                                                        <th>NombreAnt</th>
                                                                        <th>ValorAnt</th>
                                                                        <th>ValorNuevo</th>
                                                                        <th>AñadidoPor</th>
                                                                        <th>AñadidoFecha</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php 
                                                                    $idObjetoHistorial = $row['id_inventario'];
                                                                    $historial_query = "SELECT * FROM historial WHERE id_objeto = $idObjetoHistorial AND ValorNuevo <> 'Objeto removido'";
                                                                    $result_historial = mysqli_query($conn, $historial_query);
                                                                    while ($historial_row = mysqli_fetch_array($result_historial)) { ?>
                                                                        <tr>
                                                                            <td><?php echo $historial_row['id_cambio'] ?></td>
                                                                            <td><?php echo $historial_row['Campo'] ?></td>
                                                                            <td><?php echo $historial_row['id_objeto'] ?></td>
                                                                            <td><?php echo $historial_row['NombreAnt'] ?></td>
                                                                            <td><?php echo $historial_row['ValorAnt'] ?></td>
                                                                            <td><?php echo $historial_row['ValorNuevo'] ?></td>
                                                                            <td><?php echo $historial_row['AñadidoPor'] ?></td>
                                                                            <td><?php echo $historial_row['AñadidoFecha'] ?></td>
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    
    </div>
    <div id="searchresult"></div>
    <?php include("includes/footer.php") ?>
</body>
</html>