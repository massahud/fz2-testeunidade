<?php

use Forum\Model\Entidade\Topico;
/**
 * Description of ForumTest
 *
 * @author massahud
 */
class TopicoTest extends PHPUnit_Framework_TestCase {    
    const UM_USUARIO = 'Troll';    
    const UM_TITULO = 'Bolacha ou biscoito?';    
    const UM_TEXTO = 'Eu chamo de biscoito. E você?';

    /**
     * @test
     */
    public function podeSerConstruidoComUsuarioTituloETexto() {
        $topico = new Topico(static::UM_USUARIO, static::UM_TITULO, static::UM_TEXTO);
        Assert\that($topico->getUsuario())->eq(static::UM_USUARIO);
        Assert\that($topico->getTitulo())->eq(static::UM_TITULO);
        Assert\that($topico->getTexto())->eq(static::UM_TEXTO);
    }
    
    /**
     * @test
     */
    public function deveIniciarComZeroComentarios() {
        $topico = new Topico(static::UM_USUARIO, static::UM_TITULO, static::UM_TEXTO);
        Assert\that($topico->getComentarios())->notNull()->count(0);
    }        
    
}
