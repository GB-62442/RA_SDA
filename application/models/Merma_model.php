<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class Merma_model extends CI_Model{

	public function getAll(){
		$this->db->select('idInsumo, unidadMedida, insumo.nombre as nombreinsumo, insumo.idProveedor, proveedor.nombre as nombreproveedor from insumo left join proveedor on proveedor.idProveedor = insumo.idProveedor', FALSE);

		$rs = $this->db->get();

		return $rs->num_rows() > 0 ? $rs->result() : NULL;
	}

	public function insert($data){
		return $this->db->insert('mermainsumo', $data) ? true : NULL;
	}

 	public function getById($id, $inicio, $final)
    {
        $cmd = "SELECT insumo.idInsumo, insumo.nombre as nombreinsumo, insumo.unidadMedida, proveedor.idProveedor, proveedor.nombre as nombreproveedor, fecha, cantidad FROM mermainsumo inner join insumo on mermainsumo.idInsumo=insumo.idInsumo inner join proveedor on proveedor.idProveedor= insumo.idProveedor where insumo.idInsumo  = ".$id;

		$busqueda = "";
        if($inicio!= null && $inicio != "" && $final != null && $final != ""){
        	$busqueda = " AND date(fecha) BETWEEN CAST('".$inicio."' AS DATE) AND CAST('".$final."' AS DATE)";

        }
		$cmd  =$cmd.$busqueda." order by fecha desc";
		
        $query = $this->db->query($cmd);
		return $query->num_rows() > 0 ? $query->result() : NULL;
    }

}
