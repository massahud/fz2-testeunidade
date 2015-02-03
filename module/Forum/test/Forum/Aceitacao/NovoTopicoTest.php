<?php

namespace Forum\Aceitacao;

use Bootstrap;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Doctrine\ORM\EntityManager;
use Forum\Fistures\Simples\LoadForumData;
use Zend\Json\Json;
use Zend\Stdlib\Parameters;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * Como um usuário 
 * Ao acessar um fórum
 * Eu quero poder criar um novo tópico
 * 
 * @group aceitacao
 * @large
 * @author massahud
 */
class NovoTopicoTest extends AbstractHttpControllerTestCase {

    const UM_TITULO = "Novo tópico";
    const UM_TEXTO = "Texto do novo tópico";
    const UM_USUARIO = "anonymous";

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
                Bootstrap::getApplicationConfigSqliteMemoria()
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
    public function deveCriarUmNovoTopicoAoPostar() {

        $comunidade = $this->repo->getReference(LoadForumData::FORUM_COMUNIDADE);
        $this->dispatch("/forum/" . $comunidade->getId() . "/novo-topico", 
            'POST', 
            ['usuario' => self::UM_USUARIO, 
             'titulo' => self::UM_TITULO, 
             'texto' => self::UM_TEXTO]);
        $this->assertResponseStatusCode(200);
        $resposta = $this->getResponse()->getContent();
        $this->assertJson($resposta);
        $dadosResposta = Json::decode($resposta);
        expect($dadosResposta->inserido)->equals('OK');
        $this->verifiqueQueTopicoFoiInseridoNoForum($comunidade, self::UM_TITULO);
    }

    private function verifiqueQueTopicoFoiInseridoNoForum($forum, $titulo) {
        $this->dispatch('/forum/' . $forum->getId());
        $this->assertQueryContentContains('li.topico', $titulo);
    }

}
