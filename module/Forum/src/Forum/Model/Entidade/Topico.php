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
     * @var Forum
     */
    private $forum;

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
     * @var array Forum\Model\Entidade\Comentario
     */
    private $comentarios = array();
    /**
     *
     * @var \DateTime
     */
    private $dataCriacao;

    /**
     * 
     * @param Forum $forum
     * @param string $usuario
     * @param string $titulo
     * @param string $texto
     */
    function __construct(Forum $forum = NULL, $usuario = NULL, $titulo = NULL, $texto = NULL) {
        $this->forum = $forum;
        $this->usuario = $usuario;
        $this->titulo = $titulo;
        $this->texto = $texto;
    }

    public function setForum($forum) {
        $this->forum = $forum;
    }

    public function getForum() {
        return $this->forum;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getComentarios() {
        return $this->comentarios;
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
