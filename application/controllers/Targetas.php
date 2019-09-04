<?php
class Targetas extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            header("Location: ".base_url());
        }
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('targetas');
        $this->load->view('templates/footer');
    }
    function insert(){
        for ( $i=0;$i<100;$i++){
            if (isset($_POST['t'.$i])){
                $this->db->query("INSERT INTO targeta SET numero='".$_POST['t'.$i]."'");
            }
        }
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."targetas'>";
    }
    function delete($id){
        $this->db->query("DELETE FROM targeta WHERE idtargeta='$id'");
        header("Location: ".base_url()."Targetas");
    }
    function verificar($numero){
        $query=$this->db->query("SELECT * FROM targeta WHERE numero='$numero'");
        if ($query->num_rows()==1){
            echo "1";
        }else{
            echo "no";
        }
    }
}
