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
        $this->db->query("UPDATE compra SET monto=monto+$monto WHERE idcompra='$idcompra'");
        echo 1;
    }
}
