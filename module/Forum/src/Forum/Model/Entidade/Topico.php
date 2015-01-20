<?php

namespace Forum\Model\Entidade;
/**
 * Um forum é um conjunto de posts
 *
 * @author massahud
 */
class Topico {
    /**
     *
     * @var string 
     */
    private $usuario;
    /**
     *
     * @var string 
     */
    private $titulo;
    /**
     *
     * @var string 
     */
    private $texto;
    /**
     *
     * @var array 
     */
    private $comentarios = array();

    function __construct($usuario, $titulo, $texto) {
        $this->usuario = $usuario;
        $this->titulo = $titulo;
        $this->texto = $texto;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getComentarios() {
        return $this->comentarios;
    }

}
