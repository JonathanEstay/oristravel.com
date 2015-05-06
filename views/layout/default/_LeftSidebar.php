
<script type='text/javascript' src='<?php echo $_layoutParams['ruta_js']; ?>funciones.js'></script>

<link href="<?php echo $_layoutParams['ruta_css']; ?>custom-theme/jquery-ui-1.10.4.custom.css" rel="stylesheet">
<script src="<?php echo $_layoutParams['ruta_js']; ?>jquery-1.10.2.min.js"></script>
<script>
$(function()
{
    $( "#mL_txtFechaIn_H" ).datepicker({
            minDate: +1,
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
            'Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
            dateFormat: 'dd/mm/yy',
            firstDay: 1
    });
});
$(function()
{
    $( "#mL_txtFechaOut_H" ).datepicker({
            minDate: +1,
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
            'Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
            dateFormat: 'dd/mm/yy',
            firstDay: 1
    });
});



$(function()
{
    $( "#mL_txtFechaIn_S" ).datepicker({
            minDate: +1,
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
            'Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
            dateFormat: 'dd/mm/yy',
            firstDay: 1
    });
});



$(function()
{
    $( "#mL_txtFechaIn_P" ).datepicker({
            minDate: +1,
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
            'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
            'Jul','Ago','Sep','Oct','Nov','Dic'],
            dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
            dateFormat: 'dd/mm/yy',
            firstDay: 1
    });
});

</script>

