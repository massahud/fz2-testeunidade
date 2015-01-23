<?php

use Forum\Controller\ForumController;
use Forum\Model\Entidade\Forum;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumControllerTest
 * @group unidade
 * @author massahud
 */
class ForumControllerTest extends PHPUnit_Framework_TestCase {
    
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
    
    
}
