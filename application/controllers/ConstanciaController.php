<?php

require APPPATH.'third_party/PDF_visibility_protection.php';

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
        $idUsuarioPrueba = 0;//601;
        if($idUsuarioPrueba != null || $idUsuarioPrueba != 0 || $idUsuarioPrueba !=""){
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
        }else{
            redirect('https://catbiblio.uv.mx');
        }
    }

    public function descargarConstancia(){
        if($this->session->userdata('idAlumno') > 0){
            $documentoPDF = new PDF_visibility_protection('L','mm','A4');
            $documentoPDF->SetProtection(array('print'));
            $documentoPDF->AddPage('L');
            $documentoPDF->SetVisibility('print');
            $this->session->userdata("colorImpresion") == "color"?
                $documentoPDF->Image(APPPATH.'third_party/fondocolor.jpg',5, 5, 290, 200):$documentoPDF->Image(APPPATH.'third_party/fondogris.jpg',5, 5, 290, 200);
            $documentoPDF->SetVisibility('all');
            $documentoPDF->SetFont('Arial','B', 14);
            $documentoPDF->Ln(32);
            $documentoPDF->Cell(0,10,utf8_decode('      Constancia de no adeudo en línea'),0,1,'C');
            $documentoPDF->Ln(6);
            $documentoPDF->Cell(0,10,utf8_decode('                        A quien corresponda:'),0,1,'L');
            $documentoPDF->SetFont('Arial');
            $documentoPDF->Ln(4);
            $documentoPDF->Cell(0,10,utf8_decode('                        El sistema bibliotecario de la Universidad Veracruzana, ha verificado que:'),0,1,'L');
            $documentoPDF = $this->agregarDatosArchivo($documentoPDF,11.5,'Nombre',$this->session->userdata('nombreAlumno'));
            $documentoPDF = $this->agregarDatosArchivo($documentoPDF,7,'Matricula',$this->session->userdata('matricula'));
            $documentoPDF = $this->agregarDatosArchivo($documentoPDF,7,'Carrera',$this->session->userdata('carrera'));
            $documentoPDF = $this->agregarDatosArchivo($documentoPDF,7,'Tramite',$this->session->userdata('tramite'));
            $documentoPDF = $this->agregarDatosArchivo($documentoPDF,7,'Biblioteca',$this->session->userdata('facultad'));
            $documentoPDF->SetFont('Arial','B', 14);
            $documentoPDF->Ln(15);
            $documentoPDF->Write (0,'                        No tiene adeudos en las bibliotecas universitarias.');
            $documentoPDF->SetFont('Arial');
            $documentoPDF->Ln(9);
            $documentoPDF->Write (0,utf8_decode('                        Por lo que a petición del(a) interesado(a) y para fines legales que al(a) mismo(a) convengan. Se extiende'));
            $documentoPDF->Ln(5);
            $documentoPDF->Write (0,utf8_decode('                        la presente CONSTANCIA en la ciudad de Xalapa a los '. utf8_decode($this->session->userdata('diaActual')).' días del mes de '));
            $documentoPDF->Write (0,utf8_decode($this->session->userdata('mesActual').' del '.$this->session->userdata('anoActual')).'.');
            $documentoPDF->Output('ConstanciaNoAdeudo.pdf','D');
            $this->cerrarSesion();
        }else{
            redirect('https://catbiblio.uv.mx');
        }
    } 

    private function agregarDatosArchivo($documentoPDF, $saltosDeLinea, $tituloDatoAlumno, $datoAlumno){
        $documentoPDF->SetFont('Arial','B', 14);
        $documentoPDF->Ln($saltosDeLinea);
        $documentoPDF->Write (0,'                        '.$tituloDatoAlumno.': ');
        $documentoPDF->SetFont('Arial');
        $documentoPDF->Write (0,utf8_decode($datoAlumno));
        return $documentoPDF;
    }

    private function cerrarSesion(){
        $datosSesion = array('idAlumno','nombreAlumno', 'matricula', 'carrera', 'ciudadEstudio', 'facultad', 'diaActual', 'mesActual', 'anoActual', 'colorImpresion', 'tramite');
        $this->session->unset_userdata($datosSesion);
    }

    private function obtenerDatosAlumno($alumno){
        $datosAlumno = array(
            'idAlumno' => $alumno->getIdAlumno(),
            'nombreAlumno' => $alumno->getNombre()." ".$alumno->getApellidos(),
            'matricula' => $alumno->getMatricula(),
            'carrera' =>  $alumno->getCarrera(),
            'ciudadEstudio' => $alumno->getCiudadEstudio(),
            'facultad' => $alumno->getFacultad(),
            'diaActual' => date('d'),
            'mesActual'=> $this->obtenerMesActual(date('M')),
            'anoActual' => date('Y'),
            'colorImpresion' => $this->input->post("selectorImpresion"),
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