<?php

use Forum\Model\Entidade\Topico;
use Forum\Model\Entidade\Forum;

/**
 * Description of ForumTest
 *
 * @group unidade
 * @small
 * @author massahud
 */
class TopicoTest extends PHPUnit_Framework_TestCase {

    const UM_USUARIO = 'Troll';
    const UM_TITULO = 'Bolacha ou biscoito?';
    const UM_TEXTO = 'Eu chamo de biscoito. E você?';
    const OUTRO_USUARIO = 'Do contra';
    const OUTRO_TEXTO = 'Pra mim é bolacha.';
    const UM_NOME_DE_FORUM = 'Meu forum';

    private static $UM_FORUM;
    private static $UMA_DATA;

    /**
     * @beforeClass
     */
    public static function beforeClass() {
        self::$UM_FORUM = new Forum(static::UM_NOME_DE_FORUM);
        self::$UMA_DATA = new DateTime();
    }

    /**
     * @test
     */
    public function podeSerConstruido() {
        $topico = new Topico();
        Assert\that($topico->getForum())->eq(NULL);
        Assert\that($topico->getUsuario())->eq(NULL);
        Assert\that($topico->getTitulo())->eq(NULL);
        Assert\that($topico->getTexto())->eq(NULL);
    }

    /**
     * @test
     */
    public function podeSerConstruidoComForumUsuarioTituloETexto() {
        $topico = new Topico(self::$UM_FORUM, static::UM_USUARIO, static::UM_TITULO, static::UM_TEXTO);
        Assert\that($topico->getForum())->same(self::$UM_FORUM);
        Assert\that($topico->getUsuario())->same(static::UM_USUARIO);
        Assert\that($topico->getTitulo())->same(static::UM_TITULO);
        Assert\that($topico->getTexto())->same(static::UM_TEXTO);
    }

    /**
     * @test
     */
    public function deveIniciarComZeroComentarios() {
        $topico = new Topico();
        Assert\that($topico->getComentarios())->notNull()->count(0);
    }

    /**
     * @test
     */
    public function podeSerAtribuidoUmForum() {

        $topico = new Topico();

        $topico->setForum(self::$UM_FORUM);

        Assert\that($topico->getForum())->same(self::$UM_FORUM);
    }

    /**
     * @test
     */
    public function podeSerAtribuidoUmUsuario() {

        $topico = new Topico();

        $topico->setUsuario(static::UM_USUARIO);

        Assert\that($topico->getUsuario())->same(static::UM_USUARIO);
    }

    /**
     * @test
     */
    public function podeSerAtribuidoUmTitulo() {

        $topico = new Topico();

        $topico->setTitulo(static::UM_TITULO);

        Assert\that($topico->getTitulo())->same(static::UM_TITULO);
    }

    /**
     * @test
     */
    public function podeSerAtribuidoUmTexto() {

        $topico = new Topico();

        $topico->setTexto(static::UM_TEXTO);

        Assert\that($topico->getTexto())->same(static::UM_TEXTO);
    }

    /**
     * @test
     */
    public function podeSerAtribuidaUmaDataDeCriacao() {
        $topico = new Topico();

        $topico->setDataCriacao(self::$UMA_DATA);

        Assert\that($topico->getDataCriacao())->same(self::$UMA_DATA);
    }

}
