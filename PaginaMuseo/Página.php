<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php include("dbpagina.php") ?>

<?php include("includes/header.php") ?>

<body>
  <nav class="navbar navbar-dark bg-dark sticky-top">
      <a href="Página.php" class="navbar-brand mx-md-2">
        <img src="includes/media/orig-marca-otto-krause-1.png" width="110" class="d-inline-block align-top" alt="">
      </a>
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link" href="Página.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#exposiciones"><i class="fa-solid fa-magnifying-glass"></i> Explorar inventario</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://virtualitour.es/tours/uVWabABnct1CzGvlUzj8">Visita</a>
        </li>
      </ul>
  </nav>
  <div id="carouselFotosMuseo" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="false">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="includes/media/m1.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m3.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m4.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m5.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m6.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m7.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m8.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m9.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m10.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m11.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m12.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m13.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m14.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m15.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m16.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="includes/media/m17.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-caption" style="top: 25%;">
        <h1 style="font-size:5vw">BIENVENIDO AL MUSEO <br>EDUARDO LATZINA</h1>
        <h5>Baje para más información</h5>
      </div>
    </div>
  </div>
  <div>
    <div class="espacio"></div>
    <div class="hola">
      <h1>¿QUÉ ES EL MUSEO EDUARDO LATZINA?</h1>
    </div>   
    <div class="hola">
      <p class="fuenteParrafo">El museo Eduardo Latzina fue creado con el convencimiento de que la Escuela técnica  tiene  al taller como espacio activo, escenario de la enseñanza práctica.
      <br><br>Es en el Museo Eduardo Latzina donde se conservan los arquetipos, mecanismos, ensayos, y todo otro material que ponen al alumnado y al público en general en contacto con los logros de la ciencia y de la técnica a lo largo del tiempo, siendo este su objetivo principal el de exponer maquetas y modelos que sirvan de apoyo a la enseñanza, tal es la importancia del papel que debe representar el museo al permitir la identificación del hombre, en la emergencia de la identidad, con su cultura, en la cual las obras realizadas se convierten en espejo del sujeto.</p>
    </div>

    <div class="espacio"></div>
    <div class="hola">
      <h3>¿CUÁL ES SU OBJETIVO?</h3>
    </div>
    <div class="hola">
      <p class="fuenteParrafo">El objetivo fundamental a alcanzar por el Museo Eduardo Latzina, único en Latinoamérica con tales características, es que sea un instrumento para enseñar, difundir e interpretar tecnologías tradicionales y de vanguardia, y desempeñar un rol importantísimo en la enseñanza de tecnologías y ciencia, como así también en temas propios de las distintas ramas de la industria, consideradas desde principios de siglo y aún desde antes.</p>
    </div>

    <div class="espacio"></div>
    <div
      class="hola">
    <h3>¿DÓNDE ESTÁ UBICADO?</h3>
    </div>
    <div class="hola">
      <p class="fuenteParrafo">El Museo Eduardo Latzina se encuentra ubicado en la Escuela Técnica N°1 «Otto Krause» de la Ciudad Autónoma de Buenos Aires (CABA), en la Av.Paseo Colón 650.
      <br><br>Dentro de la escuela, se encuentra ubicado en el extremo derecho, al costado de las escaleras del subsuelo y los demás pisos.</p>
    </div>
  </div>


  <div class="espacio" id="exposiciones"></div>
  <div class="hola">
    <h1>CONOCÉ NUESTRAS EXPOSICIONES</h1>
  </div>

  <section>
    <div>
      <form class="d-flex mx-md-5 my-md-4 p-2" role="search">
        <input class="form-control me-2" type="search" placeholder="Busca el objeto que deseas ver" aria-label="Search" id="getSearchPagina">
      </form>  
    </div>
    <div id="showData">
      <div class="row row-cols-auto row-cols-md-4 mx-md-3">
        <?php
        $query = "SELECT * FROM objeto WHERE SecciónNombre > 0";
        $result_inventario = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result_inventario)) { ?>
          <?php
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
          ?>
          <div class="col my-md-3 animacionAgrandar">
            <div class="card h-100">
              <img src="../php_museo/includes/Images/<?php echo $row['fotoObjeto'] ?>" class="card-img-top" title="<?php echo $row['Nombre_obj'] ?>">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?php echo $row['Nombre_obj'] ?></h5>
                <p class="card-text text-truncate"><?php echo $row['Descripción'] ?></p>
                <a type="button" class="btn btn-danger stretched-link mt-auto" data-bs-toggle="modal" data-bs-target="#infoObjetoModal<?php echo $row['id_inventario']?>">Más información</a>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary"><?php echo $nombreSeccionObjeto ?></small>
              </div>
            </div>
          </div>
          <div class="modal fade" id="infoObjetoModal<?php echo $row['id_inventario']?>" tabindex="-1" aria-labelledby="infoObjetoModalLabel<?php echo $row['id_inventario']?>" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="infoObjetoModalLabel<?php echo $row['id_inventario']?>">Más información sobre "<?php echo $row['Nombre_obj']?>"</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex">
                  <div class="me-md-3">
                    <img src="../php_museo/includes/Images/<?php echo $row['fotoObjeto'] ?>" width="300" title="<?php echo $row['Nombre_obj'] ?>">
                  </div>
                  <div class="d-flex flex-column">
                    <p>Nombre: <?php echo $row['Nombre_obj'] ?></p>
                    <p>Clasificación: <?php echo $row['Clasificación'] ?></p>
                    <p>Descripción: <?php echo $row['Descripción'] ?></p>
                    <p>Sección: <?php echo $nombreSeccionObjeto ?></p>
                    <p>Número de vitrina: <?php echo $row['SecciónVitrina'] ?></p>
                    <p>Vitrina donde se aloja: <img src="../php_museo/includes/Images/<?php echo $fotoVitrinaObjeto ?>" width="125" title="Mostrar objetos alojados en esta vitrina"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>       
        <?php } ?>
      </div>
    </div>
  </section>
<?php include("includes/footer.php") ?>
</body>
</html>