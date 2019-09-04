<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('verify');
	}
	public function login(){
	    $usuario=$_POST['usuario'];
        $clave=$_POST['clave'];
        $query=$this->db->query("SELECT * FROM usuario WHERE usuario='$usuario' AND clave='$clave' AND estado='ACTIVO'");
        echo $query->num_rows();
        if ($query->num_rows()==1){
            $row=$query->row();
            $_SESSION['nombre']=$row->nombre;
            $_SESSION['idusuario']=$row->idusuario;
            $_SESSION['clave']=$row->clave;
            $_SESSION['tipo']=$row->tipo;
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."Main'>";
        }else{
            echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
        }
    }
    function logout(){
	    session_destroy();
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."'>";
    }
    function verify(){
        $clave=$_POST['clave'];
        $this->load->view('templates/header');
        $data['numero']=$clave;
        $this->load->view('verificar',$data);
        $this->load->view('templates/footer');
    }
}
