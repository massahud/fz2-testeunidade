'use strict';

/* jasmine specs for controllers go here */

describe('ajax simulado', function () {

    beforeEach(function () {
        $.ajaxReal = $.ajax;
    });

    afterEach(function () {
        $.ajax = $.ajaxReal;
    });

    it('pode usar uma fixture servida pelo karma', function (done) {

        var xhr = $.ajax({'url': '/base/js-test/fixtures/exemplos/simples.json',
            'dataType': 'json'});

        Promise.resolve(xhr).then(function (data) {
            expect(data.atributo).toBe('asd');
            done();
        });

    });

    it('pode ser simulado sobrescrevendo $.ajax', function () {
        $.ajax = function () {
            return Promise.resolve({atributo: 'asd'});
        };

        var xhr = $.ajax({'url': 'asd/qwe/asd',
            'dataType': 'json'});

        Promise.resolve(xhr).then(function (data) {
            expect(data.atributo).toBe('asd');
            return 'asd';
        }).then(function (dado) {
            console.log(dado);
            throw('um erro');
        }).then(function (dado) {
            console.log('then depois do throw');
        }, function (falha) {
            console.log('falhou ' + falha);
            throw falha;
        }).catch(function (err) {
            console.log(err);
            terminar();
        });
    });

});
