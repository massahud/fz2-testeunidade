<?php

namespace Application\Model;

/**
 * Description of HelloWorld
 *
 * @author massahud
 */
class TimeProvider {

    /**
     * @return int valor da hora
     */
    function getHora() {
        $date = new \DateTime();
        return (int)$date->format('H');
    }
    
}
