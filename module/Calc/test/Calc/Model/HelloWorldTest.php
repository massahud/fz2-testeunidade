<?php

use Calc\Model\HelloWorld;
/**
 * Description of HelloWorldTest
 *
 * @author massahud
 */
class HelloWordTest extends PHPUnit_Framework_TestCase {
    
    
    /**
     * @test
     */
    public function greet_deveUsarWordQuandoParametroForNull() {
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
    public function greet_deveUsarWordQuandoParametroForVazio() {
        // setup
        $out = new SplFileObject("php://memory", "r+");
        $helloWorld = new HelloWorld($out);
        // exercise
        $helloWorld->greet("");
        // verify
        $out->rewind();
        $greeting = $out->fgets();
        Assert\that($greeting)->eq("Hello, World!");
        // teardown (garbage collector)
    }
    
    public function greet_deveRemoverEspacosDoNome() {
        
    }
}
