<?php

use Forum\Service\ForumService;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ForumServiceTest
 *
 * @author massahud
 */
class ForumServiceTest extends PHPUnit_Framework_TestCase {

    /**
     * @test
     * @expectedException PHPUnit_Framework_Error
     * @expectedExceptionMessage Argument 1 passed to Forum\Service\ForumService::__construct() must be an instance of Doctrine\ORM\EntityManager
     */
    public function naoDeveAceitarEntityManagerNulo() {
        new ForumService(null);
    }

}
