<?php 

include("db.php");
if (isset($_POST['input'])) {
    $input = $_POST['input'];
    $query = "SELECT * FROM objeto WHERE id_inventario LIKE '%$input%' OR Nombre_obj LIKE '%$input%' 
    OR Clasificación LIKE '%$input%' OR Descripción LIKE '%$input%' OR Fecha_alta LIKE '%$input%' 
    OR Fecha_baja LIKE '%$input%' OR SecciónNombre LIKE '%$input%' OR SecciónVitrina LIKE '%$input%'; ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) { ?>
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

                while ($row = mysqli_fetch_assoc($result)) { ?>
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

                    <?php
                }
                ?>
            </tbody>
        </table>

    </div>
        <?php
    } else {
        echo "<h6 class='text-danger text-center mt-3'>Ningún objeto encontrado</h6>";
    }
}

?>