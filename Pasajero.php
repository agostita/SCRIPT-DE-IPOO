<?php
/*Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos nombre, apellido, numero de documento 
* y teléfono.*/
class Pasajero{
    private $nombre;
    private $apellido; 
    private $dni;
    private $telefono;
   

    /**
     * Obtener el valor de nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Obtener el valor de apellido
     */ 
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Obtener el valor de dni
     */ 
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Obtener el valor de telefono
     */ 
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Establecer el valor de nombre
     *
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Establecer el valor de apellido
     *
     */ 
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

    }

    /**
     * Establecer el valor de dni
     *
     */ 
    public function setDni($dni)
    {
        $this->dni = $dni;

    }

    /**
     * Establecer el valor de telefono
     *
     */ 
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

    }

    public function __construct($nombre, $apellido, $dni, $telefono)
    {
        $this->nombre= $nombre;
        $this->apellido= $apellido;
        $this->dni= $dni;
        $this->telefono= $telefono;
        
    }

    public function __toString()
    {
        return "\n"."Nombre: ". $this->getNombre()."\n".
        "Apellido: ". $this->getApellido()."\n".
        "DNI: ". $this->getDni()."\n".
        "Teléfono: ". $this->getTelefono()."\n";
    }
    
}