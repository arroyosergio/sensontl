<?php

class Registroasistencia_Model extends Model {

     function __construct() {
          parent::__construct();
     }
     
     public function get_datos_articulo($idArticulo) {
//          $idArticulo = $this->get_id_articulo($idAutor);
          
          $query = "SELECT ".
                         "artId,".
                         "artNombre,".
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
     
     public function get_id_articulo($idAutor) {
          $query = "SELECT ".
                         "artId ".
                    "FROM ".
                         "tblAutoresArticulos ".
                    "WHERE ".
                         "autId=$idAutor";
          $sth = $this->db->prepare($query);
          $sth->setFetchMode(PDO::FETCH_ASSOC);
          $sth->execute();
          $count = $sth->rowCount();
          $data = NULL;
          if ($count > 0) {
               $data = $sth->fetchAll();
               $data = $data[0]['artId'];
          } else {
               $data = FALSE;
          }
          return $data;
          
     }
     
     public function get_estatus_cambios($idArticulo) {
          $query = "SELECT ".
                         "art_cambios_asistencia ".
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
               $data = $data[0]['art_cambios_asistencia'];
          } else {
               $data = FALSE;
          }
          return $data;
     }
     
     public function get_estatus_registro($idArticulo) {
          $query = "SELECT ".
                         "art_estatus_asistencia ".
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
               $data = $data[0]['art_estatus_asistencia'];
          } else {
               $data = FALSE;
          }
          return $data;
     }
     
     public function update_estatus_asitencia($idArticulo, $estatus) {
          $query = "UPDATE ".
                         "tblArticulos ".
                    "SET ".
                         "art_estatus_asistencia='$estatus' ".
                    "WHERE ".
                         "artId=$idArticulo";
          $sth = $this->db->prepare($query);
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

     public function regitro_asistente($asistente) {
          $query = "INSERT INTO ".
                         "tbl_asistentes".
                              "(".
                                   "asi_nombre,".
                                   "asi_institucion,".
                                   "asi_tipo,".
                                   "art_id".
                              ") ".
                         "VALUES ".
                              "(".
                                   "'$asistente[nombre]',".
                                   "'$asistente[institucion]',".
                                   "'$asistente[tipoAsistente]',".
                                   Session::get('idArticulo').
                              ")";
          
          $sth = $this->db->prepare($query);
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
     
     public function get_asistentes_articulo() {
          $query = "SELECT ".
                         "asi_id,".
                         "asi_nombre,".
                         "asi_institucion,".
                         "asi_tipo ".
                    "FROM ".
                         "tbl_asistentes ".
                    "WHERE ".
                         "art_id=".Session::get('idArticulo');
          
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
     
     public function get_datos_asistente($idAsistente) {
          $query = "SELECT ".
                         "asi_id,".
                         "asi_nombre,".
                         "asi_institucion,".
                         "asi_tipo ".
                    "FROM ".
                         "tbl_asistentes ".
                    "WHERE ".
                         "asi_id=$idAsistente";
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
     
     public function borrar_asistente($idAsistente) {
          $query = "DELETE FROM ".
                         "tbl_asistentes ".
                    "WHERE ".
                         "asi_id=$idAsistente";
          $sth = $this->db->prepare($query);
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
     
     public function update_asistente($asistente) {
          $query = "UPDATE ".
                         "tbl_asistentes ".
                    "SET ".
                         "asi_nombre='$asistente[nombre]',".
                         "asi_institucion='$asistente[institucion]',".
                         "asi_tipo='$asistente[tipo]' ".
                    "WHERE ".
                    "asi_id=$asistente[id]";
          $sth = $this->db->prepare($query);
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
     
     public function registro_datos_deposito($deposito) {
          $query = "INSERT ".
                         "INTO ".
                    "tbl_depositos".
                         "(".
                              "dep_banco,".
                              "dep_sucursal,".
                              "dep_transaccion,".
                              "dep_info,".
                              "dep_tipo,".
                              "dep_fecha,".
                              "dep_hora,".
                              "dep_monto,".
                              "dep_comprobante,".
                              "art_id".
                         ") ".
                    "VALUES ".
                         "(".
                              "'$deposito[banco]',".
                              "'$deposito[numSucursal]',".
                              "'$deposito[numTransaccion]',".
                              "'$deposito[info]',".
                              "'$deposito[tipoPago]',".
                              "'$deposito[fecha]',".
                              "'$deposito[hora]',".
                              "$deposito[monto],".
                              "'$deposito[comprobante]',".
                              "$deposito[idArticulo]".
                         ")";
          $sth = $this->db->prepare($query);
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
     
     public function update_datos_deposito($deposito) {
          $query = "UPDATE ".
                        "tbl_depositos ".
                         "SET ".
                              "dep_banco='$deposito[banco]',".
                              "dep_sucursal='$deposito[sucursal]',".
                              "dep_transaccion='$deposito[transaccion]',".
                              "dep_info='$deposito[info]',".
                              "dep_tipo='$deposito[tipoPago]',".
                              "dep_fecha='$deposito[fecha]',".
                              "dep_hora='$deposito[hora]',".
                              "dep_monto=$deposito[monto],".
                              "dep_comprobante='$deposito[comprobante]' ".
                        "WHERE ". 
                              "art_id=$deposito[idArticulo]";
          $sth = $this->db->prepare($query);
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
     
     public function registro_datos_facturacion($facturacion) {
          $query = "INSERT INTO ".
                         "tbl_datos_facturacion".
                              "(".
                                   "fac_correo,".
                                   "fac_razon_social,".
                                   "fac_rfc,".
                                   "fac_calle,".
                                   "fac_numero,".
                                   "fac_colonia,".
                                   "fac_municipio,".
                                   "fac_estado,".
                                   "fac_cp,".
                                   "art_id".
                              ") ".
                         "VALUES ".
                              "(".
                                   "'$facturacion[correo]',".
                                   "'$facturacion[razonSocial]',".
                                   "'$facturacion[rfc]',".
                                   "'$facturacion[calle]',".
                                   "'$facturacion[numero]',".
                                   "'$facturacion[colonia]',".
                                   "'$facturacion[municipio]',".
                                   "'$facturacion[estado]',".
                                   "'$facturacion[cp]',".
                                   "$facturacion[idArticulo]".
                              ")";
          $sth = $this->db->prepare($query);
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
     
     public function update_datos_facturacion($facturacion) {
         if ($this->existeRegistroFacturacion($facturacion[idArticulo])) {
          $query = "UPDATE ".
                         "tbl_datos_facturacion ".
                    "SET ".
                            "fac_correo='$facturacion[correo]',".
                            "fac_razon_social='$facturacion[razonSocial]',".
                            "fac_rfc='$facturacion[rfc]',".
                            "fac_calle='$facturacion[calle]',".
                            "fac_numero='$facturacion[numero]',".
                            "fac_colonia='$facturacion[colonia]',".
                            "fac_municipio='$facturacion[municipio]',".
                            "fac_estado='$facturacion[estado]',".
                            "fac_cp='$facturacion[cp]' ".
                    "WHERE ".
                            "art_id=$facturacion[idArticulo]";
          }else{
              $query = "INSERT INTO ".
                         "tbl_datos_facturacion".
                              "(".
                                   "fac_correo,".
                                   "fac_razon_social,".
                                   "fac_rfc,".
                                   "fac_calle,".
                                   "fac_numero,".
                                   "fac_colonia,".
                                   "fac_municipio,".
                                   "fac_estado,".
                                   "fac_cp,".
                                   "art_id".
                              ") ".
                         "VALUES ".
                              "(".
                                   "'$facturacion[correo]',".
                                   "'$facturacion[razonSocial]',".
                                   "'$facturacion[rfc]',".
                                   "'$facturacion[calle]',".
                                   "'$facturacion[numero]',".
                                   "'$facturacion[colonia]',".
                                   "'$facturacion[municipio]',".
                                   "'$facturacion[estado]',".
                                   "'$facturacion[cp]',".
                                   "$facturacion[idArticulo]".
                              ")";
          }
          $sth = $this->db->prepare($query);
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
     
     public function get_total_asistentes($idArticulo,$tipoAsistente) {
          $query = "SELECT ".
                         "COUNT(asi_id) AS total ".
                    "FROM ".
                         "tbl_asistentes ".
                    "WHERE ".
                         "art_id=$idArticulo ".
                    "AND ".
                         "asi_tipo='$tipoAsistente'";
          $sth = $this->db->prepare($query);
          $sth->setFetchMode(PDO::FETCH_ASSOC);
          $sth->execute();
          $count = $sth->rowCount();
          $data = NULL;
          if ($count > 0) {
               $data = $sth->fetchAll();
               $data = $data[0];
               $data = $data['total'];
          } else {
               $data = FALSE;
          }
          return $data;
     }
     
    public function get_datos_facturacion($idArticulo) {
        $query = "SELECT ".
                    "fac_id,".
                    "fac_razon_social,".
                    "fac_correo,".
                    "fac_rfc,".
                    "fac_calle,".
                    "fac_numero,".
                    "fac_colonia,".
                    "fac_municipio,".
                    "fac_estado,".
                    "fac_cp ".
                "FROM ".
                    "tbl_datos_facturacion ".
                "WHERE ".
                    "art_id=$idArticulo";
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
    
    public function get_datos_deposito($idArticulo) {
        $query = "SELECT ".
                    "dep_id,".
                    "dep_banco,".
                    "dep_sucursal,".
                    "dep_transaccion,".
                    "dep_tipo,".
                    "dep_info,".
                    "dep_fecha,".
                    "dep_hora,".
                    "dep_monto,".
                    "dep_comprobante ".
                "FROM ".
                    "tbl_depositos ".
                "WHERE ".
                "art_id=$idArticulo";
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
    
    public function get_comprobante($idArticulo) {
        $query = "SELECT ".
                    "dep_comprobante ".
                "FROM ".
                    "tbl_depositos ".
                "WHERE ".
                    "art_id=$idArticulo";
        $sth = $this->db->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $count = $sth->rowCount();
        $data = NULL;
        if ($count > 0) {
            $data = $sth->fetchAll();
            $data = $data[0];
            $data = $data['dep_comprobante'];
        } else {
            $data = FALSE;
        }
        return $data;
    }
    
    public function update_estatus_cambios($idArticulo, $estatus) {
        $query = "UPDATE ".
                    "tblArticulos ".
                "SET ".
                    "art_cambios_asistencia='$estatus' ".
                "WHERE ".
                    "artId=$idArticulo";
        $sth = $this->db->prepare($query);
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
    
    public function existeRegistroFacturacion($idRegistro){
        $query = "SELECT ".
                    "* ".
                "FROM ".
                    "tbl_datos_facturacion ".
                "WHERE ".
                    "art_id=$idRegistro";
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
}
