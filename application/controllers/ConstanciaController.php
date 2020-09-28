<?php
class ConstanciaController extends  CI_Controller{

    private $alumnoGeneral;

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('Alumno');
        $this->load->model('AlumnoModelo','alumnoModelo');
        $this->load->library('Constancia');
        $this->load->model('ConstanciaModelo','constanciaModelo');
        $this->load->library('session');
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
        $idUsuarioPrueba = 43565;//601;
        $constancia = new constancia();
        $constancia -> setIConstancia(new ConstanciaModelo());
        $constancia = $constancia->obtenerCantidadAdeudo($idUsuarioPrueba);
        $alumno = $this->obtenerAlumno($idUsuarioPrueba);
        if($alumno->getIdAlumno() == 0){
            echo "usuario no existe";
        }else if($constancia -> getCantidadAdeudo() > 0){
            echo "el usuario tiene un adeudo de " . $constancia->getCantidadAdeudo() . " pesos";
        }else if($constancia->obtenerPrestamosVigentes($idUsuarioPrueba)->getPrestamosVigentes() > 0){
            echo "el usuario tiene prestamos vigentes";
        }else{
            $this->load->view("pages/paginaConstancia", $this->obtenerDatosAlumno($alumno));
        }
        /*$alumno = $this->obtenerAlumno(43565);*/
    }
    /* public function getAlumno(){
        return $this->alumno;
    }*/

    public function descargarConstancia(){
        echo $this->session->userdata('nombreAlumno');
        echo $this->session->userdata('matricula');
        //$this->session->unset_userdata('datosAlumno');
       // redirect('https://catbiblio.uv.mx');
    } 

    private function obtenerDatosAlumno($alumno){
        $datosAlumno = array(
            'nombreAlumno' => $alumno->getNombre()." ".$alumno->getApellidos(),
            'matricula' => $alumno->getMatricula(),
            'carrera' =>  $alumno->getCarrera(),
            'ciudadEstudio' => $alumno->getCiudadEstudio(),
            'facultad' => $alumno->getFacultad(),
            'diaActual' => date('d'),
            'mesActual'=> $this->obtenerMesActual(date('M')),
            'anoActual' => date('Y'),
            'tramite' =>$this->input->post("tipoConstancia")=="inscripcion"?
                "Inscripción":"Otros (Titulación, baja temporal o definitiva)");
        $this->session->set_userdata($datosAlumno);
        return $datosAlumno;
    }
    
    private function obtenerAlumno($idAlumno){
        $alumno = new Alumno();
        $alumno->setIdAlumno($idAlumno);
        $alumno->setIAlumno(new AlumnoModelo());
        return $alumno -> obtenerAlumnoNumeroUsuario();
    }

    private function obtenerMesActual($mes){
        switch ($mes){
            case "Jan":
                $mes = "enero";
            break;
            case "Feb":
                $mes = "febrero";
            break;
            case "Mar":
                $mes = "marzo";
            break;
            case "Apr":
                $mes = "abril";
            break;
            case "May":
                $mes = "mayo";
            break;
            case "Jun":
                $mes = "junio";
            break;
            case "Jul":
                $mes = "julio";
            break;
            case "Aug":
                $mes = "agosto";
            break;
            case "Sep":
                $mes = "septiembre";
            break;
            case "Oct":
                $mes = "octubre";
            break;
            case "Nov":
                $mes = "noviembre";
            break;
            case "Dic":
                $mes = "diciembre";
            break;
            default:
                $mes ="no hay un mes asignado";
        }
        return $mes;
    }
    
}
//echo $this->input->post("selectorImpresion");