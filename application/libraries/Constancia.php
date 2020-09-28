<?php
class Constancia{

	private $cantidadAdeudo;
	private $prestamosVigentes;
	private $iConstancia;

    public function __construct(){

    }

	public function getFechaExpedicion(){
		return $this->fechaExpedicion;
	}

	public function setCantidadAdeudo($cantidadAdeudo){
		$this->cantidadAdeudo = $cantidadAdeudo;
	}

	public function getCantidadAdeudo(){
		return $this->cantidadAdeudo;
	}

	public function getPrestamosVigentes(){
		return $this->prestamosVigentes;
	}

	public function setPrestamosVigentes($prestamosVigentes){
		$this->prestamosVigentes = $prestamosVigentes;
	}

	public function setIConstancia($iConstancia){
		$this->iConstancia = $iConstancia;
	}

	public function getIConstancia(){
		return $this->iConstancia;
	}

	public function obtenerCantidadAdeudo($idAlumno){
		return $this->iConstancia->obtenerCantidadAdeudo($idAlumno);
	}

	public function obtenerPrestamosVigentes($idAlumno){
		return $this->iConstancia->obtenerPrestamosVigentes($idAlumno);
	}

}