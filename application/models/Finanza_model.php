<?php 
class Finanza_model extends CI_Model
{
    public function fecha_actual()
    {
        $date = new DateTime("", new DateTimeZone('America/Lima'));
        return date("Y-m-d", $date->format('U'));
    }
    public function dia_siguiente($fecha_actual)
    {
        return date("Y-m-d",strtotime($fecha_actual."+ 1 days"));
    }
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
    public function is_decimal($val)
    {
        return is_numeric($val) && floor($val) != $val;
    }
    public function formato_numerico($var)
    {
        $num = number_format($var, 0, '.', '');
        if ($this->is_decimal($var))
        {
            return number_format($var, 2, '.', '');
        }
        else
        {
            return number_format($var, 0, '.', '');
        }
    }
    public function get_codigo_trabajador($id_trabajador)
    {
        $cod_trabajador = '';
        $query = $this->db->query("SELECT cod_trabajador FROM tbl_trabajador WHERE id_trabajador=$id_trabajador");
        foreach($query->result() as $row)
        {
            $cod_trabajador = $row->cod_trabajador;
        }
        return $cod_trabajador;
    }
    public function multiplicar($num1, $num2)
    {
        $multiplicacion = $this->formato_numerico($num1) * $this->formato_numerico($num2);
        return $this->formato_numerico($multiplicacion);
    }
    public function get_nombre_material($id_material)
    {
        $nombre_material = "";
        $query = $this->db->query("SELECT nombre_material FROM tbl_material WHERE id_material=$id_material");
        foreach($query->result() as $row)
        {
            $nombre_material = $row->nombre_material;
        }
        return $nombre_material;
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
    public function gasto_total($id_obra, $id_material)
    {
        $sumatoria = 0;
        $query = $this->db->query("SELECT c.precio_unitario, ca.precio, c.cantidad FROM tbl_material_obra_costo as moc LEFT JOIN tbl_costo as c ON moc.id_costo=c.id_costo LEFT JOIN tbl_material as m ON moc.id_material=m.id_material LEFT JOIN tbl_costo_adicional as ca ON moc.id_costo_adicional=ca.id_costo_adicional WHERE moc.id_obra=$id_obra AND moc.id_material=$id_material AND moc.estado_material_obra_costo=1");
        foreach($query->result() as $row)
        {
            $precio_unitario = $this->formato_numerico($row->precio_unitario);
            $precio = $this->formato_numerico($row->precio);
            $cantidad = $this->formato_numerico($row->cantidad);
            $sumatoria = $sumatoria + $this->multiplicar($precio_unitario, $cantidad) + $precio;
        }
        return $this->formato_numerico(round($sumatoria));
    }
    public function cantidad_total($id_obra, $id_material)
    {
        $sumatoria = 0;
        $query = $this->db->query("SELECT c.cantidad FROM tbl_material_obra_costo as moc LEFT JOIN tbl_costo as c ON moc.id_costo=c.id_costo LEFT JOIN tbl_material as m ON moc.id_material=m.id_material LEFT JOIN tbl_costo_adicional as ca ON moc.id_costo_adicional=ca.id_costo_adicional WHERE moc.id_obra=$id_obra AND moc.id_material=$id_material");
        foreach($query->result() as $row)
        {
            $cantidad = $this->formato_numerico($row->cantidad);
            $sumatoria = $sumatoria + $cantidad;
        }
        return $this->formato_numerico(round($sumatoria, 0));
    }
    public function subtotal($pu, $c, $p)
    {
        $precio_unitario = $this->formato_numerico($pu);
        $cantidad = $this->formato_numerico($c);
        $precio = $this->formato_numerico($p);
        return bcdiv($this->multiplicar($precio_unitario, $cantidad) + $precio, '1', 1);
    }
    public function get_gasto($id_obra, $id_material)
    {
        $query = $this->db->query("SELECT m.nombre_material, c.precio_unitario, c.cantidad, ca.precio, moc.fecha_costo FROM tbl_material_obra_costo as moc LEFT JOIN tbl_costo as c ON moc.id_costo=c.id_costo LEFT JOIN tbl_material as m ON moc.id_material=m.id_material LEFT JOIN tbl_costo_adicional as ca ON moc.id_costo_adicional=ca.id_costo_adicional WHERE moc.id_obra=$id_obra AND moc.id_material=$id_material AND moc.estado_material_obra_costo=1");
        $gasto = 0;
        foreach($query->result() as $row)
        {
            $gasto = $gasto + $this->subtotal($row->precio_unitario, $row->cantidad, $row->precio);
        }
        return $gasto;
    }
    public function calcular_gasto_total($id_obra)
    {
        $query = $this->db->query("SELECT DISTINCT moc.id_material FROM tbl_material_obra_costo as moc LEFT JOIN tbl_obra as o ON moc.id_obra=o.id_obra LEFT JOIN tbl_material as m ON moc.id_material=m.id_material WHERE moc.id_obra=$id_obra AND m.estado_material=1 AND moc.estado_material_obra_costo=1");
        $gasto_total = 0;
        foreach($query->result() as $row)
        { 
            $gasto_total = $gasto_total + $this->get_gasto($id_obra, $row->id_material);
            //echo $this->get_nombre_material($row->id_material).": ";
            //echo $this->gasto_total($id_obra, $row->id_material)."<br>"ash;
        }
        return $gasto_total;
    }
    public function listar_presupuestos()
    {
        $this->load->library('session');
        $id_proyecto_construccion = $this->session->userdata('current_id');
        $tipo_obra = '';
        $estado = '';
        $query = $this->db->query("SELECT pc.id_proyecto_construccion, pc.nombre_proyecto, o.tipo, m.nombre_material, c.precio_unitario, c.cantidad, ca.precio, moc.fecha_costo, moc.estado_material_obra_costo FROM 
        tbl_material_obra_costo as moc LEFT JOIN tbl_obra as o ON moc.id_obra=o.id_obra LEFT JOIN tbl_detalle_proyecto_obra as dpo ON o.id_obra=dpo.id_obra LEFT JOIN tbl_proyecto_construccion as pc ON dpo.id_proyecto_construccion=pc.id_proyecto_construccion LEFT JOIN tbl_costo as c ON moc.id_costo=c.id_costo LEFT JOIN 
        tbl_material as m ON moc.id_material=m.id_material 
        LEFT JOIN tbl_costo_adicional as ca ON moc.id_costo_adicional=ca.id_costo_adicional 
        WHERE pc.id_proyecto_construccion = $id_proyecto_construccion");
        $responce = array();
        foreach ($query->result() as $row)
        {
            switch($row->tipo) 
            {
                case '1':
                $tipo_obra = 'Casco gris';
                break;
                case '2':
                $tipo_obra = 'Acabados';
                break;
                case '3':
                $tipo_obra = 'Casco Rojo';
                break;
            }
            switch($row->estado_material_obra_costo) 
            {
                case '0':
                $estado = 'Inactivo';
                break;
                case '1':
                $estado = 'Activo';
                break;
            }
            $fila = array(            
                        'nombre_proyecto_construccion'=> $row->nombre_proyecto, 
                        'nombre_material'=> $row->nombre_material, 
                        'tipo_obra'=> $tipo_obra,
                        'precio_unitario'=> $this->formato_numerico($row->precio_unitario),
                        'cantidad'=> $this->formato_numerico($row->cantidad), 
                        'costo_adicional'=> $this->formato_numerico($row->precio), 
                        'subtotal'=> $this->subtotal($row->precio_unitario, $row->cantidad, $row->precio), 
                        'fecha_costo'=> $this->formato_d_m_a($row->fecha_costo), 
                        'fecha_normal' => $row->fecha_costo, //formato de fecha normal
                        'inversion_total'=> strval($this->get_inversion_total($id_proyecto_construccion)),
                        'estado_material_obra_costo'=> $estado
            );
            array_push($responce, $fila);
        }
        echo json_encode($responce);
    }   
    public function get_sueldo_semanal_trabajador($id_trabajador, $id_proyecto_construccion)
    {
        $monto_sueldo_semanal = 0;
        $query = $this->db->query("SELECT sm.monto_sueldo_semanal FROM tbl_sueldo_semanal as sm LEFT JOIN tbl_trabajador as t ON sm.id_trabajador=t.id_trabajador WHERE sm.id_proyecto_construccion=$id_proyecto_construccion AND t.id_trabajador=$id_trabajador");
        foreach($query->result() as $row)
        {
            $monto_sueldo_semanal = $row->monto_sueldo_semanal;
        }
        return $monto_sueldo_semanal;
    }
    public function get_total_adelanto_semanal($id_proyecto_construccion)
    {
        $total_adelanto_semanal = 0;
        $query = $this->db->query("SELECT tas.monto_adelanto_semanal FROM tbl_adelanto_semanal as tas LEFT JOIN tbl_detalle_adelanto_semanal as das ON tas.id_adelanto_semanal=das.id_adelanto_semanal LEFT JOIN tbl_proyecto_construccion as pc ON das.id_proyecto_construccion=pc.id_proyecto_construccion WHERE pc.id_proyecto_construccion=$id_proyecto_construccion");
        foreach($query->result() as $row)
        {
            $total_adelanto_semanal = $total_adelanto_semanal + $row->monto_adelanto_semanal; 
        }
        return $total_adelanto_semanal;
    }
    public function get_id_casco_gris($id_proyecto_construccion)
    {
        $id_casco_gris = 0;
        $query = $this->db->query("SELECT dpo.id_obra FROM tbl_detalle_proyecto_obra as dpo LEFT JOIN tbl_obra as o ON dpo.id_obra=o.id_obra WHERE dpo.id_proyecto_construccion=$id_proyecto_construccion AND o.tipo=1");
        foreach($query->result() as $row)
        {
            $id_casco_gris = $row->id_obra;
        }
        return $id_casco_gris;
    }
    public function get_id_acabados($id_proyecto_construccion)
    {
        $id_acabados = 0;
        $query = $this->db->query("SELECT dpo.id_obra FROM tbl_detalle_proyecto_obra as dpo LEFT JOIN tbl_obra as o ON dpo.id_obra=o.id_obra WHERE dpo.id_proyecto_construccion=$id_proyecto_construccion AND o.tipo=2");
        foreach($query->result() as $row)
        {
            $id_acabados = $row->id_obra;
        }
        return $id_acabados;
    }
    public function get_inversion_total($id_proyecto_construccion)
    {
        $inversion_total = 0;
        $id_casco_gris = $this->get_id_casco_gris($id_proyecto_construccion);
        $id_acabados = $this->get_id_acabados($id_proyecto_construccion);
        $total_casco_gris = $this->calcular_gasto_total($id_casco_gris);
        $total_acabados = $this->calcular_gasto_total($id_acabados);
        $total_adelanto_semanal = $this->get_total_adelanto_semanal($id_proyecto_construccion);
        $inversion_total = $total_casco_gris + $total_acabados + $total_adelanto_semanal;
        return $inversion_total;
    }
    public function mostrar_sueldos_semanales($id_proyecto_construccion)
    {
        $query = $this->db->query("SELECT p.nombres, p.apellidos, sm.monto_sueldo_semanal FROM tbl_sueldo_semanal as sm LEFT JOIN tbl_trabajador as t ON sm.id_trabajador=t.id_trabajador LEFT JOIN tbl_persona as p ON t.id_persona=p.id_persona WHERE sm.id_proyecto_construccion=$id_proyecto_construccion");
        echo "<table class='table table-bordered table-hover'>
                <th>TRABAJADOR</th>
                <th>SUELDO SEMANAL</th>
              </tr>";
        foreach($query->result() as $row)
        {
            echo "<tr>";
            echo "<td>".$row->nombres." ".$row->apellidos."</td>";
            echo "<td>".$row->monto_sueldo_semanal."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    public function get_horas_dia_trabajador($id_trabajador, $dia)
    {
        $horas = 0;
        $query = $this->db->query("SELECT ch.horas FROM tbl_control_horas as ch LEFT JOIN tbl_control_horas_trabajador as cht ON ch.id_control_horas=cht.id_control_horas LEFT JOIN tbl_trabajador as t ON cht.id_trabajador=t.id_trabajador WHERE t.id_trabajador=$id_trabajador AND ch.fecha_control_horas='$dia'");
        foreach($query->result() as $row)
        {
            $horas = $row->horas;
        }
        return $horas;
    }
    public function sumar_horas_semanales($inicio, $fin, $id_trabajador)
    {
        $horas_semanales = 0;
        $horas_dia = 0;
        $query = $this->db->query("SELECT ch.horas FROM tbl_control_horas as ch LEFT JOIN tbl_control_horas_trabajador as cht ON ch.id_control_horas=cht.id_control_horas LEFT JOIN tbl_trabajador as t ON cht.id_trabajador=t.id_trabajador WHERE t.id_trabajador=$id_trabajador AND ch.fecha_control_horas BETWEEN '$inicio' AND '$fin'");
        foreach($query->result() as $row)
        {
            $horas_dia = $this->formato_numerico($row->horas);
            $horas_semanales = $horas_semanales + $horas_dia;
        }
        return $this->formato_numerico($horas_semanales);
    }
    public function get_sueldo_a_cobrar($inicio, $fin, $id_trabajador, $id_proyecto_construccion)
    {
        $total_horas_semanales = $this->formato_numerico($this->sumar_horas_semanales($inicio, $fin, $id_trabajador));
        $sueldo_semanal = $this->formato_numerico($this->get_sueldo_semanal_trabajador($id_trabajador, $id_proyecto_construccion));
        $sueldo_a_cobrar = $total_horas_semanales * ($sueldo_semanal/48);
        return $this->formato_numerico($sueldo_a_cobrar);
    }
    public function get_nombre_dia($fecha)
    {
        $fechats = strtotime($fecha); //pasamos a timestamp
        //el parametro w en la funcion date indica que queremos el dia de la semana
        //lo devuelve en numero 0 domingo, 1 lunes,....
        switch (date('w', $fechats))
        {
            case 0: return "Domingo"; break;
            case 1: return "Lunes"; break;
            case 2: return "Martes"; break;
            case 3: return "Miercoles"; break;
            case 4: return "Jueves"; break;
            case 5: return "Viernes"; break;
            case 6: return "Sabado"; break;
        }
    }
    public function get_lunes($id_proyecto_construccion)
    {
        $lunes = '';
        $query = $this->db->query("SELECT DISTINCT ch.fecha_control_horas FROM tbl_control_horas as ch 
                                    LEFT JOIN tbl_control_horas_trabajador as cht ON ch.id_control_horas=cht.id_control_horas 
                                    LEFT JOIN tbl_trabajador as t ON cht.id_trabajador=t.id_trabajador 
                                    LEFT JOIN tbl_proyecto_construccion_trabajador as pct ON pct.id_trabajador=t.id_trabajador 
                                    LEFT JOIN tbl_proyecto_construccion as pc ON pct.id_proyecto_construccion=pc.id_proyecto_construccion 
                                    WHERE pc.id_proyecto_construccion=$id_proyecto_construccion");
        foreach($query->result() as $row)
        {
            if ($this->get_nombre_dia($row->fecha_control_horas) == "Lunes")
            {
                $lunes = $row->fecha_control_horas;
                break; //solo el primer lunes de los registros
            }
        }
        return $lunes;
    }
    public function listar_pagos()
    {
        $this->load->library('session');
        $id_proyecto_construccion = $this->session->userdata('current_id');
        $lunes = $this->get_lunes($id_proyecto_construccion);
        $martes = $this->dia_siguiente($lunes);
        $miercoles = $this->dia_siguiente($martes);
        $jueves = $this->dia_siguiente($miercoles);
        $viernes = $this->dia_siguiente($jueves);
        $sabado = $this->dia_siguiente($viernes);
        $responce = array();
        $query = $this->db->query("SELECT id_trabajador FROM `tbl_proyecto_construccion_trabajador` WHERE id_proyecto_construccion=$id_proyecto_construccion");
        foreach($query->result() as $row)
        {
            $fila = array(   
                'codigo_trabajador' => $this->get_codigo_trabajador($row->id_trabajador),         
                'nombres_apellidos_trabajador'=> $this->get_nombres_apellidos_trabajador($row->id_trabajador), 
                'sueldo_semanal_trabajador'=> $this->get_sueldo_semanal_trabajador($row->id_trabajador, $id_proyecto_construccion), 
                'TC'=> '48',
                'horas_lunes'=> $this->get_horas_dia_trabajador($row->id_trabajador, $lunes),
                'horas_martes'=> $this->get_horas_dia_trabajador($row->id_trabajador, $martes), 
                'horas_miercoles'=> $this->get_horas_dia_trabajador($row->id_trabajador, $miercoles), 
                'horas_jueves'=> $this->get_horas_dia_trabajador($row->id_trabajador, $jueves), 
                'horas_viernes'=> $this->get_horas_dia_trabajador($row->id_trabajador, $viernes), 
                'horas_sabado'=>  $this->get_horas_dia_trabajador($row->id_trabajador, $sabado),
                'sueldo_cobrar'=>  $this->get_sueldo_a_cobrar($lunes, $sabado, $row->id_trabajador, $id_proyecto_construccion)
            );
            array_push($responce, $fila);

        }
        echo json_encode($responce);
    }    
}
?>