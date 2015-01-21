<?php

use Calc\Model\HelloWorld;
/**
 * Description of HelloWorldTest
 *
 * 
 * @group unidade
 * @small
 * @author massahud
 */
class DependeTest extends PHPUnit_Framework_TestCase {

    
    /**
     * @test
     */
    public function teste1() {
        Assert\that(true)->true();
        return array("x");
    }
    
    /**
     * @test
     * @depends teste1
     */
    public function teste2(array $geradoPorTeste1) {
        Assert\that($geradoPorTeste1[0])->eq("x");
        return array("y", "z");
    }
    
    /**
     * @test
     * @depends teste1
     * @depends teste2
     */
    public function teste3Test(array $geradoPorTeste1, array $geradoPorTeste2) {
        for ($index = 0; $index < 10000000; $index++) {
            
        }
        Assert\that(implode("", $geradoPorTeste1) . implode("", $geradoPorTeste2))->eq("xyz");
        Assert\that(2)->min(0);        
    }
    
    /**
     * Método que cria dados para serem usados em testes
     * 
     * @return array de inteiros positivos
     */
    public function valoresPositivos() {
        return [
            [0], // limite inferior
            [1], // inteiro qualquer
            [0.5], // double
            [PHP_INT_MAX] // maior int
        ];
    }
    
    /**
     * teste para exemplificar dataProvider
     * @test
     * @dataProvider valoresPositivos
     */
    public function deveAceitarValoresPositivos($valor) {
        Assert\that($valor)->min(0);
        verify($valor)->greaterOrEquals(0);
    }
}
