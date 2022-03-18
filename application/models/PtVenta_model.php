<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class PtVenta_model extends CI_Model{

	public function getAll(){
		$rs = $this->db->get('puntoventa');
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
	}

     public function getById($id)
    {
        $cmd = "SELECT * FROM puntoventa where idPuntoVenta = ".$id;

        $query = $this->db->query($cmd);
        return ($query->num_rows() == 1) ? $query->row() : NULL;
    }

	public function insert($data){
		return $this->db->insert('puntoventa', $data) ? true : NULL;
	}


    public function update($entry, $idPuntoVenta)
    {
        try {
            $this->db->set($entry);
            $this->db->where('idPuntoVenta', $idPuntoVenta);
            $this->db->update('puntoventa');

            return ($idPuntoVenta) ? TRUE : NULL;
        }

        catch(Exception $e) {
            return $e->getMessage();
        }
    }	

     public function deleteById($id)
    {
        $cmd = "DELETE FROM puntoventa where idPuntoVenta = ".$id;

        $query = $this->db->query($cmd);
        return (TRUE) ? TRUE : NULL;
    }
     
}


/*
{
	"table": "puntoventa",
	"rows":
	[
		{
			"idPuntoVenta": 1,
			"unidadMedida": "lts",
			"idPuntoVenta": 1,
			"nombre": "puntoventa 1",
			"precioVenta": 1
		}
	]
}

*/