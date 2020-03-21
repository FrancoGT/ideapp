<?php 
class Material_model extends CI_Model
{
    public function listar()
    {
        $query = $this->db->query("SELECT * FROM `tbl_material` WHERE estado_material<>0");
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