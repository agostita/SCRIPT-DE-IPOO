<?php
include "Viaje.php";

/**************************************/
/************** MODULOS ***************/
/**************************************/

/**
 * Muestra el menu para que el usuario elija y retorna la opcion
 * @return int 
 */
function menu()
{
    // int $menu
    echo "\n"."MENU DE OPCIONES"."\n";
    echo "1) Saber la cantidad de pasajeros."."\n";
    echo "2) Ver los pasajeros del viaje."."\n";
    echo "3) Ver datos del viaje."."\n";
    echo "4) Modificar los datos de un pasajero."."\n";
    echo "5) Agregar un pasajeros al viaje."."\n";
    echo "6) Eliminar un pasajero del viaje."."\n";
    echo "7) Ver datos de un pasajero"."\n";
    echo "8) Cambiar destino del viaje."."\n";
    echo "9) Cambiar capacidad maxima del viaje."."\n";
    echo "10) Cambiar codigo del viaje."."\n";
    echo "0) Salir"."\n";
    echo "Opcion: ";
    $menu = trim(fgets(STDIN));
    echo "\n";
    return $menu;
}

/**
 * Retorna un array con todos los pasajeros del viaje
 * @param int $cantidad
 * @return array
 */
function personasViaje($cantidad)
{
    $arrayPersonas = [];
    for($i = 0; $i < $cantidad; $i++){
        separador();
        echo "ingrese el nombre del pasajero ".($i+1).": ";
        $nombrePasajero =  trim(fgets(STDIN));
        echo "ingrese el apellido del pasajero ".($i+1).": ";
        $apellidoPasajero =  trim(fgets(STDIN));
        echo "ingrese el DNI del pasajero ".($i+1).": ";
        $dniPasajero =  trim(fgets(STDIN));
        separador();
        echo "\n";
        $arrayPersonas[$i] = ["nombre"=> $nombrePasajero,"apellido"=> $apellidoPasajero,"documento"=>$dniPasajero];
    }
    return $arrayPersonas;
}

/**
 * Devuelve por pantalla un string que separa los puntos
 */
function separador()
{
    echo "--------------------------------------------------"."\n";
}

/**
 * Verifica que el valor ingreasado sea un entero, en caso contario lo vuelve a pedir hasta que sea un entero
 * @param int $dato
 * @return int
 */
function verificadorInt($dato)
{
    while(is_numeric($dato) == false){
        echo "El valor ".$dato." no es correcto, Por favor ingrese numeros: ";
        $dato = trim(fgets(STDIN));
    }
    return $dato;
}


/**************************************/
/********* PROGRAMA PRINCIPAL *********/
/**************************************/


//Este programa ejecuta segun la opcion elegida del usuario la secuencia de pasos a seguir
echo "Bienvenido a su viaje"."\n";
echo "Ingrese el codigo del viaje: ";
$codigoViaje = trim(fgets(STDIN));
echo "Ingrese el destino del viaje: ";
$destViaje = trim(fgets(STDIN));
echo "Ingrese la cantidad de personas maximas que pueden realizar el viaje: ";
$cantMax = trim(fgets(STDIN));
verificadorInt($cantMax);
echo "Ingrese la cantidad de personas que realizaran el viaje: ";
$cantPersonas = trim(fgets(STDIN));
verificadorInt($cantPersonas);
if($cantPersonas <= $cantMax){
    $personas = personasViaje($cantPersonas);
    $objViaje = new Viaje($personas,$cantMax,$destViaje,$codigoViaje);
    echo "El viaje se ha creado correctamente!"."\n";
}else{
    echo "La cantidad de personas supera a la cantidad maxima del viaje!"."\n";
}
separador();

