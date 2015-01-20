<?php

namespace Forum\Model\Entidade;
/**
 * Um forum é um conjunto de posts
 *
 * @author massahud
 */
class Comentario {
    /**
     * Usuário que criou a mensagem
     * 
     * @var string 
     */
    private $usuario;
    /**
     * Texto da mensagem
     * 
     * @var string 
     */
    private $texto;
    
    /**     
     * @param string $usuario
     * @param string $texto
     */
    public function __construct($usuario, $texto) {                
        $this->usuario = $usuario;
        $this->texto = $texto;
    }

    
    public function getUsuario() {
        return $this->usuario;
    }

    function getTexto() {
        return $this->texto;
    }




}
