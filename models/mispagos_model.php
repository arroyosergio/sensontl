<?php

/*
 * Persiste y recupera los datos de los pagos del auor
 */
class mispagos_Model extends Model {

    /*
     * Crea instancia 
     */
    function __construct() {
        parent::__construct();
    }//Fin __construct
     
    /*
     * Recuperar el id del autor, dado el id del usuario.
     */
    public function get_id_autor($idUsuario) {
        //Armado de la sentecia sql a ejecutar
        $query = "SELECT ".
                    "autId ".
                "FROM ".
                    "tblAutores ".
                "WHERE ".
                    "usuId=$idUsuario";
        
        //Preparacion y ejecucion de la setencia.
        $sth = $this->db->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $count = $sth->rowCount();
        $data = NULL;
        
        //Identificacion de resultados y respuesta
        if ($count > 0) {
            $data = $sth->fetchAll();
            $data = $data[0];
            $data = $data['autId'];
        } else {
            $data = FALSE;
        }
        return $data;
    }//get_id_autor

    /*
     * Recupera los articulos dictaminados de un autor, dado su id.
     */
    public function get_art_dictaminados($idAutor) {
        //Armado de la sentecia sql a ejecutar
        $query = "SELECT ".
                    "b.artId,".
                    "artNombre,".
                    "artAreaTematica,".
                    "artTipo ".
     			"FROM ".
                    "tblAutoresArticulos AS a ".
                "INNER JOIN ".
                    "tblArticulos AS b ".
                    "ON a.artId=b.artId ".
                "WHERE ".
                    "a.autId=$idAutor AND artDictaminado='si'" ;
        
        //Preparacion y ejecucion de la setencia.
        $sth = $this->db->prepare($query);
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $count = $sth->rowCount();
        $data = NULL;
        //Identificacion de resultados y respuesta
        if ($count > 0) {
            $data = $sth->fetchAll();
        } else {
            $data = FALSE;
        }
        return $data;
    }//Fin
}//Fin class mispagos_Model