<?php

use Forum\Model\Entidade\Forum;
use Forum\Model\Entidade\Comentario;

/**
 * Description of ForumTest
 *
 * @author massahud
 */
class ComentarioTest extends PHPUnit_Framework_TestCase {

    const UM_USUARIO = "zé";
    const UM_TEXTO = "huehuehue";

    /**
     * @test
     */
    public function deveSerConstruidaComUsuarioETexto() {
        $msg = new Comentario(static::UM_USUARIO, static::UM_TEXTO);
        Assert\that($msg->getUsuario())->eq(static::UM_USUARIO);
        Assert\that($msg->getTexto())->eq(static::UM_TEXTO);
    }

}
