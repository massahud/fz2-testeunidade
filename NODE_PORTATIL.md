Node portatil
=============

  Este documento é um passo a passo para colocar o node com o npm no windows mesmo sem ser administrador.

1. Faça download da versão windows binary (node.exe) em http://nodejs.org/download/
2. Crie o diretório em que o node será executado e copie o arquivo node.exe para ele
3. Faça download da última versão do zip do npm em http://nodejs.org/dist/npm
4. Descompacte o zip no diretório do node
5. Faça download da última versão do tgz do npm em http://nodejs.org/dist/npm
6. Abra este arquivo tgz no seu gerenciador de zip e descopacte apenas o arquivo npm (sem extensão) da pasta bin diretamente na pasta do node
7. Agora a pasta node deve possuir a seguinte estrutura:
  - node_modules/
  - node.exe
  - npm.cmd
  - npm

Após seguir estes passos, é possível executar o npm tanto no cmd do windows quando em shells bash, como o bash do msys (eu por exemplo uso o bash do msysgit).

Por exemplo para instalar o grunt globalmente:
  `npm install -g grunt` para obter o grunt
  `npm install -g grunt-cli` para obter os scripts executáveis do grunt (grunt.cmd e grunt) e colocá-los em no diretório do node.js



