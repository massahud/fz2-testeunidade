<?php

namespace Application\Model;

/**
 * Description of HelloWorld
 *
 * @author massahud
 */
class HelloWorld {
    

    const HELLO_FORMAT = "Hello, %s!";
    const WORLD = "World";

    /**
     * @param string $name
     */
    function greet($name) {
        if (empty($name)) {
            $name = HelloWorld::WORLD;
        }
        return sprintf(HelloWorld::HELLO_FORMAT, $name);
    }

}