$opcion = menu();
do {
switch ($opcion) { //Según lo visto en clase, switch es una instrucción de estructura de control alternativa, ya que, es similar a la instrucción IF
    
    case 1: 
        separador();
        echo "la cantidad de pasajeros del viaje ".$objViaje->getDestino()." es: ".$objViaje->cantidadPasajeros()."\n";
        separador();
        $opcion = menu();
        break;


    case 2: 
        separador();
        echo "Las personas del viaje ".$objViaje->getDestino()." son: "."\n";
        $objViaje->verPasajeros();
        separador();
        $opcion = menu();
        break;

        
    case 3: 
        separador();
        echo "Los datos del viaje ".$objViaje->getDestino()." son: "."\n";
        echo $objViaje."\n";
        separador();
        $opcion = menu();
        break;
       
        
    case 4: 
        separador();
        echo "Ingrese el DNI de que pasajero desea cambiar el dato: ";
        $dni = trim(fgets(STDIN));
        if($objViaje->existePasajero($dni)){
            echo "Ingrese que dato desea cambiar (Nombre/Apellido/Documento): ";
            $tipoDatoCambiar = strtolower(trim(fgets(STDIN)));
            while((($tipoDatoCambiar <> "nombre") && ($tipoDatoCambiar <> "apellido") && ($tipoDatoCambiar <> "documento"))){
                echo "El valor ".$tipoDatoCambiar." no es correcto, Por favor ingrese (Nombre/Apellido/Documento): ";
                $tipoDatoCambiar = trim(fgets(STDIN));
            }
            echo "Ingrese el nuevo dato: ";
            $nuevoValor = trim(fgets(STDIN));
            $objViaje->cambiarDatoPasajero($dni,$tipoDatoCambiar,$nuevoValor);
            echo "El dato se ha modificado correctamente!"."\n";
        }else{
            echo "Debes crear un viaje antes de usas las opciones. Seleccione la opcion 1"."\n";
        }
        separador();
        $opcion = menu();
        break;
        

    case 5: 
        separador();
        $superaCapacidad = $objViaje->superaCapacidad();
        if($superaCapacidad){
            echo "Ingrese cuantos pasajeros nuevos ingresaran al viaje: ";
            $pasajerosNuevos = trim(fgets(STDIN));
            $cantidadAumentada = $objViaje->cantidadPasajeros() + $pasajerosNuevos;
            if($cantidadAumentada <= $objViaje->getCantidadMax()){
                for($i=0;$i < $pasajerosNuevos;$i++){
                    echo "Ingrese el nombre del nuevo pasajero: ";
                    $nombrePasajero = trim(fgets(STDIN));
                    echo "Ingrese el apellido del nuevo pasajero: ";
                    $apellidoPasajero = trim(fgets(STDIN));
                    echo "Ingrese el DNI del nuevo pasajero: ";
                    $dniPasajero = trim(fgets(STDIN));
                    $pasajero = ["nombre"=> $nombrePasajero,"apellido"=> $apellidoPasajero,"documento"=>$dniPasajero];
                    $objViaje->agregarPasajero($pasajero);
                }
                echo "Los pasajeros se agregaron correctamente al viaje!"."\n";
            }else{
                echo "La cantidad de pasajeros es superior a la capacidad maxima!"."\n";
            }
        }else{
            echo "El vuelo ya esta lleno!"."\n";
        }
        separador();
        $opcion = menu();
        break;
        

    case 6: 
        separador();
        echo "Ingrese el DNI del pasajero que desea eliminar: ";
        $dni = trim(fgets(STDIN));
        if($objViaje->existePasajero($dni)){
            $objViaje->quitarPasajero($dni);
            echo "El pasajero se eliminó correctamente!"."\n";
        }else{
            echo "El DNI no coincide con ningún pasajero del vuelo"."\n";
        }
        separador();
        $opcion = menu();
        break;
        

    case 7: 
        separador();
        echo "Ingrese el DNI del pasajero que desea buscar: ";
        $dni = trim(fgets(STDIN));
        if($objViaje->existePasajero($dni)){
            echo "Los datos del pasajero ".$dni." son:"."\n";
            $objViaje->verUnPasajero($dni);
        }
        separador();
        $opcion = menu();
        break;


    case 8: 
        separador();
        echo "ingrese el nuevo destino: ";
        $nuevoDestino = trim(fgets(STDIN));
        $objViaje->setDestino($nuevoDestino);
        echo "El destino se ha cambiado correctamente!"."\n";
        separador();
        $opcion = menu();
        break;


    case 9: 
        separador();
        echo "ingrese la nueva capacidad del viaje: ";
        $nuevaCapacidad = trim(fgets(STDIN));
        while(is_numeric($nuevaCapacidad) == false){
            echo "El valor ".$nuevaCapacidad." no es correcto, Por favor ingrese numeros: ";
            $nuevaCapacidad = trim(fgets(STDIN));
        }
        $objViaje->setCantidadMax($nuevaCapacidad);
        echo "La capacidad se ha cambiado correctamente!"."\n";
        separador();
        $opcion = menu();
        break;


    case 10: 
        separador();
        echo "ingrese el nuevo codigo del viaje: ";
        $nuevoCodigo = trim(fgets(STDIN));
        $objViaje->setCodigoViaje($nuevoCodigo);
        echo "El codigo se ha cambiado correctamente!"."\n";
        separador();
        $opcion = menu();
        break;


    default: 
        echo "El número que ingresó no es válido, por favor ingrese un número del 0 al 10"."\n"."\n";
        $opcion = menu();
        break;
    }
} while ($opcion < 0 || $opcion > 0);
exit();
?>