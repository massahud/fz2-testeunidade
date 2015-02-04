<?php

namespace Forum\Aceitacao;

use Bootstrap;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Doctrine\ORM\EntityManager;
use Forum\Fistures\Simples\LoadForumData;
use Forum\Fistures\Simples\LoadTopicoData;
use Zend\Json\Json;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Como um usuário 
 * Eu deveria apagar topicos
 * Para limpar meu forum
 * 
 * @group aceitacao
 * @large
 * @author massahud
 */
class ApagarTopicoTest extends AbstractHttpControllerTestCase {

    /**
     *
     * @var ReferenceRepository
     */
    private $repo;

    /**
     *
     * @var EntityManager
     */
    private $em;

    public function setUp() {        
        // cria aplicação com configuração de testes
        $this->setApplicationConfig(
                Bootstrap::getApplicationConfigMySQLTestes()
        );
        parent::setUp();

        // cria esquema no sqlite
        $this->em = $this->getApplicationServiceLocator()->get('Doctrine\ORM\EntityManager');
        Bootstrap::dropCreateSchema($this->em);


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
     */
    public function deveApagarUmTopicoAoAcessarARota() {

        $forum = $this->repo->getReference(LoadForumData::FORUM_DUVIDAS);
        $topico = $this->repo->getReference(LoadTopicoData::TOPICO_NAO_FUNCIONA);
        print $topico->getTitulo();
        $this->dispatch("/forum/" . $forum->getId() . "/apagar-topico/" . $topico->getId());
        $this->assertResponseStatusCode(200);
        $resposta = $this->getResponse()->getContent();
        $this->assertJson($resposta);
        $dadosResposta = Json::decode($resposta);
        expect($dadosResposta->apagado)->equals('OK');
        print $topico->getTitulo();
        $this->verifiqueQueTopicoFoiApagadoDoForum($forum, $topico->getTitulo());
        
    }

    private function verifiqueQueTopicoFoiApagadoDoForum($forum, $titulo) {
        $this->dispatch('/forum/' . $forum->getId());
        
        $this->assertQueryCount('li.topico', 1);
        $this->assertNotQueryContentContains('li.topico', $titulo);
    }

}
