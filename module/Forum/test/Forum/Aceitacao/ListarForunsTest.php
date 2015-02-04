<?php

namespace Forum\Aceitacao;

use Bootstrap;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\ReferenceRepository;
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
    
    /** 
     *
     * @var ReferenceRepository
     */
    private $repo;
    
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
    public function deveListarOsNomesDosForunsAoAcessarOModulo() {
        $comunidade = $this->repo->getReference(LoadForumData::FORUM_COMUNIDADE);
        $duvidas = $this->repo->getReference(LoadForumData::FORUM_DUVIDAS);
        $semTopicos = $this->repo->getReference(LoadForumData::FORUM_SEM_TOPICOS);
        
        $this->dispatch('/forum');
        
        $this->assertQueryCount('li.forum', 3);
        $this->assertQueryContentContains('li.forum', $comunidade->getNome());
        $this->assertQueryContentContains('li.forum', $duvidas->getNome());
        $this->assertQueryContentContains('li.forum', $semTopicos->getNome());
        
    }
    
     /**
     * @test
     */
    public function deveColocarUmLinkParaOIdDeCadaForum() {
        $comunidade = $this->repo->getReference(LoadForumData::FORUM_COMUNIDADE);
        $duvidas = $this->repo->getReference(LoadForumData::FORUM_DUVIDAS);
        $semTopicos = $this->repo->getReference(LoadForumData::FORUM_SEM_TOPICOS);
        
        $this->dispatch('/forum');
                                
        $this->assertXpathQueryContentContains('//li[@class="forum"]/a/@href', 'forum/'.$comunidade->getId());
        $this->assertXpathQueryContentContains('//li[@class="forum"]/a/@href', 'forum/'.$duvidas->getId());
        $this->assertXpathQueryContentContains('//li[@class="forum"]/a/@href', 'forum/'.$semTopicos->getId());
    }   
    
    /**
     * @test
     */
    public function deveListarOsForunsEmOrdemAlfabetica() {
        $comunidade = $this->repo->getReference(LoadForumData::FORUM_COMUNIDADE);
        $duvidas = $this->repo->getReference(LoadForumData::FORUM_DUVIDAS);
        $semTopicos = $this->repo->getReference(LoadForumData::FORUM_SEM_TOPICOS);
        
        $this->dispatch('/forum');
               
        $this->assertXpathQueryContentContains('//li[@class="forum" and position()=1]', $comunidade->getNome());
        $this->assertXpathQueryContentContains('//li[@class="forum" and position()=2]', $duvidas->getNome());
        $this->assertXpathQueryContentContains('//li[@class="forum" and position()=3]', $semTopicos->getNome());
    }

    
    

}
