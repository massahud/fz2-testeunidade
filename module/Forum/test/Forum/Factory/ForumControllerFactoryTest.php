<?php
namespace Forum\Factory;

use Phockito;
use PHPUnit_Framework_TestCase;

/**
 * Description of ForumServiceFactoryTest
 * @group unidade
 * @small
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
