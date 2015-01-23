<?php

use Application\Model\HelloWorld;
/**
 * Description of HelloWorldTest
 * @group unidade
 * @small
 * @author massahud
 */
class HelloWordTest extends PHPUnit_Framework_TestCase {
    
    
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
        
}
