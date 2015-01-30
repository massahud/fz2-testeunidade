<?php

namespace Forum\Controller;

use Bootstrap;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Forum\Fistures\Simples\LoadForumData;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Como um usuário 
 * Ao acessar o módulo
 * Eu quero visualizar os fóruns
 * 
 * @group aceitacao
 * @large
 * @author massahud
 */
class ListarForunsTest extends AbstractHttpControllerTestCase {

    public function setUp() {
        // cria aplicação com configuração de testes
        $this->setApplicationConfig(
                Bootstrap::getApplicationConfigMySQLTestes()
        );
        parent::setUp();

        // cria esquema no sqlite
        $em = $this->getApplicationServiceLocator()->get('Doctrine\ORM\EntityManager');
        Bootstrap::dropCreateSchema($em);
        
        
        // carrega fixtures
        $loader = new Loader();
        $loader->loadFromDirectory(__DIR__.'/../Fixtures/Simples');        
        $fixtures = $loader->getFixtures();

        // limpa e insere fixtures no banco
        $purger = new ORMPurger();
        $executor = new ORMExecutor($em, $purger);
        $executor->execute($fixtures);
        $this->repo = $executor->getReferenceRepository();
        
    }
    
    /**
     * @test
     */
    public function deveListarOsForunsAoAcessarOModulo() {
        $comunidade = $this->repo->getReference(LoadForumData::FORUM_COMUNIDADE);
        $duvidas = $this->repo->getReference(LoadForumData::FORUM_DUVIDAS);
        $semTopicos = $this->repo->getReference(LoadForumData::FORUM_SEM_TOPICOS);
        
        $this->dispatch('/forum');
        
        $this->assertQueryCount('/div#foruns/ul/li', 3);
        
        $this->assertQueryContentContains('/div#foruns/ul/li', $comunidade->getNome());
        $this->assertQueryContentContains('/div#foruns/ul/li', $duvidas->getNome());
        $this->assertQueryContentContains('/div#foruns/ul/li', $semTopicos->getNome());
        
    }

}
