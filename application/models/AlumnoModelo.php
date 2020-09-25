<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
interface_exists('IAlumno', FALSE) OR require_once(APPPATH.'libraries/interfaces/IAlumno.php');

class AlumnoModelo extends CI_Model implements IAlumno {

    public function __get($attr) {
        return CI_Controller::get_instance()->$attr;
    }

    public function __construct() {
        $this->load->database('koha_pruebas');
        $this->load->library('Alumno');
    }

    /**
     * Función  que permite obtener un objeto del tipo Alumno a partir del id de registro en base de datos
     * @param idAlumno en base de datos el equivalente a borrowerNumber de la tabla borrowers usuario en registro 
     * @return Alumno objeto del tipo alumno con nombres, apellidos, matricula y siglas de la carrera en curso
     */

    public function obtenerAlumnoNumeroUsuario($idAlumno) {
        $alumno = new Alumno();
        $this->db->select("
            borrowers.cardnumber,
            borrowers.surname,
            borrowers.firstname,
            borrowers.branchcode,
            borrowers.sort2,
            borrowers.sort1,
            borrowers.city");
        $consultaSql = $this->db->get_where('koha_pruebas.borrowers', 
            array('borrowers.borrowernumber'=> $idAlumno));
        if($consultaSql -> num_rows() > 0){
            $row = $consultaSql->row();
            $alumno -> setIdAlumno($idAlumno);
            $alumno -> setNombre($row->firstname);
            $alumno -> setApellidos($row->surname);
            $alumno -> setMatricula($row->cardnumber);
            $alumno -> setCiudadEstudio($row->city);
            $alumno -> setCarrera($this->obtenerAreaEducativa($row->sort2));
            $alumno -> setFacultad($this->obtenerFacultad($row->branchcode));
            $alumno -> setIAlumno($this);
        }else{
            $alumno -> setIdAlumno(0);
        }
        return $alumno;
    }

    /**
     * Función privada que permite obtener el nombre de un area educativa a partir de un acronimo o siglas 
     * @param areaEducativa acronimo del area educativa buscada, en base de datos equivalente al campo sort2 
     * de la tabla borrowers
     * @return areaEducativa es el nombre del area educativa cursada, obtenida a partir del parametro sort2
     */

    private function obtenerAreaEducativa($areaEducativa){
        $this->db->select("authorised_values.lib");
        $consultaSql = $this->db->get_where('koha_pruebas.authorised_values',
            array('authorised_values.authorised_value' => $areaEducativa));
        if($consultaSql -> num_rows() > 0){
            $row = $consultaSql->row();
            $areaEducativa = $row->lib == null ?
                "No tiene carrera especificada, favor de dirigirse a su biblioteca." : $row->lib;
        }else{
            $areaEducativa = "Sin área educativa";
        }
        return $areaEducativa;
    }
    /**
     * Función que permite obtener el nombre de la biblioteca en la que se encuentra adscrito el alumno 
     * @param facultad acronimo de la biblioteca buscada, se obtiene a partir del parametro branchname de la tabla borrowers
     * @return facultad es el nombre completo de la biblioteca buscada 
     */
    private function obtenerFacultad($facultad){
        $this->db->select("branches.branchname");
        $consultaSql = $this->db->get_where('koha_pruebas.branches',
        array('branches.branchcode' => $facultad));
        if($consultaSql -> num_rows() > 0){
            $row = $consultaSql->row();
            $facultad = $row->branchname == null ?
                "No tiene facultad especificada, favor de dirigirse a su biblioteca." : $row->branchname;
        }else{
            $facultad = "Sin área educativa";
        }
        return $facultad;
    }
}