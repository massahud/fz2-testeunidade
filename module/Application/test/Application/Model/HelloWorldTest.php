<?php

namespace Application\Model;

use Phake;
use PHPUnit_Framework_TestCase;
/**
 * Description of HelloWorldTest
 * @group unidade
 * @small
 * @author massahud
 */
class HelloWordTest extends PHPUnit_Framework_TestCase {

    const UM_NOME = "Maria Lúcia";
    
     /**
     * @test
     */
    public function greetDeveUsarONomeWorldSemParametros() {
        
        $helloWorld = new HelloWorld();
        
        $cumprimento = $helloWorld->greet();
        
        self::assertEquals("Hello, World!", $cumprimento);
        
    }

    /**
     * @test
     */
    public function greetDeveUsarONomeWorldSeNomeForNulo() {
        
        $helloWorld = new HelloWorld();
        
        $cumprimento = $helloWorld->greet(NULL);
        
        self::assertEquals("Hello, World!", $cumprimento);
        
    }
    
    /**
     * @test
     */
    public function greetDeveUsarONomeWorldSeNomeForVazio() {
         $helloWorld = new HelloWorld();
        
        $cumprimento = $helloWorld->greet("");
        
        self::assertEquals("Hello, World!", $cumprimento);
        
    }
    
    /**
     * @test
     */
    public function greetDeveUsarONomePassadoComoParametro() {
        $helloWorld = new HelloWorld();
        
        $cumprimento = $helloWorld->greet(self::UM_NOME);
        
        self::assertEquals("Hello, ".self::UM_NOME."!", $cumprimento);
    }
    
    
    ////////////////////////////// TEMPORAL ////////////////////////////////////
    
    public function horasDaManha() {
        return [[5],[6],[7],[8],[9],[10],[11]];
    }
    
    /**
     * @test
     * @dataProvider horasDaManha
     */
    public function deveFalarGoodMorningEntreCincoDaManhaEMeioDia($hora) {
        $timeProvider = Phake::mock('Application\Model\TimeProvider');
        $helloWorld = new HelloWorld($timeProvider);
        
        Phake::when($timeProvider)->getHora()->thenReturn(5);
        
        $cumprimento = $helloWorld->greet(self::UM_NOME, true);
        
        
        self::assertEquals("Good morning, ".self::UM_NOME."!", $cumprimento);
    }
    
    public function horasDaTarde() {
        return [[12],[13],[14],[15],[16],[17]];
    }
    
    /**
     * @test
     * @dataProvider horasDaTarde
     */
    public function deveFalarGoodAfternoonEntreMeioDiaESeisDaTarde($hora) {
        $timeProvider = Phake::mock('Application\Model\TimeProvider');
        $helloWorld = new HelloWorld($timeProvider);
        
        Phake::when($timeProvider)->getHora()->thenReturn($hora);
        
        $cumprimento = $helloWorld->greet(self::UM_NOME, true);
        
        self::assertEquals("Good afternoon, ".self::UM_NOME."!", $cumprimento);
    }
    
    public function horasDaNoite() {
        return [[18],[19],[20],[21],[22],[23],[0],[1],[2],[3],[4]];
    }
    
    /**
     * @test
     * @dataProvider horasDaNoite
     */
    public function deveFalarGoodNightEntreSeisDaTardeECincoDaManha($hora){
        $timeProvider = Phake::mock('Application\Model\TimeProvider');
        $helloWorld = new HelloWorld($timeProvider);
        
        Phake::when($timeProvider)->getHora()->thenReturn($hora);
        
        $cumprimento = $helloWorld->greet(self::UM_NOME, true);
        
        self::assertEquals("Good night, ".self::UM_NOME."!", $cumprimento);
    }
    
    /**
     * @test
     * @expectedException Application\Model\TemporalSemTimeProviderException
     */
    public function deveLancarExcecaoSeForTermporalSemTimeProvider() {
        $helloWorld = new HelloWorld();
        $helloWorld->greet(self::UM_NOME, true);
    }
}
