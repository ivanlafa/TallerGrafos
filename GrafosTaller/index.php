<?php

include("grafo.php");

session_start();

if (!isset($_SESSION['grafo'])) {
    $_SESSION['grafo'] = new Grafo();
}
?>
 

<!DOCTYPE html>
<html>
<head>
    <title>Grafos</title>
  
  
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<script type="text/javascript"
	src="vis/dist/vis-network.js"></script>
	<link href="vis/dist/vis-network.css" rel="stylesheet" type="text/css">
   

   <?php
     include("script.php");
    ?>


	<link rel="shortcut icon" type="image/png" href="images/icons/favicon.png">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="images/go-down/fonts.css">
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="js/go-down.js"></script>
    
    

	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="normalize.css">
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
   
    

    <div class="contenedor"> 
        <header>        
            <div class="logo-contenedor">
                <img src="img/Grafo.png" alt="Grafo.png" class="logoinicio" id="logoinicio">
            </div>     
        </header>
    </div>
    <div class="contenido-principal">
        <main>
            <div class="grafo1" id="grafo1">
                
            </div>


            <section class="Funciones">
                <div class="titlegrafo">
                    <h4><b>Controles del grafo:</b></h4><br>
                </div>

               
                  
                <form action="index.php" method="post">
                  <input type="submit" class="boton" id="addVerti" value="Agregar Vertice">&ensp;
                  <input type="text" class="controls" name="agregarVertice" id="agregarVertice" placeholder="Digite id vertice a agregar"><br>
                </form>

                <form action="index.php" method="post">
                <input type="submit" class="boton" id="addAris" value="Agregar Arista">&ensp;
                <input type="text" class="controls" name="verticeOrigen" id="verticeOrigen" placeholder="Digite origen"> &ensp;
                <input type="text" class="controls" name="verticeDestino" id="verticeDestino" placeholder="Digite Destino"> &ensp;
                <input type="text" class="controls" name="pesoArista" id="pesoArista" placeholder="Digite Peso"> <br>
                </form>
                
                <form action="index.php" method="post">
                <input type="submit" class="boton" id="verVerti" value="Ver vertice">&ensp;
                <input type="text" class="controls" name="verVertice" id="verVertice" placeholder="Digite id vertice"><br>
                </form>

                <form action="index.php" method="post">
                <input type="submit" class="boton" id="verAdya" value="Ver Adyacentes">&ensp;
                <input type="text" class="controls" name="verAdyacentes" id="verAdyacentes" placeholder="Digite id vertice"><br>
                </form>

                <form action="index.php" method="post">
                <input type="submit" class="boton" id="verGrade" value="Ver grado">&ensp;
                <input type="text" class="controls" name="verGrado" id="verGrado" placeholder="Digite id vertice"><br>
                </form>

                <form action="index.php" method="post">
                <input type="submit" class="boton" id="eliminarV" value="Eliminar vertice">&ensp;
                <input type="text" class="controls" name="Evertice" id="Evertice" placeholder="Digite id vertice"><br>
                </form>

                <form action="index.php" method="post">
                <input type="submit" class="boton" id="eliminarA" value="Eliminar Arista">&ensp;
                <input type="text" class="controls" name="EaristaOrigen" id="EaristaOrigen" placeholder="Digite vertice origen"> &ensp;
                <input type="text" class="controls" name="EaristaDestino" id="EaristaDestino" placeholder="Digite vertice destino"> &ensp;
                </form>

				<form action="index.php" method="post">
                <input type="submit" class="boton" id="btnAnchura" value="Ver Anchura">&ensp;
                <input type="text" class="controls" name="txtAnchura" id="txtAnchura" placeholder="Digite id vertice"><br>
                </form>

				<form action="index.php" method="post">
                <input type="submit" class="boton" id="btnProfundidad" value="Ver Profunidad">&ensp;
                <input type="text" class="controls" name="txtProfundidad" id="txtProfundidad" placeholder="Digite id vertice"><br>
                </form>

				<form action="index.php" method="post">
                <input type="submit" class="boton" id="btnMascorto" value="Camino mas corto">&ensp;
                <input type="text" class="controls" name="txtCaristaOrigen" id="txtCaristaOrigen" placeholder="Digite vertice origen"> &ensp;
                <input type="text" class="controls" name="txtCaristaDestino" id="txtCaristaDestino" placeholder="Digite vertice destino"> &ensp;
                </form>
				
            </section>

        </main>

    </div>

    <?php 

//Agregar  vértice
if (isset($_POST["agregarVertice"])){
	if ($_POST["agregarVertice"]== null) {
		echo "<script>
			swal('No ah escrito nigun valor!', 'Escriba un valor correcto');
		</script>";
		include("script.php");
	}else{
      $agr= $_SESSION['grafo']->agregarVertice(new Vertice($_POST["agregarVertice"]));
      if ($agr) {
 	 echo "<script>
			swal('El vertice se agrego!', '');
		</script>";
		include("script.php");
     }else{
 	echo "<script>
			swal('El vertice escrito ya esta registrado!', 'Escriba un vertice diferente.');
		</script>";
		include("script.php");
   }
  }
}
?>

<?php 

