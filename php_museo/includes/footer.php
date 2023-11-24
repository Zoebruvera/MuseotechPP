<!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a62b915f08.js" crossorigin="anonymous"></script>
<!-- JAVASCRIPT FUNCTIONS -->
    <script>
        const setNullRadio = document.getElementById('fechaValor1');
        const setValueRadio = document.getElementById('fechaValor2');
        const fechaBajaInput = document.getElementById('fechaInput');
        setNullRadio.addEventListener('change', function () {
            fechaBajaInput.disabled = true;
        });
        setValueRadio.addEventListener('change', function () {
            fechaBajaInput.disabled = false; 
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