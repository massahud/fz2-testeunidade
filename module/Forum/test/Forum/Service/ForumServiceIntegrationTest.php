<?php

namespace Forum\Service;

use Bootstrap;
use DateTime;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Doctrine\ORM\EntityManager;
use Forum\Fistures\Simples\LoadForumData;
use Forum\Service\ForumService;
use Forum\Service\TimeService;
use Phake;
use PHPUnit_Framework_TestCase;
use \Assert;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumIntegrationTest
 * @group integracao
 * @author massahud
 */
class ForumServiceIntegrationTest extends PHPUnit_Framework_TestCase {

    const UM_USUARIO = "anonymous";
    const UM_TITULO = "Titulo";
    const UM_TEXTO = "Texto";

    /**
     *
     * @var EntityManager 
     */
    protected $em;

    /**
     *
     * @var ReferenceRepository 
     */
    private $repo;

    /**
     *
     * @var TimeService
     */
    private $timeService;
    
    /**
     *
     * @var DateTime 
     */
    private $dataAtual;

    public function setUp() {
        $this->em = Bootstrap::getEntityManager();
        $this->timeService = Phake::mock('Forum\Service\TimeService');
        $this->dataAtual=  DateTime::createFromFormat(DateTime::W3C, '2015-02-03T14:03:05-02:00');
        Phake::when($this->timeService)->getDataHoraAtual()->thenReturn($this->dataAtual);
        // carrega fixtures
        $loader = new Loader();
        $loader->loadFromDirectory(__DIR__ . '/../Fixtures/Simples');
        $fixtures = $loader->getFixtures();

        // limpa e insere fixtures no banco
        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->em, $purger);
        $executor->execute($fixtures);
        $this->repo = $executor->getReferenceRepository();
    }

    /**
     * @test
     * @medium
     */
    public function deveListarOsForuns() {

        $comunidade = $this->repo->getReference(LoadForumData::FORUM_COMUNIDADE);
        $duvidas = $this->repo->getReference(LoadForumData::FORUM_DUVIDAS);
        $semTopicos = $this->repo->getReference(LoadForumData::FORUM_SEM_TOPICOS);

        $forumService = new ForumService($this->em, $this->timeService);

        $foruns = $forumService->listar();

        Assert\that($foruns)->isArray()->count(3);
        expect($foruns)->contains($comunidade);
        expect($foruns)->contains($duvidas);
        expect($foruns)->contains($semTopicos);
    }

    /**
     * @test
     * @medium
     */
    public function deveObterForumPorId() {
        $duvidas = $this->repo->getReference(LoadForumData::FORUM_DUVIDAS);
        $forumService = new ForumService($this->em, $this->timeService);

        $forum = $forumService->find($duvidas->getId());

        expect($forum)->equals($duvidas);
    }

    /**
     * @test
     * @medium
     */
    public function devePersistirNovoTopico() {
        $semTopicos = $this->repo->getReference(LoadForumData::FORUM_SEM_TOPICOS);
        $forumService = new ForumService($this->em, $this->timeService);

        $topico = $forumService->criarTopico($semTopicos, self::UM_USUARIO, self::UM_TITULO, self::UM_TEXTO);

        expect($topico->getId())->notEmpty();
        expect($this->em->find('Forum\Model\Entidade\Topico',$topico->getId()))->equals($topico);
    }

}
