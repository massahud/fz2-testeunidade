<?php

namespace Forum\Fistures\Simples;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Forum\Model\Entidade\Comentario;
use \DateTime;

/**
 * Description of ForumLoader
 *
 * @author massahud
 */
class LoadComentarioData extends AbstractFixture implements OrderedFixtureInterface {

    const COMENTARIO_RESPOSTA_PADRAO = "comentario-resposta-padrao";
    const COMENTARIO_JA_TENTEI = "comentario-ja-tentei";
    const COMENTARIO_FORUM_ERRADO = "comentario-forum-errado";

    public function load(ObjectManager $manager) {

        $topicoApresentacao = $this->getReference(LoadTopicoData::TOPICO_APRESENTACAO);
        $topicoSuporte = $this->getReference(LoadTopicoData::TOPICO_SUPORTE);
        $topicoNaoFunciona = $this->getReference(LoadTopicoData::TOPICO_NAO_FUNCIONA);

        $comentarioForumErrado = new Comentario(
                $topicoSuporte, 
                'AdminChato', 
                'Esse não é o fórum correto de se pedir isso, fechando o topico.',
                DateTime::createFromFormat(DateTime::W3C, '2015-01-22T16:30:23-02:00')
        );

        $comentarioRespostaPadrao = new Comentario(
                $topicoNaoFunciona, 
                'Atendente', 
                'Senhor, já tentou desligar e ligar o aparelho?',
                DateTime::createFromFormat(DateTime::W3C, '2015-01-10T08:00:00-02:00')
        );

        $comentarioJaTentei = new Comentario(
                $topicoNaoFunciona, 
                'bios', 
                'Foi a primeira coisa que tentei!',
                DateTime::createFromFormat(DateTime::W3C, '2015-01-10T08:24:00-02:00')
        );

        $manager->persist($comentarioForumErrado);
        $manager->persist($comentarioRespostaPadrao);
        $manager->persist($comentarioJaTentei);

        $manager->flush();

        $this->addReference(self::COMENTARIO_FORUM_ERRADO, $comentarioForumErrado);
        $this->addReference(self::COMENTARIO_JA_TENTEI, $comentarioJaTentei);
        $this->addReference(self::COMENTARIO_RESPOSTA_PADRAO, $comentarioRespostaPadrao);
    }
    

    public function getOrder() {
        return 30;
    }

}
