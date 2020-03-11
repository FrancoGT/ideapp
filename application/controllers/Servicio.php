<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Servicio extends CI_Controller
{    
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->model('obra_model','obra'); //simplificamos el nombre del modelo cuando lo llamamos
    }
    public function index()
    {
        $this->load->model('usuario_model');
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('servicio/opciones');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }       
    }
    public function modulo_obras_construccion()
    {
        $this->load->model('usuario_model');
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('obras/obras_construccion');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function modulo_materiales_obra()
    {
        $this->load->model('usuario_model');
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('materiales/materiales_obra');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function mostrar_items_proyecto_construccion()
    {
        $query=  $this->obra->mostrar_items_proyecto_construccion();
        if($query)
        {
          $result['tbl_proyecto_construccion']  = $this->obra->mostrar_items_proyecto_construccion();
        }
        echo json_encode($result);
    }
}