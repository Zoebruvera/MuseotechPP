<?php

include("dbpagina.php");

$busqueda = $_POST['busquedaPagina'];
$searchquery = "SELECT * FROM objeto WHERE Nombre_obj LIKE '%$busqueda%' OR Clasificación LIKE '%$busqueda%' 
OR Descripción LIKE '%$busqueda%' OR SecciónNombre LIKE '%$busqueda%' OR SecciónVitrina LIKE '%$busqueda%'";
$result_search = mysqli_query($conn, $searchquery);

// Reset $data variable
$data = '';

while ($row = mysqli_fetch_assoc($result_search)) {
    $idObjetoSeccion = $row['SecciónNombre'];
    $ObjetoSeccionQuery = "SELECT seccNombre FROM seccion WHERE id_seccion = $idObjetoSeccion";
    $resultseccionobjeto = mysqli_query($conn, $ObjetoSeccionQuery);

    if (mysqli_num_rows($resultseccionobjeto) == 1) {
        $rowseccion = mysqli_fetch_array($resultseccionobjeto);
        $nombreSeccionObjeto = $rowseccion['seccNombre'];
    }

    $idObjetoVitrina = $row['SecciónVitrina'];
    $ObjetoVitrinaQuery = "SELECT fotoVitrina FROM vitrina WHERE id_vitrina = $idObjetoVitrina";
    $resultvitrinaobjeto = mysqli_query($conn, $ObjetoVitrinaQuery);

    if (mysqli_num_rows($resultseccionobjeto) == 1) {
        $rowvitrina = mysqli_fetch_array($resultvitrinaobjeto);
        $fotoVitrinaObjeto = $rowvitrina['fotoVitrina'];
    }

    $modalId = "infoObjetoModal{$row['id_inventario']}";

    $data .= <<<HTML
        <div class="col my-md-3 animacionAgrandar">
            <div class="card">
                <img src="../php_museo/includes/Images/{$row['fotoObjeto']}" class="card-img-top" title="{$row['Nombre_obj']}">
                <div class="card-body">
                    <h5 class="card-title">{$row['Nombre_obj']}</h5>
                    <p class="card-text text-truncate">{$row['Descripción']}</p>
                    <a type="button" class="btn btn-danger stretched-link" data-bs-toggle="modal" data-bs-target="#{$modalId}">Más información</a>
                </div>
                <div class="card-footer">
                    <small class="text-body-secondary">{$nombreSeccionObjeto}</small>
                </div>
            </div>

        </div>
        <div class="modal fade" id="{$modalId}" tabindex="-1" aria-labelledby="{$modalId}Label" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="{$modalId}Label">Más información sobre "{$row['Nombre_obj']}"</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body d-flex">
                            <div class="me-md-3">
                                <img src="../php_museo/includes/Images/{$row['fotoObjeto']}" width="300" title="{$row['Nombre_obj']}">
                            </div>
                            <div class="d-flex flex-column">
                                <p>Nombre: {$row['Nombre_obj']}</p>
                                <p>Clasificación: {$row['Clasificación']}</p>
                                <p>Descripción: {$row['Descripción']}</p>
                                <p>Sección: {$nombreSeccionObjeto}</p>
                                <p>Número de vitrina: {$row['SecciónVitrina']}</p>
                                <p>Vitrina donde se aloja: <img src="../php_museo/includes/Images/{$fotoVitrinaObjeto}" width="125" title="Mostrar objetos alojados en esta vitrina"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    HTML;
}

echo '<div class="row row-cols-auto row-cols-md-4 mx-md-3">' . $data . '</div>';
?>