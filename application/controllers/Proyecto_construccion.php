<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Proyecto_construccion extends CI_Controller
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
            $this->load->view('obras/obras_construccion');
            $this->load->view('template/footer');
        }
        else
        {
            redirect("login/index");
        } 
    }
    public function insertarProyecto_construccion()
    {
    	$config = array(
                    array('field' => 'nombre',
                        'label' => 'Nombre',
                        'rules' => 'trim|required'
                    ),
                    array('field' => 'fecha_inicio',
                        'label' => 'Inicio Obra',
                        'rules' => 'trim|required'
                    ),
                    array('field' => 'fecha_fin',
                        'label' => 'Fin Obra',
                        'rules' => 'required'
                    ),
                    array('field' => 'estado',
                        'label' => 'Estado',
                        'rules' => 'trim|required'
                    )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) 
        {
            $result['error'] = true;
            $result['msg'] = array(
                'nombre'=>form_error('nombre'),
                'fecha_inicio'=>form_error('fecha_inicio'),
                'fecha_fin'=>form_error('fecha_fin'),
                'estado'=>form_error('estado')
            );
        }
        else
        {
            $data = array(
                'nombre_proyecto'=> $this->input->post('nombre'),
                'fecha_inicio'=> $this->input->post('fecha_inicio'),
                'fecha_fin'=> $this->input->post('fecha_fin'),
                'estado_proyecto'=> $this->input->post('estado')
            );
            if ($this->obra->addProyecto_construccion($data))
            {
               $result['error'] = false;
               $result['msg'] ='Proyecto de Construcción agregado exitosamente';
            }
            
        }
        echo json_encode($result);
    }

    public function actualizarProyecto_construccion()
    {		
        $config = array(
              array('field' => 'nombre',
                    'label' => 'Nombre',
                    'rules' => 'trim|required'
                   ),
                   array('field' => 'fecha_inicio',
                    'label' => 'Inicio Obra',
                    'rules' => 'trim|required'
                   ),
                   array('field' => 'fecha_fin',
                    'label' => 'Fin de Obra',
                    'rules' => 'required'
                   ),
                   array('field' => 'estado',
                    'label' => 'Estado',
                    'rules' => 'trim|required'
                   )
                );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) 
        {
            $result['error'] = true;
            $result['msg'] = array(
                'nombre'=>form_error('nombre'),
                'fecha_inicio'=>form_error('fecha_inicio'),
                'fecha_fin'=>form_error('fecha_fin'),
                'estado'=>form_error('estado')
            );
        }
        else
        {
            $id = $this->input->post('id_proyecto_construccion');
            $data = array(
                     'nombre_proyecto'=> $this->input->post('nombre'),
                  'fecha_inicio'=> $this->input->post('fecha_inicio'),
                  'fecha_fin'=> $this->input->post('fecha_fin'),
                  'estado_proyecto'=> $this->input->post('estado')
              );
              if($this->obra->updateProyecto_construccion($id,$data))
              {
                  $result['error'] = false;
                  $result['success'] = 'Proyecto actualizado';
              }
       
        }
        echo json_encode($result);
    }
    public function buscar_proyecto_construccion()
    {
        $value = $this->input->post('text');
        $query =  $this->obra->searchProyecto_construccion($value);
        if($query)
        {
            $result['tbl_proyecto_construccion']= $query;
        }
        echo json_encode($result);
    }
}