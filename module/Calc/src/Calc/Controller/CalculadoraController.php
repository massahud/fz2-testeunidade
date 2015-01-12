<?php

namespace Calc\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;
use Calc\Model\Calculadora;

class CalculadoraController extends AbstractActionController {            
    /**
     * @var Calculadora
     */
    private $calculadora;
    /**     
     * @return Zend\Session\Container
     */
    private $calculadoraContainer;

    public function indexAction() {
        return new ViewModel();
    }

    public function teclaAction() {
        $this->restoreState();        
        return array('display' => $this->calculadora->getDisplay(),
            'registrador' => '1');
    }
    
    public function getContainer() {
        if (empty($this->calculadoraContainer)) {            
            $this->calculadoraContainer = new Container('namespace');
        }
        return $this->calculadoraContainer;
    }
    
    private function getTecla() {
        return $this->params('tecla');
    }

    private function saveState() {
        $this->getContainer()->display = $this->display or '';
    }

    private function restoreState() {      
        $this->calculadora = $this->getContainer()->offsetGet('calculadora') or new Calculadora();
    }

    public function setContainer($container) {
        $this->calculadoraContainer = $container;
    }

}
