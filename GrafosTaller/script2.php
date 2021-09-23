<script type="text/javascript">
  // create an array with nodes
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
 
    $go=count($ver);
    $go2=0;

    foreach ($_SESSION['grafo']->getMatrizA() as $vp => $adya) {

  if($adya !=null){
    foreach ($adya as $de => $pe) {
      if ($pe!=null) {
        if ($go2<($go)) {
          foreach ($ver as $key => $value) {
          if ($value==$vp) {
            if (in_array($de, $ver)) {
              echo "{from:'$vp' , to:'$de' , label:'$pe',color:{color:'red'}},";
            $go2=$go2+1;
            }         
           

          }
        } echo "{from:'$vp' , to:'$de' , label:'$pe',color:{color:'#1A1B13'}},";
        }else{
           echo "{from:'$vp' , to:'$de' , label:'$pe'},";
        }
        
       
      
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
            color: '#1A1B13'
          }
        },
        nodes: {
          color: {
            background: '#73CF8B',
            border: '#09AB33'
          }
        }
      };
  var network = new vis.Network(contenedor, data, opciones);
}
</script>