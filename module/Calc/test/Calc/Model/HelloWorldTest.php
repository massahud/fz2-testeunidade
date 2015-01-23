<?php

use Calc\Model\HelloWorld;
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
    public function greet_deveUsarWorldQuandoParametroForNull() {
        // setup
        $out = new SplFileObject("php://memory", "r+");
        $helloWorld = new HelloWorld($out);
        // exercise
        $helloWorld->greet(NULL);
        // verify
        $out->rewind();
        $greeting = $out->fgets();
        Assert\that($greeting)->eq("Hello, World!");
        // teardown (garbage collector)
    }
    
    /**
     * @test
     */
    public function greet_deveUsarWorldQuandoParametroForVazio() {
        // setup
        $out = new SplFileObject("php://memory", "r+");
        $helloWorld = new HelloWorld($out);
        // exercise
        $helloWorld->greet("");
        // verify
        $out->rewind();
        $greeting = $out->fgets();
        Assert\that($greeting)->eq("Hello, World!");
        self::assertGreaterThanOrEqual($greeting, $helloWorld)
        // teardown (garbage collector)
    }
    
    /**
     * @test
     */
    public function greet_deveRemoverEspacosDoNome() {
        
        $hello = new HelloWorld();
        
        $oi = $hello->comprimentar('João');
        
        self::assertEquals('Hello, João!', $oi, 'Não comprimentou o João');        
    }
    
    /**
     * @test
     */
    public function greet_deveRemoverEspacosDoNomeComAssert() {
        Assert\that('maria josé')->eq('josé');
    }
}
