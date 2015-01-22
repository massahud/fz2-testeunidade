<?php

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Doctrine\ORM\EntityManager;
use Forum\Fistures\Simples\LoadForumData;
use Forum\Service\ForumService;

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
class ForumServiceIntegrationTest extends PHPUnit_Framework_TestCase {
    
    /**
     *
     * @var EntityManager 
     */
    protected $em;
    /**
     *
     * @var ReferenceRepository 
     */
    protected $repo;
    

    
    public function setUp() {
        $this->em = Bootstrap::getEntityManager();
        // carrega fixtures
        $loader = new Loader();
        $loader->loadFromDirectory(__DIR__.'/../../Fixtures/Simples');        
        $fixtures = $loader->getFixtures();        

        // limpa e insere fixtures no banco
        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->em, $purger);
        $executor->execute($fixtures);
        $this->repo = $executor->getReferenceRepository();
        
        
    }

    /**
     * @test
     */
    public function deveListarOsForums() {
        
        $comunidade = $this->repo->getReference(LoadForumData::FORUM_COMUNIDADE);
        $duvidas = $this->repo->getReference(LoadForumData::FORUM_DUVIDAS);
        $semTopicos = $this->repo->getReference(LoadForumData::FORUM_SEM_TOPICOS);
        
        $forumService = new ForumService($this->em);

        $forums = $forumService->listar();
                
        Assert\that($forums)->isArray()->count(3);
        Assert\that($comunidade)->inArray($forums);
        Assert\that($duvidas)->inArray($forums);
        Assert\that($semTopicos)->inArray($forums);        
    }
    
    /**
     * @test
     */
    public function deveObterForumPorId() {
        $duvidas = $this->repo->getReference(LoadForumData::FORUM_DUVIDAS);
        $forumService = new ForumService($this->em);
        
        $forum = $forumService->find($duvidas->getId());
        
        Assert\that($forum)->eq($duvidas);
    }

}
