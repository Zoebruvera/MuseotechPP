<!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- JAVASCRIPT FUNCTIONS -->
    <script>
        const setNullRadio = document.getElementById('fechaValor1');
        const setValueRadio = document.getElementById('fechaValor2');
        const fechaBajaInput = document.getElementById('fechaInput');
        const optionSeccionNombre = document.getElementById('seccionesNombre');
        const optionSeccionVitrina = document.getElementById('seccionesVitr');
        setNullRadio.addEventListener('change', function () {
            fechaBajaInput.disabled = true;
            optionSeccionNombre.disabled = false;
            optionSeccionVitrina.disabled = false;
        });
        setValueRadio.addEventListener('change', function () {
            fechaBajaInput.disabled = false;
            optionSeccionNombre.disabled = true;
            optionSeccionVitrina.disabled = true;
            optionSeccionNombre.value = 0;
            optionSeccionVitrina.value = 0;
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#seccionesNombre').on('change', function () {
                var selectedSeccion = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: 'AJAX_handler.php',
                    data: {selectedSeccion: selectedSeccion},
                    success: function(response) {
                        $('#seccionesVitr').html(response);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#getSearch').on('keyup', function () {
                var busquedaMostrar = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'AJAX_search.php',
                    data: {busqueda: busquedaMostrar},
                    success: function(response) {
                        $('#showdata').html(response);
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ordenarPorColumnaSelect = document.getElementById('ordenarPorColumna');
            var ordenarPorOrdenSelect = document.getElementById('ordenarPorOrden');
            ordenarPorColumnaSelect.addEventListener('change', updateTableOrder);
            ordenarPorOrdenSelect.addEventListener('change', updateTableOrder);
            
            renderTable();

            function updateTableOrder() {
                renderTable();
            }

            function renderTable() {
                var selectedColumn = mapColumn(ordenarPorColumnaSelect.value);
                var selectedOrder = ordenarPorOrdenSelect.value;

                $.ajax({
                    type: 'POST',
                    url: 'AJAX_orderTable.php',
                    data: {
                        selectedColumn: selectedColumn,
                        selectedOrder: selectedOrder
                    },
                    success: function (data) {
                        $('#showdata').empty();
                        for (var i = 0; i < data.length; i++) {
                            var row = data[i];
                            
                            $('#showdata').append(
                                '<tr><td>' + '<img src="includes/Images/' + 
                                row.fotoObjeto + '" width=100 title="' + row.Nombre_obj + '" >' + '</td>' + 
                                '<td>' + row.id_inventario + '</td>' + 
                                '<td>' + row.Nombre_obj + '</td>' + 
                                '<td>' + row.Clasificación + '</td>' + 
                                '<td>' + row.Descripción + '</td>' + 
                                '<td>' + row.Fecha_alta + '</td>' + 
                                '<td>' + row.Fecha_baja + '</td>' + 
                                '<td>' + row.SecciónNombre + '</td>' + 
                                '<td>' + row.SecciónVitrina + '</td>' + 
                                '<td>' + 
                                '<a href="edit.php?id=' + row.id_inventario + '" class="btn btn-secondary btn-sm">' +
                                '<i class="fa-solid fa-marker"></i>' +
                                '</a>' +
                                '<a href="delete_task.php?id=' + row.id_inventario + '" class="btn btn-danger btn-sm">' +
                                '<i class="fa-solid fa-trash"></i>' +
                                '</a>' +
                                '<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#historialObjetoModal' + row.id_inventario + '">' +
                                '<i class="fa-solid fa-clock"></i>' +
                                '</button>' +
                                '</td>' +
                                '</tr>'
                            );
                        }
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            }
            function mapColumn(value) {
                var columnMap = {
                    'orderByObjetoID': 'id_inventario',
                    'orderByNombre': 'Nombre_obj',
                    'orderByClasificacion': 'Clasificación',
                    'orderByDescripcion': 'Descripción',
                    'orderByFechaAlta': 'Fecha_alta',
                    'orderByFechaBaja': 'Fecha_baja',
                    'orderBySeccionID': 'SecciónNombre',
                    'orderByVitrinaID': 'SecciónVitrina',
                };
                return columnMap[value] || value;
            }
        });
    </script>
    <script>
        function confirmDeleteVitrina(id) {
            // Check if there are related rows in the 'objeto' table
            $.ajax({
                url: 'AJAX_checkDeleteVitrina.php?id=' + id,
                type: 'GET',
                success: function(response) {
                    if (response > 0) {
                        $('#avisoEliminarVitrina').modal('show');
                    } else {
                        window.location.href = 'delete_vitrina.php?id=' + id + '&confirmed=true';
                    }
                },
                error: function(error) {
                    console.error('Error checking related rows: ', error);
                }
            });
        }
    </script>
    <script>
        function confirmDeleteSeccion(id) {
            $.ajax({
                url: 'AJAX_checkDeleteSeccion.php?id=' + id,
                type: 'GET',
                success: function(response) {
                    if (response > 0) {
                        $('#avisoEliminarSeccion').modal('show');
                    } else {
                        window.location.href = 'delete_seccion.php?id=' + id + '&confirmed=true';
                    }
                },
                error: function(error) {
                    console.error('Error checking related rows: ', error);
                }
            });
        }
    </script>