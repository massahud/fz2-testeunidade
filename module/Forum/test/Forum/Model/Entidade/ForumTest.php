<?php
namespace Forum\Model\Entidade;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase;
use \Assert;

/**
 * Description of ForumTest
 *
 * @group unidade
 * @small
 * @author massahud
 */
class ForumTest extends PHPUnit_Framework_TestCase {

    const UM_NOME = "comunidade";

    /**
     * @test
     */
    public function deveSerConstruidoComUmNome() {
        $forum = new Forum(static::UM_NOME);
        Assert\that($forum->getNome())->eq(static::UM_NOME);
    }
    
    /**
     * @test     
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Nome não pode ser nulo
     */
    public function naoPodeSerConstruidoComNomeNull() {
        $forum = new Forum(NULL);
    }

    /**
     * @test
     */
    public function deveSerConstruidoSemTopicos() {
        $forum = new Forum(static::UM_NOME);

        Assert\that($forum->getTopicos())->notNull()->count(0);
    }

}
