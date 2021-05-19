<?php

if(isset($_POST['btnIngresar']))
{
	include 'conexion_bd.php';
	$conn = AbrirCon();

	$usuario = $_POST["usuario"];
	$password = $_POST["password"];

	$existe = "call ExisteUsuarios( '$usuario', '$password')";
	$listaUsuarios = $conn -> query($existe);
	
	while($row = mysqli_fetch_array($listaUsuarios))
	{
		session_start();
		$_SESSION["nombre"] = $row["nombre"];
		$_SESSION["rol"] = $row["rol"];
		$_SESSION["correo"] = $row["correo"];
		$_SESSION["cedula"] = $row["numCedula"];
		
		header('Location: //localhost:/PaginaPrincipal.php');	
		CerrarCon($conn);
		return;
	}

	echo "Su usuario no existe, favor crear un nuevo usuario";
	$_SESSION["nombre"] = null;
	$_SESSION["rol"] = null;
	$_SESSION["correo"] =null;
	$_SESSION["cedula"] = null;

	
}

?>
		

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


<div class="container col-12" style="height: 755px;">
	<form method="post" action="" autocomplete="off">

		<center>			
			<div  style="padding-bottom: 5% ; padding-top: 5%">
				<img src="images/logo.png" width="20%">	
			</div>		
			
				<div class="col-5 login fondo" style="height: 50%"  >
					<!--label><h2 class="letra">Bienvendio</h2></label-->
					<br/>

					<div class="form-group col-7" style="padding-bottom: 2%">
						<input type="text" name="usuario" class="form-control" placeholder="Usuario">
					</div>

					<div class="form-group col-7">
						<input type="password" name="password" class="form-control" placeholder="Contraseña">
					</div>
					<br/>			
	</form>
			<div class="form-group" style="padding-bottom: 2%">
				<input type="submit" class="btn col-2 botones" name="btnIngresar" value="Ingresar"/>

						
					</div>
					
					<a href="Registro.php" class="letra">¿Aún no tenés cuenta? !Creá una!</a><br>
			</div>
		</center>
</div>
</body>
</html>
