<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Forum\Factory;

use Forum\Controller\ForumController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Description of ForumControllerFactory
 *
 * @author massahud
 */
class ForumControllerFactory implements FactoryInterface {
    /**
      * Create service
      *
      * @param ServiceLocatorInterface $serviceLocator
      *
      * @return mixed
      */
     public function createService(ServiceLocatorInterface $serviceLocator)
     {
        $realServiceLocator = $serviceLocator->getServiceLocator();
         $forumService        = $realServiceLocator->get('Forum\Service\ForumService');

         return new ForumController($forumService);
     }
}
