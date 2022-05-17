<?php

class Viaje{
    private $codigoViaje;
    private $destino;
    private $cantidadMax;
    private $arrayPasajeros;
    private $objResponsableV;
    private $importe; 
    private $tipoAsiento; 
    
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
    /**
     * Establece el valor de tipoAsiento
     */ 
    public function setTipoAsiento($tipoAsiento){
        $this->tipoAsiento = $tipoAsiento;
    }

    /**
     * Establece el valor de importe
     */ 
    public function setImporte($importe){
        $this->importe = $importe;
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
    /**
     * Obtiene el valor de importe
     */ 
    public function getImporte(){
        return $this->importe;
    }

    /**
     * Obtiene el valor de tipoAsiento
     */ 
    public function getTipoAsiento(){
        return $this->tipoAsiento;
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
    public function __construct($arrayPasajeros,$cantidadMax,$destino,$codigoViaje, $objResponsableV, $importe, $tipoAsiento){
        $this->arrayPasajeros = $arrayPasajeros;
        $this->cantidadMax = $cantidadMax;
        $this->destino = $destino;
        $this->codigoViaje = $codigoViaje;
        $this->objResponsableV= $objResponsableV;
        $this->importe= $importe;
        $this->tipoAsiento= $tipoAsiento;
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
     * @return boolean
     */
    public function quitarPasajero($documento){
        $arrayPasajeros = $this->getArrayPasajeros();
        $objPasajero = $this->buscarPasajero($documento);
        $i=0;
        if ($objPasajero <> null){
            unset($arrayPasajeros[$i]); //unset elimina el elemento seleccionado del array
            sort($arrayPasajeros); // sor ordena todos los elementos de un array para que vaya del 0 a la N
            $this->setArrayPasajeros($arrayPasajeros);
            $quitar=true;
        }else{
            $quitar=false;
        }
        return $quitar;
        }

    /**
    * Esta función le permite al pasajero cambiar sus datos 
    * @param int $dni
    * @param string $dato
    * @param int $opcion
    * @return boolean
    */
    public function cambiarDatoPasajero($dni, $dato, $opcion){
        $arrayPasajeros = $this->getArrayPasajeros();
        $objPasajero= $this->buscarPasajero($dni);
        if($objPasajero <> null)
        {
            switch ($opcion){
                case 1: 
                    $objPasajero->setNombre($dato);
                    break;

                case 2: 
                    $objPasajero->setApellido($dato);
                break;

                case 3: 
                    $objPasajero->setTelefono($dato);
                    break;                      
            }
            $modificado=true;
        }else {
            $modificado=false;
        }
        return $modificado;
    }

    /**
    * Esta función le permite al responsable del viaje cambiar sus datos
    * @param string $dato
    * @param int $opcion
    */
    public function cambiarDatoResponsable($opcion, $dato){
        $objResponsableV = $this->getObjResponsableV();
        switch ($opcion){            
            case 1: 
                $objResponsableV->setNombre($dato);
                break;

            case 2: 
                $objResponsableV->setApellido($dato);
            break;

            case 3: 
                $objResponsableV->setNmroEmpleado($dato);
                break;              
            
            case 4: 
                $objResponsableV->setNmroLicencia($dato);
                break;                  
        }   
    }    
    
    /**
    * Esta función permite cambiar los datos del viaje 
    * @param string $dato
    * @param int $opcion
    */
    public function cambiarDatosViaje($dato, $opcion){
        switch ($opcion){            
            case 1: 
                $this->setCodigoViaje($dato);
                break;

            case 2: 
                $this->setDestino($dato);
            break;

            case 3: 
                $this->setCantidadMax($dato);
                break;      
        }   
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
     * @return string
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
     * @return int 
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
     * Este modulo devuelve el responsable del viaje
     * @return object
     */
    public function verResponsableV(){
        $objResponsableV = $this->getObjResponsableV();
        return $objResponsableV;
    }

        
    /**
     * Este módulo busca si existe el pasajero y devuelve un objeto 
     * @param int $dni
     * @return object
    */
    public function buscarPasajero($dni){
        $arrayPasajeros = $this->getArrayPasajeros();
        $i = 0;
        $dimension = count($arrayPasajeros);
        $pasajeroEncontrado= null; //null = vacío
        if($this->existePasajero($dni)){
            do{
                $seguirBuscando = true;
                if($arrayPasajeros[$i]-> getDni() == $dni){ 
                    $seguirBuscando = false;
                    $pasajeroEncontrado= $arrayPasajeros[$i];
                }else{
                $i++;
                }
            }while($seguirBuscando && ($i < $dimension));
        }
        return ($pasajeroEncontrado);
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
     * Este módulo recibe como parámetro un pasajero y registra la venta si hay capacidad
     * @param object $pasajero
     * @return int 
     */
    public function venderPasaje($objPasajero){
        $importe= null; 
        if($this->hayCapacidad()){
            $this->agregarPasajero($objPasajero);
            $importe= $this->getImporte();
        }
        return $importe;
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
                "El responsable del viaje es: ".$this->getObjResponsableV(). "\n".
                "El importe del viaje es: ".$this->getImporte()."\n".
                "El tipo de asiento de su viaje es: ".$this->getTipoAsiento(). "\n";
    }
      

    
}

?>