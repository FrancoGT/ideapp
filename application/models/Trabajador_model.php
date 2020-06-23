<?php 
class Trabajador_model extends CI_Model
{
    public function get_area($id_area_cargo)
    {
        $area = '';
        $query = $this->db->query("SELECT area FROM tbl_area_cargo WHERE id_area_cargo=$id_area_cargo");
        foreach($query->result() as $row)
        {
            $area = $row->area;
        }
        return $area;
    }
    public function get_cargo($id_area_cargo)
    {
        $cargo = '';
        $query = $this->db->query("SELECT cargo FROM tbl_area_cargo WHERE id_area_cargo=$id_area_cargo");
        foreach($query->result() as $row)
        {
            $cargo = $row->cargo;
        }
        return $cargo;
    }
    public function listar_trabajadores()
    {
        $query = $this->db->query("SELECT * FROM tbl_trabajador");
        $responce = array();
        $area = '';
        $cargo = '';
        $estado = '';
        foreach ($query->result() as $row)
        {
            if ($row->estado_trabajador == '1')
            {
                $estado = 'Activo';
            }
            if ($row->estado_trabajador == '0')
            {
                $estado = 'Inactivo';
            }
            $fila = array(  
                'id_trabajador'=> $row->id_trabajador,  
                'cod_trabajador'=> $row->cod_trabajador, 
                'trabajador'=> $this->get_nombres_apellidos_trabajador($row->id_trabajador), 
                'area'=> $this->get_area($row->id_area_cargo),
                'cargo'=> $this->get_cargo($row->id_area_cargo),
                'estado_trabajador'=> $estado
            );
            array_push($responce, $fila);
        }
        echo json_encode($responce);
    }
    public function get_nombres_apellidos_trabajador($id_trabajador)
    {
        $full_name = '';
        $query = $this->db->query("SELECT p.nombres, p.apellidos FROM tbl_trabajador as t LEFT JOIN tbl_persona as p ON t.id_persona=p.id_persona WHERE t.id_trabajador=$id_trabajador");
        foreach($query->result() as $row)
        {
            $full_name = $row->nombres." ".$row->apellidos;
        }
        return $full_name;
    }  
    public function insertar_persona($data)
    {
        $this->db->insert('tbl_persona', array(
			'nombres' => $data['nombres'],
			'apellidos' => $data['apellidos']
		));
        $last_id = $this->db->insert_id();
        return $last_id;
    }  
    public function insertar($data)
    {
        $id_persona = $this->insertar_persona($data);
        $this->db->insert('tbl_trabajador', array(
            'cod_trabajador' => $data['cod_trabajador'],
            'id_persona' => $id_persona,
            'id_area_cargo' => $data['id_area_cargo'],
            'estado_trabajador' => $data['estado_trabajador']
		));
    }
}
?>