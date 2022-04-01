<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class CompraInsu_model extends CI_Model{

	public function getAll(){
		$this->db->select('idInsumo, unidadMedida, insumo.nombre as nombreinsumo, insumo.idProveedor, proveedor.nombre as nombreproveedor from insumo left join proveedor on proveedor.idProveedor = insumo.idProveedor', FALSE);

		$rs = $this->db->get();

		return $rs->num_rows() > 0 ? $rs->result() : NULL;
	}

	public function insertc($data){
		return $this->db->insert('comprasinsumo', $data) ? true : NULL;
	}

	public function insertpv($data){
		return $this->db->insert('puntoventainsumo', $data) ? true : NULL;
	}     

	public function getById($id)
    {
        $cmd = "SELECT insumo.idInsumo, insumo.nombre as nombreinsumo, proveedor.idProveedor, proveedor.nombre as nombreproveedor, fecha, cantidad FROM comprasinsumo inner join insumo on comprasinsumo.idInsumo=insumo.idInsumo inner join proveedor on proveedor.idProveedor= insumo.idProveedor where insumo.idInsumo  = ".$id;

        $query = $this->db->query($cmd);
		return $query->num_rows() > 0 ? $query->result() : NULL;
    }
}
