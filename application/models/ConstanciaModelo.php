<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
interface_exists('IConstancia', FALSE) OR require_once(APPPATH.'libraries/interfaces/IConstancia.php');

class ConstanciaModelo extends CI_Model implements IConstancia {
    
    public function __get($attr) {
        return CI_Controller::get_instance()->$attr;
    }

    public function __construct(){
        $this->load->database('koha_pruebas');
        $this->load->library('Constancia');
    }

    public function obtenerCantidadAdeudo($idAlumno){
        $constancia = new Constancia();
        $this->db->select_sum('accountlines.amountoutstanding');
        $consultaSql = $this->db->get_where('koha_pruebas.accountlines', 
            array('accountlines.borrowernumber'=> $idAlumno));
        if($consultaSql -> num_rows() > 0){
            $constancia -> setCantidadAdeudo($consultaSql->result()[0]->amountoutstanding);
            $constancia ->setIConstancia($this);
        }else{
            $constancia -> setCantidadAdeudo(0);
        }
        return $constancia;
    }

    //queda pendiente a probar
    public function obtenerPrestamosVigentes($idAlumno){
        $constancia = new Constancia();
        $this->db->select_sum('koha_pruebas.issues');
        $consultaSql = $this->db->get_where('koha_pruebas.accountlines', 
            array('issues.borrowernumber'=> $idAlumno));
        if($consultaSql -> num_rows() > 0){
            $constancia -> setCantidadAdeudo($consultaSql->result()[0]->issues);
            $constancia ->setIConstancia($this);
        }else{
            $constancia -> setCantidadAdeudo(0);
        }
        return $constancia;
    }
}