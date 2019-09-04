<?php

class Caja extends CI_Controller{
    function index()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('caja');
        $this->load->view('templates/footer');
    }
}
