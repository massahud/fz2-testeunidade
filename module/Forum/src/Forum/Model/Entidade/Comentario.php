<?php

namespace Forum\Model\Entidade;

use Doctrine\ORM\Mapping as ORM;

/**
 * Um forum é um conjunto de posts
 *
 * @ORM\Entity
 * @author massahud
 */
class Comentario {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     * Topico do comentário
     * 
     * @var Topico     
     * @ORM\ManyToOne(targetEntity="Topico", inversedBy="comentarios")
     */
    private $topico;

    /**
     * Usuário que criou a mensagem
     * 
     * @var string 
     * @ORM\Column(type="string")
     */
    private $usuario;

    /**
     * Texto da mensagem
     * 
     * @var string 
     * @ORM\Column(type="string", length=4000)
     */
    private $texto;

    /**
     *
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $dataCriacao;

    /**
     * @param Topico $topico
     * @param string $usuario
     * @param string $texto
     */
    public function __construct(Topico $topico, $usuario, $texto, \DateTime $dataCriacao) {
        $this->topico = $topico;
        $this->usuario = $usuario;
        $this->texto = $texto;
        $this->dataCriacao = $dataCriacao;
    }

    function getId() {
        return $this->id;
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

    public function getDataCriacao() {
        return $this->dataCriacao;
    }

}
