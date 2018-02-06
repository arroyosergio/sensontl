<?php

class Registroarticulo_Model extends Model {

    function __construct() {
        parent::__construct();
    }
    
    public function get_paises() {
        $query = "SELECT ".
                    "pais_nombre,".
                    "pais_id ".
                "FROM ".
                    "tblPaises ".
                "ORDER BY ".
                    "pais_nombre ".
                "ASC";
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
    
    public function get_estados($codigoPais) {
        $query = "SELECT ".
                    "est_nombre ".
                "FROM ".
                    "tblEstados ".
                "WHERE ".
                    "pais_id=$codigoPais";
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
    
    public function get_ciudades($estado) {
        $query = "SELECT ".
                    "Name ".
                "FROM ".
                    "city ".
                "WHERE ".
                    "Province='$estado'";
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
    
     public function registro_articulo($articulo) {
        $query = "INSERT INTO ".
                    "tblArticulos".
                        "(".
                            "artNombre,".
                            "artAreaTematica,".
                            "autContacto,".
                            "artTipo".
                        ") ".
                    "VALUES".
                        "(".
                            "'$articulo[nombre]',".
                            "'$articulo[area]',".
                            "'$articulo[idAutor]',".
                            "'$articulo[tipo]'".
                        ")";
        $data = NULL;
        $sth   = $this->db->prepare($query);
        try {
            $sth->execute();
            $data = $this->db->lastInsertId();
        } catch (PDOException $exc) {
            error_log($query);
            error_log($exc);
            $data = FALSE;
        }
        return $data;
    }
    
    public function registro_version_articulo($idArticulo,$archivo) {
        $query = "INSERT INTO ".
                    "tblVersionesArticulos ".
                        "(".
                            "artId,".
                            "verArchivo".
                        ") ".
                    "VALUES ".
                        "(".
                            "$idArticulo,".
                            "'$archivo'".
                        ")";
        $data = NULL;
        $sth   = $this->db->prepare($query);
        try {
            $sth->execute();
            $data = TRUE;
        } catch (PDOException $exc) {
            error_log($query);
            error_log($exc);
            $data = FALSE;
        }
        return $data;
    }
    
    //    Valida que el nombre del articulo no este registrado
    public function existe_articulo($nombre) {
        $query = "SELECT ".
                    "artId ".
                "FROM ".
                    "tblArticulos ".
                "WHERE ".
                    "artNombre='$nombre'";
        
        $sth = $this->db->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $count = $sth->rowCount();
        $data = NULL;
        if ($count > 0) {
            $data = TRUE;
        } else {
            $data = FALSE;
        }
        return $data;
    }
    
    public function registro_autor_articulo($idArticulo, $idAutor) {
        $query = "INSERT INTO ".
                    "tblAutoresArticulos".
                        "(".
                            "autId,".
                            "artId".
                        ") ".
                    "VALUES ".
                        "(".
                            "$idAutor,".
                            "$idArticulo".
                        ")";
        $data = NULL;
        $sth   = $this->db->prepare($query);
        try {
            $sth->execute();
            $data = TRUE;
        } catch (PDOException $exc) {
            error_log($query);
            error_log($exc);
            $data = FALSE;
        }
        return $data;
    }
    
    public function existe_autor_articulo($idArticulo, $nombre, $apPaterno, $apMaterno) {
        $query = "SELECT ".
                    "tblAutores.autId AS autId ".
                "FROM ".
                    "tblAutores ".
                "INNER JOIN ".
                    "tblAutoresArticulos ".
                    "ON tblAutores.autId=tblAutoresArticulos.autId ".
                "WHERE ".
                    "autNombre='$nombre' ".
                "AND ".
                    "autApellidoPaterno='$apPaterno' ".
                "AND ".
                    "autApellidoMaterno='$apMaterno' ".
                "AND ".
                    "artId=$idArticulo ";
        $sth = $this->db->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $count = $sth->rowCount();
        $data = NULL;
        if ($count > 0) {
            $data = TRUE;
        } else {
            $data = FALSE;
        }
        return $data;
    }
    
    public function registro_autor($autor) {
        $query = "INSERT INTO ".
                    "tblAutores".
                        "(".
                            "autNombre,".
                            "autApellidoPaterno,".
                            "autApellidoMaterno,".
                            "autInstitucionProcedencia,".
                            "autCiudad,".
                            "autEstado,".
                            "autPais,".
                            "autCorreo,".
                            "autGradoAcademico,".
                            "autTipoInstitucion,".
                            "autAsistenciaCica".
                        ") ".
                    "VALUES".
                        "(".
                            "'$autor[nombre]',".
                            "'$autor[apellidoPaterno]',".
                            "'$autor[apellidoMaterno]',".
                            "'$autor[institucionProcedencia]',".
                            "'$autor[ciudad]',".
                            "'$autor[estado]',".
                            "'$autor[pais]',".
                            "'$autor[correo]',".
                            "'$autor[gradoAcademico]',".
                            "'$autor[tipoInstitucion]',".
                            "'$autor[asistenciaCica]'".
                        ")";
        $data = NULL;
        $sth   = $this->db->prepare($query);
        try {
            $sth->execute();
            $data = $this->db->lastInsertId();
        } catch (PDOException $exc) {
            error_log($query);
            error_log($exc);
            $data = FALSE;
        }
        return $data;
    }
    
    public function get_autores_articulo($idArticulo) {
        $query = "SELECT ".
                    "tblAutores.autId as autId,".
                    "autNombre,".
                    "autApellidoPaterno,".
                    "autApellidoMaterno ".
                "FROM ".
                    "tblAutores ".
                "INNER JOIN ".
                    "tblAutoresArticulos ".
                    "ON tblAutores.autId=tblAutoresArticulos.autId ".
                "WHERE ".
                "tblAutoresArticulos.artId=$idArticulo ";
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
    
    public function get_total_autores($idArticulo) {
        $query = "SELECT ".
                    "COUNT(autId) as totalAutores ".
                "FROM ".
                    "tblAutoresArticulos ".
                "WHERE ".
                    "artId=$idArticulo";
        
        $sth = $this->db->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $count = $sth->rowCount();
        $data = NULL;
        if ($count > 0) {
            $data = $sth->fetchAll();
            $data = $data[0];
            $data = $data['totalAutores'];
        } else {
            $data = FALSE;
        }
        return $data;
    }
    
    public function get_detalles_articulo($idArticulo) {
        $query = "SELECT ".
                    "artNombre,".
                    "artAreaTematica,".
                    "artArchivo,".
                    "artTipo ".
                "FROM ".
                    "tblArticulos ".
                "WHERE ".
                    "artId=$idArticulo";
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
    
    public function get_nombre_archivo($idArticulo) {
        $query = "SELECT ".
                    "verArchivo ".
                "FROM ".
                    "tblVersionesArticulos ".
                "WHERE ".
                    "artId=$idArticulo";
        
        $sth = $this->db->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $count = $sth->rowCount();
        $data = NULL;
        if ($count > 0) {
            $data = $sth->fetchAll();
            $data = $data[0];
            $data = $data['verArchivo'];
        } else {
            $data = FALSE;
        }
        return $data;
                    
    }
    
    public function borrar_articulo($idArticulo) {
        $query = "DELETE FROM ".
                    "tblArticulos ".
                "WHERE ".
                    "artId=$idArticulo";
        
        $data = NULL;
        $sth   = $this->db->prepare($query);
        try {
            $sth->execute();
            $data = $this->db->lastInsertId();
        } catch (PDOException $exc) {
            error_log($query);
            error_log($exc);
            $data = FALSE;
        }
        return $data;
    }
    
    public function borrar_autor($idAutor) {
        $query = "DELETE FROM ".
                    "tblAutores ".
                "WHERE ".
                    "autId=$idAutor";
        
        $data = NULL;
        $sth   = $this->db->prepare($query);
        try {
            $sth->execute();
            $data = $this->db->lastInsertId();
        } catch (PDOException $exc) {
            error_log($query);
            error_log($exc);
            $data = FALSE;
        }
        return $data;
    }
    
    public function borrar_relacion_autor_articulo($idArticulo) {
        $query = "DELETE FROM ".
                    "tblAutoresArticulos ".
                "WHERE ".
                    "artId=$idArticulo";
        $data = NULL;
        $sth   = $this->db->prepare($query);
        try {
            $sth->execute();
            $data = $this->db->lastInsertId();
        } catch (PDOException $exc) {
            error_log($query);
            error_log($exc);
            $data = FALSE;
        }
        return $data;
    }
    
     public function get_id_autor($idUsuario) {
        $query = "SELECT ".
                    "autId ".
                "FROM ".
                    "tblAutores ".
                "WHERE ".
                    "usuId=$idUsuario";
        $sth = $this->db->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $count = $sth->rowCount();
        $data = NULL;
        if ($count > 0) {
            $data = $sth->fetchAll();
            $data = $data[0];
            $data = $data['autId'];
        } else {
            $data = FALSE;
        }
        return $data;
    }
    
    public function autor_de_contacto($idArticulo, $idAutor) {
        $query = "UPDATE ".
                    "tblArticulos ".
                "SET ".
                    "autContacto=$idAutor ".
                "WHERE ".
                "artId=$idArticulo";
        $data = NULL;
        $sth   = $this->db->prepare($query);
        try {
            $sth->execute();
            $data = $this->db->lastInsertId();
        } catch (PDOException $exc) {
            error_log($query);
            error_log($exc);
            $data = FALSE;
        }
    }
    
    public function registro_tabla_documentos($idArticulo) {
        $query = "INSERT INTO ".
                    "tblDocumentos".
                        "(".
                            "art_id".
                        ") ".
                    "VALUES".
                        "(".
                            "$idArticulo".
                        ")";
         $data = NULL;
        $sth   = $this->db->prepare($query);
        try {
            $sth->execute();
            $data = TRUE;
        } catch (PDOException $exc) {
            error_log($query);
            error_log($exc);
            $data = FALSE;
        }
    }
    
}
