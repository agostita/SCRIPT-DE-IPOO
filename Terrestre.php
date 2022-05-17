<?php

class Terrestre extends Viaje{

    public function __construct($arrayPasajeros,$cantidadMax,$destino,$codigoViaje, $objResponsableV, $importe, $tipoAsiento){
        parent:: __construct($arrayPasajeros,$cantidadMax,$destino,$codigoViaje, $objResponsableV, $importe, $tipoAsiento);
    }
    
/**
 *Este módulo recibe como parámetro un pasajero y registra la venta si hay capacidad
 * @param object $objPasajero
 *@return int
 */
public function venderPasaje($objPasajero){
    $importe= parent:: venderPasaje($objPasajero);
    if($importe != null){
        $tipoAsiento= parent::getTipoAsiento();                            // ? = enconces // : = sino
        $importeCama=($tipoAsiento == 1) ? ($importe*1.25) : ($importe); //1 representa la opción tipo asiento CAMA. 
        $importe= $importe + $importeCama;
    }
    return $importe;
}
}