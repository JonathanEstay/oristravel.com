<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class Funciones
{
    public static function invertirFecha($fecha, $char, $newChar)
    {
        if($fecha)
        {
            $datos = explode($char, $fecha);
            $fechaFinal = $datos[2].$newChar.$datos[1].$newChar.$datos[0];
        }
        else
        {
            $fechaFinal='';
        }
        
        return $fechaFinal;
    }
    
    public static function add_ceros($numero,$ceros) 
    {
            $order_diez = explode(".",$numero);
            $dif_diez = $ceros - strlen($order_diez[0]);
            for($m=0;$m<$dif_diez;$m++)
            {
                    @$insertar_ceros .= 0;
            }
            
            return $insertar_ceros .= $numero;
    }
    
    public static function getTipoMoneda($moneda)
    {
        if($moneda == "D")
        {
             $newMon= "USD";
        }
        elseif($moneda == "P")
        {
            $newMon= "$";
        }
        elseif($moneda == "E")
        {
            $newMon= "EUR";
        }
        
        return $newMon;
    }

        public static function sumFecha($fIni, $dias=0, $meses=0, $years=0)
    {
        $fechaExp= explode('/', $fIni);
        $newDate= mktime(0, 0, 0, $fechaExp[1]+$meses, $fechaExp[0]+$dias, $fechaExp[2]+$years);
        $fechaEnd= date("d/m/Y", $newDate);
        
        return $fechaEnd;
        
        /*php 5.3 
        //P --Para iniciar los parametros de Fecah;
        //7Y --Setear 7 a�os
        //5M --Setear 5 meses
        //4D --Setear 4 dias
        //T -- para iniciar parametros de Hora
        //4H --Setear 4 horas
        //3M --Setear 3 minutos
        //2S --Setear 2 segundos
        //$fecha->add(new DateInterval('P7Y5M4DT4H3M2S'));
        $fecha = new DateTime($fIni);
        $fecha->add(new DateInterval('P'.$years.'Y'.$meses.'M'.$dias.'D'));
        echo $fecha->format('Y-m-d'); */
    }
    
    
    public static function getBrowser()
    { 
        $u_agent = $_SERVER['HTTP_USER_AGENT']; 
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent))
        {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Internet Explorer'; 
            $ub = "MSIE"; 
        } 
        elseif(preg_match('/Firefox/i',$u_agent)) 
        { 
            $bname = 'Mozilla Firefox'; 
            $ub = "Firefox"; 
        } 
        elseif(preg_match('/Chrome/i',$u_agent)) 
        { 
            $bname = 'Google Chrome'; 
            $ub = "Chrome"; 
        } 
        elseif(preg_match('/Safari/i',$u_agent)) 
        { 
            $bname = 'Apple Safari'; 
            $ub = "Safari"; 
        } 
        elseif(preg_match('/Opera/i',$u_agent)) 
        { 
            $bname = 'Opera'; 
            $ub = "Opera"; 
        } 
        elseif(preg_match('/Netscape/i',$u_agent)) 
        { 
            $bname = 'Netscape'; 
            $ub = "Netscape"; 
        } 

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }
    public function validaFoto($tipoFotoPerfil)
    {
        $tipoImagen=false;
            if(strpos(strtolower($tipoFotoPerfil), "gif")){ $tipoImagen= "gif"; }
        elseif(strpos(strtolower($tipoFotoPerfil), "png")){ $tipoImagen= "png"; }
        elseif(strpos(strtolower($tipoFotoPerfil), "jpeg")){ $tipoImagen= "jpg"; }
        elseif(strpos(strtolower($tipoFotoPerfil), "jpg")){ $tipoImagen= "jpg"; }

        if($tipoImagen)
        {
            return $tipoImagen;
        }
        else
        {
            return false;
        }
    }
    
    public function validaArchivo($archivo){
     $tipoArchivo= false;
        if(strpos(strtolower($archivo), "pdf")){$tipoArchivo = "pdf";}
        
        if($tipoArchivo)
        {
           return $tipoArchivo; 
        }
        else
        {           
           return false; 
        }
        
    }
    
     public function validaChk($chk)
    {
        if($chk=='on')
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    public function eliminaFile($file)
    {
        if(is_readable($file))
        {
            @unlink($file);
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function validarEmail($email)
    { 
        if (!ereg("^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*$", $email)) 
        {
            $mail_correcto = 0;
        }
       else
        {
            $mail_correcto = 0; 
            //compruebo unas cosas primeras 
            if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@"))
            { 
                if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," ")))
                { 
                    //miro si tiene caracter . 
                    if (substr_count($email,".")>= 1)
                    { 
                        //obtengo la terminacion del dominio 
                        $term_dom = substr(strrchr ($email, '.'),1); 
                        //compruebo que la terminaci�n del dominio sea correcta 
                        if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) )
                        { 
                            //compruebo que lo de antes del dominio sea correcto 
                            $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1); 
                            $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1); 
                            if ($caracter_ult != "@" && $caracter_ult != ".")
                            { 
                                $mail_correcto = 1; 
                            } 
                        } 
                    } 
                } 
            }
        }
        
        if ($mail_correcto) 
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                return false;
            }
            else
            {
                return $email; //1
            }
        }
        else
        {    
            return false; 
        }
    }
    
    public function traduceDia()
    {
        $dia=date('l');
        switch ($dia) {
            case 'Monday':
                $dia='Lunes';
                break;
            case 'Tuesday':
                $dia='Martes';
                break;
            case 'Wednesday':
                $dia='Mi&eacute;rcoles';
                break;
            case 'Thursday':
                $dia='Jueves';
                break;
            case 'Friday':
                $dia='Viernes';
                break;
            case 'Saturday':
                $dia='S&aacute;bado';
                break;
            case 'Sunday':
                $dia='Domingo';
                break;

            default:
                $dia='Error';
                break;
        }
        return $dia;
    }
    
    
    public function traduceMes()
    {
        $mes=date('F');
        switch ($mes) {
            case 'January':
                $mes='Enero';
                break;
            case 'February':
                $mes='Febrero';
                break;
            case 'March':
                $mes='Marzo';
                break;
            case 'April':
                $mes='Abril';
                break;
            case 'May':
                $mes='Mayo';
                break;
            case 'June':
                $mes='Junio';
                break;
            case 'July':
                $mes='Julio';
                break;
            case 'August':
                $mes='Agosto';
                break;
            case 'September':
                $mes='Septiembre';
                break;
            case 'October':
                $mes='Octubre';
                break;
            case 'November':
                $mes='Noviembre';
                break;
            case 'December':
                $mes='Diciembre';
                break;

            default:
                $mes='Error';
                break;
        }
        return $mes;
    }

   
}

?>