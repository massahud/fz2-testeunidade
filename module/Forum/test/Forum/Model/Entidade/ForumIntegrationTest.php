<?php

use Forum\Model\Entidade\Forum;

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

    /**
     *
     * @var Doctrine\ORM\EntityManager 
     */
    protected $em;
    
    public function setUp() {
        $this->em = Bootstrap::getEntityManager();
    }

    /**
     * @test
     * @medium
     */
    public function deveReceberIdNoFlush() {

        $forum = new Forum();        
        $forum->setNome('Nome do forum');
        $forum2 = new Forum('outro nome');
        
        
        $this->em->persist($forum2);
        $this->em->getUnitOfWork()->clear();
        $this->em->persist($forum);
        $this->em->flush();
        

        print $forum->getId();
        Assert\that($forum->getId())->notNull();
        Assert\that($forum2->getId())->eq(NULL);
    }
    
    /**
     * @test
     * @medium
     */
    public function deveReceberIdNoFlush2() {

        $forum = new Forum();        
        $forum->setNome('Nome do forum');
        $forum2 = new Forum('outro nome');
        
        
        $this->em->persist($forum2);
        $this->em->getUnitOfWork()->clear();
        $this->em->persist($forum);
        $this->em->flush();
        

        print $forum->getId();
        Assert\that($forum->getId())->notNull();
        Assert\that($forum2->getId())->eq(NULL);
    }

}
