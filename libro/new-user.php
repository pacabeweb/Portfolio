<?php
	//Sesión
	session_start();

    //Conexion
    include_once "conexion.php";

	//Variables
	$usuario = NULL;

	if(isset($_REQUEST['usu'])){
		$usuario = $_REQUEST['usu'];
	}

	function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    } 

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<titleNuevo usuario</title>
</head>

<body>
	<form method="post" action="new-user.php"> 
		<label for="usuario">Nombre:</label><input type="text" id="usuario"	name="usu">
		<button>Registrar</button>
	</form>
</body>
</html>

<?php

	if($_SERVER["REQUEST_METHOD"] =="POST"){
		if(!empty($usuario)){
			$usuario = test_input($_REQUEST["usu"]);
			
			$sql = "INSERT INTO usuarios(user)
                    VALUES ('$usuario')";
			
            if ($conn->query($sql) === TRUE) {
                echo "Usuario guardado.<br>";
				$_SESSION['usuario'] = $usuario;
                echo "<a href='book-list.php'><button>Ir a la lista</button></a> ";
                echo "<a href='index.php'><button>Inicio</button></a>";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
        }
        else{
            echo "Rellene el nombre de usuario";
        }
	}	
?>