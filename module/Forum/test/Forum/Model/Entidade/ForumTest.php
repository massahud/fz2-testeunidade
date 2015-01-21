<?php

use Forum\Model\Entidade\Forum;

/**
 * Description of ForumTest
 *
 * @group unidade
 * @small
 * @author massahud
 */
class ForumTest extends PHPUnit_Framework_TestCase {

    const UM_NOME = "comunidade";
    const OUTRO_NOME = "perguntas";

    /**
     * @test
     */
    public function podeSerConstruidoSemNome() {       
        $forum = new Forum();
        Assert\that($forum->getNome())->eq(NULL);
    }

    /**
     * @test
     */
    public function podeSerConstruidoComUmNome() {
        $forum = new Forum(static::UM_NOME);
        Assert\that($forum->getNome())->eq(static::UM_NOME);
    }

    /**
     * @test
     */
    public function deveSerPossivelAtribuirUmNome() {
        $forum = new Forum(static::UM_NOME);

        $forum->setNome(static::OUTRO_NOME);

        Assert\that($forum->getNome())->eq(static::OUTRO_NOME);
    }

    /**
     * @test
     */
    public function deveIniciarSemTopicos() {
        $forum = new Forum();

        Assert\that($forum->getTopicos())->notNull()->count(0);
    }

}
