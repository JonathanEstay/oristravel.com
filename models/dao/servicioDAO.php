<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class servicioDAO extends Model
{
    public function __construct() {
        parent::__construct();
    }
    
    public function getCiudadesServ() {
        $sql = 'SELECT pais.nombre AS nombre_pais, pais.codigo AS codigo_pais, ciudad.nombre AS nombre_ciudad, ciudad.codigo AS codigo_ciudad '
                . 'FROM pais '
                . 'JOIN ciudad ON (pais.codigo = ciudad.codigop) '
                //. 'WHERE'
                //. 'ciudad.nombre LIKE "%'.$nombre_h.'%" OR pais.nombre LIKE "%'.$nombre_h.'%" OR ciudad.codigo LIKE "%'.$nombre_h.'%" '
                . 'ORDER BY ciudad.nombre ASC';

        $ciudadesServ = $this->_db->consulta($sql);
        if ($this->_db->numRows($ciudadesServ) > 0) {
            
            $servArray = $this->_db->fetchAll($ciudadesServ);
            $objetosServ = array();
            
            foreach ($servArray as $servdb) {
                $servObj = new servicioDTO();
                
                $servObj->setCodPais(trim($servdb['codigo_pais']));
                $servObj->setPais(trim($servdb['nombre_pais']));
                $servObj->setCodCiudad(trim($servdb['codigo_ciudad']));
                $servObj->setCiudad(trim($servdb['nombre_ciudad']));
                
                $objetosServ[] = $servObj;
            }
            
            return $objetosServ;
            //return $this->_db->fetchAll($ciudadesServ);
            
        } else {
            return false;
        }
    }
    
    public function getServicios(){
        $sql = 'SELECT numero, nombre FROM tablaser';
        
        $serv= $this->_db->consulta($sql);
        if($this->_db->numRows($serv)> 0){
            
            $servArray = $this->_db->fetchAll($serv);
            $objetosServ = array();
            
            foreach($servArray as $objServAr){
                $servObj = new servicioDTO();
                
                $servObj->setNumero(trim($objServAr['numero']));
                $servObj->setNombre(trim($objServAr['nombre']));
                
               $objetosServ[] = $servObj;
                
            }
            
            return $objetosServ;
            
        }
        else{
            return false;
        }
           
    }
}