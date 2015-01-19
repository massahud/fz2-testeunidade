<?php

use Forum\Model\Entidade\Forum;

/**
 * Description of ForumTest
 *
 * @author massahud
 */
class ForumTest extends PHPUnit_Framework_TestCase {
    
    const UM_NOME = "fórum";
    /**
     * @test
     */
    public function devePossuirUmNome() {
        $forum = new Forum();
        
        $forum->setNome(UM_NOME);
        
        Assert\that($forum->getNome())->eq(UM_NOME);
    }
}
