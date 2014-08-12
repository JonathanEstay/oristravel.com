<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class hotelModel extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getCatHoteles()
    {
        $sql='SELECT codigo, nombre FROM cath ORDER BY nombre ASC';
        //echo $sql;

        $datos= $this->_db->consulta($sql);
        if($this->_db->numRows($datos)>0)
        {
            return $this->_db->fetchAll($datos);
        }
        else
        {
            return false;
        }
    }
    
    public function getAdmHoteles($ciudad, $hotel, $cat)
    {
        $sql='SELECT * FROM hotel WHERE 1=1 ';
        
        if(!empty($ciudad))
        {
            $sql.=' AND ciudad="'.$ciudad.'" '; 
        }
        if(!empty($hotel))
        {
            $sql.=' AND hotel LIKE "%'.$hotel.'%" ';
        }
        if(!empty($cat))
        {
             $sql.=' AND cat="'.$cat.'" ';
             //$sql.=' AND pais="CHILE" ';
        }
        
        //echo $sql; exit;
        
        $datos= $this->_db->consulta($sql);
        if($this->_db->numRows($datos)>0)
        {
            return $this->_db->fetchAll($datos);
        }
        else
        {
            return false;
        }
    }
    
    /*public function getCiudadesHot()
    {
        $sql= 'SELECT pais.nombre AS nombre_pais, pais.codigo AS codigo_pais, ciudad.nombre AS nombre_ciudad, ciudad.codigo AS codigo_ciudad '
            . 'FROM pais '
            . 'JOIN ciudad ON (pais.codigo = ciudad.codigop) '
            //. 'WHERE'
            //. 'ciudad.nombre LIKE "%'.$nombre_h.'%" OR pais.nombre LIKE "%'.$nombre_h.'%" OR ciudad.codigo LIKE "%'.$nombre_h.'%" '
            . 'ORDER BY ciudad.nombre ASC';
        
        $ciudadesHot= $this->_db->consulta($sql);
        if($this->_db->numRows($ciudadesHot)>0)
        {
            return $this->_db->fetchAll($ciudadesHot);
        }
        else
        {
            return false;
        }
    }*/
}