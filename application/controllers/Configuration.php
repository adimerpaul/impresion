<?php
class Configuration extends CI_Controller
{
    function index()
    {
        if ($_SESSION['tipo'] == "") {
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
        }
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('configuration');
        $this->load->view('templates/footer');
    }
    function update(){
        $idconfiguracion=$_POST['idconfiguracion'];
        $estado=$_POST['estado'];
        $this->db->query("UPDATE configuracion SET estado='$estado' WHERE idconfiguracion='$idconfiguracion'");
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."Configuration'>";
    }
}
