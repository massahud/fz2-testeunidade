<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumIntegrationTest
 *
 *
 * @group integracao
 * @author massahud
 */
class ForumIntegrationTest extends PHPUnit_Framework_TestCase {

    protected $em;

    public function __construct($name = null, array $data = array(), $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->em = Bootstrap::getEntityManager();
    }

    /**
     * @test
     * @medium
     */
    public function podeSerConstruidoSemNome() {

        $forum = new \Forum\Model\Entidade\Forum();
        $forum->setNome('Nome do forum');

        $this->em->persist($forum);
        $this->em->flush();

        print 'id ' . $forum->getId() . "\n";
    }

}
