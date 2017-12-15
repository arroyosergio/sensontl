<?php

class registropublico_Model extends Model {

	function __construct() {
		parent::__construct();
		Session::init();
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
				"tblreg_asis_pub".
				"(".
				"reg_id,".
				"reg_nombre,".
				"reg_institucion,".
				"reg_tipo".
				") ".
				"VALUES ".
				"(".
				"$asistente[reg_id],".
				"'$asistente[nombre]',".
				"'$asistente[institucion]',".
				"'$asistente[tipoAsistente]'".
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
	
	public function nuevo_registro() {
 		$dt = new DateTime('now', new DateTimeZone('America/Mexico_City'));
		$query = "INSERT INTO ".
				"tblreg_publico".
				"(".
				"reg_fecha,".
				"reg_validar_dep,".
				"reg_fact_enviada".
				") ".
				"VALUES ".
				"('".$dt->format('Y-m-d').
				"','no','no'".
				")";
		$sth = $this->db->prepare($query);
		try {
			$sth->execute();
			Session::set('idRegistroPublico', $this->db->lastInsertId());
			$data = TRUE;
		} catch (PDOException $exc) {
			error_log($query);
			error_log($exc);
			$data = FALSE;
		}
		return $data;
	}
	 
	public function get_asistentes_publico() {
		$query = "SELECT ".
				"id,".
				"reg_nombre,".
				"reg_institucion,".
				"reg_tipo ".
				"FROM ".
				"tblreg_asis_pub ".
				"WHERE ".
				"reg_id=".Session::get('idRegistroPublico');
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
				"id,".
				"reg_nombre,".
				"reg_institucion,".
				"reg_tipo ".
				"FROM ".
				"tblreg_asis_pub ".
				"WHERE ".
				"id=$idAsistente";
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
				"tblreg_asis_pub ".
				"WHERE ".
				"id=$idAsistente";
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
				"tblreg_asis_pub ".
				"SET ".
				"reg_nombre='$asistente[nombre]',".
				"reg_institucion='$asistente[institucion]',".
				"reg_tipo='$asistente[tipo]' ".
				"WHERE ".
				"id=$asistente[id]";
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
				"tblreg_pub_depositos".
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
				"reg_id".
				") ".
				"VALUES ".
				"(".
				"'$deposito[banco]',".
				"'$deposito[sucursal]',".
				"'$deposito[transaccion]',".
				"'$deposito[info]',".
				"'$deposito[tipoPago]',".
				"'$deposito[fecha]',".
				"'$deposito[hora]',".
				"$deposito[monto],".
				"'$deposito[comprobante]',".
				"$deposito[reg_id]".
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
				"tblreg_datos_factura".
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
				"reg_id".
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
				"$facturacion[reg_id]".
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
	 
	public function get_total_asistentes($idRegistroPublico,$tipoAsistente) {
		$query = "SELECT ".
				"COUNT(reg_id) AS total ".
				"FROM ".
				"tblreg_asis_pub ".
				"WHERE ".
				"reg_id=$idRegistroPublico ".
				"AND ".
				"reg_tipo='$tipoAsistente'";
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

	public function get_total_asistentes_pub($idRegistroPublico) {
		$query = "SELECT ".
				"COUNT(reg_id) AS total ".
				"FROM ".
				"tblreg_asis_pub ".
				"WHERE ".
				"reg_id=$idRegistroPublico ";
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
	
	public function get_buscar_asistente($nombre_asistente) {
		$query ="SELECT ".
				"CONCAT(TRIM( autNombre ) ,TRIM( autApellidoPaterno ) , TRIM( autApellidoMaterno )) AS autnombre ".
				"FROM ".
				"tblautores ".
				"WHERE ".
				"UPPER(CONCAT(TRIM(autNombre),TRIM(autApellidoPaterno),TRIM(autApellidoMaterno))) IN (:nombre)";
		$sth = $this->db->prepare($query);
		$nombre_asistente=strtoupper($nombre_asistente);
		$sth->bindParam(':nombre', $nombre_asistente);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$count = $sth->rowCount();
		$data = NULL;
		if ($count > 0) {
			$data = true;
		} else {
			$data = false;
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
	}
	