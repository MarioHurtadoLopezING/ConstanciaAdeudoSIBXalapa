<?php
class Alumno{

	private $idAlumno;
	private $nombre;
	private $apellidos;
    private $matricula;
	private $carrera;
	private $ciudadEstudio;
	private $facultad;
	private $iAlumno;

    public function __construct(){

	}
	
	public function getIdAlumno(){
		return $this->idAlumno;
	}

	public function setIdAlumno($idAlumno){
		$this->idAlumno = $idAlumno;
	}

    public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function setApellidos($apellidos){
		$this->apellidos = $apellidos;
	}

	public function getApellidos(){
		return $this->apellidos;
	}

	public function getMatricula(){
		return $this->matricula;
	}

	public function setMatricula($matricula){
		$this->matricula = $matricula;
	}

	public function getCarrera(){
		return $this->carrera;
	}

	public function setCarrera($carrera){
		$this->carrera = $carrera;
	}

	public function setCiudadEstudio($ciudadEstudio){
		$this->ciudadEstudio = $ciudadEstudio;
	}

	public function getCiudadEstudio(){
		return $this->ciudadEstudio;
	}
	
	public function setFacultad($facultad){
		$this->facultad = $facultad;
	}
	
	public function getFacultad(){
		return $this->facultad;
	}

	public function getIAlumno(){
		return $this->iAlumno;
	}
	public function setIAlumno($iAlumno){
		$this->iAlumno = $iAlumno;
	} 

    public function obtenerAlumnoNumeroUsuario(){
        return $this->iAlumno->obtenerAlumnoNumeroUsuario($this->idAlumno);
    }

}