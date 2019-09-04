<?php
class Student extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
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
        $query=$this->db->query("SELECT * FROM compra c INNER JOIN targeta t ON c.idtargeta=t.idtargeta  WHERE idestudiante='$id'");
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
        $this->db->query("INSERT INTO compra SET idestudiante='$idestudiante',idtargeta='$idtargeta'");
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
}
