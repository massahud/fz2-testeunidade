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

    /**
     * @var Container $calculadoraContainer
     * @param Calculadora $calculadora
     * @param Container $calculadoraContainerva
     */
    function __construct(Container $calculadoraContainer = NULL) {
        if ($calculadoraContainer == NULL) {
            throw new \InvalidArgumentException('calculadoraContainer não pode ser null');
        }

        $this->calculadoraContainer = $calculadoraContainer;
        $this->calculadora = $calculadoraContainer->calculadora;
        if ($this->calculadora == NULL) {
            $this->calculadora = new Calculadora();
            $calculadoraContainer->calculadora = $this->calculadora;
        }
    }

    public function indexAction() {
        return new ViewModel();
    }

    public function teclaAction() {
        
    }

    private function getTecla() {
        return $this->params('tecla');
    }

    public function getCalculadora() {
        return $this->calculadora;
    }

}
