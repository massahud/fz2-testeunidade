<?php

use Application\Model\Entidade\Turma;
use Application\Model\Entidade\Aluno;
class TurmaTest extends PHPUnit_Framework_TestCase {
    
    public function quantidadeVagasValidas() {
        return [
          [0, "sem vagas"],
          [1, "uma vaga"],
          [3, "vagas positivas"]
        ];
    }
    
    public function quantidadeVagasInvalidas() {
        return [
          [-1], // vaga negativa
          [1.1], // vaga não inteira
          ["asd"] // string
        ];
    }
    
    /**
     * @test
     * @param int $quantidadeDeVagasValida
     * @param string $descricao
     * @dataProvider quantidadeVagasValidas
     */
    public function __construct__deveConstruirComQuantidadeDeVagasValidas($quantidadeDeVagasValida, $descricao) {
        $turma = new Turma($quantidadeDeVagasValida);        
        Assert\that($turma->getVagas(), $descricao)->eq($quantidadeDeVagasValida);
    }
    
    /**
     * @test
     * @param int $quantidadeDeVagasValida
     * @param string $descricao
     * @dataProvider quantidadeVagasInvalidas
     * @expectedException InvalidArgumentException
     */
    public function __construct__naoDeveConstruirComQuantidadeDeVagasValidas($quantidadeDeVagasValida) {
        $turma = new Turma($quantidadeDeVagasValida);                
    }

    /**
     * @test
     * @expectedException TurmaSemVagaException
     */
//    public function adicionarAluno_naoDevePermitirAdicionarAlunoSeNaoTiverVagas() {
//        $aluno = Phockito::mock('Application\Model\Aluno');
//        $turmaSemVagas = new Turma(0);
//        
//    
//    }

}
