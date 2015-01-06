<?php

namespace Calc\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Container;

class CalculadoraController extends AbstractActionController {            
    private $calculadora;

    public function indexAction() {
        return new ViewModel();
    }

    public function teclaAction() {
        $this->restoreState();        
        $this->saveState();
        return array('display' => $this->calculadora->getDisplay(),
            'registrador' => '1');
    }
    
    private function getContainer() {
        if (empty($this->__calculadoraContainer)) {            
            $this->__calculadoraContainer = new Container('namespace');
        }
        return $this->__calculadoraContainer;
    }
    
    private function getTecla() {
        return $this->params('tecla');
    }

    private function saveState() {
        $this->getContainer()->display = $this->display or '';
    }

    private function restoreState() {      
        $this->calculadora = $this->getContainer()->calculadora or new Calculadora();
    }

}
