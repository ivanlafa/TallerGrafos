<script type="text/javascript">
 
  window.onload=function(){
  var nodos = new vis.DataSet([
  	 <?php 
 	
 	foreach ($_SESSION['grafo']->getVectorV() as $key => $value) {
			$txt=$value->GetId();
      if ($value!=null) {
        
				echo "{id: '$key' ,label: '$txt'},";
			}
			else{
				echo "{id: '$key',label: $txt}";
			}

		}
 
	
  ?>
    

  ]);

 
  var aristas = new vis.DataSet([
  	<?php

  	foreach ($_SESSION['grafo']->getMatrizA() as $vp => $adya) {

	if($adya !=null){
		foreach ($adya as $de => $pe) {
			if ($pe!=null) {
			echo "{from:'$vp' , to:'$de' , label:'$pe'},";
		}
		else{
			echo "{from:'$vp' , to:'$de' , label:'$pe'}";
		}
	}
	}
}

?>

  ]);

 
  var contenedor = document.getElementById('grafo1');
  var data = {
    nodes: nodos,
    edges: aristas
  };
  var opciones = {
        edges: {
          arrows: {
            to: {
              enabled: true,
            }
          },
          color: {
            color: '#B22222'
          }
        },
        nodes: {
          color: {
            background: '#CEE7FF',
            border: '#7CFC00',           
          }
        }
      };
  var network = new vis.Network(contenedor, data, opciones);
}
</script>