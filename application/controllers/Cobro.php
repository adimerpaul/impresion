<?php
require_once('tcpdf.php');
class Cobro extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
        }
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('cobro');
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
    function delete($id){
        $this->db->query("DELETE FROM usuario WHERE idusuario='$id'");
        header("Location: ".base_url()."User");
    }
    function datos($id){
        $query=$this->db->query("SELECT * FROM targeta t 
INNER JOIN  estudiante e ON t.idestudiante=e.idestudiante
WHERE numero='$id'");
        echo json_encode($query->result());
    }
    function cobrorecarga(){
        $idusuario=$_SESSION['idusuario'];
        $monto=$_POST['monto'];
        $idtargeta=$_POST['idtargeta'];
        $query=$this->db->query("SELECT * FROM compra WHERE idtargeta='$idtargeta'");
        $idcompra=$query->row()->idcompra;
        $this->db->query("INSERT INTO cobro SET idusuario='$idusuario',monto='$monto',idcompra='$idcompra'");
        $idcobro=$this->db->insert_id();
        $this->db->query("UPDATE compra SET monto=monto-$monto WHERE idcompra='$idcompra'");
        $query=$this->db->query("SELECT * FROM cobro co 
INNER JOIN  compra c ON c.idcompra=co.idcompra
WHERE idcobro='$idcobro'");
        echo json_encode($query->result());
    }
    function targeta($id){
        $row=$this->db->query("SELECT co.fecha,e.nombre,c.monto,co.monto recarga
FROM cobro co 
INNER JOIN compra c ON co.idcompra=c.idcompra
INNER JOIN estudiante e ON e.idestudiante=c.idestudiante
WHERE co.idcobro='$id'")->row();
        $nombre=$row->nombre;
        $monto=$row->monto;
        $fecha=$row->fecha;
        $recarga=$row->recarga;

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
&nbsp;&nbsp; <b> Monto del cobro: </b>'.$recarga.' Bs.<br>

</small>';
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('example_006.pdf', 'I');


    }
}