//Agregar  arista
if (isset($_POST["verticeOrigen"],$_POST["verticeDestino"],$_POST["pesoArista"])){
	if ($_POST["verticeOrigen"]==null) {
		echo "<script>
			swal('Escriba el origen');
		      </script>";
		      include("script.php");
	}else{
		if ($_POST["verticeDestino"]==null) {
			echo "<script>
			swal('Escriba el Destino');
		          </script>";
		          include("script.php");
		}else{
			if ($_POST["pesoArista"]==null) {
				echo "<script>
			swal('Escriba el peso');
		             </script>";
		             include("script.php");
			}else{
                $agr=$_SESSION['grafo']->agregarArista($_POST["verticeOrigen"],$_POST["verticeDestino"],$_POST["pesoArista"]);
               if ($agr) {
                     echo "<script>
			swal('Arista agregada!');
		                  </script>";
		                  include("script.php");
               }else{
               	echo "<script>
			swal('Arista no agregada:(', ');
		             </script>";
		             include("script.php");
               }
			}
		}
	}
}
?>

<?php
//Ver vértice
			if (isset($_POST['verVertice']))
			 {

        $vertice = $_POST['verVertice'];
			if ($_POST["verVertice"] == null) 
			{
		echo "<script>
			swal('No ah escrito ninngun valor', 'Escriba por favor un valor');
		</script>";
		include("script.php");
	    }else{
				$encontrado = $_SESSION['grafo']->getVertice($vertice);
				if (!$encontrado)
				 {
					echo "<script>
							swal('Vertice no encontrado!');
						</script>";
						include("script.php");
				} else {
				if($encontrado)
				{
					echo "<script>
							swal('El vértice--> $vertice <-- Se encontro');
						</script>";
						include("script.php");

				}						
						
				}
			}
		}	


?>

<?php
	    //Ver adyacentes
	if (isset($_POST['verAdyacentes'])) {
		if ($_POST["verAdyacentes"] == null) 
		{
		    echo "<script>
			swal('No ah escrito ningun valor!', 'Escriba un valor');
		      </script>";
		      include("script.php");
	    }else{

			$id = $_POST['verAdyacentes'];
			$v = $_SESSION['grafo']->getVertice($id);
		if (!$v)
		 {

		    echo "<script>
			swal('vertice no encontrado!');
			</script>";
			include("script.php");

		} else {

			$ady = $_SESSION['grafo']->getAdyacentes($id);
			if ($ady == null) 
			{
			    echo "<script>
			    swal('El vértice--> $id <-- no encontro ningún adyacentes');
			    </script>";
			    include("script.php");
			} else {

				print_r($ady);
                include("script.php");
				}
			}	
		}
	}	
?>

<?php
//Ver grado 
			if (isset($_POST['verGrado'])) {
				if ($_POST["verGrado"] == null) {
		echo "<script>
			swal('No ah escrito ningun valor', 'Escriba un valor');
		      </script>";
		      include("script.php");
	    }else{
				$idVertice = $_POST['verGrado'];
				$vld = $_SESSION['grafo']->getVertice($idVertice);
				if ($vld == null) {
					echo "<script>
							swal('Vertice no encontrado!');
						</script>";
						include("script.php");
				} else {
					$grd = $_SESSION['grafo']->grado($idVertice);
					echo "<script>
								swal('Grado del vertice --> $idVertice es $grd');
						</script>";
						include("script.php");
				}
			}
		}
?>		

<?php 

//Eliminar  vértice 
if (isset($_POST["Evertice"])){
	if ($_POST["Evertice"]== null) {
		echo "<script>
			swal('No ah escrito ningun valor', 'Escriba un valor');
		     </script>";
		     include("script.php");
	}else{
		$el =$_SESSION['grafo']->eliminarVertice($_POST["Evertice"]);
		if ($el) {
			echo "<script>
			swal('Vértice eliminado!');
		         </script>";
		         include("script.php");
		}else{
			echo "<script>
			swal('El vertice no se ah podido eliminar', 'No se encontró nignun vértice escrito');
		        </script>";
		        include("script.php");
		}
	}
    }
 ?>




<?php 

//Eliminar arista 
if (isset($_POST["EaristaOrigen"],$_POST["EaristaDestino"])){
	if ($_POST["EaristaOrigen"]==null) {
		echo "<script>
			swal('Escriba un valor por favor');
		        </script>";
		        include("script.php");
	}else{
		if ($_POST["EaristaDestino"]==null) {
			echo "<script>
			swal('Escriba el destino');
		        </script>";
		        include("script.php");
		}else{
			 $el=$_SESSION['grafo']->eliminarArista($_POST["EaristaOrigen"],$_POST["EaristaDestino"]);
               if ($el) {
                     echo "<script>
			swal('Arista Eliminada!');
		         </script>";
		         include("script.php");
               }else{
               	echo "<script>
			swal('La arista no se ah podido eliminarr');
		        </script>";
		        include("script.php");
               }
			}
		}
	}
	
 ?>





 <div class="piepag"><p align='center'>Ivan Lafaurie. <br> Sebastian Rodriguez. <br> Camilo Oliveros. <br>&copy Copyrigth</p></div>
</body>
</html>
