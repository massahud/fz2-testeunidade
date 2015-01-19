<?php

namespace Forum\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ForumController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function topicoAction()
    {
        return new ViewModel();
    }

    public function topicosAction()
    {
        return new ViewModel();
    }


}

