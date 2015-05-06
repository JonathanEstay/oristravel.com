<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class processController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $this->redireccionar('sistema');
    }
    
    public function consBooking()
    {
        Session::acceso('Usuario');
        Session::set('sess_pCR_fechaDesde', $this->getTexto('txtFechaDesde-ConsRes'));
        Session::set('sess_pCR_fechaHasta', $this->getTexto('txtFechaHasta-ConsRes'));
        Session::set('sess_pCR_tipoFecha', $this->getTexto('rdbFecha'));

        $this->redireccionar('sistema/consultarBooking');
    }
    
    public function bsHot()
    {
        Session::acceso('Usuario');
        //Session::set('sess_pCR_fechaDesde', $this->getTexto('txtFechaDesde-ConsRes'));
        //Session::set('sess_pCR_fechaHasta', $this->getTexto('txtFechaHasta-ConsRes'));
        //Session::set('sess_pCR_tipoFecha', $this->getTexto('rdbFecha'));
        
        for($i=1; $i<=3; $i++){ 
            Session::set('sess_BP_Adl_'.$i,$this->getTexto('mL_cmbAdultos_'.$i));          
        }
       // for($i=1; $i<=2; $i++){
        
        // Session::set('sess_BP_Chd_'.$i,$this->getTexto('mL_child_'.$i));
            
        //}
        
        Session::set('sess_pBP_cntHab',$this->getTexto('ML_cmbHab'));  
 

        $this->redireccionar('sistema/buscarHoteles');
    }
    
    public function admHoteles()
    {
        Session::acceso('Usuario');

        Session::set('sess_pCH_ciudad', $this->getTexto('cmbCiudadDestino_H'));
        Session::set('sess_pCH_nombre', $this->getTexto('txtNombre_H'));
        Session::set('sess_pCH_cat', $this->getTexto('cmbCategoria_H'));
        
        $this->redireccionar('sistema/hoteles');
    }
    
    public function admProgramas()
    {
        Session::acceso('Usuario');
        //Session::set('sess_combo_pais',$this->getTexto('elegido'));
        Session::set('sess_pC_aP_ciudad',$this->getTexto('aP_txtCiudadDestino_P'));
        Session::set('sess_pC_aP_Pais',$this->getTexto('aP_txtPaisDestino_P'));
        
        
        $this->redireccionar('sistema/adminProgramas');
        
    }
    
    public function admUsuarios(){
        Session::acceso('Usuarios');
        
        //Session::set('sess_US_NomAge', $this->getTexto('US_cmbAgencia'));
        
        //$this->redireccionar('sistema/insertUsuarios');
        
        
    }
}