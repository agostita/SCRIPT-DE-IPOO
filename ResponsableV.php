<?php
/*También se desea guardar la información de la persona responsable de realizar el viaje, para ello cree una clase ResponsableV 
* que registre el número de empleado, número de licencia, nombre y apellido. La clase Viaje debe hacer referencia al responsable
*  de realizar el viaje.  */

class ResponsableV{
    private $nombre;
    private $apellido;
    private $nmroEmpleado;
    private $nmroLicencia;
    

    /**
     * Obtiene el valor de nombre
     */ 
    public function getNombre(){
        return $this->nombre;
    }

    /**
     * Obtiene el valor de apellido
     */ 
    public function getApellido(){
        return $this->apellido;
    }

    /**
     * Obtiene el valor de nmroEmpleado
     */ 
    public function getNmroEmpleado(){
        return $this->nmroEmpleado;
    }

    /**
     * Obtiene el valor de nmroLicencia
     */ 
    public function getNmroLicencia(){
        return $this->nmroLicencia;
    }

    /**
     * Establece el valor de nombre
     */ 
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    /**
     * Establece el valor de apellido
     */ 
    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    /**
     * Establece el valor de nmroEmpleado
     */ 
    public function setNmroEmpleado($nmroEmpleado){
        $this->nmroEmpleado = $nmroEmpleado;
    }

    /**
     * Establece el valor de nmroLicencia
     */ 
    public function setNmroLicencia($nmroLicencia){
        $this->nmroLicencia = $nmroLicencia;
    }

    public function __construct($nombre, $apellido, $nmroLicencia, $nmroEmpleado)
    {
        $this->nombre= $nombre;
        $this->apellido= $apellido;
        $this->nmroEmpleado= $nmroEmpleado;
        $this->nmroLicencia= $nmroLicencia;        
    }

    public function __toString()
    {
        
        return "\n"."Nombre del responsable: ".$this->getNombre()."\n".
        "Apellido responsable del viaje: ".$this->getApellido()."\n".
        "Número de empleado del responsable: ".$this->getNmroEmpleado()."\n".
        "Número de licencia del responsable: ".$this->getNmroLicencia()."\n";

    }
}