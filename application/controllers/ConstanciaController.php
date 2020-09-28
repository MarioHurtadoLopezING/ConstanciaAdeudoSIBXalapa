<?php
class ConstanciaController extends  CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('Alumno');
        $this->load->model('AlumnoModelo','alumnoModelo');
        $this->load->library('Constancia');
        $this->load->model('ConstanciaModelo','constanciaModelo');
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
        $constancia = new constancia();
        $constancia -> setIConstancia(new ConstanciaModelo());
        $constancia = $constancia->obtenerCantidadAdeudo(24228);
        if($constancia -> getCantidadAdeudo() > 0){
            echo "el usuario tiene un adeudo de " . $constancia->getCantidadAdeudo() . " pesos";
        }else{
            $alumno = $this->obtenerAlumno(24228);
            if($alumno->getIdAlumno() == 0){
                echo "usuario no existe";
            }else{
                $this->load->view("pages/paginaConstancia", $this->obtenerDatosAlumno($alumno));
            }
        }
        /*$alumno = $this->obtenerAlumno(43565);*/
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

// echo $this->input->post("tipoConstancia");
//echo $this->input->post("selectorImpresion");