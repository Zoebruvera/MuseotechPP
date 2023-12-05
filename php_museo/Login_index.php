<?php include("db.php"); ?>
<?php include("includes/header.php") ?>

<body class="d-flex justify-content-center align-items-center" style="background-image: url('includes/Images/OttoKrauseFondo.jpg'); height: 100vh;">
    <form action="login.php" method="POST" class="card card-body d-flex flex-column align-items-center" style="max-width: 400px; width: 100%;">
        <h2 class="mb-4">LOGIN</h2>
        <?php
        if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert"><?php echo $_GET['error'] ?></div>
        <?php } ?>
        <div class="row g-3 w-100">
            <div class="col">
                <label for="inputUser" class="form-label">Usuario</label>
                <input type="text" class="form-control" name="inputUser" id="inputUser">
            </div>
        </div>
        <div class="row g-3 w-100 mt-1">
            <div class="col">
                <label for="inputPassword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="inputPassword" id="inputPassword">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Iniciar sesión</button>
    </form>    

    <?php include("footerLogin.php") ?>
</body>
</html>