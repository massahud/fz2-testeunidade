<?php

namespace Application\Model;

/**
 * Description of Dinheiro
 *
 * @author massahud
 */
class Dinheiro {
    
    private $simbolo;
    private $valor;
    private $cotacao;
        
    public function __construct($simbolo, $valor, $cotacao) {        
        if ($cotacao <= 0) {
            throw new \InvalidArgumentException("Cotação deve ser maior que zero");
        }
        $this->simbolo = $simbolo;
        $this->valor = $valor;
        $this->cotacao = $cotacao;
    }

    public function getSimbolo() {
        return $this->simbolo;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getCotacao() {
        return $this->cotacao;
    }
    
    private function getValorAbsoluto() {
        return $this->getValor()*$this->getCotacao();
    }

    public function compareTo(Dinheiro $dinheiro) {        
        return $this->getValorAbsoluto() - $dinheiro->getValorAbsoluto();
    }

}
