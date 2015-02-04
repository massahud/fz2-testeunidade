<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Forum\Service;

use Doctrine\ORM\EntityManager;
use Forum\Model\Entidade\Topico;

/**
 * Description of ForumService
 *
 * @author massahud
 */
class ForumService {

    /**
     *
     * @var EntityManager
     */
    private $em;

    /**
     * @var TimeService
     */
    private $timeService;

    public function __construct(EntityManager $em, TimeService $timeService) {
        $this->em = $em;
        $this->timeService = $timeService;
    }

    public function listar() {
        $q = $this->em->createQuery('select f from Forum\Model\Entidade\Forum f order by f.nome');
        return $q->getResult();
    }

    /**
     * 
     * @param int $id
     * @return Forum\Model\Forum
     */
    public function find($id) {
        return $this->em->find('Forum\Model\Entidade\Forum', $id);
    }

    public function criarTopico($forum, $usuario, $titulo, $texto) {
        $topico = new Topico($forum, $usuario, $titulo, $texto, $this->timeService->getDataHoraAtual());
        $this->em->persist($topico);
        $this->em->flush($topico);
        return $topico;
    }

    public function apagarTopico($topicoId) {
        $topico = $this->em->find('Forum\Model\Entidade\Topico', $topicoId);
        if (!empty($topico)) {
            $this->em->remove($topico);
            $this->em->flush($topico);
            return true;
        }
        return false;
    }

}
