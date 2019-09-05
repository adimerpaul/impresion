<?php
class Target extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
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
}