<style>
	.colorText:hover{color: #0088CC; font-size: 13px;}
</style>

<nav id="page-leftbar" role="navigation" style="position:fixed;">

    <!-- BEGIN SIDEBAR MENU -->
    <ul class="acc-menu" id="sidebar">
        
        <li <?php if($this->currentMenu==8){ ?>class="active"<?php } ?>>
            <a href="javascript:;"><i><img src="<?php echo $_layoutParams['ruta_img']; ?>hotel.png" /></i> <span>Hoteles</span> <span style="float: right;"><img src="<?php echo $_layoutParams['ruta_img']; ?>down.png" width="12px" /></span></a>
            <ul class="acc-menu">
                <li>
                    <form id="frmBuscarHoteles" method="post" action="<?php echo BASE_URL ?>process/bsHot">
                        
                        <select name="mL_cmbCiudadDestino_H" id="mL_cmbCiudadDestino_H" class="form-control" >
                            <option value="0">Seleccione destino</option>
                            <?php 
                            if($this->objCiudadesHotel)
                            { 
                                foreach($this->objCiudadesHotel as $objCiuHot)
                                {
                                        $mL_codigoCiuHot= $objCiuHot->getCodCiudad();
                                        $mL_nombreCiuHot= $objCiuHot->getCiudad();
                                        $mL_nombreCiudadHot = $mL_nombreCiuHot." (".$mL_codigoCiuHot.")";

                                        if(Session::get('sess_pCH_ciudad')==$mL_nombreCiuHot)
                                        {
                                        ?>
                                            <option value="<?php echo $mL_nombreCiuHot; ?>" selected="selected"><?php echo $mL_nombreCiudadHot; ?></option>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <option value="<?php echo $mL_nombreCiuHot; ?>"><?php echo $mL_nombreCiudadHot; ?></option>
                                        <?php
                                        }
                                }
                            }
                            ?>
                        </select>
                        
                     	<table width="100%" style="display:<?php echo $this->mL_expandeFiltros; ?>; margin-top:5px;">
                            <tr>
                            	<td width="30%"><span style="padding-left:10px;">Fecha In:</span></td>
                                <td>
                                	<!-- style="background:#d2d3d6;" -->
                                        <input type="text" class="form-control" id="mL_txtFechaIn_H" name="mL_txtFechaIn_H" value="<?php if(isset($mL_ini)){ echo $mL_ini; } ?>">
                                </td>
                            </tr>
                            <tr>
                            	<td width="30%"><span style="padding-left:10px;">Noches:</span></td>
                                <td>
                                	<!-- style="background:#d2d3d6;" -->
                                        <select name="mL_cmbNoches_H" class="form-control">
                                            <option value="0">Seleccione</option>
										<?php 
										for($i=1; $i<=10; $i++)
										{
											if(Session::get('sess_pBP_cntHab')==$i)
											{
										?>
                                        	<option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                                        <?php }else{ ?>
                                        	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } 
										} ?>
                                        </select>
                                </td>
                            </tr>
                            <tr>
                            	<td><span style="padding-left:10px;">Fecha Out:</span></td>
                                <td>
                                        <input type="text" class="form-control" id="mL_txtFechaOut_H" name="mL_txtFechaOut_H" value="<?php if(isset($mL_out)){ echo $mL_out; } ?>">
                                </td>
                            </tr>
                            
                            <tr>
                            	<td width="30%"><span style="padding-left:10px;">Categoria:</span></td>
                                <td>
                                	<!-- style="background:#d2d3d6;" -->
                                        <select name="mL_cmbCat_H" class="form-control">
                                            <option value="0">Seleccione</option>
										<?php 
										for($i=1; $i<=10; $i++)
										{
											if(Session::get('sess_pBP_cntHab')==$i)
											{
										?>
                                            <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                                    <?php }else{ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } 
                                                                            } ?>
                                    </select>
                                </td>
                            </tr>

                            
                            
                            <tr>
                            	<td><span style="padding-left:10px;">Habitaci&oacute;n:</span></td>
                                <td>
                                    <select name="ML_cmbHab" id="ML_cmbHab" class="form-control" onchange="habitaciones('ML_tblHab_H', this.value)">
                                    	<option value="0">Seleccione</option>
                                        <?php 
                                        for($i=1; $i<=3; $i++)
                                        {
                                                if(Session::get('sess_pBP_cntHab')==$i)
                                                {
										?>
                                        	<option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                                        <?php }else{ ?>
                                        	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } 
                                        } ?>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                            	<td colspan="2">
                                    
                                    <?php for($i=1; $i<=3; $i++)
                                    {
                                        $display='display:none;';
                                        if(Session::get('sess_BP_cntHab')>=$i){ $display= 'display:block;'; }?>
                                    <div id="ML_tblHab_H_<?php echo $i; ?>" style="<?php echo $display; ?>">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                            <tr>
                                                <td>Adultos</td>
                                                <td>
                                                    <select name="mL_cmbAdultos_<?php echo $i; ?>" id="mL_cmbAdultos_<?php echo $i; ?>">
                                                      <?php
                                                          for($x=1; $x<=4; $x++)
                                                          { 
                                                              if(Session::get('sess_BP_Adl_' . $i) == $x)
                                                              { ?>
                                                              <option selected="selected" value="<?php echo Session::get('sess_BP_Adl_' . $i); ?>"><?php echo Session::get('sess_BP_Adl_' . $i); ?></option>
                                                              <?php 
                                                            }
                                                            else
                                                            { ?>                          
                                                            <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                      <?php }
                                                          } ?>
                                                    </select>                          
                                                </td>
                                                <td>Edad C1</td>
                                                <td>
                                                    <select id="mL_edadChild_1_<?php echo $i; ?>" name="mL_edadChild_1_<?php echo $i; ?>" <?php if(Session::get('sess_BP_Chd_' . $i)>=1){}else{ echo "disabled='disabled'"; }?> >
                                                    <?php
                                                    for($x=2;$x<=12;$x++)
                                                    {
                                                        if(Session::get('sess_BP_edadChd_1_' . $i) == $x)
                                                        {?>
                                                    <option selected="selected" value="<?php echo Session::get('sess_BP_edadChd_1_' . $i); ?>"><?php echo Session::get('sess_BP_edadChd_1_' . $i); ?></option>
                                                    <?php
                                                        }
                                                        else
                                                        {?>                          
                                                    <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                    <?php }  
                                                    } ?>
                                                    </select>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>Child</td>
                                                <td>
                                                    <select name="mL_child_<?php echo $i; ?>" id="mL_child_<?php echo $i; ?>" onchange="habilitaEdadChild(this.value, <?php echo $i; ?>);">
                                                    <?php 
                                                        for($x=0; $x<=2; $x++)
                                                        {
                                                            if(Session::get('sess_BP_Chd_' . $i) == $x)
                                                            {?>
                                                        <option selected="selected" value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                        <?php }else{ ?>                          
                                                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                        <?php }
                                                        }?>
                                                    </select>
                                                </td>                    	  

                                                <td>Edad C2</td>
                                                <td>
                                                    <select id="mL_edadChild_2_<?php echo $i; ?>" name="mL_edadChild_2_<?php echo $i; ?>" <?php if(Session::get('sess_BP_Chd_' . $i)==2){}else{ echo "disabled='disabled'"; }?> >
                                                        <?php
                                                        for($x=2; $x<=12; $x++)
                                                        {
                                                            if(Session::get('sess_BP_edadChd_2_' . $i) == $x)
                                                            { ?>
                                                        <option selected="selected" value="<?php echo Session::get('sess_BP_edadChd_2_' . $i); ?>"><?php echo Session::get('sess_BP_edadChd_2_' . $i); ?></option>
                                                        <?php }else{ ?>                          
                                                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>Infant</td>
                                                <td colspan="3">
                                                    <select name="mL_inf_<?php echo $i; ?>" id="mL_inf_<?php echo $i; ?>">
                                                      <?php
                                                        for($x=0; $x<=1; $x++)
                                                        {
                                                            if(Session::get('sess_BP_Inf_' . $i) == $x)
                                                            {?>
                                                        <option selected="selected" value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                        <?php }else{ ?>                          
                                                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </td>                    	  
                                            </tr>

                                        </table>
                                        <li class="divider"></li>
                                    </div>      
                                    <?php } ?>
                                    
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <td colspan="2" align="right">
                                	<input type="button"  id="btnBuscarHoteles" class="btn btn-primary" style="margin-right:5px" value="Buscar">
                                </td>
                            </tr>
                        </table>

            </form>
                </li>
            </ul>
        </li>
        
        
        
        
        <li >  <!-- class="open active" -->
            <a href="javascript:;"><i><img src="<?php echo $_layoutParams['ruta_img']; ?>servicio.png" /></i> <span>Servicios</span> <span style="float: right;"><img src="<?php echo $_layoutParams['ruta_img']; ?>down.png" width="12px" /></span></a>
            <ul class="acc-menu"  > <!--style="display: block;" -->
                <li>
                    <form id="frmBuscarServicios" method="post" action="process/procesoBuscaProgramas.php">
                        
                        <select name="mL_txtCiudadDestino_S" id="mL_txtCiudadDestino_S" class="form-control" >
                            <option value="0">Seleccione destino</option>
                            <?php 
                            if($this->objCiudadesServ)
                            { 
                                foreach($this->objCiudadesServ as $objCiuServ)
                                {
                                        $mL_codigoCiu_Serv= $objCiuServ->getCodCiudad();
                                        $mL_nombreCiu_Serv= $objCiuServ->getCiudad();
                                        $mL_nombreCiudad_Serv = $mL_nombreCiu_Serv." (".$mL_codigoCiu_Serv.")";

                                        if(Session::get('sess_pCS_ciudad')==$mL_nombreCiu_Serv)
                                        {
                                        ?>
                                            <option value="<?php echo $mL_nombreCiu_Serv; ?>" selected="selected"><?php echo $mL_nombreCiudad_Serv; ?></option>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <option value="<?php echo $mL_nombreCiu_Serv; ?>"><?php echo $mL_nombreCiudad_Serv; ?></option>
                                        <?php
                                        }
                                }
                            }
                            ?>
                        </select>
                        
                     	<table width="100%" style="display:<?php echo $this->mL_expandeFiltros; ?>; margin-top:5px;">
                            <tr>
                            	<td width="30%"><span style="padding-left:10px;">Fecha In:</span></td>
                                <td>
                                	<!-- style="background:#d2d3d6;" -->
                                        <input type="text" class="form-control" id="mL_txtFechaIn_S" name="mL_txtFechaIn_S" value="<?php if(isset($mL_ini)){ echo $mL_ini; } ?>">
                                </td>
                            </tr>
                            
                           <tr>
                            	<td width="30%"><span style="padding-left:10px;">Servicios:</span></td>
                                <td>
                                	<!-- style="background:#d2d3d6;" -->
                                        <select name="mL_cmbServicios_S" class="form-control">
                                            <option value="0">Seleccione</option>
										<?php 
										for($i=1; $i<=10; $i++)
										{
											if(Session::get('sess_pBP_cntHab')==$i)
											{
										?>
                                            <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                                    <?php }else{ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } 
                                                                            } ?>
                                    </select>
                                </td>
                            </tr>
                            
                            
                            <tr>
                            	<td width="30%"><span style="padding-left:10px;">Adutlos:</span></td>
                                <td>
                                	<!-- style="background:#d2d3d6;" -->
                                        <select name="mL_cmbAdultos_S" class="form-control">
                                            <option value="0">Seleccione</option>
										<?php 
										for($i=1; $i<=10; $i++)
										{
											if(Session::get('sess_pBP_cntHab')==$i)
											{
										?>
                                            <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                                    <?php }else{ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } 
                                                                            } ?>
                                    </select>
                                </td>
                            </tr>
                            
                            
                            <tr>
                            	<td width="30%"><span style="padding-left:10px;">Child:</span></td>
                                <td>
                                	<!-- style="background:#d2d3d6;" -->
                                        <select name="mL_cmbChild_S" class="form-control">
                                            <option value="0">Seleccione</option>
										<?php 
										for($i=1; $i<=10; $i++)
										{
											if(Session::get('sess_pBP_cntHab')==$i)
											{
										?>
                                            <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                                    <?php }else{ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } 
                                                                            } ?>
                                    </select>
                                </td>
                            </tr>
                            
                            
                            
                            <tr>
                                <td colspan="2" align="right">
                                	<input type="button"  id="btnBuscarServicios" class="btn btn-primary" style="margin-right:5px" value="Buscar">
                                </td>
                            </tr>
                        </table>

            </form>
                </li>
            </ul>
        </li>
        
        
        
        <li>
            <a href="javascript:;"><i><img src="<?php echo $_layoutParams['ruta_img']; ?>programa.png" /></i> <span>Programas</span> <span  style="float: right;"><img src="<?php echo $_layoutParams['ruta_img']; ?>down.png" width="12px" /></span></a>
            <ul class="acc-menu">
                <li>
                    <form id="frmBuscarProgramas" method="post" action="process/procesoBuscaProgramas.php">
                     	
                        <select name="mL_txtCiudadDestino_P" id="mL_txtCiudadDestino_P" class="form-control" >
                            <option value="0">Seleccione destino</option>
                            <?php 
                            if($this->objCiudadesPRG)
                            { 
                                foreach($this->objCiudadesPRG as $objCiuPRG)
                                {
                                        $mL_codigoCiuPRG= $objCiuPRG->getCodCiudad();
                                        $mL_nombreCiuPRG= $objCiuPRG->getCiudad();
                                        $mL_nombreCiudadPRG = $mL_nombreCiuPRG." (".$mL_codigoCiuPRG.")";

                                        if(Session::get('sess_pCP_ciudad')==$mL_nombreCiuPRG)
                                        {
                                        ?>
                                            <option value="<?php echo $mL_nombreCiuPRG; ?>" selected="selected"><?php echo $mL_nombreCiudadPRG; ?></option>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                            <option value="<?php echo $mL_nombreCiuPRG; ?>"><?php echo $mL_nombreCiudadPRG; ?></option>
                                        <?php
                                        }
                                }
                            }
                            ?>
                        </select>
                        
                     	<table width="100%" id="tblFormBusqueda" style="display:<?php echo $this->mL_expandeFiltros; ?>; margin-top:5px;">
                            <tr>
                            	<td width="30%"><span style="padding-left:10px;">Fecha In:</span></td>
                                <td>
                                	<!-- style="background:#d2d3d6;" -->
                                        <input type="text" class="form-control" id="mL_txtFechaIn_P" name="mL_txtFechaIn_P" value="<?php if(isset($mL_ini)){ echo $mL_ini; } ?>">
                                </td>
                            </tr>
                            
                            
                            <tr>
                            	<td><span style="padding-left:10px;">Habitaci&oacute;n:</span></td>
                                <td>
                                	<select name="ML_cmbHab_P" id="ML_cmbHab" class="form-control" onchange="habitaciones('ML_tblHab_P', this.value)">
                                    	<option value="0">Seleccione</option>
										<?php 
										for($i=1; $i<=3; $i++)
										{
											if(Session::get('sess_pBP_cntHab')==$i)
											{
										?>
                                            <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                                        <?php }else{ ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php } 
										} ?>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                            	<td colspan="2">
                                	
                                    
                                    <?php for($i=1; $i<=3; $i++)
                                    {
                                        $display='display:none;';
                                        if(Session::get('sess_BP_cntHab')>=$i){ $display= 'display:block;'; }?>
                                    <div id="ML_tblHab_P_<?php echo $i; ?>" style="<?php echo $display; ?>">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                            <tr>
                                                <td>Adultos</td>
                                                <td>
                                                    <select name="mL_cmbAdultos_<?php echo $i; ?>" id="mL_cmbAdultos_<?php echo $i; ?>">
                                                      <?php
                                                          for($x=1; $x<=6; $x++)
                                                          { 
                                                              if(Session::get('sess_BP_Adl_' . $i) == $x)
                                                              { ?>
                                                              <option selected="selected" value="<?php echo Session::get('sess_BP_Adl_' . $i); ?>"><?php echo Session::get('sess_BP_Adl_' . $i); ?></option>
                                                              <?php 
                                                            }
                                                            else
                                                            { ?>                          
                                                            <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                      <?php }
                                                          } ?>
                                                    </select>                          
                                                </td>
                                                <td>Edad C1</td>
                                                <td>
                                                    <select id="mL_edadChild_1_<?php echo $i; ?>" name="mL_edadChild_1_<?php echo $i; ?>" <?php if(Session::get('sess_BP_Chd_' . $i)>=1){}else{ echo "disabled='disabled'"; }?> >
                                                    <?php
                                                    for($x=2;$x<=12;$x++)
                                                    {
                                                        if(Session::get('sess_BP_edadChd_1_' . $i) == $x)
                                                        {?>
                                                    <option selected="selected" value="<?php echo Session::get('sess_BP_edadChd_1_' . $i); ?>"><?php echo Session::get('sess_BP_edadChd_1_' . $i); ?></option>
                                                    <?php
                                                        }
                                                        else
                                                        {?>                          
                                                    <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                    <?php }  
                                                    } ?>
                                                    </select>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>Child</td>
                                                <td>
                                                    <select name="mL_child_<?php echo $i; ?>" id="mL_child_<?php echo $i; ?>" onchange="habilitaEdadChild(this.value, <?php echo $i; ?>);">
                                                    <?php 
                                                        for($x=0; $x<=2; $x++)
                                                        {
                                                            if(Session::get('sess_BP_Chd_' . $i) == $x)
                                                            {?>
                                                        <option selected="selected" value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                        <?php }else{ ?>                          
                                                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                        <?php }
                                                        }?>
                                                    </select>
                                                </td>                    	  

                                                <td>Edad C2</td>
                                                <td>
                                                    <select id="mL_edadChild_2_<?php echo $i; ?>" name="mL_edadChild_2_<?php echo $i; ?>" <?php if(Session::get('sess_BP_Chd_' . $i)==2){}else{ echo "disabled='disabled'"; }?> >
                                                        <?php
                                                        for($x=2; $x<=12; $x++)
                                                        {
                                                            if(Session::get('sess_BP_edadChd_2_' . $i) == $x)
                                                            { ?>
                                                        <option selected="selected" value="<?php echo Session::get('sess_BP_edadChd_2_' . $i); ?>"><?php echo Session::get('sess_BP_edadChd_2_' . $i); ?></option>
                                                        <?php }else{ ?>                          
                                                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>Infant</td>
                                                <td colspan="3">
                                                    <select name="mL_inf_<?php echo $i; ?>" id="mL_inf_<?php echo $i; ?>">
                                                      <?php
                                                        for($x=0; $x<=1; $x++)
                                                        {
                                                            if(Session::get('sess_BP_Inf_' . $i) == $x)
                                                            {?>
                                                        <option selected="selected" value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                        <?php }else{ ?>                          
                                                        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                </td>                    	  
                                            </tr>

                                        </table>
                                        <li class="divider"></li>
                                    </div>      
                                    <?php } ?>
                                    
                                    
                                </td>
                            </tr>
                            
                            
                            <tr>
                                <td colspan="2" align="right">
                                	<input type="button"  id="btnBuscarProgramas" class="btn btn-primary" style="margin-right:5px" value="Buscar">
                                </td>
                            </tr>
                        </table>

            </form>
                </li>
            </ul>
        </li>
        
        
        <li class="divider"></li>
        
        
        <?php if(Session::accesoView('Admin')){ ?>
        <li <?php if($this->currentMenu==1){ ?>class="active"<?php } ?>>
            <a id="menuConsBook" href="javascript:;">
                <i><img src="<?php echo $_layoutParams['ruta_img']; ?>right.png" width="12px" /></i>
                <span>Booking</span>
            </a>
        </li>
        <?php } ?>
        
        
        
        

        <?php if(Session::accesoView('Admin')){ ?>
        <li <?php if($this->currentMenu==2 || $this->currentMenu==3 || $this->currentMenu==4 || $this->currentMenu==5){ ?>class="open active hasChild"<?php } ?>>
            <a href="javascript:;">
                <i>&nbsp;</i>
                <span>Administraci&oacute;n</span> <span  style="float: right;"><img src="<?php echo $_layoutParams['ruta_img']; ?>down.png" width="12px" /></span>
            </a>
            <ul class="acc-menu" <?php if($this->currentMenu==2 || $this->currentMenu==3 || $this->currentMenu==4 || $this->currentMenu==5){ ?>style="display: block;"<?php } ?>>
                <li <?php if($this->currentMenu==2){ ?>class="active"<?php } ?>><a id="menuHoteles" href="javascript:;"><span>Hoteles</span></a></li>
                <li <?php if($this->currentMenu==3){ ?>class="active"<?php } ?>><a id="menuAdminProg" href="javascript:;"><span>Programas</span></a></li>
                <li <?php if($this->currentMenu==4){ ?>class="active"<?php } ?>><a id="menuUsuarios" href="javascript:;"><span>Usuarios</span></a></li>
                <li <?php if($this->currentMenu==5){ ?>class="active"<?php } ?>><a id="menuImagenes" href="javascript:;"><span>Imagenes</span></a></li>
            </ul>
        </li>
        <?php } ?>
        
        
        <?php if(Session::accesoView('Admin')){ ?>
        <li <?php if($this->currentMenu==7){ ?>class="active"<?php } ?>>
            <a id="menuContacto" href="javascript:;">
                <i><img src="<?php echo $_layoutParams['ruta_img']; ?>right.png" width="12px" /></i>
                <span>Cont&aacute;ctenos</span>
            </a>
        </li>
        <?php } ?>
        
    </ul>
    <!-- END SIDEBAR MENU -->

</nav>
        
<script>
/*BEGIN: Busqueda de Hoteles */
$('#btnBuscarHoteles').on('click',function()
{
    var mL_Error=0;
    $("#btnBuscarHoteles").attr('disabled', 'disabled');
    document.getElementById('frmBuscarHoteles').submit();
    return false;
    
    if($('#mL_cmbCiudadDestino_H').val() != 0)
    {
        if($('#ML_cmbHab').val() != 0)
        {
            $(document).skylo('start');

            setTimeout(function(){
                $(document).skylo('set',50);
            },1000);

            setTimeout(function(){
                $(document).skylo('end');
            },1500);
            setTimeout(function(){
               document.getElementById('frmBuscarHoteles').submit();
            },2500);
        }
        else
        {
            mL_Error=1;
            $('#mensajeWar').html('Debe seleccionar la cantidad de habitaciones');
        }
    }
    else
    {
            mL_Error=1;
            $('#mensajeWar').html('Debe ingresar una ciudad de destino');	
    }




    if( mL_Error==1 )
    {
        $('#divAlertWar').delay( 10 ).fadeIn( 500 );
        $('#divAlertWar').animate({
                'display': 'block'
        });

        $('#divAlertWar').delay( 2000 ).fadeOut( 500 );
        $('#divAlertWar').animate({
                                    'display': 'none'
                                });

        $("#btnBuscarHoteles").delay(2000).queue(function(dis)
        {
            $("#btnBuscarHoteles").removeAttr("disabled");
            dis();
        });	
    }

});
/*END: Busqueda de Hoteles*/
    
    
    
    
    
    
    
    $('#menuConsBook').on('click',function(){
        $(document).skylo('start');

        setTimeout(function(){
            $(document).skylo('set',50);
        },1000);

        setTimeout(function(){
            $(document).skylo('end');
        },1500);
		setTimeout(function(){
            window.location.href = '<?php echo BASE_URL; ?>sistema/consultarBooking';
        },2500);
    });
    /*
    $('#menuAnulaBook').on('click',function(){
        $(document).skylo('start');

        setTimeout(function(){
            $(document).skylo('set',50);
        },1000);

        setTimeout(function(){
            $(document).skylo('end');
        },1500);
		setTimeout(function(){
            window.location.href = '<?php echo BASE_URL; ?>sistema/anularBooking';
        },2500);
    });
    */
    
    $('#menuHoteles').on('click',function(){
        $(document).skylo('start');

        setTimeout(function(){
            $(document).skylo('set',50);
        },1000);

        setTimeout(function(){
            $(document).skylo('end');
        },1500);
		setTimeout(function(){
            window.location.href = '<?php echo BASE_URL; ?>sistema/hoteles';
        },2500);
    });
    
    $('#menuAdminProg').on('click',function(){
        $(document).skylo('start');

        setTimeout(function(){
            $(document).skylo('set',50);
        },1000);

        setTimeout(function(){
            $(document).skylo('end');
        },1500);
		setTimeout(function(){
            window.location.href = '<?php echo BASE_URL; ?>sistema/adminProgramas';
        },2500);
    });
    
    $('#menuImagenes').on('click',function(){
        $(document).skylo('start');

        setTimeout(function(){
            $(document).skylo('set',50);
        },1000);

        setTimeout(function(){
            $(document).skylo('end');
        },1500);
		setTimeout(function(){
            window.location.href = '<?php echo BASE_URL; ?>sistema/imagenes';
        },2500);
    });
    
    $('#menuUsuarios').on('click',function(){
        $(document).skylo('start');

        setTimeout(function(){
            $(document).skylo('set',50);
        },1000);

        setTimeout(function(){
            $(document).skylo('end');
        },1500);
		setTimeout(function(){
            window.location.href = '<?php echo BASE_URL; ?>sistema/usuarios';
        },2500);
    });
    
    
    
    //////#####
     $('#menuContacto').on('click',function(){
        $(document).skylo('start');

        setTimeout(function(){
            $(document).skylo('set',50);
        },1000);

        setTimeout(function(){
            $(document).skylo('end');
        },1500);
		setTimeout(function(){
            window.location.href = '<?php echo BASE_URL; ?>sistema/contactenos';
        },2500);
    });
    
    
    
    function abrePopup(docPHP, titulo, varProg)
	{
            initLoad();
            $("#divPopupPRG").html('');
            document.getElementById("tituloFormPRG").innerHTML=titulo;
            $.post(docPHP, 
            {
                    post_varProg: varProg
            }, function(data)
            {
                    $("#divPopupPRG").html(data);
                    endLoad();
            });
	}
</script>

<div class="ui-pnotify " id="divAlertExito" style="width: 300px; right: 25px; top: 25px; opacity: 1; display: none; cursor: auto;">
	<div class="alert ui-pnotify-container alert-success ui-pnotify-shadow" style="min-height: 16px;">
        <h4 class="ui-pnotify-title">Terminado</h4>
		<div class="ui-pnotify-text"><img src="<?php echo $_layoutParams['ruta_img']; ?>ok.png" width="32" border="0" /> Proceso realizado con &eacute;xito.</div>
    </div>
</div>

<div class="ui-pnotify " id="divAlertWar" style="width: 300px; right: 25px; top: 25px; opacity: 1; display: none; cursor: auto;">
	<div class="alert ui-pnotify-container alert-danger ui-pnotify-shadow" style="min-height: 16px;">
        <h4 class="ui-pnotify-title">&iexcl;Atenci&oacute;n!</h4>
        <div class="ui-pnotify-text" id="mensajeWar"><span id="msjWar"></span></div>
    </div><!--<img src="<?php echo $_layoutParams['ruta_img']; ?>st_rojo.png" width="16" border="0"  />-->
</div>

<div class="ui-pnotify " id="divAlertInfo" style="width: 300px; right: 25px; top: 25px; opacity: 1; display: none; cursor: auto;">
	<div class="alert ui-pnotify-container alert-info ui-pnotify-shadow" style="min-height: 16px;">
        <div class="ui-pnotify-text">
        	<span class="fa fa-spin"><img src="<?php echo $_layoutParams['ruta_img']; ?>loading.png" width="32" border="0" /></span> Procesando, espere un momento.</div>
    </div>
</div>





<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div id="modal_dialog" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ML_tituloForm"></h4>
            </div>

            <div class="modal-body" id="ML_divPopup"></div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->