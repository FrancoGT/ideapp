<?php 
class Trabajador_model extends CI_Model
{
    public function listar_obreros()
    {
        $query = $this->db->query("SELECT p.nombres, p.apellidos, sm.monto_sueldo_semanal FROM tbl_sueldo_semanal as sm LEFT JOIN tbl_trabajador as t ON sm.id_trabajador=t.id_trabajador LEFT JOIN tbl_persona as p ON t.id_persona=p.id_persona WHERE t.estado_trabajador=1 AND t.cargo=1");
        if($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
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
}
?>