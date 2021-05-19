<?php

    $rol = $_SESSION["rol"];
	
	if($rol == "usuario") {
	  
	 echo "<a href='PaginaPrincipal.php' class='list-group-item list-group-item-action componentes-sidebar'> P&aacute;gina Principal</a>";
     echo '<a href="SolicitarCotizacion.php" class="list-group-item list-group-item-action componentes-sidebar">Solicitar cotizaci&oacute;n</a>';
     echo '<a href="Contactenos.php" class="list-group-item list-group-item-action componentes-sidebar">Cont&aacute;ctenos</a>';
		
	} else if($rol == "admin") {
		
        echo "<a href='PaginaPrincipal.php' class='list-group-item list-group-item-action componentes-sidebar'> P&aacute;gina Principal</a>";
        echo '<a href="#" class="list-group-item list-group-item-action componentes-sidebar">Reportes</a>';
		
	}
	
?>