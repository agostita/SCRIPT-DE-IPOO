<?php
include "Viaje.php"; //los include los hacemos dentro del test y no de otra clase. 
include "Pasajero.php";
include "ResponsableV.php";
include "Terrestre.php";
include "Aereo.php";



//viaje 1
$arrayObjPasajero[0]= new Pasajero("Raúl", "Mishi", 37965417, 29958463);
$arrayObjPasajero[1]= new Pasajero("Ricardo", "Caniche", 35965417, 29958468);
//viaje 2
$arrayObjPasajero2= [new Pasajero("Fran", "Martin", 37965416, 29958487), new Pasajero("Pedro", "Alberti", 35965419, 299584565)];
$objResponsableV= new ResponsableV("Román", "Riquelme", 10, 9);

$viaje1= [254, "Brasil", 3, $arrayObjPasajero2, $objResponsableV, 10000, 1];
$viaje2= [252, "Perú", 2, $arrayObjPasajero, $objResponsableV, 15000, 1];


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
    echo "3) Ver datos de un pasajero"."\n";
    echo "4) Modificar los datos de un pasajero."."\n";
    echo "5) Agregar pasajeros al viaje."."\n";
    echo "6) Eliminar un pasajero del viaje."."\n";
    echo "7) Ver datos del responsable viaje"."\n";
    echo "8) Cambiar datos del responsable del viaje"."\n";
    echo "9) Ver datos del viaje."."\n";
    echo "10) Cambiar destino del viaje."."\n";
    echo "11) Cambiar capacidad maxima del viaje."."\n";
    echo "12) Cambiar codigo del viaje."."\n";
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
    $arrayPasajeros = [];
    for($i = 0; $i < $cantidad; $i++){
        separador();
        echo "Ingrese el nombre del pasajero ".($i+1).": ";
        $nombrePasajero =  trim(fgets(STDIN));
        echo "Ingrese el apellido del pasajero ".($i+1).": ";
        $apellidoPasajero =  trim(fgets(STDIN));
        echo "Ingrese el DNI del pasajero ".($i+1).": ";
        $dniPasajero =  trim(fgets(STDIN));
        echo "Ingrese el teléfono del pasajero ".($i+1).": ";
        $telPasajero =  trim(fgets(STDIN));        
        separador();
        echo "\n";
        $arrayPasajeros[$i] = new Pasajero($nombrePasajero, $apellidoPasajero, $dniPasajero, $telPasajero);        
    }
    return $arrayPasajeros;
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
echo "Ingrese el codigo del viaje: "."\n";
$codigoViaje = trim(fgets(STDIN));
echo "Ingrese el destino del viaje: "."\n";
$destViaje = trim(fgets(STDIN));
echo "Ingrese la cantidad máxima de personas que pueden realizar el viaje: "."\n";
$cantMax = verificadorInt(trim(fgets(STDIN)));
echo "Ingrese la cantidad de personas que realizaran el viaje: "."\n";
$cantPersonas = verificadorInt(trim(fgets(STDIN)));
if($cantPersonas <= $cantMax){
    $arrayPasajeros = personasViaje($cantPersonas);
    $objViaje = new Viaje($arrayPasajeros,$cantMax,$destViaje,$codigoViaje, $objResponsableV, $importe, $tipoAsiento);
    echo "El viaje se ha creado correctamente!"."\n";
}else{
    echo "La cantidad de pasajeros supera a la cantidad maxima del viaje!"."\n";
}
separador();

