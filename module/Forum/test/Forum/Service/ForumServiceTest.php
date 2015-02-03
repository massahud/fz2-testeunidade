<?php
namespace Forum\Service;

use DateTime;
use Forum\Service\ForumService;
use Phake;
use PHPUnit_Framework_Error;
use PHPUnit_Framework_TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumServiceTest
 * @group unidade
 * @small
 * @author massahud
 */
class ForumServiceTest extends PHPUnit_Framework_TestCase {
    
    const UM_ID = 123;
    const UM_USUARIO = "anonymous";
    const UM_TITULO = "Titulo";
    const UM_TEXTO = "Texto";


    /**
     * @test
     * @expectedException PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to Forum\Service\ForumService::__construct() must be an instance of Doctrine\ORM\EntityManager
     */
    public function naoDeveAceitarEntityManagerNulo() {
        new ForumService(null, Phake::mock('Forum\Service\TimeService'));
    }
    
    /**
     * @test
     * @expectedException PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 2 passed to Forum\Service\ForumService::__construct() must be an instance of Forum\Service\TimeService
     */
    public function naoDeveAceitarTimeServiceNulo() {
        new ForumService(Phake::mock('Doctrine\ORM\EntityManager'), null);
    }
    
    /**
     * @test
     */
    public function deveCriarNovoTopico() {
        $em = Phake::mock('Doctrine\ORM\EntityManager');
        $forum = Phake::mock('Forum\Model\Entidade\Forum');
        
        $timeService = Phake::mock('Forum\Service\TimeService');
        $data = new DateTime();
        Phake::when($timeService)->getDataHoraAtual()->thenReturn($data);
        $service = new ForumService($em, $timeService);
        
        $novoTopico = $service->criarTopico($forum, self::UM_USUARIO, self::UM_TITULO, self::UM_TEXTO);
        
        expect($novoTopico->getForum())->equals($forum);
        expect($novoTopico->getUsuario())->equals(self::UM_USUARIO);
        expect($novoTopico->getTitulo())->equals(self::UM_TITULO);
        expect($novoTopico->getTexto())->equals(self::UM_TEXTO);
        expect($novoTopico->getDataCriacao())->equals($data);
    }
    
    /**
     * @test
     */
    public function devePersistirNoEntityManagerONovoTopico() {
        $em = Phake::mock('Doctrine\ORM\EntityManager');
        $forum = Phake::mock('Forum\Model\Entidade\Forum');
        
        $timeService = Phake::mock('Forum\Service\TimeService');
        $data = new DateTime();
        Phake::when($timeService)->getDataHoraAtual()->thenReturn($data);
        $service = new ForumService($em, $timeService);
        
        $novoTopico = $service->criarTopico($forum, self::UM_USUARIO, self::UM_TITULO, self::UM_TEXTO);
        
        Phake::verify($em)->persist($novoTopico);
    }

}
