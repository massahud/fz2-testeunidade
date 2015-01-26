<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Forum\Factory;

use Forum\Service\ForumService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * Description of ForumControllerFactory
 *
 * @author massahud
 */
class ForumServiceFactory implements FactoryInterface {
    /**
      * Create service
      *
      * @param ServiceLocatorInterface $serviceLocator
      *
      * @return mixed
      */
     public function createService(ServiceLocatorInterface $serviceLocator)
     {
//         $realServiceLocator = $serviceLocator->getServiceLocator();
         $em = $serviceLocator->get('Doctrine\ORM\EntityManager');

         return new ForumService($em);
     }
}
