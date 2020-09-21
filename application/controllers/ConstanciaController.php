<?php
class ConstanciaController extends  CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
    }

    public function index(){
        $this->load->view("pages/PaginaGeneradorConstancia");
    }

    public function vista($pagina = "generarConstancia"){
        if($pagina == "generarConstancia"){
            $this->load->view("pages/paginaConstancia");
        }
    }

    public function generarConstancia(){
        $this->vista();
        /*echo "hola mundo!!";
        echo $this->input->post("selectorImpresion");
        echo $this->input->post("opcionesImpresion");*/
    }
}