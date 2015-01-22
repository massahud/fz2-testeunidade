<?php

namespace Forum\Fistures\Simples;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Forum\Model\Entidade\Forum;
use \DateTime;

/**
 * Description of ForumLoader
 *
 * @author massahud
 */
class LoadForumData extends AbstractFixture implements OrderedFixtureInterface {
    
    const FORUM_COMUNIDADE = 'forum-comunidade';
    const FORUM_DUVIDAS = 'forum-duvidas';
    const FORUM_SEM_TOPICOS = 'forum-sem-topicos';

    public function load(ObjectManager $manager) {
        $forumComunidade = new Forum('Comunidade');
        $forumDuvidas = new Forum('Dúvidas');
        $forumSemTopicos = new Forum('Sem tópicos');
        $manager->persist($forumComunidade);
        $manager->persist($forumDuvidas);
        $manager->persist($forumSemTopicos);
        $manager->flush();

        print 'flush forum'."\n";
        $this->addReference(self::FORUM_COMUNIDADE, $forumComunidade);
        $this->addReference(self::FORUM_DUVIDAS, $forumDuvidas);
        $this->addReference(self::FORUM_SEM_TOPICOS, $forumSemTopicos);
    }

    public function getOrder() {
        return 10;
    }

}
