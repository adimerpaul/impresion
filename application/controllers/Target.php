<?php
require_once('tcpdf.php');
class Target extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
        }
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('target');
        $this->load->view('templates/footer');
    }
    function datos($id){
        $query=$this->db->query("SELECT * FROM targeta t 
INNER JOIN  compra c ON c.idtargeta=t.idtargeta
INNER JOIN  estudiante e ON c.idestudiante=e.idestudiante
WHERE numero='$id'");
        echo json_encode($query->result());
    }
    function insertrecarga(){
        $idusuario=$_SESSION['idusuario'];
        $monto=$_POST['monto'];
        $idtargeta=$_POST['idtargeta'];
        $query=$this->db->query("SELECT * FROM compra WHERE idtargeta='$idtargeta'");
        $idcompra=$query->row()->idcompra;
        $this->db->query("INSERT INTO recarga SET idusuario='$idusuario',monto='$monto',idcompra='$idcompra'");
        $idrecarga=$this->db->insert_id();
        $this->db->query("UPDATE compra SET monto=monto+$monto WHERE idcompra='$idcompra'");
        $query=$this->db->query("SELECT * FROM recarga r 
INNER JOIN  compra c ON c.idcompra=r.idcompra
WHERE idrecarga='$idrecarga'");
        echo json_encode($query->result());
    }
    function targeta($id){
        $row=$this->db->query("SELECT r.fecha,e.nombre,c.monto,r.monto recarga
FROM recarga r 
INNER JOIN compra c ON r.idcompra=c.idcompra
INNER JOIN estudiante e ON e.idestudiante=c.idestudiante
WHERE r.idrecarga='$id'")->row();
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
&nbsp;&nbsp; <b> Monto de la recarga: </b>'.$recarga.' Bs.<br>

</small>';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output('example_006.pdf', 'I');


    }
}
