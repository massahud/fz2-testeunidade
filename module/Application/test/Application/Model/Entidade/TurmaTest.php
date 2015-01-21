<?php

use Application\Model\Entidade\Turma;
use Application\Model\Entidade\Aluno;

/**
 * @group unidade
 * @small
 */
class TurmaTest extends \PHPUnit_Framework_TestCase {

    public function quantidadeVagasValidas() {
        return [
            [0], // sem vagas
            [1], // 1 vaga
            [3] // vagas positivoas
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
     * @dataProvider quantidadeVagasValidas
     */
    public function __construct_deveConstruirComQuantidadeDeVagasValida($quantidadeDeVagasValida) {
        $turma = new Turma($quantidadeDeVagasValida);
        Assert\that($turma->getVagas())->eq($quantidadeDeVagasValida);
    }

    /**
     * @test
     * @param int $quantidadeDeVagasInvalida
     * @dataProvider quantidadeVagasInvalidas
     * @expectedException InvalidArgumentException
     */
    public function __construct_naoDeveConstruirComQuantidadeDeVagasInvalida($quantidadeDeVagasInvalida) {
        $turma = new Turma($quantidadeDeVagasInvalida);
    }

    /**
     * @test
     * @param int $vagas
     * @param string $descricao
     * @dataProvider quantidadeVagasValidas
     */
    public function __construct_devePossuirZeroAlunos($quantidadeDeVagasValida) {
        $turma = new Turma($quantidadeDeVagasValida);
        Assert\that($turma->getAlunos())->notNull()->isArray()->count(0);
    }

    /**
     * @test
     */
    public function adicionarAluno_devePermitirAdicionarAlunoSeTiverVagasÓÓ() {
        //dado
        $aluno = new Aluno();
        $turma = new Turma(1);

        //quando
        $turma->addAluno($aluno);

        //então
        $alunos = $turma->getAlunos();
        Assert\that($alunos)->count(1);
        Assert\that($aluno)->inArray($alunos);
    }

    /**
     * @test
     * @expectedException Application\Model\Entidade\Exception\TurmaSemVagaException
     */
    public function adicionarAluno_naoDevePermitirAdicionarAlunoSeNaoTiverVagas() {
        $aluno = new Aluno();
        $turmaSemVagas = new Turma(0);
        
        $turmaSemVagas->addAluno($aluno);
    }

}
