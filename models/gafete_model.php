<?php

class Gafete_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function get_asistentes($idArticulo) {
        $query = "SELECT ".
                    "asi_id,".
                    "asi_nombre,".
                    "asi_tipo,".
                    "art_id,".
                    "artNombre ".
                "FROM ".
                    "tblArticulos ".
                "INNER JOIN ".
                    "tbl_asistentes ".
                    "ON ".
                        "tblArticulos.artId=tbl_asistentes.art_id ".
                "WHERE ".
                    "tbl_asistentes.art_id=$idArticulo";
        $sth = $this->db->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $count = $sth->rowCount();
        $data = NULL;
        if ($count > 0) {
            $data = $sth->fetchAll();
        } else {
            $data = FALSE;
        }
        return $data;
    }
    
    public function get_datos_asistente($idArticulo, $id) {
        $query = "SELECT ".
                    "asi_id,".
                    "asi_nombre,".
                    "asi_tipo,".
                    "art_id,".
                    "artNombre ".
                "FROM ".
                    "tblArticulos ".
                "INNER JOIN ".
                    "tbl_asistentes ".
                    "ON ".
                        "tblArticulos.artId=tbl_asistentes.art_id ".
                "WHERE ".
                    "tbl_asistentes.art_id=$idArticulo ". 
                "AND ". 
                    "tbl_asistentes.asi_id=$id"; 
        $sth = $this->db->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $count = $sth->rowCount();
        $data = NULL;
        if ($count > 0) {
            $data = $sth->fetchAll();
            $data = $data[0];
        } else {
            $data = FALSE;
        }
        return $data;
    }

}