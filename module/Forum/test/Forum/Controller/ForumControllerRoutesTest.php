<?php

namespace Forum\Controller;

use Bootstrap;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\View\Model\ViewModel;


/**
 * Teste de integração de rotas do zend
 * mais exemplos de testes de integração com zend em http://framework.zend.com/manual/current/en/tutorials/unittesting.html
 * @group integracao
 * @medium
 * @author massahud
 */
class ForumControllerRoutesTest extends AbstractHttpControllerTestCase {

    private $routeMatch;    
    
    public function setUp() {
        // cria aplicação com configuração de testes
        $this->setApplicationConfig(
                Bootstrap::getApplicationConfig()
        );
        parent::setUp();
        
        // cria esquema no sqlite
        $em = $this->getApplicationServiceLocator()->get('Doctrine\ORM\EntityManager');
        Bootstrap::dropCreateSchema($em);
        
        // cria um listener para obter o routeMatch, de onde podemos obter
        // os parametros passados pela rota.
        $self = $this;
        $this->getApplication()->getEventManager()->attach('route', function($event) use ($self) {            
            $self->routeMatch = $event->getRouteMatch();            
        });
    }
    
    public function getParam($param) {
        return $this->routeMatch->getParam($param);
    }

    /**
     * @test
     */
    public function rotaDefaultDeveIrParaIndexAction() {
        $this->dispatch('/forum');

        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Forum');
        $this->assertControllerName('Forum\Controller\Forum');
        $this->assertControllerClass('ForumController');
        $this->assertActionName('index');
        $this->assertMatchedRouteName('default');
    }

    /**
     * @test
     */
    public function deveChamarAcaoTopicosAoReceberIdDoForum() {
        $this->dispatch('/forum/123');

        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Forum');
        $this->assertControllerName('Forum\Controller\Forum');
        $this->assertControllerClass('ForumController');
        $this->assertActionName('topicos');
        $this->assertMatchedRouteName('default/forum');
        
        expect($this->getParam('forumId'))->equals('123');
    }
    

    /**
     * @test
     */
    public function deveChamarAcaoTopicoAoReceberIdDoTopico() {
        $this->dispatch('/forum/123/topico/456');

        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Forum');
        $this->assertControllerName('Forum\Controller\Forum');
        $this->assertControllerClass('ForumController');
        $this->assertActionName('topico');
        $this->assertMatchedRouteName('default/forum/topico');
        
        expect($this->getParam('forumId'))->equals('123');
        expect($this->getParam('topicoId'))->equals('456');        
    }

}
