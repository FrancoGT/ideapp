<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Recurso_Humano extends CI_Controller
{  
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuario_model');
    }
    public function index()
    {
        $this->load->model('usuario_model');
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('recurso_humano/opciones');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function modulo_trabajadores()
    {
        $this->load->model('usuario_model');
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('trabajadores/trabajadores_registrados');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function modulo_usuarios()
    {
        $this->load->model('usuario_model');
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('usuarios/usuarios_registrados');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
}