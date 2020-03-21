<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Servicio extends CI_Controller
{    
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->model('obra_model','obra'); //simplificamos el nombre del modelo cuando lo llamamos
        $this->load->model('material_model','material');
        $this->request = json_decode(file_get_contents('php://input'));
    }
    public function index()
    {
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
    public function recuperar_proyecto_construccion()
    {
        $items_proyecto_construccion = $this->obra->listar();
		echo json_encode($items_proyecto_construccion);
    }
    public function recuperar_materiales()
    {
        $items_material = $this->material->listar();
		echo json_encode($items_material);
    }
    public function get_estado_material($indice)
    {
        return $this->material->get_estado_by_id($indice);
    }
}