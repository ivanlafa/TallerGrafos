<?php
include("vertice.php");

Class Grafo{

		
		private $matrizA;
		private $vectorV;
		private $dirigido;

		public function __construct($dir = true){
			$this->matrizA = null;
			$this->vectorV = null;
			$this->dirigido = $dir;
		}

		
		
		public function agregarVertice($v){
			if(!isset($this->vectorV[$v->getId()])){
				$this->matrizA[$v->getId()] = null;
				$this->vectorV[$v->getId()] = $v;
			} else{
				return false;
			}
			return true;

		}

		public function getVertice($v){
        if(!isset($this->vectorV[$v])){
        return false;
        }else{
	    return $this->vectorV[$v];
        }		
		}
		public function mostrarVertice($v){
			$mostrar="";
			$mostrar=$this->vectorV[$v];
			$mostrar=$mostrar->getId();
			echo $mostrar;
		}

	
		public function agregarArista($o, $d, $p = null){
			if (isset($this->vectorV[$o]) && isset($this->vectorV[$d])){
				$this->matrizA[$o][$d] = $p;
			}else{
		
				return false;
			} 

			return true;
		}

		
		public function getAdyacentes($v){
			return $this->matrizA[$v];
		}

		public function getMatrizA(){
			return $this->matrizA;
		}

		public function getVectorV(){
			return $this->vectorV;
		}

		
		public function gradoSalida($v){

		if (isset($this->matrizA[$v])) {
			return count($this->matrizA[$v]);
			} else {
				return 0;
			}
		}

		public function gradoEntrada($v){
			$gr = 0;
			if ($this->matrizA != null){
				foreach ($this->matrizA as $vp => $adya) {
					if($adya !=null){
						foreach ($adya as $de => $pe) {
							if($de == $v){
								$gr++;
							}
						}
					}
				}
			}

			return $gr;
		}

		
		public function grado($v){
 
			return $this->gradoSalida($v) + $this->gradoEntrada($v);
       }

		
		public function eliminarArista($o, $d){
			if (isset($this->matrizA[$o][$d])){
				unset($this->matrizA[$o][$d]);
			}else{
				return false;
			}

			return true;
		}

		
		public function eliminarVertice($v){
			if(isset($this->vectorV[$v])){
				foreach ($this->matrizA as $vp => $adya) {
					if($adya !=null){
						foreach ($adya as $de => $pe) {
							if($de == $v){
								unset($this->matrizA[$vp][$de]);
							}
						}
					}
				}
				unset($this->matrizA[$v]);
				unset($this->vectorV[$v]);
			} else{
				return false;
			}
			return true;

		}
		public function Visitado($v){
			$validador=true;
			$this->vectorV[$v]->setVisitado($validador);
			echo "ENTRO A VISITADO";

		}

        public function anchura($idVerticeInicial){
			$cola = array();
			$recorrido = array();

			if (isset($this->vectorV[$idVerticeInicial])) {
				array_push($cola, $idVerticeInicial); 

				while (!empty($cola)) {
					$nodoExtraido = array_shift($cola); 

					if (in_array($nodoExtraido , $recorrido) == false) { 
				    	array_push($recorrido, $nodoExtraido ); 

				    	if ($this->matrizA != null) {
				    		foreach ($this->matrizA as $idVertices => $adyacentes) { 
								if($idVertices == $nodoExtraido){
									if ($adyacentes != null) {
										foreach ($adyacentes as $idVertices2 => $peso) {
											array_push($cola, $idVertices2); 
										}
									}
								}
							}
				    	}
					}
				}
				return $recorrido;  

			}else{
				return false;
			}
		}


		
		public function profundidad($idVerticeInicial){
			$pila = array();
			$recorrido = array();

			if (isset($this->vectorV[$idVerticeInicial])) {
				array_push($pila, $idVerticeInicial);

				while (!empty($pila)) {
					$nodoExtraido  = array_pop($pila);

					if (!in_array($nodoExtraido , $recorrido)) { 
				    	array_push($recorrido, $nodoExtraido ); 

				    	if ($this->matrizA != null) {
				    		foreach ($this->matrizA as $idVertices => $adyacentes) { 
								if($idVertices == $nodoExtraido){
									if ($adyacentes != null) {
										foreach ($adyacentes as $idVertices2 => $peso) {
											array_push($pila, $idVertices2);
										}
									}
								}
							}
				    	}
					}
				}
			}
			else{
				return false;
			}
			return $recorrido; 
		}


		public function caminoMasCorto($a,$b){
        if(isset($this->vectorV[$a]) && isset($this->vectorV[$b])){
        $S = array();
        $Q = array();
        foreach(array_keys($this->matrizA) as $val) $Q[$val] = 99999;
        $Q[$a] = 0;

       
        while(!empty($Q)){
            $min = array_search(min($Q), $Q);
            if($min == $b) break;
            foreach($this->matrizA[$min] as $key=>$val) if(!empty($Q[$key]) && $Q[$min] + $val < $Q[$key]) {
                $Q[$key] = $Q[$min] + $val;
                $S[$key] = array($min, $Q[$key]);
            }
            unset($Q[$min]);
        }


        $path = array();
        $pos = $b;
        while($pos != $a){
            $path[] = $pos;
            $pos = $S[$pos][0];
        }
        $path[] = $a;
        $path = array_reverse($path);
        
        return $path;

    }else{
    return false;	
    }
}
	}
?>