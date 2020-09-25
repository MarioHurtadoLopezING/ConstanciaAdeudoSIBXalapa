<?php
class Constancia{

    private $fechaExpedicion;
	private $ciudad;
	private $biblioteca;
	private $tramite;
	private $iConstancia;

    public function __construct(){

    }

	public function getFechaExpedicion(){
		return $this->fechaExpedicion;
	}

	public function setFechaExpedicion($fechaExpedicion){
		$this->fechaExpedicion = $fechaExpedicion;
	}

	public function getCiudad(){
		return $this->ciudad;
	}

	public function setCiudad($ciudad){
		$this->ciudad = $ciudad;
	}

	public function getBiblioteca(){
		return $this->biblioteca;
	}

	public function setBiblioteca($biblioteca){
		$this->biblioteca = $biblioteca;
	}

	public function getAdeudo(){
		return $this->adeudo;
	}

	public function setAdeudo($adeudo){
		$this->adeudo = $adeudo;
	}

	public function getTramite(){
		return $this->tramite;
	}

	public function setTramite($tramite){
		$this->tramite = $tramite;
	}

	public function setIConstancia($iConstancia){
		$this->iConstancia = $iConstancia;
	}

	public function getIConstancia(){
		return $this->iConstancia;
	}

	public function obtenerCiudadExpedicion(){

	}

	public function obtenerFechaExpedicion(){

	}

	public function obtenerBibliotecaExpeidicion(){

	}
}