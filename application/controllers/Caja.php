<?php

class Caja extends CI_Controller{
    function index()
    {
        if ($_SESSION['tipo'] == "") {
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
        }
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('caja');
        $this->load->view('templates/footer');
    }
}
