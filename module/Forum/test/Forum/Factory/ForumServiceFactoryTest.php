<?php

use Forum\Factory\ForumServiceFactory;

/**
 * Description of ForumServiceFactoryTest
 *
 * @author massahud
 */
class ForumServiceFactoryTest extends PHPUnit_Framework_TestCase {
        
    /**
     * @test
     */
    public function deveObterEntityManagerDoServiceLocator() {   
        $locator = Phockito::mock('Zend\ServiceManager\ServiceLocatorInterface');
        
        $em = Phockito::mock('Doctrine\ORM\EntityManager');
        
        Phockito:: when($locator->get('Doctrine\ORM\EntityManager'))->return($em);
        
        $factory = new ForumServiceFactory();
        $service = $factory->createService($locator);

        expect($service)->notNull();
        Phockito::verify($locator)->get('Doctrine\ORM\EntityManager');
    }
}
