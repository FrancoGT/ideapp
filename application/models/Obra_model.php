<?php 
class Obra_model extends CI_Model
{
    public function mostrar_items_proyecto_construccion()
    {
        $query = $this->db->get('tbl_proyecto_construccion');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    public function addProyecto_construccion($data)
    {
        return $this->db->insert('tbl_proyecto_construccion', $data);
    }
    public function updateProyecto_construccion($id_proyecto_construccion,$field)
    {
        $this->db->where('id_proyecto_construccion', $id_proyecto_construccion);
        $this->db->update('tbl_proyecto_construccion', $field);
        if($this->db->affected_rows() >0)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    public function deleteProyecto_construccion($id_proyecto_construccion)
    {
        $this->db->where('id_proyecto_construccion', $id_proyecto_construccion);
        $this->db->delete('tbl_proyecto_construccion');
        if($this->db->affected_rows() >0)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    }
    public function searchProyecto_construccion($match) 
    {
        $field = array('nombre_proyecto','fecha_inicio','fecha_fin','estado_proyecto');    
        $this->db->like('concat('.implode(',',$field).')',$match);
        $query = $this->db->get('tbl_proyecto_construccion');
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
}
?>