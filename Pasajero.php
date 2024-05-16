<?php
class Pasajero{
    private $nombre;
    private $apellido;
    private $numDocumento;
    private $numTelefono;
    private $nroAsiento;
    private $nroTicket;

	public function __construct($nombre,$apellido,$numDocumento,$numTelefono, $nroAsiento, $nroTicket) {

		$this->nombre = $nombre;
        $this->apellido=$apellido;
        $this->numDocumento=$numDocumento;
        $this->numTelefono=$numTelefono;
		$this->nroAsiento = $nroAsiento;
		$this->nroTicket = $nroTicket;
	}

    //observadores
    public function getNombre() {
		return $this->nombre;
	}

    public function getApellido(){
        return $this->apellido;
    }

    public function getNumDocumento(){
        return $this->numDocumento;
    }

    public function getNumTelefono(){
        return $this->numTelefono;
    }

	public function getNroAsiento() {
		return $this->nroAsiento;
	}

	public function getNroTicket() {
		return $this->nroTicket;
	}

    //modificadores
    public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

    public function setApellido($apellido){
        $this->apellido=$apellido;
    }

    public function setNumDocumento($numDocumento){
        $this->numDocumento=$numDocumento;
    }

    public function setNumTelefono($numTelefono){
        $this->numTelefono=$numTelefono;
    }

    public function setNroAsiento($nroAsiento) {
		$this->nroAsiento = $nroAsiento;
	}

    public function setNroTicket($nroTicket) {
		$this->nroTicket = $nroTicket;
    }

    //propias del tipo
    public function __toString(){
        $cadena="";

        $cadena.= "\nnombre: ".$this->getNombre();
        $cadena.="\napellido: ".$this->getApellido();
        $cadena.="\nnro de documento: ".$this->getNumDocumento();
        $cadena.="\ntelefono: ".$this->getNumTelefono();
        $cadena.= "\nnro de asiento: ".$this->getNroAsiento();
        $cadena.= "\nnro de ticket: ".$this->getNroTicket();
        return $cadena;
    }

    /**
     * Retorne el porcentaje que debe aplicarse como incremento 
     * según las características del pasajero
     * @return Int
     */
    public function darPorcentajeIncremento(){
        $porcentaje=0;
        return $porcentaje;
    }

    /**
     * Determina si es ya existe el pasajero
     * @param int
     * @return boolean
     */
    public function igual($dni){
        $cumple=false;
        if($dni==$this->getNumDocumento()){
            $cumple=true;
        }
        return $cumple;
    }

    /**
     * Cambia algun dato del pasajero
     * @param string
     * @param string/int
     * @return boolean
     */
    public function cambiarInformacion($opcionCambio,$otroDato){
        $cumple=false;
        switch($opcionCambio){
            case "nombre":
                if(strcmp($otroDato,$this->getNombre())!=0){
                    $this->setNombre($otroDato);
                    $cumple=true;
                };break;
            case "apellido":
                if(strcmp($otroDato,$this->getApellido())!=0){
                    $this->setApellido($otroDato);
                    $cumple=true;
                };break;
            case "telefono":
                if(strcmp($otroDato,$this->getNumTelefono())!=0){
                    $this->setNumTelefono($otroDato);
                    $cumple=true;
                };break;
            case "asiento":
                if($otroDato!=$this->getNroAsiento()){
                   $this->setNroAsiento($otroDato);
                   $cumple=true;
                };break;
        }
        return $cumple;
    }
}