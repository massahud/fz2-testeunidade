<?php

namespace Forum\Controller;

use Forum\Service\ForumService;
use InvalidArgumentException;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractActionController;

class ForumController extends AbstractActionController {
    
    private $forumService;
    
    public function __construct(ForumService $forumService) {
        $this->forumService = $forumService;
      
    }

    public function indexAction() {
        $foruns = $this->forumService->listar();
        return array('foruns'=>$foruns);
    }

    public function topicosAction() {
        $forum = $this->forumService->find($this->params('forumId'));
        if ($forum == null) {
            throw new InvalidArgumentException('Não existe forum com id '.$this->params('forumId'));
        }
        
        return array('topicos'=>$forum->getTopicos());
        
    }
    
    /**
     * 
     * @return \Zend\Http\Response
     */
    public function novoTopicoAction() {
        $forum = $this->forumService->find($this->params('forumId'));
        $usuario = $this->getRequest()->getPost('usuario');
        $titulo = $this->getRequest()->getPost('titulo');
        $texto = $this->getRequest()->getPost('texto');
   
        $novoTopico = $this->forumService->criarTopico($forum, $usuario, $titulo, $texto);
        if (!empty($novoTopico)) {
            return $this->getResponse()->setContent(Json::encode(array('inserido'=>'OK')));
        } else {
            return $this->getResponse()->setContent(Json::encode(array('inserido'=>'ERRO')));
        }
        
    }

}
