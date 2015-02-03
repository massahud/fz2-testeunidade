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
/**
 * @group unidade
 * @small
 */
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

    ///////////////////////////////////////////////////////////////////////////

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
     * @expectedException InvalidArgumentException
     */
    public function stubLancaExcecaoComPhockito() {
        $obj = Phake::mock('Application\Model\MeuObjeto');
        Phake::when($obj)->funcaoComParametro('Z')->thenThrow(new InvalidArgumentException());

        $obj->funcaoComParametro('Z');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function stubLancaExcecaoComPHPUnit() {
        $obj = $this->getMockBuilder('Application\Model\MeuObjeto')->getMock();
        $obj->expects($this->any())
                ->method('funcao')
                ->will($this->throwException(new InvalidArgumentException()));

        $obj->funcao();
    }

    ///////////////////////////////////////////////////////////////////////////

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
    public function spyComPhockito() {
        $obj = Phockito::mock('Application\Model\MeuObjeto');

        $obj->funcao();
        
        $obj->outraFuncaoComParametro('Y');
        $obj->outraFuncaoComParametro('Y');

        // verificação simples
        Phockito::verify($obj)->funcao();

        // quantidade de chamadas
        Phockito::verify($obj, 2)->outraFuncaoComParametro('Y');
        Phockito::verify($obj, '1+')->outraFuncaoComParametro('Y');
        // não tem verificação de máximo de chamadas

        // não tem captura de argumentos, da para gambiarrar com callback
    }
    
    /**
     * É mais um mock do que um spy
     * @test
     */
    public function spyComPHPUnit() {
        $obj = $this->getMockBuilder('Application\Model\MeuObjeto')->getMock();
        
        $obj->expects($this->once())
                ->method('funcao');                

        $obj->expects($this->exactly(2))
                ->method('outraFuncaoComParametro')
                ->with('Y');
        
        $obj->expects($this->atLeast(1))
                ->method('funcaoComParametro');
        
        
        $obj->funcao('X');
        $obj->outraFuncaoComParametro('Y');
        $obj->outraFuncaoComParametro('Y');
        
        $obj->funcaoComParametro('X');       
        $obj->funcaoComParametro('Y');         
    }
    
    ////////////////////////////////////////////////////////////////////////////

    /**
     * @test
     */
    public function mockComPHPUnit() {
        $obj = $this->getMockBuilder('Application\Model\MeuObjeto')->getMock();

        $obj->expects($this->once())
                ->method('funcaoComParametro')
                ->with('X');

        $obj->funcaoComParametro('X');
    }

    /* 
     * Phake e Phockito não possuem mocks propriamentes ditos, para simular o
     * comportamento de um mock podemos lançar exceção em todos os métodos que 
     * não devem ser utilizados ou após o teste verificar que todos esses métodos
     * não foram chamados
     */
    
    ////////////////////////////////////////////////////////////////////////////

    /**
     * @test
     */
    public function callbackComPhockito() {
        $obj = Phockito::mock('Application\Model\MeuObjeto');
        $self = $this;
        Phockito::when($obj->funcaoComParametro(anything()))->callback(function($param) use ($self) {
            $self->param = $param;
            return 'X';
        });
        $retorno = $obj->funcaoComParametro('Z');

        expect($retorno)->equals('X');
        expect($this->param)->equals('Z');
    }

    /**
     * @test
     */
    public function callbackComPHPUnit() {
        $obj = $this->getMockBuilder('Application\Model\MeuObjeto')->getMock();
        $self = $this;
        // Com PHPUnit é possível apenas com callbacks
        $obj->expects($this->any())->method('funcaoComParametro')
                ->will($this->returnCallback(function($param) use ($self) {
                            $self->param = $param;
                            return 'X';
                        })
        );
        $retorno = $obj->funcaoComParametro('Z');
        expect($retorno)->equals('X');
        expect($this->param)->equals('Z');
    }

    ///////////////////////////////////////////////////////////////////////////

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
    
    ///////////////////////////////////////////////////////////////////////////
    
    /**
     * @test
     */
    public function stubMultiplosRetornosComPhake() {
        $obj = Phake::mock('Application\Model\MeuObjeto');

        Phake::when($obj)->funcaoComParametro('A')->thenReturn(1)->thenReturn(2);

        expect($obj->funcaoComParametro('A'))->equals(1);
        expect($obj->funcaoComParametro('A'))->equals(2);
        expect($obj->funcaoComParametro('A'))->equals(2);        
    }

    /**
     * @test
     */
    public function stubMultiplosRetornosComPhockito() {
        $obj = Phockito::mock('Application\Model\MeuObjeto');

        Phockito::when($obj->funcaoComParametro('A'))->return(1)->return(2);
        

        expect($obj->funcaoComParametro('A'))->equals(1);
        expect($obj->funcaoComParametro('A'))->equals(2);
        expect($obj->funcaoComParametro('A'))->equals(2);        
    }

    /**
     * @test
     */
    public function stubMultiplosRetornosComPHPUnit() {
        $obj = $this->getMockBuilder('Application\Model\MeuObjeto')->getMock();

        $self = $this;
        $this->retorno = 1;
        // Com PHPUnit é possível apenas com callbacks
        $obj->expects($this->any())->method('funcaoComParametro')
                ->will($this->returnCallback(function($param) use ($self){
                            switch ($param) {
                                case 'A':
                                    return $self->retorno++;
                                default:
                                    return null;
                            }
                        })
        );

        expect($obj->funcaoComParametro('A'))->equals(1);
        expect($obj->funcaoComParametro('A'))->equals(2);
        expect($obj->funcaoComParametro('A'))->equals(3);
        
    }

}
