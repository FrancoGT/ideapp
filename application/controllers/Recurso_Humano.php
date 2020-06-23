<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Recurso_Humano extends CI_Controller
{  
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->model('obra_model','obra');
        $this->load->model('trabajador_model','trabajador'); //simplificamos el nombre del modelo cuando lo llamamos
        $this->load->model('area_cargo_model','area_cargo');
        $this->request = json_decode(file_get_contents('php://input'));
    }
    public function index()
    {
        $enlace['link']="servicio_reportes/reporte_general.js";
        $enlace['otro_link']="servicio_reportes/otros_reportes.js";
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header', $enlace);
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
        $enlace['link']="servicio_recursos_humanos/trabajadores/trabajadores.js";
        $enlace['otro_link']="servicio_recursos_humanos/trabajadores/pagination.js";
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header', $enlace);
            $this->load->view('template/sidebar');
            $this->load->view('trabajadores/trabajadores_registrados');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function modulo_areas_cargos()
    {
        $enlace['link']="servicio_recursos_humanos/areas_cargos/areas_cargos.js";
        $enlace['otro_link']="servicio_recursos_humanos/areas_cargos/pagination.js";
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header', $enlace);
            $this->load->view('template/sidebar');
            $this->load->view('areas_cargos/areas_cargos');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function modulo_usuarios()
    {
        $enlace['link']="servicio_recursos_humanos/perfil_usuario/usuario.js";
        $enlace['otro_link']="servicio_recursos_humanos/perfil_usuario/reportes_usuario.js";
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header', $enlace);
            $this->load->view('template/sidebar');
            $this->load->view('perfil_usuario/ver_perfil');
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
    public function recuperar_trabajadores()
    {
        $items_trabajador = $this->trabajador->listar_trabajadores();
		$json_final = $this->quitar_null(json_encode($items_trabajador));
        return $json_final;
    }
    public function recuperar_areas_cargos()
    {
        $items_areas_cargos = $this->area_cargo->listar();
		$json_final = $this->quitar_null(json_encode($items_areas_cargos));
        return $json_final;
    }
    public function recuperar_perfil()
    {
        $perfil = $this->usuario_model->get_perfil();
        $json_final = $this->quitar_null($perfil);
        return $json_final;
    }
    public function insertar_trabajador()
    {
        $this->trabajador->insertar(array(
			'cod_trabajador' => $this->request->cod_trabajador,
            'nombres' => $this->request->nombres,
            'apellidos' => $this->request->apellidos,
            'id_area_cargo' => $this->request->id_area_cargo,
            'estado_trabajador' => $this->request->estado_trabajador
		));
    }
    public function actualizar_trabajador()
    {
        $this->area_cargo->actualizar(array(
            'id_area_cargo' => $this->request->id_area_cargo,
            'cod_area_cargo' => $this->request->cod_area_cargo,
			'area' => $this->request->area,
            'cargo' => $this->request->cargo,
            'estado_area_cargo' => $this->request->estado_binario
		));
    }
    public function insertar_area_cargo()
    {
        $this->area_cargo->insertar(array(
			'cod_area_cargo' => $this->request->cod_area_cargo,
            'area' => $this->request->area,
            'cargo' => $this->request->cargo,
            'estado_area_cargo' => $this->request->estado_area_cargo
		));
    }
    public function actualizar_area_cargo()
    {
        $this->area_cargo->actualizar(array(
            'id_area_cargo' => $this->request->id_area_cargo,
            'cod_area_cargo' => $this->request->cod_area_cargo,
			'area' => $this->request->area,
            'cargo' => $this->request->cargo,
            'estado_area_cargo' => $this->request->estado_binario
		));
    }
    public function actualizar_perfil()
    {
        $data_user = array();
        $data_persona = array();
        $contra = $this->request->contra;
        $data_user = array(
                'id_user' => $this->request->id_user,
                'username' => $this->request->username
            );
        if ($contra != '')
        {
            $data_user['password'] = MD5($contra);
        }
        $data_persona = array(
                    'id_persona' => $this->request->id_persona,
                    'nombres' => $this->request->nombres,
                    'apellidos' => $this->request->apellidos
        );
        $this->usuario_model->actualizar($data_user, $data_persona);
    }
    public function get_data_area_cargo()
	{
        $resultado = $this->db->query("SELECT * FROM tbl_area_cargo WHERE estado_area_cargo=1");
		echo json_encode($resultado->result());
	}
}