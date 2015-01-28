<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Application\Model;

use \InvalidArgumentException;
use Phake;
use Phockito;
use PHPUnit_Framework_TestCase;

class MeuObjeto {

    public function funcao() {
        return "Função";
    }

    public function funcaoComParametro($parametro) {
        return "Função com parâmetro: $parametro";
    }

    public function outraFuncaoComParametro($parametro) {
        return "Outra função com parâmetro: $parametro";
    }
}

/**
 * Description of ExemplosTestDouble
 *
 * @author massahud
 */
class ExemplosTestDouble extends PHPUnit_Framework_TestCase {
    

    /**
     * @test
     */
    public function stubComPhake() {
        $obj = Phake::mock('Application\Model\MeuObjeto');

        Phake::when($obj)->funcao()->thenReturn('Stub');
        Phake::when($obj)->funcaoComParametro('A')->thenReturn('A Stub');

        expect($obj->funcao())->equals('Stub');
        expect($obj->funcaoComParametro('A'))->equals('A Stub');
        expect($obj->funcaoComParametro('B'))->null();
        expect($obj->outraFuncaoComParametro('B'))->null();
    }

    /**
     * @test
     */
    public function stubComPHPUnit() {
        $obj = $this->getMockBuilder('Application\Model\MeuObjeto')->getMock();

        $obj->expects($this->any())->method('funcao')
                ->willReturn('Stub');
        $obj->expects($this->any())->method('funcaoComParametro')
                ->with('A')
                ->willReturn('A Stub');

        expect($obj->funcao())->equals('Stub');
        expect($obj->funcaoComParametro('A'))->equals('A Stub');
        // Não funciona pois não faz retorno de NULL por padrão de um método já com stub, pode ser feito com callback
        //expect($obj->funcaoComParametro('B'))->null();
        expect($obj->outraFuncaoComParametro('B'))->null();
    }

    /**
     * @test
     */
    public function stubComPhockito() {
        $obj = Phockito::mock('Application\Model\MeuObjeto');

        Phockito::when($obj->funcao())->return('Stub');
        Phockito::when($obj->funcaoComParametro('A'))->return('A Stub');

        expect($obj->funcao())->equals('Stub');
        expect($obj->funcaoComParametro('A'))->equals('A Stub');
        expect($obj->funcaoComParametro('B'))->null();
        expect($obj->outraFuncaoComParametro('B'))->null();
    }
    
    /**
     * @test
     */
    public function stubMultiplosArgumentosComPhake() {
        $obj = Phake::mock('Application\Model\MeuObjeto');

        Phake::when($obj)->funcaoComParametro('A')->thenReturn('A Stub');
        Phake::when($obj)->funcaoComParametro('B')->thenReturn('B Stub');

        expect($obj->funcaoComParametro('A'))->equals('A Stub');
        expect($obj->funcaoComParametro('B'))->equals('B Stub');
        expect($obj->funcaoComParametro('C'))->null();
    }

    /**
     * @test
     */
    public function stubMultiplosArgumentosComPHPUnit() {
        $obj = $this->getMockBuilder('Application\Model\MeuObjeto')->getMock();

        // Com PHPUnit é possível apenas com callbacks
        $obj->expects($this->any())->method('funcaoComParametro')
                ->will($this->returnCallback(function($param) {
                            switch ($param) {
                                case 'A':
                                    return 'A Stub';
                                case 'B':
                                    return 'B Stub';
                                default:
                                    return null;
                            }
                        })
        );
        
        expect($obj->funcaoComParametro('A'))->equals('A Stub');
        expect($obj->funcaoComParametro('B'))->equals('B Stub');
        expect($obj->funcaoComParametro('C'))->null();
    }

    /**
     * @test
     */
    public function stubMultiplosArgumentosComPhockito() {
        $obj = Phockito::mock('Application\Model\MeuObjeto');

        Phockito::when($obj->funcaoComParametro('A'))->return('A Stub');
        Phockito::when($obj->funcaoComParametro('B'))->return('B Stub');


        expect($obj->funcaoComParametro('A'))->equals('A Stub');
        expect($obj->funcaoComParametro('B'))->equals('B Stub');
        expect($obj->funcaoComParametro('C'))->null();
    }
    
    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function stubLancaExcecaoComPhake() {
        $obj = Phake::mock('Application\Model\MeuObjeto');
        Phake::when($obj)->funcaoComParametro('Z')->thenThrow(new InvalidArgumentException());
        
        $obj->funcaoComParametro('Z');
    }

    /**
     * @test
     */
    public function spyComPhake() {
        $obj = Phake::mock('Application\Model\MeuObjeto');

        $obj->funcao();
        $obj->funcaoComParametro('X');
        $obj->outraFuncaoComParametro('Y');
        $obj->outraFuncaoComParametro('Y');

        // verificação simples
        Phake::verify($obj)->funcao();                
        
        // quantidade de chamadas
        Phake::verify($obj, Phake::times(2))->outraFuncaoComParametro('Y');
        Phake::verify($obj, Phake::atLeast(1))->outraFuncaoComParametro('Y');
        Phake::verify($obj, Phake::atMost(2))->outraFuncaoComParametro('Y');
        
        // captura de argumentos
        Phake::verify($obj)->funcaoComParametro(Phake::capture($arg));
        expect($arg)->equals('X');
        
    }

    /**
     * @test
     */
    public function spyComPHPUnit() {
        
    }

    /**
     * @test
     */
    public function spyComPhockito() {
        
    }

    /**
     * @test
     */
    public function callbackComPhake() {
        // não existe
    }

    /**
     * @test
     */
    public function callbackComPHPUnit() {
        
    }

    /**
     * @test
     */
    public function callbackComPhockito() {
        
    }

    

}
