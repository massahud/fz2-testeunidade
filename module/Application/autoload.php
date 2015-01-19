<?php
$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Application\Module'                            => $vendorDir . '\module\Application/M:/zf2-testeunidade/module/Application/Module.php',
    'Application\Controller\IndexController'        => $vendorDir . '\module\Application/M:/zf2-testeunidade/module/Application/src/Application/Controller/IndexController.php',
    'Application\Model\Aluno'              => $vendorDir . '\module\Application/M:/zf2-testeunidade/module/Application/src/Application/Model/Aluno.php',
    'Application\Model\Negocio\ControleDeMatricula' => $vendorDir . '\module\Application/M:/zf2-testeunidade/module/Application/src/Application/Model/Negocio/ControleDeMatricula.php',
    'Application\Model\Turma'              => $vendorDir . '\module\Application/M:/zf2-testeunidade/module/Application/src/Application/Model/Turma.php',
    'Application\Bootstrap'                         => $vendorDir . '\module\Application/M:/zf2-testeunidade/module/Application/test/Bootstrap.php',
);