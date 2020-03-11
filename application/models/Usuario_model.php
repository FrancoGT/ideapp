<?php 
class Usuario_model extends CI_Model
{
	public function sigue_logeado()
	{
		//Verificar si aun tiene la sesion abierta
		$permiso = $this->session->userdata;
		if ($permiso['user_id'] == NULL)
		{
			return false;
			//redirect("login/index");
		}
		else
		{
			return true;
		}
	}
    public function get_id_user()
    {
       $info_usuario = $this->session->userdata;
       return $info_usuario['user_id'];
    }
    public function get_full_name($id_user)
    {
    	$nombres = '';
    	$apellidos = '';
    	$query = $this->db->query("SELECT p.nombres, p.apellidos FROM tbl_persona as p LEFT JOIN tbl_users as u ON u.id_persona=p.id_persona WHERE u.id_user='$id_user'");
    	foreach ($query->result() as $row)
    	{
    		$nombres = $row->nombres;
    		$apellidos = $row->apellidos;
    	}
    	return $nombres.' '.$apellidos;
    }
}
?>