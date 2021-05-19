

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Remodelaciones</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Menu desplegable -->
    <div id="sidebar-wrapper">
      <div class="sidebar-heading"><img src="images/logo.png" width="200px"></div>
      <div class="list-group list-group-flush">
      <a href="PaginaPrincipal.php" class="list-group-item list-group-item-action componentes-sidebar"> P&aacute;gina Principal</a>
        <a href="SolicitarCotizacion.php" class="list-group-item list-group-item-action componentes-sidebar">Solicitar cotizaci&oacute;n</a>
        <a href="Contactenos.php" class="list-group-item list-group-item-action componentes-sidebar">Cont&aacute;ctenos</a>
      </div>
    </div>
    
    <!-- Contenido de la Pagina -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light componentes-sidebar border-bottom">

        <button class="btn botones" id="menu-toggle"><i class="fa fa-bars"></i></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active"> <!--Estas las deje por si las podemos ocupar luego-->
              <a class="nav-link" href="VerCotizaciones.php">Ver Cotizaciones</a>
            </li>
            
          </ul>
        </div>
      </nav>

<div class="container col-12 fondo" >
  <br/>
    <div class="row"> <!--Contiene todas las imagenes y texto -->
      <div class="col-4" ><!--Contiene solo la imagen de la cocina-->
        <img src="images/Cocina1.jpg" width="370px" style="margin-right:15% ; margin-left: 5%">
      </div>

      <div class="col-7" > <!--Contiene el texto y las dos imagenes -->
        <br/>
          <div class="col-12"><!--Contiene solo el texto -->
            <h1 class="letra">¿Quiénes somos?</h1>
          <br/>
            <p style="text-align: justify;">HJA Remodelaciones busca sintetizar en un enunciado la razón de ser de la empresa, así como mencionar   lo que la organización hace para cumplir y acercarse cada vez más a su propósito. Es el faro que indicará en todo momento la dirección a la que deben apuntar las acciones y las decisiones. Puede ser objeto de las revisiones y cambios que sean necesarios, para adecuarla a las circunstancias cambiantes del entorno.La visión plasma el lugar y circunstancia en que la organización quisiera estar en el futuro. Genera en la mente una imagen que inspira a la acción, a través de elementos que la presentan como algo alcanzable. En general, la visión permanecerá fija durante la vida de la empresa.
            </p>
          </div>

          <div class="col-12" style=" padding-top: 60px"><!--Contiene las dos imagenes horizontales-->
            <img src="images/bedroom.jpg" width="370px" height="187px" style="margin-right: 27px; margin-left: 0%;">
            <img src="images/bathroom.jpg" width="280px">
          </div>
      </div>
    </div>
  </div>
</div>
 
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>
