<?php

use Application\Model\Dinheiro;
/**
 * Description of DinheiroTest
 *
 * @group unidade
 * @small
 * @author massahud
 */
class DinheiroTest extends PHPUnit_Framework_TestCase {

    const UM_SIMBOLO = "R$";
    const UM_VALOR = 10.01;
    const UMA_COTACAO = 2.5;
    
    public function simboloValorCotacaoValidos() {
        return [
          ["R$", 10.01, 2.5],
          ["Cr$", 10.01, 2.5],
          ["R$", 0.01, 2.5],
          ["R$", 10.01, 0.01],
          ["R$", 1000000000000000000.01, 0.01],
          ["R$", 1, 1000000000000000000.01],
        ];
    }
    
    /**
     * @test
     * @dataProvider simboloValorCotacaoValidos
     */
    public function deveConstruirComSimboloValorECotacaoValidos($simbolo,$valor,$cotacao) {
        $dinheiro = new Dinheiro($simbolo, $valor, $cotacao);

        expect($dinheiro->getSimbolo())->equals($simbolo);
        expect($dinheiro->getValor())->equals($valor);
        expect($dinheiro->getCotacao())->equals($cotacao);
    }
        
    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function naoDeveConstruirComCotacaoNegativa() {        
        $dinheiro = new Dinheiro(self::UM_SIMBOLO, self::UM_VALOR, -1);
    }
    
    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function naoDeveConstruirComCotacaoZero() {
        $dinheiro = new Dinheiro(self::UM_SIMBOLO, self::UM_VALOR, 0);
    }
    
    
    public function dinheiroMenorEMaior() {
        return [
          [new Dinheiro(self::UM_SIMBOLO,    1, 1), new Dinheiro(self::UM_SIMBOLO, 1, 1.01)],
          [new Dinheiro(self::UM_SIMBOLO, 0.99, 1), new Dinheiro(self::UM_SIMBOLO, 1, 1)],
          [new Dinheiro(self::UM_SIMBOLO, 0.01, 0.01), new Dinheiro(self::UM_SIMBOLO, 0.01, 0.02)]
        ];
    }
    
    /**
     * @test
     * @dataProvider dinheiroMenorEMaior
     */
    public function compareToDeveRetornarNegativoSeValorMultiplicadoPorCotacaoForMenor(Dinheiro $menor, Dinheiro $maior) {       
        expect($menor->compareTo($maior))->lessThen(0);
    }
    
     /**
     * @test
     * @dataProvider dinheiroMenorEMaior
     */
    public function compareToDeveRetornarPositivoSeValorMultiplicadoPorCotacaoForMaior(Dinheiro $menor, Dinheiro $maior) {       
        expect($maior->compareTo($menor))->greaterThan(0);
    }
    
    public function dinheirosIguais() {
        return [
          [new Dinheiro(self::UM_SIMBOLO, 0.01, 0.02),new Dinheiro(self::UM_SIMBOLO, 0.02, 0.01)],
          [new Dinheiro(self::UM_SIMBOLO, 3, 4),new Dinheiro(self::UM_SIMBOLO, 6, 2)],          
        ];
    }
    
    /**
     * @test
     * @dataProvider dinheirosIguais
     */
    public function compareToDeveRetornarZeroSeValorMultiplicadoPorCotacaoForIgual(Dinheiro $igual1, Dinheiro $igual2) {
        
        expect($igual1->compareTo($igual2))->notNull();
        expect($igual1->compareTo($igual2))->equals(0);
        
        expect($igual2->compareTo($igual1))->notNull();
        expect($igual2->compareTo($igual1))->equals(0);
    }

}
