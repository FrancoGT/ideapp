<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->model('material_model','material');
    }
    public function index()
    {
        $enlace['link']="servicio_reportes/reporte_general.js";
        $enlace['otro_link']="servicio_reportes/otros_reportes.js";
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header', $enlace);
            $this->load->view('template/sidebar');
            $this->load->view('dashboard/index');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function get_array_materiales()
    {
        $data = $this->material->listar_materiales_top_5();
        $array_info = [];
        foreach($data as $cd)
        {
            array_push($array_info, $cd->nombre_material);
        }
        echo json_encode($array_info);
    }
    public function get_array_precios()
    {
        $data = $this->material->listar_precios_top_5();
        $array_info = [];
        foreach($data as $cd)
        {
            array_push($array_info, $cd->precio_unitario);
        }
        echo json_encode($array_info);
    }
}