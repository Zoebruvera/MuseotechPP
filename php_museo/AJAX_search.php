<?php

include("db.php");

$busqueda = $_POST['busqueda'];
$searchquery = "SELECT * FROM objeto WHERE id_inventario LIKE '%$busqueda%' OR Nombre_obj LIKE '%$busqueda%' 
OR Clasificación LIKE '%$busqueda%' OR Descripción LIKE '%$busqueda%' OR SecciónNombre LIKE '%$busqueda%' 
OR SecciónVitrina LIKE '%$busqueda%'";
$result_search = mysqli_query($conn, $searchquery);
$data = '';

while ($row = mysqli_fetch_assoc($result_search)) {
    
    $fotoObjetoSrc = "includes/Images/" . $row['fotoObjeto'];
    $idInventario = $row['id_inventario'];
    $nombreObj = $row['Nombre_obj'];
    $clasificacion = $row['Clasificación'];
    $descripcion = $row['Descripción'];
    $fechaAlta = $row['Fecha_alta'];
    $fechaBaja = $row['Fecha_baja'];
    $seccionNombre = $row['SecciónNombre'];
    $seccionVitrina = $row['SecciónVitrina'];
    $idObjetoHistorial = $row['id_inventario'];
    $idObjetoSeccion = $row['SecciónNombre'];
    $tooltipObjetoSeccionQuery = "SELECT seccNombre FROM seccion WHERE id_seccion = $idObjetoSeccion";
    $resultseccionobjetotooltip = mysqli_query($conn, $tooltipObjetoSeccionQuery);

    if (mysqli_num_rows($resultseccionobjetotooltip) == 1) {
        $rowtooltipobjeto = mysqli_fetch_array($resultseccionobjetotooltip);
        $nombreSeccionObjetotooltip = $rowtooltipobjeto['seccNombre'];
    }

    $historialRows = '';
    $historial_query = "SELECT * FROM historial WHERE id_objeto = $idObjetoHistorial AND ValorNuevo <> 'Objeto removido'";
    $result_historial = mysqli_query($conn, $historial_query);

    while ($historial_row = mysqli_fetch_array($result_historial)) {
        $historialRows .= <<<HTML
            <tr>
                <td>{$historial_row['id_cambio']}</td>
                <td>{$historial_row['Campo']}</td>
                <td>{$historial_row['id_objeto']}</td>
                <td>{$historial_row['NombreAnt']}</td>
                <td>{$historial_row['ValorAnt']}</td>
                <td>{$historial_row['ValorNuevo']}</td>
                <td>{$historial_row['AñadidoPor']}</td>
                <td>{$historial_row['AñadidoFecha']}</td>
            </tr>
    HTML;
    }
    $data .= <<<HTML
    <tr>
        <td><img src="$fotoObjetoSrc" width=100 title="$fotoObjetoSrc"></td>
        <td>$idInventario</td>
        <td>$nombreObj</td>
        <td>$clasificacion</td>
        <td>$descripcion</td>
        <td>$fechaAlta</td>
        <td>$fechaBaja</td>
        <td><a class="text-decoration-none" href="#" data-bs-toggle="tooltip" data-bs-title="$nombreSeccionObjetotooltip">$seccionNombre</a></td>
        <td>$seccionVitrina</td>
        <td>
            <a href="edit.php?id=$idInventario" class="btn btn-secondary btn-sm">
                <i class="fa-solid fa-marker"></i>
            </a>
            <a href="delete_task.php?id=$idInventario" class="btn btn-danger btn-sm">
                <i class="fa-solid fa-trash"></i>
            </a>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#historialObjetoModal$idInventario">
                <i class="fa-solid fa-clock"></i>
            </button>
            <div class="modal fade" id="historialObjetoModal$idInventario" tabindex="-1" aria-labelledby="historialObjetoModalLabel$idInventario" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="historialObjetoModalLabel$idInventario">Historial de movimiento de $nombreObj</h1>
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
        $historialRows
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
HTML;
}

echo $data;
?>