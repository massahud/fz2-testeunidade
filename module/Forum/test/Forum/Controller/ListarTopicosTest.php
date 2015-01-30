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
 * Ao acessar um fórum
 * Eu quero visualizar seus tópicos
 * 
 * @group aceitacao
 * @large
 * @author massahud
 */
class ListarTopicosTest extends AbstractHttpControllerTestCase {

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
    public function deveListarOsTopicosAoAcessarUmForum() {
                
        $duvidas = $this->repo->getReference(LoadForumData::FORUM_DUVIDAS);
        $topicoSuporte = $this->repo->getReference(\Forum\Fistures\Simples\LoadTopicoData::TOPICO_SUPORTE);
        $topicoNaoFunciona = $this->repo->getReference(\Forum\Fistures\Simples\LoadTopicoData::TOPICO_NAO_FUNCIONA);
        
        $this->dispatch("/forum/".$duvidas->getId());
        
        $this->assertQueryCount('/div#topicos/ul/li', 2);
        
        $this->assertQueryContentContains('/div#topicos/ul/li', $topicoSuporte->getTitulo());
        $this->assertQueryContentContains('/div#topicos/ul/li', $topicoNaoFunciona->getTitulo());
        
    }
    
    /**
     * @test
     */
    public function deveExibirAMensagemNaoHaTopicosAoAcessarUmForumSemTopicos() {
                
        $semTopicos = $this->repo->getReference(LoadForumData::FORUM_SEM_TOPICOS);
        
        $this->dispatch("/forum/".$semTopicos->getId());
        
        $this->assertQueryCount('/div#topicos/ul/li', 0);
        
        $this->assertQueryContentContains('/div#topicos', 'Não há topicos');                
    }        
    
    

}
