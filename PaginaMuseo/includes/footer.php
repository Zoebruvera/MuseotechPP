<!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<!-- JAVASCRIPT FUNCTIONS -->
    <script>
        $(document).ready(function () {
            $('#getSearchPagina').on('keyup', function () {
                var busquedaPaginaMostrar = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'AJAX_searchObjeto.php',
                    data: {busquedaPagina: busquedaPaginaMostrar},
                    success: function(response) {
                        $('#showData').html(response);
                    }
                });
            });
        });
    </script>