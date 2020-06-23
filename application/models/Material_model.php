<?php 
class Material_model extends CI_Model
{
    public function listar()
    {
        $query = $this->db->query("SELECT * FROM tbl_material");
        $responce = array();
        $estado = '';
        foreach ($query->result() as $row)
        {
            if ($row->estado_material == '1')
            {
                $estado = 'Activo';
            }
            if ($row->estado_material == '0')
            {
                $estado = 'Inactivo';
            }
            $fila = array(  
                'id_material'=> $row->id_material,           
                'nombre_material'=> $row->nombre_material, 
                'unidad'=> $row->unidad,
                'estado_binario' => $row->estado_material,
                'estado_material'=> $estado
            );
            array_push($responce, $fila);
        }
        echo json_encode($responce);
    }
    public function insertar($data)
    {
		$this->db->insert('tbl_material', array(
			'nombre_material' => $data['nombre_material'],
			'unidad' => $data['unidad'],
			'estado_material' => $data['estado_material']
		));
    }
    public function actualizar($data)
    {
        $this->db
			->where('id_material', $data['id_material'])
			->update('tbl_material', array(
				'nombre_material' => $data['nombre_material'],
                'unidad' => $data['unidad'],
                'estado_material' => $data['estado_material'],
			));
    }
    public function get_precio_mayor()
    {
        $precio_mayor = '';
        $this->db->select_max('precio_unitario');
        $this->db->from('tbl_costo');
        $query = $this->db->get();
        foreach($query->result() as $row)
        {
            $precio_mayor = $row->precio_unitario;
        }
        return $precio_mayor;
    }
    public function listar_materiales_top_5()
    {
        $precio_mayor = $this->get_precio_mayor();
        $query = $this->db->query("SELECT DISTINCT m.nombre_material, c.precio_unitario FROM tbl_material as m LEFT JOIN tbl_material_obra_costo as moc ON m.id_material=moc.id_material LEFT JOIN tbl_costo as c ON c.id_costo=moc.id_costo WHERE c.precio_unitario<=$precio_mayor AND m.estado_material<>0 ORDER BY c.precio_unitario DESC LIMIT 5");
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    public function listar_precios_top_5()
    {
        $precio_mayor = $this->get_precio_mayor();
        $query = $this->db->query("SELECT DISTINCT m.nombre_material, c.precio_unitario FROM tbl_material as m LEFT JOIN tbl_material_obra_costo as moc ON m.id_material=moc.id_material LEFT JOIN tbl_costo as c ON c.id_costo=moc.id_costo WHERE c.precio_unitario<=$precio_mayor AND m.estado_material<>0 ORDER BY c.precio_unitario DESC LIMIT 5");
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    public function get_estado_by_id($indice)
    {
        $estado_material = '';
        $query = $this->db->query("SELECT estado_material FROM `tbl_material` WHERE id_material='$indice'");
		foreach ($query->result() as $row)
		{
			$estado_material = $row->estado_material;
		}
		return $estado_material;
    }
}
?>