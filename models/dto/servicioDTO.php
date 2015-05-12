<?php

/* 
 * Proyecto : oristravel.com
 * Autor    : Tsyacom Ltda.
 * Fecha    : Lunes, 28 de julio de 2014
 */

class servicioDTO
{
    private $_cod_pais;
    private $_pais;
    private $_cod_ciudad;
    private $_ciudad;
    private $_numero;
    private $_nombre;
    
    
    function getNumero() {
        return $this->_numero;
    }

    function getNombre() {
        return $this->_nombre;
    }

    function setNumero($numero) {
        $this->_numero = $numero;
        return $this;
    }

    function setNombre($nombre) {
        $this->_nombre = $nombre;
        return $this;
    }

        
    
    public function getCiudad() {
        return $this->_ciudad;
    }
    public function setCiudad($ciu) {
        $this->_ciudad = $ciu;
    }

    public function getCodCiudad() {
        return $this->_cod_ciudad;
    }
    public function setCodCiudad($cod) {
        $this->_cod_ciudad = $cod;
    }
    
    public function getPais() {
        return $this->_pais;
    }
    public function setPais($pais) {
        $this->_pais = $pais;
    }
    
    public function getCodPais() {
        return $this->_cod_pais;
    }
    public function setCodPais($cod) {
        $this->_cod_pais = $cod;
    }
}