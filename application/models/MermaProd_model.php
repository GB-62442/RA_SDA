<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class MermaProd_model extends CI_Model{

	public function getAll(){
		$this->db->select('idProducto, unidadMedida, producto.nombre as nombreproducto, precioVenta, producto.idProveedor, proveedor.nombre as nombreproveedor from producto left join proveedor on proveedor.idProveedor = producto.idProveedor', FALSE);

		$rs = $this->db->get();

		return $rs->num_rows() > 0 ? $rs->result() : NULL;
	}

	public function insert($data){
		return $this->db->insert('mermaproducto', $data) ? true : NULL;
	}

 	public function getById($id)
    {
        $cmd = "SELECT producto.idProducto, producto.nombre as nombreproducto, producto.unidadMedida, precioVenta, proveedor.idProveedor, proveedor.nombre as nombreproveedor, fecha, cantidad FROM mermaproducto inner join producto on mermaproducto.idProducto=producto.idProducto inner join proveedor on proveedor.idProveedor= producto.idProveedor where producto.idProducto  = ".$id;

        $query = $this->db->query($cmd);
		return $query->num_rows() > 0 ? $query->result() : NULL;
    }

}

 