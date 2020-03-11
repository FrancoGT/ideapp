<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->model('obra_model');
    }
    public function index()
    {
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('dashboard/index');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function get_proyecto_construccion_json_calendario()
    {
        $data = $this->obra_model->mostrar_items_proyecto_construccion();
        foreach ($data as $row) 
        {
            $jsondata[] = array('title' => $row->nombre_proyecto,
                                'description' => 'Proyecto Nº: '.$row->id_proyecto_construccion,
                                'start' => $row->fecha_inicio,
                                'color' => '#3A87AD',
                                'textColor'   => '#ffffff'
                            );
        }
        echo json_encode($jsondata);
    }
    
}