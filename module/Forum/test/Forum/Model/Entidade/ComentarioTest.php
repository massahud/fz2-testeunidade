<?php

use Forum\Model\Entidade\Forum;
use Forum\Model\Entidade\Comentario;
use Forum\Model\Entidade\Topico;

/**
 * Description of ForumTest
 * 
 * @group unidade
 * @small
 * @author massahud
 */
class ComentarioTest extends PHPUnit_Framework_TestCase {

    const UM_USUARIO = "zé";
    const UM_TEXTO = "huehuehue";

    private static $UM_TOPICO;
    private static $UMA_DATA;

    /**
     * @beforeClass
     */
    public static function beforeClass() {
        self::$UM_TOPICO = new Topico();
        self::$UMA_DATA = new DateTime();
    }

    /**
     * @test
     */
    public function podeSerConstruidoComTopicoUsuarioETexto() {

        $comentario = new Comentario(self::$UM_TOPICO, static::UM_USUARIO, static::UM_TEXTO);
        Assert\that($comentario->getTopico())->same(self::$UM_TOPICO);
        Assert\that($comentario->getUsuario())->same(static::UM_USUARIO);
        Assert\that($comentario->getTexto())->same(static::UM_TEXTO);
    }

    /**
     * @test
     */
    public function podeSerAtribuidaUmaDataDeCriacao() {
        $comentario = new Comentario();

        $comentario->setDataCriacao(self::$UMA_DATA);

        Assert\that($comentario->getDataCriacao())->same(self::$UMA_DATA);
    }

    /**
     * @test
     */
    public function podeSerAtribuidoUmTopico() {
        $comentario = new Comentario();
        $comentario->setTopico(self::$UM_TOPICO);
        Assert\that($comentario->getTopico())->same(self::$UM_TOPICO);
    }

}
