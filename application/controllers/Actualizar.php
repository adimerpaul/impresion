<?php
class Actualizar extends CI_Controller{
    function index(){
        if ($_SESSION['tipo']==""){
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
        }
        $this->load->view('templates/header');
        $this->load->view('templates/nav');
        $this->load->view('actualizar');
        $this->load->view('templates/footer');
    }
    function insert(){
        $ci=$_POST['ci'];
        $mi_archivo = 'foto';
        $config['upload_path'] = "fotos/";
        $config['file_name'] = $ci;
        $config['allowed_types'] = "*";
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";
        $config['overwrite'] = true;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
            exit;
        }
        $data['uploadSuccess'] = $this->upload->data();

        $nombre=$_POST['nombre'];
        $celular=$_POST['celular'];
        $carrera=$_POST['carrera'];
        $sede=$_POST['sede'];
        $correo=$_POST['correo'];
        $this->db->query("INSERT INTO estudiante SET ciestudiante='$ci',nombre='$nombre',correo='$correo',celular='$celular',carrera='$carrera',sede='$sede'");
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."Actualizar'>";

    }
    function update(){
        $ci=$_POST['ci'];

        $mi_archivo = 'foto';
        $config['upload_path'] = "fotos/";
        $config['file_name'] = $ci;
        $config['allowed_types'] = "*";
        $config['max_size'] = "50000";
        $config['max_width'] = "2000";
        $config['max_height'] = "2000";
        $config['overwrite'] = true;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($mi_archivo)) {
            //*** ocurrio un error
            $data['uploadError'] = $this->upload->display_errors();
            if ($data['uploadError']!="<p>You did not select a file to upload.</p>"){
                echo $this->upload->display_errors();
                echo "<meta http-equiv='refresh' content='2; url=".base_url()."Actualizar'>";
                exit;
            }
        }
        $data['uploadSuccess'] = $this->upload->data();

        $nombre=$_POST['nombre'];
        $celular=$_POST['celular'];
        $carrera=$_POST['carrera'];
        $sede=$_POST['sede'];
        $correo=$_POST['correo'];
        $id=$_POST['id'];
        $this->db->query("UPDATE  estudiante SET ciestudiante='$ci',nombre='$nombre',correo='$correo',celular='$celular',carrera='$carrera',sede='$sede' WHERE idestudiante='$id'");
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."Actualizar'>";

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
