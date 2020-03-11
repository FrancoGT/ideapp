<?php 
class Recurso_Humano_model extends CI_Model
{
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
}
?>