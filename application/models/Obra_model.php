<?php 
class Obra_model extends CI_Model
{
    public function anteponer_cero($valor)
    {
        $num = (int)$valor;
        $nuevo_valor = "";
        if ($num < 10)
        {
        $nuevo_valor = (string)$valor;
        $nuevo_valor = str_pad($valor, 2, "0", STR_PAD_LEFT);
        return $nuevo_valor;
        }
        else
        {
        $nuevo_valor = (string)$valor;
        return $nuevo_valor;
        }
    }
    public function formato_d_m_a($date)
    {
        $day = date("j", strtotime($date));
        $day = $this->anteponer_cero($day);
        $month= date("n", strtotime($date));
        $month= $this->anteponer_cero($month);
        $date = date("$day/$month/Y", strtotime($date));
        return $date;
    }
    public function listar()
    {
        $query = $this->db->query("SELECT * FROM tbl_proyecto_construccion");
        $responce = array();
        $estado = '';
        foreach ($query->result() as $row)
        {
            if ($row->estado_proyecto == '1')
            {
                $estado = 'Activo';
            }
            if ($row->estado_proyecto == '0')
            {
                $estado = 'Inactivo';
            }
            $fila = array(  
                'id_proyecto_construccion' => $row->id_proyecto_construccion,          
                'nombre_proyecto'=> $row->nombre_proyecto, 
                'fecha_inicio'=> $this->formato_d_m_a($row->fecha_inicio),
                'fecha_fin'=> $this->formato_d_m_a($row->fecha_fin),
                'estado_proyecto'=> $estado,
                'estado_binario'=> $row->estado_proyecto,
                'inicio' => $row->fecha_inicio, //formato de fecha normal
                'fin' => $row->fecha_fin //formato de fecha normal
            );
            array_push($responce, $fila);
        }
        echo json_encode($responce);
    } //xD
    public function insertar($data)
    {
		$this->db->insert('tbl_proyecto_construccion', array(
			'nombre_proyecto' => $data['nombre_proyecto'],
			'fecha_inicio' => $data['fecha_inicio'],
			'fecha_fin' => $data['fecha_fin'],
			'estado_proyecto' => $data['estado_proyecto']
		));
	}
    public function actualizar($data)
    {
        $this->db
			->where('id_proyecto_construccion', $data['id_proyecto_construccion'])
			->update('tbl_proyecto_construccion', array(
				'nombre_proyecto' => $data['nombre_proyecto'],
                'fecha_inicio' => $data['fecha_inicio'],
                'fecha_fin' => $data['fecha_fin'],
                'estado_proyecto' => $data['estado_proyecto'],
			));
    }
    public function buscar($match) //
    {
        $field = array('nombre_proyecto','fecha_inicio','fecha_fin','estado_proyecto');    
        $this->db->like('concat('.implode(',',$field).')',$match);
        $query = $this->db->get('tbl_proyecto_construccion');
        if($query->num_rows() > 0)
        {
            $responce = array();
            $estado = '';
            foreach ($query->result() as $row)
            {
                if ($row->estado_proyecto == '1')
                {
                    $estado = 'Activo';
                }
                if ($row->estado_proyecto == '0')
                {
                    $estado = 'Inactivo';
                }
                $fila = array(  
                    'id_proyecto_construccion' => $row->id_proyecto_construccion,          
                    'nombre_proyecto'=> $row->nombre_proyecto, 
                    'fecha_inicio'=> $this->formato_d_m_a($row->fecha_inicio),
                    'fecha_fin'=> $this->formato_d_m_a($row->fecha_fin),
                    'estado_proyecto'=> $estado,
                    'estado_binario'=> $row->estado_proyecto,
                    'inicio' => $row->fecha_inicio,
                    'fin' => $row->fecha_fin
                );
                array_push($responce, $fila);
            }
            echo json_encode($responce);
        }
        else
        {
            return false;
        }
    }
}
?>