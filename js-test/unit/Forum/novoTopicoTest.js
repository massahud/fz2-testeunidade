'use strict';

/* jasmine specs for controllers go here */

describe('Novo topico', function () {

    beforeEach(function () {
        $.ajaxReal = $.ajax;
        var fixtures = jasmine.getFixtures();
        fixtures.fixturesPath = 'base';
        fixtures.load('js-test/fixtures/forum/novoTopico.html');
    });

    afterEach(function () {
        console.log('FIM');
        $.ajax = $.ajaxReal;
        var fixtures = jasmine.getFixtures();
        fixtures.cleanUp();
        fixtures.clearCache();
    });



    it('deve obter entradas dos inputs da página html', function () {
        var dados = Forum.getDadosNovoTopico();
        expect(dados.forumId).toBe(123);
        expect(dados.usuario).toBe('Um usuário');
        expect(dados.titulo).toBe('Um título');
        expect(dados.texto).toBe('Um texto');

        console.log(jQuery(document.querySelector('#topicos>ul')));

    });

    it('deve criar o ajax passando as entradas obtidas', function () {
        sinon.stub(jQuery, 'ajax');

        Forum.criarRequisicaoAjaxNovoTopico();

        var opts = jQuery.ajax.args[0][0]; // primeiro argumento da primeira chamada

        expect(jQuery.ajax.called).toBeTruthy();
        expect(opts['url']).toEqual('/tu/forum/123/novo-topico');
        expect(opts['data'].usuario).toBe('Um usuário');
        expect(opts.data.titulo).toBe('Um título');
        expect(opts.data.texto).toBe('Um texto');

        jQuery.ajax.restore();
    });

    it('deve adicionar o novo tópico no DOM se ajax retornou OK', function (done) {
        jQuery.ajax = function () {
            return Promise.resolve({'inserido': 'OK'});
        };
        
        Forum.criarNovoTopico().then(function() {
            expect(jQuery('li.topico').length).toBe(2);
            expect(jQuery('li.topico').last().text()).toBe('Um título');
            done();
        });

    });

});
