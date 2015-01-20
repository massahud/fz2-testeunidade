<?php

namespace Forum\Model\Entidade;

/**
 * Um forum é um conjunto de posts
 *
 * @author massahud
 */
class Comentario {

    /**
     * Topico do comentário
     * 
     * @var Topico
     */
    private $topico;

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
     *
     * @var \DateTime
     */
    private $dataCriacao;

    /**
     * @param Topico $topico
     * @param string $usuario
     * @param string $texto
     */
    public function __construct(Topico $topico = NULL, $usuario = NULL, $texto = NULL) {
        $this->topico = $topico;
        $this->usuario = $usuario;
        $this->texto = $texto;
    }

    public function getTopico() {
        return $this->topico;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    function getTexto() {
        return $this->texto;
    }

    /**
     * 
     * @param \DateTime $data
     */
    public function setDataCriacao(\DateTime $data) {
        $this->dataCriacao = $data;
    }

    /**
     * @return \DateTime data de criação
     */
    public function getDataCriacao() {
        return $this->dataCriacao;
    }

}
