<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Finanza extends CI_Controller
{  
    function __construct()
    {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->model('finanza_model', 'finanza');
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
            $this->load->view('finanzas/opciones');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function modulo_presupuesto_obra()
    {
        $enlace['link']="servicio_finanzas/presupuestos/presupuestos.js";
        $enlace['otro_link']="servicio_reportes/presupuestos/pagination.js";
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header', $enlace);
            $this->load->view('template/sidebar');
            $this->load->view('presupuesto/buscar_presupuesto');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function modulo_pagos_trabajadores()
    {
        $enlace['link']="servicio_finanzas/pagos/pagos.js";
        $enlace['otro_link']="servicio_finanzas/pagos/pagination.js";
        if ($this->usuario_model->sigue_logeado())
        {

            $this->load->view('template/header', $enlace);
            $this->load->view('template/sidebar');
            $this->load->view('pagos/buscar_pagos');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function ver_presupuestos()
    {
        $form = $this->input->post();
        $id_proyecto_construccion = $form['data-holder'];
        
        $this->load->library('session');
        $session_data = array(
            'current_id' => $id_proyecto_construccion
        );
        //set session userdata
        $this->session->set_userdata($session_data);

        $enlace['link']="servicio_finanzas/presupuestos/presupuestos.js";
        $enlace['otro_link']="servicio_reportes/presupuestos/pagination.js";
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header', $enlace);
            $this->load->view('template/sidebar');
            $this->load->view('presupuesto/presupuestos_obra');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function ver_pagos()
    {
        $form = $this->input->post();
        $id_proyecto_construccion = $form['data-holder'];
        
        $this->load->library('session');
        $session_data = array(
            'current_id' => $id_proyecto_construccion
        );
        //set session userdata
        $this->session->set_userdata($session_data);

        $enlace['link']="servicio_finanzas/pagos/pagos.js";
        $enlace['otro_link']="servicio_reportes/pagos/pagination.js";
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header', $enlace);
            $this->load->view('template/sidebar');
            $this->load->view('pagos/pagos_trabajadores');
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
    public function get_data_proyecto_construccion()
	{
        $resultado = $this->db->query("SELECT * FROM tbl_proyecto_construccion WHERE estado_proyecto=1");
		echo json_encode($resultado->result());
	}
    public function recuperar_presupuestos()
    {
        $items_presupuesto = $this->finanza->listar_presupuestos();
        $json_final = $this->quitar_null(json_encode($items_presupuesto));
		return $json_final;
    }
    public function recuperar_pagos()
    {
        $items_pagos = $this->finanza->listar_pagos();
        $json_final = $this->quitar_null(json_encode($items_pagos));
		return $json_final;
    }
}