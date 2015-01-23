<?php

namespace Forum\Controller;

use Forum\Service\ForumService;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ForumController extends AbstractActionController {
    
    private $forumService;
    
    public function __construct(ForumService $forumService) {
        $this->forumService = $forumService;
    }

    public function indexAction() {
        $foruns = $this->forumService->listar();
        return array('foruns'=>$foruns);
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
        if ($this->getRequest()->isXmlHttpRequest()) {
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
