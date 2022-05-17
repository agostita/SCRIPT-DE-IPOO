<?php
class Aereo extends Viaje{
    private $nroVuelo;
    private $nombreAerolinea; 
    private $cantEscalas;


    public function __construct($arrayPasajeros,$cantidadMax,$destino,$codigoViaje, $objResponsableV, $importe, $tipoAsiento, $nroVuelo,
    $nombreAerolinea, $cantEscalas){
        parent:: __construct($arrayPasajeros,$cantidadMax,$destino,$codigoViaje, $objResponsableV, $importe, $tipoAsiento);
        $this->nroVuelo= $nroVuelo;
        $this->nombreAerolinea= $nombreAerolinea;
        $this->cantEscalas= $cantEscalas;       

    }
    

    /**
     * Obtiene el valor de nroVuelo
     */ 
    public function getNroVuelo(){
        return $this->nroVuelo;
    }

    /**
     * Obtiene el valor de nombreAerolinea
     */ 
    public function getNombreAerolinea(){
        return $this->nombreAerolinea;
    }

    /**
     * Obtiene el valor de cantEscalas
     */ 
    public function getCantEscalas(){
        return $this->cantEscalas;
    }

    /**
     * Establece el valor de cantEscalas
     */ 
    public function setCantEscalas($cantEscalas){
        $this->cantEscalas = $cantEscalas;
    }

    /**
     * Establece el valor de nombreAerolinea
     */ 
    public function setNombreAerolinea($nombreAerolinea){
        $this->nombreAerolinea = $nombreAerolinea;
    }

    /**
     * Establece el valor de nroVuelo
     */ 
    public function setNroVuelo($nroVuelo){
        $this->nroVuelo = $nroVuelo;
    }

    /**
    *Este módulo recibe como parámetro un pasajero y registra la venta si hay capacidad
    * @param object $objPasajero
    *@return int
    */
    public function venderPasaje($objPasajero){
        $importe= parent:: venderPasaje($objPasajero);
        if($importe != null){
            $tipoAsiento= parent::getTipoAsiento();   
            if(($tipoAsiento == 1) && ($this->getCantEscalas() > 0) ){
                $importe= $importe * 1.6; //primera clase con escala
            }else if (($tipoAsiento == 1) ($this->getCantEscalas() == 0)){
                $importe= $importe * 1.4; //primera clase sin escalas
            }else if (($tipoAsiento == 1) ($this->getCantEscalas() > 0)){
                $importe= $importe *1.2; // regular sin escala
            }
                        
        }return $importe;
}
}