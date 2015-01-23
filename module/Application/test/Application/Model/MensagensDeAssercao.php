<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AssertionTest
 * 
 * 
 * @author massahud
 */
class AssertionTest extends PHPUnit_Framework_TestCase {
    
    public function setUp() {
        self::markTestSkipped('teste criado apenas para exibir as mensagens de erro entre bibliotecas de asserções');
    }
    
    /**
     * @test
     */
    public function greaterThanSemMensagemPHPUnit() {
        self::assertGreaterThan(1, 0);
    }
    
    /**
     * @test
     */
    public function greaterThanSemMensagemAssert() {
        Assert\that(0)->min(1);
    }
    
    /**
     * @test
     */
    public function greaterThanSemMensagemVerify() {
        verify(0)->greaterThan(1);
        //expect(0)->greaterThan(1);
    }
    
    /**
     * @test
     */
    public function greaterThanComMensagemPHPUnit() {
        self::assertGreaterThan(1, 0, "meu número");
    }
    
    /**
     * @test
     */
    public function greaterThanComMensagemAssert() {
        Assert\that(0, "meu número")->min(1);
    }
    
    /**
     * @test
     */
    public function greaterThanComMensagemVerify() {        
        verify("meu número", 0)->greaterThan(1);
    }

}
