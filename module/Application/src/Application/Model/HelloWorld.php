<?php

namespace Application\Model;

/**
 * Description of HelloWorld
 *
 * @author massahud
 */
class HelloWorld {

    const HELLO_FORMAT = "%s, %s!";
    const WORLD = "World";
    const HELLO = 'Hello';
    const GOOD_MORNING = 'Good morning';
    const GOOD_AFTERNOON = 'Good afternoon';
    const GOOD_NIGHT = 'Good night';
    
    /** 
     * @var TimeProvider
     */
    private $timeProvider;
    
    function __construct(TimeProvider $timeProvider = NULL) {
        $this->timeProvider = $timeProvider;
    }

        /**
     * @param string $name
     */
    function greet($name = NULL, $temporal = false) {
        if (empty($name)) {
            $name = HelloWorld::WORLD;
        }
        if ($temporal) {           
            if (empty($this->timeProvider)) {
                throw new TemporalSemTimeProviderException();
            }
            $hora = $this->timeProvider->getHora();
            
            if ($hora >= 5 && $hora < 12) {
                return sprintf(HelloWorld::HELLO_FORMAT, self::GOOD_MORNING, $name);
            } elseif ($hora >= 12 && $hora < 18) {
                return sprintf(HelloWorld::HELLO_FORMAT, self::GOOD_AFTERNOON, $name);
            } elseif ($hora >= 18 || $hora < 5) {
                return sprintf(HelloWorld::HELLO_FORMAT, self::GOOD_NIGHT, $name);
            }
        } else {
            return sprintf(HelloWorld::HELLO_FORMAT, self::HELLO, $name);
        }
    }

}
