<?php
namespace Application\Model\Entidade;

/**
 * Description of Turma
 *
 * @author massahud
 */
class Turma {
    /**
     * @var int
     */
    private $vagas;
    
    /**
     * 
     * @param int $vagas
     * @throws \InvalidArgumentException se vagas não for 'int' e maior ou igual a 0
     */
    public function __construct($vagas) {    
        if (!is_int($vagas)) {
            throw new \InvalidArgumentException("quantidade de vagas deve ser int, ". gettype($vagas)." passado");
        }
        if ($vagas < 0) {
            throw new \InvalidArgumentException("quantidade de vagas deve positiva ". $vagas. " passado");
        }
        $this->vagas = $vagas;
    }
    
    function getVagas() {
        return $this->vagas;
    }


}
