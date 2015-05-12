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
        Session::set('sess_pCH_ciudad',$this->getTexto('mL_cmbCiudadDestino_H'));
        
        
        for ($i = 1; $i <= 3; $i++) {
            
            Session::set('sess_BP_Adl_' . $i, $this->getTexto('mL_cmbAdultos_' . $i));
                   
        }
        
        for ($i = 1; $i <= 2; $i++) {
            
            Session::set('sess_BP_Chd_' . $i, $this->getTexto('mL_child_' . $i));
                  
        }

        for($i=1; $i <= 12; $i++){
            
            Session::set('sess_BP_edadChd_1_'.$i, $this->getTexto('mL_edadChild_1_' . $i));
        }
        
        for($i=1; $i<=12; $i++){
            
           Session::set('sess_BP_edadChd_2_'.$i , $this->getTexto('mL_edadChild_2_' . $i));
            
        }
        for($i=0; $i<=1; $i++){
            
            Session::set('sess_BP_Inf_'.$i,$this->getTexto('mL_inf_'.$i));
                    
        }     
        Session::set('sess_BP_noches', $this->getTexto('mL_cmbNoches_H'));
        Session::set('sess_pBP_cntHab',$this->getTexto('ML_cmbHab'));
        Session::set('sess_pBP_FechaIn',$this->getTexto('mL_txtFechaIn_H'));
        Session::set('sess_pBP_FechaOut',$this->getTexto('mL_txtFechaOut_H'));
        Session::set('sess_pBP_Cagegorias', $this->getTexto('mL_cmbCat_H'));
 

        $this->redireccionar('sistema/buscarHoteles');
    }
    
    public function bsServ(){
        Session::set('sess_sCH_ciudad', $this->getTexto('mL_txtCiudadDestino_S'));
        Session::set('sess_sBP_fechaIn',$this->getTexto('mL_txtFechaIn_S'));

       

        Session::set('sess_sBP_serv', $this->getTexto('mL_cmbServicios_S'));   
        Session::set('sess_sBP_adultos', $this->getTexto('mL_cmbAdultos_S'));
        Session::set('sess_sBP_childs', $this->getTexto('mL_cmbChild_S'));
        
        
        $this->redireccionar('sistema/buscarServicios');
    
    }
    
    public function bsProgramas(){
        
       Session::set('sess_prog_Ciudad', $this->getTexto('mL_txtCiudadDestino_P'));
       Session::set('sess_prog_FechaIn', $this->getTexto('mL_txtFechaIn_P'));
       
       
              
       Session::set('sess_prog_Hab', $this->getTexto('ML_cmbHab_P'));   
       
       
       for($i=1; $i<=4; $i++){          
       Session::set('sess_BP_Adl_P_'.$i, $this->getTexto('mL_cmbAdultos_P_'.$i));             
       }
       
       for($i=1; $i<=12; $i++){       
       Session::set('mL_edadChild_1_P_'.$i, $this->getTexto('sess_BP_edadChd_1_P_'.$i));              
       }
       
       for($i=1; $i<=2; $i++){          
       Session::set('sess_BP_Chd_P_'.$i,$this->getTexto('mL_child_P_'.$i));            
       }
      
       for($i=1; $i<=12; $i++){
       Session::set('mL_edadChild_2_P_'.$i, $this->getTexto('sess_BP_edadChd_2_P_'));              
       }
       
       for($i=0; $i<=1; $i++){
          
       Session::set('sess_BP_Inf_P_'.$i,$this->getTexto('mL_inf_P_'.$i));    
           
       }
          
       
       $this->redireccionar('sistema/buscarProgramas');
        
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