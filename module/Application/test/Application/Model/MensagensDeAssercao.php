<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Model;

use PHPUnit_Framework_TestCase;
use function greaterThan;
use \Assert;
/**
 * Description of AssertionTest
 * 
 * @group unidade
 * @small
 * @author massahud
 */
class AssertionTest extends PHPUnit_Framework_TestCase {
    
    public function setUp() {
        // COMENTE A LINHA ABAIXO PARA VER EXECUTAR
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
    public function greatherThanSemMensagemMatcherPHPUnit() {
        $this->assertThat(0, $this->greaterThan(1));
    }
    
    /**
     * @test
     */
    public function greatherThanSemMensagemMatcherHamcrest() {
        assertThat(0, greaterThan(1));
    }
    
    /**
     * @test
     */
    public function greaterThanComMensagemPHPUnit() {
        self::assertGreaterThan(1, 0, "mensagem");
    }
    
    /**
     * @test
     */
    public function greaterThanComMensagemAssert() {
        Assert\that(0, "mensagem")->min(1);
    }
    
    /**
     * @test
     */
    public function greaterThanComMensagemVerify() {        
        verify("mensagem", 0)->greaterThan(1);
    }
    
    /**
     * @test
     */
    public function greatherThanComMensagemMatcherPHPUnit() {
        $this->assertThat(0, $this->greaterThan(1), "mensagem");
    }
    
    
}
