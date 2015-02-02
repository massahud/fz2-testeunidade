<?php

use Forum\Model\Entidade\Comentario;

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

    /**
     *
     * @var \Forum\Model\Entidade\Topico 
     */
    private $UM_TOPICO;
    private $UMA_DATA;

    /**
     * @beforeMethod
     */
    public function setUp() {
        $this->UM_TOPICO = Phake::mock('Forum\Model\Entidade\Topico');
        $this->UMA_DATA = new DateTime();
    }

    /**
     * @test
     */
    public function deveSerConstruidoComTopicoUsuarioETexto() {

        $comentario = new Comentario($this->UM_TOPICO, self::UM_USUARIO, self::UM_TEXTO, $this->UMA_DATA);
        Assert\that($comentario->getTopico())->same($this->UM_TOPICO);
        Assert\that($comentario->getUsuario())->same(self::UM_USUARIO);
        Assert\that($comentario->getTexto())->same(self::UM_TEXTO);
        Assert\that($comentario->getDataCriacao())->same($this->UMA_DATA);
    }

}
