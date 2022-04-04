<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class Usuario_model extends CI_Model{

	public function getAll(){
		$rs = $this->db->get('usuario');
		return $rs->num_rows() > 0 ? $rs->result() : NULL;
	}

     public function getById($id)
    {
        $cmd = "SELECT * FROM Usuario where idUsuario = ".$id;

        $query = $this->db->query($cmd);
        return ($query->num_rows() == 1) ? $query->row() : NULL;
    }

     public function getSesionesById($id, $inicio, $final)
    {
        $cmd = "SELECT usuario.idUsuario, nombre, rol, resultado, fecha FROM usuario inner join registrosesion on Usuario.idUsuario=registrosesion.idUsuario where usuario.idUsuario = ".$id;

        $busqueda = "";
        if($inicio!= null && $inicio != "" && $final != null && $final != ""){
            $busqueda = " AND date(fecha) BETWEEN CAST('".$inicio."' AS DATE) AND CAST('".$final."' AS DATE)";

        }

        $cmd  =$cmd.$busqueda." order by fecha desc";
        

        $query = $this->db->query($cmd);
        return $query->num_rows() > 0 ? $query->result() : NULL;
    }

	public function insert($data){
		return $this->db->insert('Usuario', $data) ? true : NULL;
	}

    public function insertSesion($data){
        return $this->db->insert('registrosesion', $data) ? true : NULL;
    }

    public function update($entry, $idUsuario)
    {
        try {
            $this->db->set($entry);
            $this->db->where('idUsuario', $idUsuario);
            $this->db->update('Usuario');

            return ($idUsuario) ? TRUE : NULL;
        }

        catch(Exception $e) {
            return $e->getMessage();
        }
    }	

     public function deleteById($id)
    {
        $cmd = "DELETE FROM Usuario where idUsuario = ".$id;

        $query = $this->db->query($cmd);
        return (TRUE) ? TRUE : NULL;
    }
     
}


/*
{
	"table": "Usuario",
	"rows":
	[
		{
			"idUsuario": 1,
			"unidadMedida": "lts",
			"idProveedor": 1,
			"nombre": "Usuario 1",
			"precioVenta": 1
		}
	]
}

*/