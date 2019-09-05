<?php

class Report extends CI_Controller{
    function index()
    {
        if ($_SESSION['tipo'] == "") {
            header("Location: " . base_url());
        }
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('report');
        $this->load->view('templates/footer');
    }
    function datos($d1,$d2){
        $query=$this->db->query("SELECT r.idrecarga,u.nombre,r.monto,numero,e.nombre as estudiante,carrera,r.fecha,r.tipo
FROM targeta t
INNER JOIN compra c ON c.idtargeta=t.idtargeta
INNER JOIN estudiante e ON c.idestudiante=e.idestudiante
INNER JOIN recarga r ON r.idcompra=c.idcompra
INNER JOIN usuario u ON u.idusuario=r.idusuario
WHERE r.tipo='REGARGA'
AND date(r.fecha)>='$d1' AND date(r.fecha)<='$d2'");
        echo json_encode($query->result());
    }
    function datos2($d1,$d2){
        $query=$this->db->query("SELECT c.costo,numero,e.nombre as estudiante,carrera,c.fecha
FROM targeta t
INNER JOIN compra c ON c.idtargeta=t.idtargeta
INNER JOIN estudiante e ON c.idestudiante=e.idestudiante
AND date(c.fecha)>='$d1' AND date(c.fecha)<='$d2'");
        echo json_encode($query->result());
    }
}
