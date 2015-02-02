<?php

namespace Forum\Model\Entidade;

use Doctrine\ORM\Mapping as ORM;

/**
 * Um forum é um conjunto de posts
 *
 * @author massahud
 * @ORM\Entity
 */
class Forum {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @var integer
     */
    private $id;

    /**
     *
     * @var string 
     * @ORM\Column(type="string")
     */
    private $nome;

    /**
     *
     * @var array 
     * @ORM\OneToMany(mappedBy="forum", targetEntity="Topico")
     */
    private $topicos = array();

    public function __construct($nome) {
        if ($nome == NULL) {
            throw new \InvalidArgumentException("Nome não pode ser nulo");
        }
        $this->nome = $nome;
    }

    function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTopicos() {
        return $this->topicos;
    }

}
