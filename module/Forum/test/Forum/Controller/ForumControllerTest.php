<?php
namespace Forum\Controller;

use Forum\Model\Entidade\Forum;
use Phake;
use Phockito;
use PHPUnit_Framework_Error;
use PHPUnit_Framework_TestCase;
use Zend\Json\Json;
use Zend\Mvc\Router\Http\RouteMatch;
use Zend\Stdlib\Parameters;
use \Assert;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumControllerTest
 * @group unidade
 * @small
 * @author massahud
 */
class ForumControllerTest extends PHPUnit_Framework_TestCase {

    const UM_ID = 123;
    const UM_USUARIO = "anonymous";
    const UM_TITULO = "Titulo";
    const UM_TEXTO = "Texto";

    /**
     * @test
     * @expectedException PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to Forum\Controller\ForumController::__construct() must be an instance of Forum\Service\ForumService
     */
    public function naoDeveAceitarServiceNulo() {
        new ForumController(null);
    }

    /**
     * @test
     */
    public function indexActionDeveColocarOsForunsNaChaveForuns() {

        $foruns = array(new Forum('FORUM 1'), new Forum('Fórum 2'));

        $service = Phockito::mock('Forum\Service\ForumService');
        Phockito::when($service->listar())->return($foruns);


        $forumController = new ForumController($service);

        $listaDeForuns = $forumController->indexAction();

        Assert\that($listaDeForuns['foruns'])->eq($foruns);
    }

    /**
     * Este teste está complicado, pois temos que fazer um
     * spy parcial do controle para controlar o método 'params'
     * @test
     */
    public function deveListarOsTopicosDoForum() {
        $service = Phake::mock('Forum\Service\ForumService');
        $forum = Phake::mock('Forum\Model\Entidade\Forum');
        $topicos = [Phake::mock('Forum\Model\Entidade\Topico'),
            Phake::mock('Forum\Model\Entidade\Topico'),
            Phake::mock('Forum\Model\Entidade\Topico'),
            Phake::mock('Forum\Model\Entidade\Topico')
        ];
        Phake::when($service)->find(self::UM_ID)->thenReturn($forum);
        Phake::when($forum)->getTopicos()->thenReturn($topicos);

        $forumController = Phake::partialMock('Forum\Controller\ForumController', $service);
        Phake::when($forumController)->params('forumId')->thenReturn(self::UM_ID);
        $topicosRetornados = $forumController->topicosAction()['topicos'];

        expect($topicosRetornados)->equals($topicos);
    }

    /**
     * @test
     */
    public function deveCriarUmNovoTopico() {
        $service = Phake::mock('Forum\Service\ForumService');
        $forum = Phake::mock('Forum\Model\Entidade\Forum');
        Phake::when($service)->find(self::UM_ID)->thenReturn($forum);
        $forumController = new ForumController($service);
        $forumController->getRequest()
                ->setMethod('POST')
                ->setPost(new Parameters(array('usuario' => self::UM_USUARIO, 'titulo' => self::UM_TITULO, 'texto' => self::UM_TEXTO)));

        $forumController->getEvent()->setRouteMatch(new RouteMatch(['forumId' => self::UM_ID]));

        $forumController->novoTopicoAction();

        Phake::verify($service)->criarTopico($forum, self::UM_USUARIO, self::UM_TITULO, self::UM_TEXTO);
    }

    /**
     * @test
     */
    public function deveRetornarJsonOKSeNovoTopicoForCriado() {
        $service = Phake::mock('Forum\Service\ForumService');
        Phake::when($service)->criarTopico(null, null, null, null)->thenReturn(Phake::mock('Forum\Model\Entidade\Topico'));
        $forumController = new ForumController($service);
        $forumController->getEvent()->setRouteMatch(new RouteMatch(['forumId' => self::UM_ID]));

        $response = $forumController->novoTopicoAction();

        expect(Json::decode($response->getContent())->inserido)->equals('OK');
    }

    /**
     * Este teste está complicado, pois temos que fazer um
     * spy parcial do controle para controlar o método 'params'
     * @test
     */
    public function deveRetornarJsonERROSeNovoTopicoNaoForCriado() {
        $service = Phake::mock('Forum\Service\ForumService');
        $forum = Phake::mock('Forum\Model\Entidade\Forum');

        Phake::when($service)->find(self::UM_ID)->thenReturn($forum);
        $forumController = new ForumController($service);
        $forumController->getEvent()->setRouteMatch(new RouteMatch(['forumId' => self::UM_ID]));

        $response = $forumController->novoTopicoAction();

        expect(Json::decode($response->getContent())->inserido)->equals('ERRO');
    }

}
