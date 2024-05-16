<?php
class Viaje{
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    private $colPasajeros;
    private $responsableV;
    //modificaciones del TPE2
    private $costo;
    private $costosAbonados;
    //------------------------

    public function __construct($codigo,$destino,$cantMax,$colPasajeros,$responsableV,$costo,$costosAbonados){
        $this->codigo=$codigo;
        $this->destino=$destino;
        $this->cantMaxPasajeros=$cantMax;
        $this->colPasajeros=$colPasajeros;
        $this->responsableV=$responsableV;
        //modificaciones del TPE2
        $this->costo=$costo;
        $this->costosAbonados=$costosAbonados;
        //--------------------------------------
    }

    //observadores
    public function getCodigo(){
        return $this->codigo;
    }

    public function getDestino(){
        return $this->destino;
    }

    public function getCantMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }

    public function getColPasajeros(){
        return $this->colPasajeros;
    }

    public function getResponsableV(){
        return $this->responsableV;
    }

    //-------------modificaciones del TPE2------------------
    public function getCosto(){
        return $this->costo;
    }

    public function getCostosAbonados(){
        return $this->costosAbonados;
    }
    //------------------------------------------------------

    //modificadores
    public function setCodigo($codigo){
        $this->codigo=$codigo;
    }

    public function setDestino($destino){
        $this->destino=$destino;
    }

    public function setCantMaxPasajeros($cantMax){
        $this->cantMaxPasajeros=$cantMax;
    }

    public function setColPasajeros($colPasajeros){
        $this->colPasajeros=$colPasajeros;
    }

    public function setResponsableV($responsableV){
        $this->responsableV=$responsableV;
    }

    //-------------modificaciones del TPE2------------------
    public function setCosto($costo){
        $this->costo=$costo;
    }

    public function setCostosAbonados($costosAbonados){
        $this->costosAbonados=$costosAbonados;
    }
    //------------------------------------------------------


    //propias del tipo
    public function __toString(){
        $pasajeros=$this->getColPasajeros();
        return "<--------datos del viaje------------>\n".
        "codigo:".$this->getCodigo()."\nDestino: ".$this->getDestino()."\nCantidad maxima de pasajeros: ".$this->getCantMaxPasajeros().
        "\nCosto del viaje: $".$this->getCosto().
        "\nCostos abonados: $".$this->getCostosAbonados().
        "\n<-----------responsable del vuelo---------------->".$this->getResponsableV().
        "\n\n<-------Pasajeros que hacen el viaje:---------->\n".$this->ColDeObjetos($pasajeros);
    }

    /**
     * Devuelve la  coleccion de mis objetos en String
     * @return String
     */
    public function ColDeObjetos($coleccionObjeto){
        $coleccion="";
        for($i=0;$i<count($coleccionObjeto);$i++){
            $coleccion.=$coleccionObjeto[$i]."\n";
        }
        return $coleccion;
    }

    //---------------------Modificaciones del TPE2------------------------------
    /**
     * Incorpora un pasajero a la coleccion de pasajeros (si hay espacio disponible)
     * actualiza los costos abonados y retorna lo que debe pagar el pasajero
     * @param Pasajero
     * @return float 
     */
    public function venderPasaje($objPasajero){
        $costoFinal=0;
        $colPasajerosAux=$this->getColPasajeros();
        if(!$this->verificarViajaPasajero($objPasajero) && $this->hayPasajesDisponibles()){
            
            //aca va hacer el calculo del precio que debe pagar el pasajero
            $incremento=$objPasajero->darPorcentajeIncremento();
            $costoFinal=$this->getCosto()*(1+$incremento/100);
            
            //actualiza los costos abonados
            $costoActual=$this->getCostosAbonados();
            $nuevoAbono=$costoActual+$costoFinal;
            $this->setCostosAbonados($nuevoAbono);

            //Incorpora el pasajero a la coleccion de pasajeros
            array_push($colPasajerosAux,$objPasajero);
            $this->setColPasajeros($colPasajerosAux);
        }
        return $costoFinal;
    }

    /**
     * Retorna verdadero si la cantidad de pasajeros del viaje es menor a la cantidad máxima de pasajeros 
     * y falso en el caso contrario
     *@return boolean
     */
    public function hayPasajesDisponibles(){
        $disponible=false;
        $cantCol=count($this->getColPasajeros());
        if($cantCol<$this->getCantMaxPasajeros()){
            $disponible=true;
        }
        return $disponible;
    }

    //--------------------------------------------------------------------------
    /**
     * Busca en el viaje, si se encuentra el pasajero. Si no se encuentra devuelve false 
     * @param Pasajero
     * @return boolean
     */
    public function verificarViajaPasajero($dniPasajero){
        $encontrado=false;
        $i=0;
        $cantCol=count($this->getColPasajeros());
        $colPasajerosAux=$this->getColPasajeros();
        if($cantCol!=0){//es en el caso de que la coleccion de pasajeros en el viaje no se encuentre vacia
            while(!$encontrado & $i<$cantCol){
                if($colPasajerosAux[$i]->igual($dniPasajero)){
                    $encontrado=true;
                }
                $i++;
            }
        }
        return $encontrado;
    }

    /**
     * Busca en el viaje, la posicion donde esta guardado el pasajero 
     * @param Pasajero
     * @return boolean
     */
    public function buscarPosPasajero($dniPasajero){
        $cumple=false;
        $i=0;
        $posPasajero=-1;
        $cantCol=count($this->getColPasajeros());
        $colPasajerosAux=$this->getColPasajeros();
        if($cantCol!=0){//es en el caso de que la coleccion de pasajeros en el vaije no se encuentre vacia
            while(!$cumple & $i<$cantCol){
                if($colPasajerosAux[$i]->igual($dniPasajero)){
                    $cumple=true;
                    $posPasajero=$i;
                }
                $i++;
            }
        }
        return $posPasajero;
    }

    /**
     * Cambia la informacion del pasajero asignado, segun la opcion que eligio
     * @param String
     * @param String
     * @param int
     * @return boolean
     */
    public function cambiarPasajero($opcionCambio,$otroDato,$dniPasajero){
        $posPasajero=$this->buscarPosPasajero($dniPasajero);
        $auxPasajero=$this->getColPasajeros()[$posPasajero];
        $colPasajerosAux=$this->getColPasajeros();
        
        $cumple=$auxPasajero->cambiarInformacion($opcionCambio,$otroDato);
        if($cumple){
            $colPasajerosAux[$posPasajero]=$auxPasajero;
            $this->setColPasajeros($colPasajerosAux);
        }
        return $cumple;
    }

    /**
     * Cambia la informacion del viaje segun la opcion que eligio
     * @param String
     * @param String
     * @return boolean
     */
    public function cambiarViaje($opcionCambio,$otroDato){
        $cumple=false;
        switch($opcionCambio){
            case "codigo":
                if($otroDato!=$this->getCodigo()){
                    $this->setCodigo($otroDato);
                    $cumple=true;
                };break;
            case "destino":
                if($otroDato!=$this->getDestino()){
                    $this->setDestino($otroDato);
                    $cumple=true;
                };break;
            case "maximo":
                if($otroDato!=$this->getCantMaxPasajeros()){
                    $this->setCantMaxPasajeros($otroDato);
                    $cumple=true;
                };break;
            case "costo":
                if($otroDato!=$this->getCosto()){
                    $this->setCosto($otroDato);
                    $cumple=true;
                };break;
            case "abonado":
                if($otroDato!=$this->getCostosAbonados()){
                    $this->setCostosAbonados($otroDato);
                    $cumple=true;
                };break;
        }
        return $cumple;
    }

    /**
     * Cambia la informacion del responsable del vuelo segun la opcion que eligio
     * @param String
     * @param String
     * @return boolean
     */
    public function cambiarResponsableV($opcionCambio,$otroDato){
        $unResponsableV=$this->getResponsableV();
        $cumple=$unResponsableV->cambiarInfo($opcionCambio,$otroDato);
        if($cumple){
            $this->setResponsableV($unResponsableV);
        }
        return $cumple;
    }
}
?>