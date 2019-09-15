<?php
class User extends CI_Controller{
function index(){
    if ($_SESSION['tipo']==""){
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
    }
    $this->load->view('templates/header');
    $this->load->view('templates/nav');
    $this->load->view('user');
    $this->load->view('templates/footer');
}
function insert(){
    $nombre=$_POST['nombre'];
    $usuario=$_POST['usuario'];
    $tipo=$_POST['tipo'];
    $clave=md5($_POST['clave']);
    $this->db->query("INSERT INTO usuario SET nombre='$nombre',usuario='$usuario',tipo='$tipo',clave='$clave'");
    header("Location: ".base_url()."User");
}
function delete($id){
    $this->db->query("DELETE FROM usuario WHERE idusuario='$id'");
    header("Location: ".base_url()."User");
}
    function update($id){
        $this->db->query("UPDATE usuario SET clave='".md5(123)."' WHERE idusuario='$id'");
        header("Location: ".base_url()."User");
    }
}
