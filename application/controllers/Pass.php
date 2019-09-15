<?php
class Pass extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
        }
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('pass');
        $this->load->view('templates/footer');
    }
    function update(){
        $pass1=md5($_POST['pass1']);
        $pass2=md5($_POST['pass2']);
        if( $pass1==$_SESSION['clave']){
            $this->db->query("UPDATE usuario SET clave='$pass2' WHERE idusuario='".$_SESSION['idusuario']."'");
            $_SESSION['clave']=$pass2;
            echo "Cambiado correctamnte!";
            echo "<meta http-equiv='refresh' content='2; url=".base_url()."Pass'>";
        }else{
            echo "La clave antigua no es compatible";
            echo "<meta http-equiv='refresh' content='2; url=".base_url()."Pass'>";
        }
    }
}
