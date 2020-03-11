<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Finanza extends CI_Controller
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
        $this->load->model('usuario_model');
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('presupuesto/presupuesto_obra');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
    public function modulo_pagos_trabajadores()
    {
        $this->load->model('usuario_model');
        if ($this->usuario_model->sigue_logeado())
        {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('pagos/pagos_trabajadores');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        }
    }
}