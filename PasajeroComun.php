<?php
class PasajeroComun extends Pasajero{
    private $incrementoImporte;

	public function __construct($nombre,$apellido,$numDocumento,$numTelefono, $nroAsiento, $nroTicket) {
        parent::__construct($nombre,$apellido,$numDocumento,$numTelefono, $nroAsiento, $nroTicket);
        $this->incrementoImporte=10;
	}

    //propias del tipo
    public function __toString(){
        $cadena=parent::__toString();
        return $cadena;
    }

    /**
     * Retorna el 10% de incremento
     * @return Int
     */
    public function darPorcentajeIncremento(){
        $porcentaje=parent::darPorcentajeIncremento();
        $Incrementoporc=$porcentaje+$this->incrementoImporte;
        return $Incrementoporc;
    }

    public function igual($dni){
        $cumple=parent::igual($dni);
        return $cumple;
    }


    public function cambiarInformacion($opcionCambio,$otroDato){
        $cumple=parent::cambiarInformacion($opcionCambio,$otroDato);
        return $cumple;
    }

}