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
        $this->load->model('area_cargo_model','area_cargo');
        $this->request = json_decode(file_get_contents('php://input'));
    }
    public function index()
    {
        $enlace['link']="servicio_reportes/reporte_general.js";
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header', $enlace);
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
        $enlace['link']="servicio_obras/obras/obras_construccion.js";
        $enlace['otro_link']="servicio_obras/obras/pagination.js";
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header', $enlace);
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
        $enlace['link']="servicio_obras/materiales/materiales_obra.js";
        $enlace['otro_link']="servicio_obras/materiales/pagination.js";
        $this->load->model('usuario_model');
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header', $enlace);
            $this->load->view('template/sidebar');
            $this->load->view('materiales/materiales_obra');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function quitar_null($responce)
    {
        str_replace(']null', ']', $responce);
        return $responce;
    }
    //metodos para mostrar registros
    public function recuperar_proyecto_construccion()
    {
        $items_proyecto_construccion = $this->obra->listar();
        $json_final = $this->quitar_null(json_encode($items_proyecto_construccion));
        return $json_final;
    }
    public function recuperar_materiales()
    {
        $items_material = $this->material->listar();
		$json_final = $this->quitar_null(json_encode($items_material));
        return $json_final;
    }
    //metodos para insertar y actaulizar registros
    public function insertar_proyecto_construccion()
    {
        $this->obra->insertar(array(
			'nombre_proyecto' => $this->request->nombre_proyecto,
            'fecha_inicio' => $this->request->fecha_inicio,
            'fecha_fin' => $this->request->fecha_fin,
            'estado_proyecto' => $this->request->estado_proyecto
		));
    }
    public function actualizar_proyecto_construccion()
    {
        $this->obra->actualizar(array(
            'id_proyecto_construccion' => $this->request->id_proyecto_construccion,
			'nombre_proyecto' => $this->request->nombre_proyecto,
            'fecha_inicio' => $this->request->inicio,
            'fecha_fin' => $this->request->fin,
            'estado_proyecto' => $this->request->estado_binario
		));
    }

    public function insertar_material()
    {
        $this->material->insertar(array(
			'nombre_material' => $this->request->nombre_material,
            'unidad' => $this->request->unidad,
            'estado_material' => $this->request->estado_material
		));
    }
    public function actualizar_material()
    {
        $this->material->actualizar(array(
            'id_material' => $this->request->id_material,
			'nombre_material' => $this->request->nombre_material,
            'unidad' => $this->request->unidad,
            'estado_material' => $this->request->estado_binario
		));
    }
    public function get_estado_material($indice)
    {
        return $this->material->get_estado_by_id($indice);
    }
    public function buscar_proyecto_construccion()
    {
        $value = $this->input->post('text');
        $query =  $this->obra->buscar($value);
        if($query)
        {
            $json_final = $this->quitar_null(json_encode($query));
        }
        return $json_final;
    }
}