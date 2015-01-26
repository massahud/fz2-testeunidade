<?php

use Forum\Factory\ForumControllerFactory;
use Forum\Model\Entidade\Forum;

/**
 * Description of ForumServiceFactoryTest
 *
 * @author massahud
 */
class ForumControllerFactoryTest extends PHPUnit_Framework_TestCase {

    const UM_ID = 123;

    /**
     * @test
     */
    public function deveObterForumServiceDoServiceLocatorInterno() {
        
        $locator = Phockito::mock('Zend\ServiceManager\ServiceLocatorInterface');
        $locatorInterno = Phockito::mock('Zend\ServiceManager\ServiceLocatorInterface');
        
        $forumService = Phockito::mock('Forum\Service\ForumService');

        Phockito::when($locator->getServiceLocator())->return($locatorInterno);        
        Phockito::when($locatorInterno->get('Forum\Service\ForumService'))->return($forumService);        
        
        $factory = new ForumControllerFactory();
        $controller = $factory->createService($locator);
        expect($controller)->notNull();
        Phockito::verify($locatorInterno)->get('Forum\Service\ForumService');
        
    }

}
