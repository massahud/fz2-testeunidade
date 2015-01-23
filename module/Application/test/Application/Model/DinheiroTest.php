<?php

use Application\Model\Dinheiro;
/**
 * Description of DinheiroTest
 *
 * @author massahud
 */
class DinheiroTest extends PHPUnit_Framework_TestCase {

    const UM_SIMBOLO = "R$";
    const UM_VALOR = 10.01;
    const UMA_COTACAO = 2.5;

    public function deveConstruirComSimboloValorECotacao() {
        $dinheiro = new Dinheiro(self::UM_SIMBOLO, self::UM_VALOR, self::UMA_COTACAO);

        expect($dinheiro->getSimbolo())->equals(self::UM_SIMBOLO);
        expect($dinheiro->getValor())->equals(self::UM_VALOR);
        expect($dinheiro->getCotacao())->equals(self::UMA_COTACAO);
    }

}
