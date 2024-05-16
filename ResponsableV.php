<?php
class ResponsableV{
    private $numEmpleado;
    private $numLicencia;
    private $nombreEmpleado;
    private $apellidoEmpleado;

    public function __construct($numEmpleado,$numLicencia,$nombre,$apellido){
        $this->numEmpleado=$numEmpleado;
        $this->numLicencia=$numLicencia;
        $this->nombreEmpleado=$nombre;
        $this->apellidoEmpleado=$apellido;
    }

    //observadores
    public function getNumEmpleado(){
        return $this->numEmpleado;
    }

    public function getNumLicencia(){
        return $this->numLicencia;
    }

    public function getNombreEmpleado(){
        return $this->nombreEmpleado;
    }

    public function getApellidoEmpleado(){
        return $this->apellidoEmpleado;
    }

    //modificadores
    public function setNumEmpleado($numEmpleado){
        $this->numEmpleado=$numEmpleado;
    }

    public function setNumLicencia($numLicencia){
        $this->numLicencia=$numLicencia;
    }

    public function setNombreEmpleado($nombre){
        $this->nombreEmpleado=$nombre;
    }

    public function setApellidoEmpleado($apellido){
        $this->apellidoEmpleado=$apellido;
    }

    //propias del tipo
    public function __toString(){
        return "\nnumero empleado: ".$this->getNumEmpleado().
        "\nnumero de licencia: ".$this->getNumLicencia()."\nnombre: ".$this->getNombreEmpleado().
        "\napellido: ".$this->getApellidoEmpleado();
    }

    /**
     * Cambia la informacion, que se quiera cambiar, del Responsable del viaje
     * @param string
     * @param string
     * @return boolean
     */
    public function cambiarInfo($opcionCambio,$otroDato){
        $cumple=false;
        switch($opcionCambio){
            case "numero":
                if($otroDato!=$this->getNombreEmpleado()){
                    $this->setNumEmpleado($otroDato);
                    $cumple=true;
                };break;
            case "licencia":
                if($otroDato!=$this->getNumLicencia()){
                    $this->setNumEmpleado($otroDato);
                    $cumple=true;
                };break;
            case "nombre":
                if(strcmp($otroDato,$this->getNombreEmpleado())!=0){
                    $this->setNombreEmpleado($otroDato);
                    $cumple=true;
                };break;
            case "apellido":
                if(strcmp($otroDato,$this->getApellidoEmpleado())!=0){
                    $this->setApellidoEmpleado($otroDato);
                    $cumple=true;
                };break;
        }
        return $cumple;
    }
}
?>