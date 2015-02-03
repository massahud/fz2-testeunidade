<?php

use Forum\Model\Entidade\Topico;
use Forum\Model\Entidade\Forum;
use \Assert;
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
    public function deveSerConstruidoComForumUsuarioTituloETexto() {
        $topico = new Topico(self::$UM_FORUM, static::UM_USUARIO, static::UM_TITULO, static::UM_TEXTO, self::$UMA_DATA);
        Assert\that($topico->getForum())->same(self::$UM_FORUM);
        Assert\that($topico->getUsuario())->same(static::UM_USUARIO);
        Assert\that($topico->getTitulo())->same(static::UM_TITULO);
        Assert\that($topico->getTexto())->same(static::UM_TEXTO);
    }
    
    /**
     * @test
     * @expectedException PHPUnit_Framework_Error
     * @expectedExceptionMessage __construct() must be an instance of Forum\Model\Entidade\Forum, null given
     */
    public function forumNaoPodeSerNulo() {
        $topico = new Topico(NULL, static::UM_USUARIO, static::UM_TITULO, static::UM_TEXTO, self::$UMA_DATA);       
    }
    
    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Usuário não pode ser nulo
     */
    public function usuarioNaoPodeSerNulo() {
        $topico = new Topico(self::$UM_FORUM, NULL, static::UM_TITULO, static::UM_TEXTO, self::$UMA_DATA);
    }
    
    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Título não pode ser nulo
     */
    public function tituloNaoPodeSerNulo() {
        $topico = new Topico(self::$UM_FORUM, static::UM_USUARIO, NULL, static::UM_TEXTO, self::$UMA_DATA);
    }
    
    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Texto não pode ser nulo
     */
    public function textoNaoPodeSerNulo() {
        $topico = new Topico(self::$UM_FORUM, static::UM_USUARIO, static::UM_TITULO, NULL, self::$UMA_DATA);
    }
    
    /**
     * @test
     * @expectedException PHPUnit_Framework_Error
     * @expectedExceptionMessage __construct() must be an instance of DateTime, null given
     */
    public function dataNaoPodeSerNula() {
        $topico = new Topico(self::$UM_FORUM, static::UM_USUARIO, static::UM_TITULO, static::UM_TEXTO, NULL);       
    }
    

    /**
     * @test
     */
    public function deveIniciarComZeroComentarios() {
        $topico = new Topico(self::$UM_FORUM, static::UM_USUARIO, static::UM_TITULO, static::UM_TEXTO, self::$UMA_DATA);
        Assert\that($topico->getComentarios())->notNull()->count(0);
    }
}
