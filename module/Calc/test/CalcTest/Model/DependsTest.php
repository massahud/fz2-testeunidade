<?php

/**
 * Description of DependsTest
 *
 * @author massahud
 */
class DependsTest extends PHPUnit_Framework_TestCase {

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
     * @small
     * @depends teste1
     * @depends teste2
     */
    public function teste3(array $geradoPorTeste1, array $geradoPorTeste2) {
        for ($index = 0; $index < 10000000; $index++) {
            
        }
        Assert\that(implode("", $geradoPorTeste1) . implode("", $geradoPorTeste2))->eq("xyz");
        Assert\that(2)->min(0);        
    }

    public function valoresPositivos() {
        return array(
            array(0), // limite inferior
            array(1), // inteiro qualquer
            array(0.5), // double
            array(PHP_INT_MAX) // maior int
        );
    }
    
    /**
     * @test
     * @param numeric $valor
     * @dataProvider valoresPositivos
     */
    public function deveAceitarValoresPositivos($valor) {        
        Assert\that($valor)->numeric()->min(0);            
        expect($valor)->greaterOrEquals(0);
    }

}
