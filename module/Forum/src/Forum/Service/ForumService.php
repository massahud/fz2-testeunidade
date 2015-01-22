<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Forum\Service;

use Doctrine\ORM\EntityManager;

/**
 * Description of ForumService
 *
 * @author massahud
 */
class ForumService {

    /**
     *
     * @var Doctrine\ORM\EntityManager
     */
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function listar() {
        $q = $this->em->createQuery('select f from Forum\Model\Entidade\Forum f');
        return $q->getResult();
    }

    public function find($id) {
        return $this->em->find('Forum\Model\Entidade\Forum', $id);
        
    }

}
