<?php

namespace Forum\Fistures\Simples;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Forum\Model\Entidade\Topico;
use \DateTime;

/**
 * Description of ForumLoader
 *
 * @author massahud
 */
class LoadTopicoData extends AbstractFixture implements \Doctrine\Common\DataFixtures\OrderedFixtureInterface {

    const TOPICO_APRESENTACAO = 'topico-apresentacao';
    const TOPICO_SUPORTE = 'topico-suporte';
    const TOPICO_NAO_FUNCIONA = 'topico-nao-funciona';

    public function load(ObjectManager $manager) {


        $forumComunidade = $this->getReference(LoadForumData::FORUM_COMUNIDADE);
        $forumDuvidas = $this->getReference(LoadForumData::FORUM_DUVIDAS);

        $topicoApresentacao = new Topico($forumComunidade, 'massahud', 'Apresentação', 'Pessoal, usem este tópico para se apresentar aos demais usuários');
        $topicoApresentacao->setDataCriacao(DateTime::createFromFormat(DateTime::W3C, '2015-01-01T00:30:23-02:00'));

        $topicoSuporte = new Topico($forumComunidade, 'usuario', 'Suporte', 'Preciso de ajuda para fazer xxx');
        $topicoSuporte->setDataCriacao(DateTime::createFromFormat(DateTime::W3C, '2015-01-01T09:00:01-02:00'));

        $topicoNaoFunciona = new Topico($forumComunidade, 'bios', 'Não funciona', 'Não consigo de jeito nenhum fazer yyy funcionar');
        $topicoNaoFunciona->setDataCriacao(DateTime::createFromFormat(DateTime::W3C, '2015-01-01T09:00:00-02:00'));

        $manager->persist($topicoApresentacao);
        $manager->persist($topicoSuporte);
        $manager->persist($topicoNaoFunciona);


        $manager->flush();

        $this->addReference(self::TOPICO_APRESENTACAO, $topicoApresentacao);
        $this->addReference(self::TOPICO_SUPORTE, $topicoSuporte);
        $this->addReference(self::TOPICO_NAO_FUNCIONA, $topicoNaoFunciona);
    }

    public function getOrder() {
        return 20;
    }

}
