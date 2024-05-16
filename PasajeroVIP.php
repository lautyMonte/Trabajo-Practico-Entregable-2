<?php
class PasajeroVIP extends Pasajero{
    private $incrementoImporte;
    private $nroViajesFrecuentes;
    private $cantMillas;

	public function __construct($nombre,$apellido,$numDocumento,$numTelefono, $nroAsiento, $nroTicket,$nroViajesFrecuentes, $cantMillas) {
        parent::__construct($nombre,$apellido,$numDocumento,$numTelefono, $nroAsiento, $nroTicket);
		$this->nroViajesFrecuentes = $nroViajesFrecuentes;
		$this->cantMillas = $cantMillas;
        $this->incrementoImporte=35;
	}

    //observadores
	public function getNroViajesFrecuentes() {
		return $this->nroViajesFrecuentes;
	}

	public function getCantMillas() {
		return $this->cantMillas;
	}

    //modificadores
	public function setNroViajesFrecuentes($nroViajesFrecuentes) {
		$this->nroViajesFrecuentes = $nroViajesFrecuentes;
	}

    public function setCantMillas($cantMillas) {
		$this->cantMillas = $cantMillas;
	}

    //propias del tipo
    public function __toString(){
        $cadena=parent::__toString();
        
        $cadena.="\ncantidad de viajes frecuentes: ".$this->getNroViajesFrecuentes(); 
        $cadena.="\ncantidad de millas: ".$this->getCantMillas();
        return $cadena;
    }
 
    /**
     * Al ser VIP se le incrementara un 35% y ademas, si el recorrido supera las 300 millas,
     * se le añaden otros 30%
     * @return Int
     */
    public function darPorcentajeIncremento(){
        $porcentaje=parent::darPorcentajeIncremento();
        $Incrementoporc=$porcentaje+$this->incrementoImporte;
        if($this->getCantMillas()>300){
            $Incrementoporc=$Incrementoporc+($this->incrementoImporte-5);//para agregarle un 30%
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
            if(strcmp($opcionCambio,"frecuencia")==0){
                if($otroDato!=$this->getNroViajesFrecuentes()){
                    $this->setNroViajesFrecuentes($otroDato);
                    $cumple=true;
                }
            }else{
                if($otroDato!=$this->getCantMillas()){
                    $this->setCantMillas($otroDato);
                    $cumple=true;
                }
            }
        }
        return $cumple;
    }

}