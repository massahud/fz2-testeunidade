<?php

namespace Forum\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Json\Json;

class ForumController extends AbstractActionController {

    public function indexAction() {
                       
        return new ViewModel();
    }

    public function topicoAction() {
        $topico = array(
            'forumId' => $this->params('forumId'),
            'topicoId' => $this->params('topicoId'),
            'titulo' => 'titulo do topico',
            'mensagens' => array(
                ['usuario' => 'nome do usuario',
                    'texto' => 'texto da mensagem'],
                ['usuario' => 'nome do usuario',
                    'texto' => 'texto da mensagem'],
                ['usuario' => 'nome do usuario',
                    'texto' => 'texto da mensagem'],
                ['usuario' => 'nome do usuario',
                    'texto' => 'texto da mensagem']
            )
        );
        if (!$this->getRequest()->isXmlHttpRequest()) {
            $data = array(
                'result' => true,
                'controller' => 'Forum',
                'action' => 'topico',
                'topico' => $topico
            );
            return $this->getResponse()->setContent(Json::encode($data));
        }


        return $topico;
    }

    public function topicosAction() {
        return new ViewModel();
    }

}
