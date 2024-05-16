<?php
class PasajerosEspeciales extends Pasajero{
    private $incrementoImporte;
    private $necesidad;

	public function __construct($nombre,$apellido,$numDocumento,$numTelefono, $nroAsiento, $nroTicket,$necesidad) {
        parent::__construct($nombre,$apellido,$numDocumento,$numTelefono, $nroAsiento, $nroTicket);
		$this->necesidad = $necesidad;
        $this->incrementoImporte=15;
	}

    //observadores
	public function getNecesidad() {
		return $this->necesidad;
	}

    //modificadores
	public function setNecesidad($necesidad) {
		$this->necesidad = $necesidad;
	}

    //propias del tipo
    public function __toString(){
        $cadena=parent::__toString();

        $cadena.="\nnecesidad: ".$this->getNecesidad();
        return $cadena;
    }
 
    /**
     * Si requiere silla de ruedas, asistencia y comida especial entonces el pasaje tiene un incremento del 30%:
     * si solo requiere uno de los servicios prestados entonces el incremento es del 15%
     * @return Int
     */
    public function darPorcentajeIncremento(){
        $porcentaje=parent::darPorcentajeIncremento();
        if(strcmp($this->getNecesidad(),"todo")==0){
            $Incrementoporc=$porcentaje+($this->incrementoImporte*2);
        }else{
            $Incrementoporc=$porcentaje+$this->incrementoImporte;
        }
        return $Incrementoporc;
    }

    public function igual($dni){
        $cumple=parent::igual($dni);
        return $cumple;
    }

    public function cambiarInformacion($opcionCambio,$otroDato){
        $cumple=parent::cambiarInformacion($opcionCambio,$otroDato);

        if(!$cumple){
            if(strcmp($otroDato,$this->getNecesidad())!=0){
                $this->setNecesidad($otroDato);
                $cumple=true;
            }
        }
    return $cumple;
    }
}