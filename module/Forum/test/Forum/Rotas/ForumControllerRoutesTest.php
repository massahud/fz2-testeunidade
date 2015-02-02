<?php

namespace Forum\Rotas;

use Bootstrap;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Forum\Fistures\Simples\LoadForumData;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Teste de integração de rotas do zend
 * mais exemplos de testes de integração com zend em http://framework.zend.com/manual/current/en/tutorials/unittesting.html
 * @group integracao
 * @medium
 * @author massahud
 */
class ForumControllerRoutesTest extends AbstractHttpControllerTestCase {

    /**
     *
     * @var ReferenceRepository
     */
    private $repo;

    /**
     *
     * @var RouteMatch
     */
    private $routeMatch;

    public function setUp() {
        // cria aplicação com configuração de testes
        $this->setApplicationConfig(
                Bootstrap::getApplicationConfigSqliteMemoria()
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

        // carrega fixtures
        $loader = new Loader();
        $loader->loadFromDirectory(__DIR__ . '/../Fixtures/Simples');
        $fixtures = $loader->getFixtures();

        // limpa e insere fixtures no banco
        $purger = new ORMPurger();
        $executor = new ORMExecutor($em, $purger);
        $executor->execute($fixtures);
        $this->repo = $executor->getReferenceRepository();
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
        $forum = $this->repo->getReference(LoadForumData::FORUM_COMUNIDADE);

        $this->dispatch('/forum/' . $forum->getId());

        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Forum');
        $this->assertControllerName('Forum\Controller\Forum');
        $this->assertControllerClass('ForumController');
        $this->assertActionName('topicos');
        $this->assertMatchedRouteName('default/forum');

        expect($this->getParam('forumId'))->equals($forum->getId());        
    }
}
