<?php

namespace Forum\Model\Entidade;
/**
 * Um forum é um conjunto de posts
 *
 * @author massahud
 */
class Forum {
    /**
     *
     * @var string 
     */
    private $nome;
    /**
     *
     * @var array 
     */
    private $topicos = array();
    
    public function __construct($nome = NULL) {
        $this->nome = $nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getNome() {
        return $this->nome;
    }

    public function getTopicos() {
        return $this->topicos;
    }

}
