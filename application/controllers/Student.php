<?php
require_once('tcpdf.php');
class Student extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
        }
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('student');
        $this->load->view('templates/footer');
    }
    function insert(){
        $nombre=$_POST['nombre'];
        $usuario=$_POST['usuario'];
        $tipo=$_POST['tipo'];
        $clave=$_POST['clave'];
        $this->db->query("INSERT INTO usuario SET nombre='$nombre',usuario='$usuario',tipo='$tipo',clave='$clave'");
        header("Location: ".base_url()."User");
    }
    function ver($id){
        $query=$this->db->query("SELECT * FROM estudiante WHERE idestudiante='$id'");
        echo json_encode($query->result());
    }
    function targetas($id){
        $query=$this->db->query("SELECT c.idcompra,c.fecha,c.monto,t.numero,t.estado FROM compra c INNER JOIN targeta t ON c.idtargeta=t.idtargeta  WHERE idestudiante='$id'");
        echo json_encode($query->result());
    }
    function inserttargeta(){
        $numero=$_POST['numero'];
        $query=$this->db->query("SELECT * FROM targeta WHERE numero='$numero'");
        if ($query->num_rows()==0){
            echo "No existe";
            exit;
        }else{
        $idtargeta=$query->row()->idtargeta;
        $idestudiante=$_POST['idestudiante'];
        $costo=$this->db->query("SELECT * FROM configuracion WHERE idconfiguracion=4")->row()->estado;
        $this->db->query("INSERT INTO compra SET idestudiante='$idestudiante',idtargeta='$idtargeta',costo='$costo'");
        $idcompra=$this->db->insert_id();
//        echo $this->db->query("SELECT * FROM compra WHERE idestudiante='$idestudiante'")->num_rows() ;
//        exit;
        $query=$this->db->query("SELECT * FROM compra WHERE idestudiante='$idestudiante'");
        $montoantiguo=0;
        foreach ($query->result() as $row){
            $montoantiguo=$montoantiguo+$row->monto;
            $this->db->query("UPDATE compra SET monto=0 WHERE idcompra='$row->idcompra'");
            $this->db->query("UPDATE targeta SET estado='INACTIVO' WHERE idtargeta='$row->idtargeta'");
        }
        $this->db->query("UPDATE targeta SET estado='ACTIVO' WHERE idtargeta='$idtargeta'");
        $monto=$this->db->query("SELECT * FROM configuracion WHERE idconfiguracion=1")->row()->estado;
        $monto=$monto+$montoantiguo;
        $this->db->query("INSERT INTO recarga SET idusuario='".$_SESSION['idusuario']."', monto='$monto',idcompra='$idcompra',tipo='PRIMER'");
        $this->db->query("UPDATE compra SET monto=monto+$monto WHERE idcompra='$idcompra'");

        echo 1;
        }
    }
    function configuracion(){
        $query=$this->db->query("SELECT * FROM configuracion");
        echo json_encode($query->result());
    }
    function target($id){
        $row=$this->db->query("SELECT * FROM
compra c INNER JOIN estudiante e ON c.idestudiante=e.idestudiante
WHERE idcompra='$id'")->row();
        $nombre=$row->nombre;
        $monto=$row->monto;
        $fecha=$row->fecha;
        $costo=$row->costo;

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, $unit='mm', array(80,210), true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(0, 0, 0);

        $pdf->AddPage();

        $html = '
<div style="font-size: 7px;font-weight: bold;text-align: center;margin: 0;">
<table>
<tr>
<td width="15%">
<img src="'.base_url().'assets/images/sis.png" >
</td>
<td width="70%">
FACULTAD NACIONAL DE INGENIERIA <br> INGENIERIA DE SISTEMAS E  INFORMATICA <br>CENTRO DE IMPRESIONES <br> Nº '.$id.'
</td>
<td width="15%">
<img src="'.base_url().'assets/images/inf.png" >
</td>
</tr>
</table>
</div>
<small style="border: 50px">
&nbsp;&nbsp; <b> Estudiante: </b>'.$nombre.' <br>
&nbsp;&nbsp; <b> Fecha: </b>'.$fecha.'<br>
&nbsp;&nbsp; <b> Saldo Actual: </b>'.$monto.' Bs.<br>
&nbsp;&nbsp; <b> Costo de la targeta: </b>'.$costo.' Bs.<br>

</small>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('example_006.pdf', 'I');

    }
}
