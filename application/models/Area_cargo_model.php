<?php 
class Area_cargo_model extends CI_Model
{
    public function listar()
    {
        $query = $this->db->query("SELECT * FROM tbl_area_cargo");
        $responce = array();
        $estado = '';
        foreach ($query->result() as $row) 
        {
            if ($row->estado_area_cargo == '1')
            {
                $estado = 'Activo';
            }
            if ($row->estado_area_cargo == '0')
            {
                $estado = 'Inactivo';
            }
            $fila = array(  
                'id_area_cargo'=> $row->id_area_cargo,    
                'cod_area_cargo'=> $row->cod_area_cargo,       
                'area'=> $row->area, 
                'cargo'=> $row->cargo,
                'estado_area_cargo'=> $estado,
                'estado_binario' => $row->estado_area_cargo
            );
            array_push($responce, $fila);
        }
        echo json_encode($responce);
    }
    //
    public function insertar($data)
    {
        $this->db->insert('tbl_area_cargo', array(
			'cod_area_cargo' => $data['cod_area_cargo'],
			'area' => $data['area'],
			'cargo' => $data['cargo'],
			'estado_area_cargo' => $data['estado_area_cargo']
		));
    }
    public function actualizar($data)
    {
        $this->db
			->where('id_area_cargo', $data['id_area_cargo'])
			->update('tbl_area_cargo', array(
				'cod_area_cargo' => $data['cod_area_cargo'],
                'area' => $data['area'],
                'cargo' => $data['cargo'],
                'estado_area_cargo' => $data['estado_area_cargo']
			));
    }
}
?>