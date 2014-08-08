<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class errorController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        $this->_view->titulo= 'Error';
        $this->_view->mensaje= $this->_getError();
        $this->_view->renderizaPrincipal('index');
    }
    
    
    public function access($codigo)
    {
        $this->_view->titulo= 'Error';
        $this->_view->mensaje= $this->_getError($codigo);
        $this->_view->renderizaPrincipal('access');
    }
    
    private function _getError($codigo = false) //utilizo '_' para identificar que es una funcion privada
    {
        if($codigo)
        {
            //$codigo = $this->filtrarInt($codigo);
            if(is_int($codigo))
                $codigo=$codigo;
        }
        else
        {
            $codigo = 'default';
        }
        
        $error['default'] = 'Ha ocurrido un error en esta p�gina';
        $error['5050'] = 'Acceso restringido';
        $error['8080'] = 'Tiempo de la session agotado';
        
        if(array_key_exists($codigo, $error))
        {
            return $error[$codigo];
        }
        else
        {
            return $error['default'];
        }
    }
}

?>