$opcion = menu();
do {
switch ($opcion) { //Según lo visto en clase, switch es una instrucción de estructura de control alternativa, ya que, es similar a la instrucción IF
    
    case 1: 
        separador();
        echo "La cantidad actual de pasajeros del viaje a ".$objViaje->getDestino()." son: ".$objViaje->cantidadPasajeros()."\n";
        separador();
        $opcion = menu();
        break;


    case 2: 
        separador();
        echo "Las personas del viaje a ".$objViaje->getDestino()." son: ".$objViaje->verPasajeros() ."\n";
        separador();
        $opcion = menu();
        break;

        
    case 3: 
        separador();
        echo "Ingrese el DNI del pasajero que desea buscar: ";
        $dni = trim(fgets(STDIN));
        if($objViaje->existePasajero($dni)){
            echo "Los datos del pasajero ".$dni." son:"."\n". $objViaje->verUnPasajero($dni)."\n";
        }
        separador();
        $opcion = menu();
        break;
       
        
    case 4: 
        separador();
        echo "Ingrese el DNI de que pasajero desea cambiar el dato: ";
        $dni = trim(fgets(STDIN));
        if($objViaje->existePasajero($dni)){
            echo "Ingrese que dato desea cambiar: 1(Nombre), 2 (Apellido) ó 3 (Teléfono): ". "\n";
            $nmroOpcion = trim(fgets(STDIN)); //minúscula
            while((($nmroOpcion <> 1) && ($nmroOpcion <> 2) && ($nmroOpcion <> 3))){
                echo "El valor ".$nmroOpcion." no es correcto, Por favor ingrese opción 1, 2 ó 3: "."\n";
                $nmroOpcion = trim(fgets(STDIN));
            }
            echo "Ingrese el nuevo dato: ";
            $nuevoDato = trim(fgets(STDIN));
            $objViaje->cambiarDatoPasajero($dni,$nuevoDato,$nmroOpcion);
            echo "El dato se ha modificado correctamente!"."\n";
            echo $objViaje->verUnPasajero($dni);
        }else{
            echo "El pasajero no se ha encontrado"."\n";
        }
        separador();
        $opcion = menu();
        break;
        

    case 5: 
        separador();
        $capacidad = $objViaje->hayCapacidad();
        if($capacidad){
            echo "Ingrese cuántos pasajeros nuevos ingresarán al viaje: ";
            $pasajerosNuevos = trim(fgets(STDIN));
            $cantidadAumentada = $objViaje->cantidadPasajeros() + $pasajerosNuevos;
            if($cantidadAumentada <= $objViaje->getCantidadMax()){
                $nuevosPasajeros= personasViaje($pasajerosNuevos);
                $arrayPasajeroNuevo=array_merge($objViaje->getArrayPasajeros(), $nuevosPasajeros);
                $objViaje->setArrayPasajeros($arrayPasajeroNuevo);
                echo "Los pasajeros se agregaron correctamente al viaje!"."\n";
            }else{
                echo "La cantidad de pasajeros es superior a la capacidad máxima!"."\n";
            }
        }else{
            echo "El viaje ya está lleno!"."\n";
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
            echo "El DNI no coincide con ningún pasajero del viaje"."\n";
        }
        separador();
        $opcion = menu();
        break;

    case 7:
        separador();
        echo "Los datos del responsable del viaje a: ". $objViaje->getDestino(). " son: "."\n";
        echo $objResponsableV. "\n";
        $opcion = menu();
        break;

    case 8: 
        separador();
        echo "Ingrese el dato que desea modificar del responsable del viaje: 1 (Nombre), 2 (Apellido), 3 (número de empleado) ó 
        4 (número de licencia)"."\n";
        $opcionElegida= trim(fgets(STDIN));
        while((($opcionElegida <> 1) && ($nmroOpcion <> 2) && ($nmroOpcion <> 3) && ($nmroOpcion <> 4))){
            echo "El valor ".$opcionElegida." no es correcto, Por favor ingrese opción 1, 2, 3 ó 4: "."\n";
            $opcionElegida = trim(fgets(STDIN));
        }    
        echo "Ingrese el nuevo dato: ";
        $datoNuevo = trim(fgets(STDIN));
        $objViaje->cambiarDatoResponsable($opcionElegida,$datoNuevo);
        echo "El dato se ha modificado correctamente!"."\n";
        echo $objViaje->getObjResponsableV();
        $opcion = menu();
        break;

     case 9: 
        separador();
        echo "Los datos del viaje a ".$objViaje->getDestino()." son: "."\n";
        echo $objViaje."\n";
        separador();
        $opcion = menu();
        break;


    case 10: 
        separador();
        echo "Ingrese el nuevo destino: ";
        $nuevoDestino = trim(fgets(STDIN));
        $objViaje->setDestino($nuevoDestino);
        echo "\n"."El destino se ha cambiado correctamente!"."\n";
        separador();
        $opcion = menu();
        break;


    case 11: 
        separador();
        echo "Ingrese la nueva capacidad del viaje: ";
        $nuevaCapacidad = trim(fgets(STDIN));
        while(is_numeric($nuevaCapacidad) == false){
            echo "El valor ".$nuevaCapacidad." no es correcto, Por favor ingrese números: ";
            $nuevaCapacidad = trim(fgets(STDIN));
        }
        $objViaje->setCantidadMax($nuevaCapacidad);
        echo "La capacidad se ha cambiado correctamente!"."\n";
        separador();
        $opcion = menu();
        break;


    case 12: 
        separador();
        echo "Ingrese el nuevo código del viaje: ";
        $nuevoCodigo = trim(fgets(STDIN));
        $objViaje->setCodigoViaje($nuevoCodigo);
        echo "El código se ha cambiado correctamente!"."\n";
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