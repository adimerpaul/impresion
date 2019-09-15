<?php
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
}
