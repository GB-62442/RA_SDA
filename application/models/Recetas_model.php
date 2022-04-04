<?php
defined('BASEPATH') OR exit('No se permite el acceso directo.');

class Recetas_model extends CI_Model{

    public function getAll($idPuntoVenta){
        $cmdReceta = 'select receta.idReceta, receta.nombre, receta.precioVenta, receta.presentacion, insumo.idInsumo, insumoreceta.cantidad, puntoventa.idPuntoVenta from receta, insumoreceta, insumo, puntoventainsumo, puntoventa where receta.idReceta = insumoreceta.idReceta AND insumo.idInsumo = insumoreceta.idInsumo and insumo.idInsumo = puntoventainsumo.idInsumo AND "'.$idPuntoVenta.'" = puntoventainsumo.idPuntoVenta order by idReceta';

        $query = $this->db->query($cmdReceta);

        return $query->num_rows() != 0 ? $query->result() : NULL;
    }

    public function getInsumos($idPuntoVenta){
        $cmdInsumo = 'SELECT insumo.idInsumo, insumo.nombre, insumo.unidadMedida from insumo, puntoventainsumo, puntoventa where insumo.idInsumo = puntoventainsumo.idInsumo AND "'.$idPuntoVenta.'" = puntoventainsumo.idPuntoVenta GROUP BY idInsumo;';
        $query = $this->db->query($cmdInsumo);
        return $query->num_rows() != 0 ? $query->result() : NULL;
    }


    public function insertarReceta($nombre, $precioVenta, $presentacion, $arreglo_insumo, $arreglo_cantidad){
        $cmdReceta = 'INSERT INTO receta values("'.null.'","'.$nombre.'",'.$precioVenta.',"'.$presentacion.'")';
        $this->db->query($cmdReceta);

        $idRecetaQuery = 'SELECT MAX(idReceta) from receta where idReceta = (SELECT MAX(idReceta) from receta)';
        $idReceta = $this->db->query($idRecetaQuery);
        $idReceta = (int)$idReceta->result()[0]->{'MAX(idReceta)'};
        
        for ($i=0; $i < count($arreglo_insumo); $i++) {
            $insumoRecetaQuery = 'INSERT INTO insumoreceta VALUES('.$arreglo_insumo[$i].','.$idReceta.','.$arreglo_cantidad[$i].')';
            $this->db->query($insumoRecetaQuery);
        }
        
    }

    public function obtenerReceta($id_receta){
        $cmdReceta = 'SELECT receta.idReceta, receta.nombre, receta.precioVenta, receta.presentacion, insumo.idInsumo, insumoreceta.cantidad from receta, insumoreceta, insumo WHERE receta.idReceta = '.$id_receta.' AND receta.idReceta = insumoreceta.idReceta AND insumo.idInsumo = insumoreceta.idInsumo order by receta.idReceta';
        $query = $this->db->query($cmdReceta);
        return $query->num_rows() != 0 ? $query->result() : NULL;

    }

    public function actualizarReceta($id_receta, $nombre, $precioVenta, $presentacion, $arreglo_insumo, $arreglo_cantidad){
        $cmdReceta = 'UPDATE receta SET nombre = "'.$nombre.'", precioVenta = '.$precioVenta.', presentacion = "'.$presentacion.'" WHERE idReceta = '.$id_receta;
        $this->db->query($cmdReceta);

        //debemos eliminar registros anteriores
        $cmdEliminar = 'DELETE FROM insumoreceta WHERE idReceta = '.$id_receta;
        $this->db->query($cmdEliminar);


        
        for ($i=0; $i < count($arreglo_insumo); $i++) {
            $insumoRecetaQuery = 'INSERT INTO insumoreceta VALUES('.$arreglo_insumo[$i].','.$id_receta.','.$arreglo_cantidad[$i].')';
            $this->db->query($insumoRecetaQuery);
        }
        
    }
     
}