<?php
namespace Forum\Factory;

use Forum\Service\TimeService;
use Phockito;
use PHPUnit_Framework_TestCase;

/**
 * Description of ForumServiceFactoryTest
 * @group unidade
 * @small
 * @author massahud
 */
class ForumServiceFactoryTest extends PHPUnit_Framework_TestCase {
        
    /**
     * @test
     */
    public function deveObterEntityManagerETimeServiceDoServiceLocator() {   
        $locator = Phockito::mock('Zend\ServiceManager\ServiceLocatorInterface');
        
        $em = Phockito::mock('Doctrine\ORM\EntityManager');
        $timeService = new TimeService();
        Phockito:: when($locator->get('Doctrine\ORM\EntityManager'))->return($em);
        Phockito:: when($locator->get('Forum\Service\TimeService'))->return($timeService);
        
        
        $factory = new ForumServiceFactory();
        $service = $factory->createService($locator);

        expect($service)->notNull();
        Phockito::verify($locator)->get('Doctrine\ORM\EntityManager');
        Phockito::verify($locator)->get('Forum\Service\TimeService');
    }
}
