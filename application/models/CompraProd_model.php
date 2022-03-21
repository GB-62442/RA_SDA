<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class CompraProd_model extends CI_Model{

	public function getAll(){
		$this->db->select('idProducto, unidadMedida, producto.nombre as nombreproducto, precioVenta, producto.idProveedor, proveedor.nombre as nombreproveedor from producto left join proveedor on proveedor.idProveedor = producto.idProveedor', FALSE);

		$rs = $this->db->get();

		return $rs->num_rows() > 0 ? $rs->result() : NULL;
	}

	public function insertc($data){
		return $this->db->insert('comprasproducto', $data) ? true : NULL;
	}

	public function insertpv($data){
		return $this->db->insert('puntoventaproducto', $data) ? true : NULL;
	}     
}

