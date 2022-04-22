<?php

class Viaje{
    private $codigoViaje;
    private $destino;
    private $cantidadMax;
    private $arrayPasajeros;
    private $objResponsableV;
    
    /**************************************/
    /**************** SET *****************/
    /**************************************/

    /**
     * Cambia el valor de cantidad maxima
     *
     * @param int $cantidadMax
     */ 
    public function setCantidadMax($cantidadMax){
        $this->cantidadMax = $cantidadMax;
    }

    /**
     * Cambia el valor de destino
     *
     * @param string $destino
     */ 
    public function setDestino($destino){
        $this->destino = $destino;
    }

    /**
     * Cambia el valor del codigo del viaje
     *
     * @param int $codigoViaje
     */ 
    public function setCodigoViaje($codigoViaje){
        $this->codigoViaje = $codigoViaje;
    }


    
    /**
     * Establece el valor de arrayPasajeros
     */ 
    public function setArrayPasajeros($arrayPasajeros){
        $this->arrayPasajeros = $arrayPasajeros;
    }

    /**
     * Establece el valor de objResponsableV
     */ 
    public function setObjResponsableV($objResponsableV){
        $this->objResponsableV = $objResponsableV;
    }

    /**************************************/
    /**************** GET *****************/
    /**************************************/


    /**
     * Devuelve la cantidad maxima de pasajeros
     * 
     * @return int
     */ 
    public function getCantidadMax(){
        return $this->cantidadMax;
    }

    /**
     * Devuelve el nombre del viaje
     * 
     * @return  string
     */ 
    public function getDestino(){
        return $this->destino;
    }

    /**
     * Devuelve el codigo del viaje
     * 
     * @return int
     */ 
    public function getCodigoViaje(){
        return $this->codigoViaje;
    }

    /**
     * Obtiene el valor de arrayPasajeros
     */ 
    public function getArrayPasajeros(){
        return $this->arrayPasajeros;
    }

    /**
     * Obtiene el valor de ObjResponsableV
     */ 
    public function getObjResponsableV(){
        return $this->objResponsableV;
    }
    
    /**************************************/
    /************** FUNCIONES *************/
    /**************************************/

    /**
     * Este modulo asigna los valores a los atributos cuando se crea una instancia de la clase 
     * @param array $arrayPasajeros
     * @param int $cantidadMax
     * @param string $destino
     * @param int $codigoViaje
     * @param object $objResponsableV
    */
    public function __construct($arrayPasajeros,$cantidadMax,$destino,$codigoViaje, $ObjResponsableV){
        $this->pasajeros = $arrayPasajeros;
        $this->cantidadMax = $cantidadMax;
        $this->destino = $destino;
        $this->codigoViaje = $codigoViaje;
        $this->ObjResponsableV= $ObjResponsableV;
    }


    /**
     * Este modulo agrega un nuevo pasajero al final del arrayPasajero existente.
     * @param object $nuevoPasajero
    */
    public function agregarPasajero($nuevoPasajero){
        $arrayPasajeros = $this->getArrayPasajeros();
        array_push($arrayPasajeros, $nuevoPasajero);
        $this->setArrayPasajeros($arrayPasajeros);
    }

    /**
     * Este modulo quita un pasajero del array pasajero.
     * @param int documento 
     */
    public function quitarPasajero($documento){
        $arrayPasajeros = $this->getArrayPasajeros();
        $indice = $this->buscarPasajero($documento);
        if ($indice <> null){
            unset($arrayPasajeros[$indice]); //unset elimina el elemento seleccionado del array
            sort($arrayPasajeros); // sor ordena todos los elementos de un array para que vaya del 0 a la N
            $this->setArrayPasajeros($arrayPasajeros);
            $quitar=true;
        }else{
            $quitar=false;
        }
        return $quitar;
        }

    /**
     * Este modulo analiza si la capacidad de los pasajeros es menor a la capacidad maxima
     * @return boolean
    */
    public function hayCapacidad(){
        $capacidad = count($this->getArrayPasajeros());
        if($capacidad < $this->getCantidadMax()){
            $verificacion = true;
        }else{
            $verificacion=false;
        }
        return $verificacion;
    }

    /**
     * Este modulo devuelve todos los pasajeros del viaje por pantalla
    */
    public function verPasajeros(){
        $arrayPasajeros = $this->getArrayPasajeros();
        $string = "";
        foreach ($arrayPasajeros as $objPasajero){
            $string .= $objPasajero; // .= esto es un operador de cadena de caracteres que concatena. 
        }
        return $string; 
        
    }

    /**
     * Este modulo devuelve la cantidad de pasajeros que hay en el viaje
    */
    public function cantidadPasajeros(){
        $cantidad = count($this->getArrayPasajeros());
        return $cantidad;
    }

    /**
     * Este modulo devuelve un pasajero del viaje 
     * @param int documento
     * @return object
     */
    public function verUnPasajero($documento){
        $objPasajero = $this->buscarPasajero($documento);
        return $objPasajero;
        }

    /**
     * Este modulo busca si existe el pasajero y devuelve true o false
     * @param int $dni
     * @return boolean
    */
    public function existePasajero($dni){
        $arrayPasajeros = $this->getArrayPasajeros();
        $i = 0;
        $dimension = count($arrayPasajeros);
        $existe = false;
        $seguirBuscando = true;
        do{
            if($arrayPasajeros[$i]->getDni()== $dni){
                $seguirBuscando = false;
                $existe = true;
            }else{
            $i++;
            }
        }while($seguirBuscando && ($i < $dimension));
        return $existe;
    }

    /**
     * Este modulo devuelve una cadena de caracteres mostrando el contenido de los atributos
     * @return string
    */
    public function __toString(){
        return "Los pasajeros del viaje son: ".count($this->getarrayPasajeros())."\n".
                "La capacidad maxima del viaje es: ".$this->getCantidadMax()."\n".
                "El destino del viaje es: ".$this->getDestino()."\n".
                "El codigo del viaje es: ".$this->getCodigoViaje()."\n".
                "El responsable del viaje es: ".$this->getObjResponsableV(). "\n";
    }

    /**************************************/
    /********* FUNCIONES INTERNAS *********/
    /**************************************/
    
    /**
     * Este modulo busca si existe el pasajero y devuelve el indice donde se encuentra
     * @return int
    */
    private function buscarPasajero($dni){
        $arrayPasajeros = $this->getArrayPasajeros();
        $i = 0;
        $dimension = count($arrayPasajeros);
        if($this->existePasajero($dni)){
            do{
                $seguirBuscando = true;
                if($arrayPasajeros[$i]-> getDni() == $dni){ 
                    $seguirBuscando = false;
                }else{
                $i++;
                }
            }while($seguirBuscando && ($i < $dimension));
        }else{
            $i=null; //null = vacío
        }
        return ($i);
    }

 
}

?>