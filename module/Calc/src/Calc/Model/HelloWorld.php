<?php

namespace Calc\Model;

/**
 * Description of HelloWorld
 *
 * @author massahud
 */
class HelloWorld {

    /**
     * @var \SplFileObject
     */
    private $out;

    const HELLO_FORMAT = "Hello, %s!";
    const WORLD = "World";

    function __construct(\SplFileObject $out) {
        $this->out = $out;
    }

    /**
     * @param string $name
     */
    function greet($name) {
        if (empty($name)) {
            $name = HelloWorld::WORLD;
        }
        $this->out->fwrite(sprintf(HelloWorld::HELLO_FORMAT, $name));
    }

}
