<?php

namespace Calc\Model;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calculadora
 *
 * @author massahud
 */
class Calculadora {

    private $display = '';
    private $registrador = array();

    /**
     * Números aceitos pela calculadora     
     */
    const NUMEROS = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    /**
     * Operações aceitas pela calculadora
     */
    const OPERACOES = ['-', '+', '/', '*'];
    
    const IGUAL = '=';

    public function getDisplay() {
        return $this->display;
    }

    public function tecla($tecla) {
        if (in_array($tecla, self::NUMEROS)) {
            $this->display .= $tecla;
        } else if (in_array($tecla, self::OPERACOES)) {            
            array_push($this->registrador, $this->display);
            array_push($this->registrador, $tecla);            
        }
        return $this;
    }

    public function getRegistrador() {
        return $this->registrador;
    }

    

}
