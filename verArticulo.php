<?php
session_start();
require_once "Connection.php";

// Castellano por defecto o mantiene la sesion si se ha cambiado el idioma
if (isset($_SESSION["idioma"])){
    include $_SESSION["idioma"];
}else{
    include "castellano.php";
}
if(isset($_GET['asset'])) {
    $article_id = $_GET['asset'];

    $dbh = Connection::make();
    $stmt = $dbh->prepare("SELECT * FROM articulos WHERE ID_art = :article_id");
    $params = [':article_id'=>$article_id];
    $stmt->execute($params);
    $articulo = $stmt->fetch(PDO::FETCH_ASSOC);

} else {
    header('Location: index.php');
}
?>
<!-- AQUI VA LA PARTE GRÁFICA DE LOS ARTÍCULOS -->

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo $titPagina ?></title>

    <!-- Núcleo Bootstrap css -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fuentes de texto -->
    <link href="img/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Estilos customizados -->
    <link href="css/estilos.css" rel="stylesheet" type="text/css">

</head>

<body id="Principal">

<!-- Navegador -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">Titulo de la consulta</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#NavegadorResponsive" aria-controls="NavegadorResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="NavegadorResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item">
                    <div class="dropdown nav-link">
                        <a class=" dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $navIdioma ?></a>
                        <div class="dropdown-menu " style="border-color: transparent; background-color: #212529;" aria-labelledby="dropdownMenu2">
                            <button class="dropdown-item btn bg-transparent" style="color: white; " id="castellano" type="button">Castellano</button>
                            <button class="dropdown-item btn bg-transparent" style="color: white" id="valenciano" type="button">Valenciano</button>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="pagArticulos.php"><?php echo $pagArtVolver ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Cabecera -->
<header class="masthead" style="background-image:url('<?= $articulo['imagen'] ?>')">
    <div class="container">
        <div class="intro-text">
            <div class=" intro-heading text-uppercase"><?= $articulo['titulo'] ?></div>
        </div>
    </div>
</header>

<!-- Servicios de la consulta -->

<section class=" page-section">

        <div class="container">

                <div class="row">
                    <div class="col-lg-12 ">

                        <p><?= $articulo['contenido'] ?></p>
                    </div>
                </div>
                <div class="container">
                      <div class="row">


                      </div>
                </div>
        </div>
</section>



<!-- footer -->
<footer class="footer">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; Ignacio Macias Martinez 2DAW</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                    <li class="list-inline-item">
                        <a href="#"><?php echo $fooPolitica ?></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#"><?php echo $fooTerminos ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Nucleo Bootstrap JavaScript -->
<script src="js/jquery/jquery.js"></script>
<script src="bootstrap/js/bootstrap.bundle.js"></script>

<!-- Plugin JavaScript -->
<script src="js/jquery-easing/jquery.easing.js"></script>

<!-- Formulario Contacto JavaScript -->
<script src="js/jqBootstrapValidation.js"></script>
<script src="js/contacto.js"></script>

<!-- Scripts customizados -->
<script src="js/Bootstrap.js"></script>
<script src="js/Scripts.js"></script>

<!-- Cambio de idioma -->
<script type="text/javascript">
    document.getElementById("castellano").onclick= cambioIdioma;
    document.getElementById("valenciano").onclick= cambioIdioma;
</script>

</body>

</html>