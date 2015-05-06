<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class carroDAO extends Model{

public function getAddCarro($user){

$sql = "SELECT  tipo_ser,
                status,
		tipoh, 
                pa, 
		fecha_in, 
		fecha_out, 
		tot_hab, 
		pais,
		ciudad,
                (tot_pax_1+tot_pax_2+tot_pax_3) as tot_pax_ad, 
	        (tot_child_1+tot_child_2+tot_child_3) as tot_child,
	        total_venta,
		vuelo

        FROM    ol_venta 

        WHERE   usuario = '".$user."';";
//echo $sql;
$datos= $this->_db->consulta($sql);

    if($this->_db->numRows($datos)){
        $arrayCarro = $this->_db->fetchAll($datos);
        $objetosCarro = array();
        
        foreach($arrayCarro as $objCar){
            
            $objCarro = new carroDTO();
            $objCarro->setStatus($objCar['status']);
            $objCarro->setServicio($objCar['tipo_ser']);
            $objCarro->setHabitacion($objCar['tipoh']);
            $objCarro->setPa($objCar['pa']);
            $objCarro->setFecha_in($objCar['fecha_in']);
            $objCarro->setFecha_out($objCar['fecha_out']);
            $objCarro->setNhab($objCar['tot_hab']);
            $objCarro->setPais($objCar['pais']);
            $objCarro->setCiudad($objCar['ciudad']);
            $objCarro->setA($objCar['tot_pax_ad']);
            $objCarro->setC($objCar['tot_child']);
            $objCarro->setTotal($objCar['total_venta']);
            $objCarro->setVuelo($objCar['vuelo']);
            
            $objetosCarro[] = $objCarro;
            
        }
    return $objetosCarro;

    }
    else{
        
        return false;
        
    }

}    
}

