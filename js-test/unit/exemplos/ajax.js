'use strict';

/* jasmine specs for controllers go here */

describe('ajax simulado', function () {

    beforeEach(function () {
        $.ajaxReal = $.ajax;
    });

    afterEach(function () {
        $.ajax = $.ajaxReal;
    });
    
    it('pode usar uma fixture servida pelo karma', function (terminar) {
        var xhr = $.ajax({'url': '/base/js-test/fixtures/exemplos/simples.json',
            'dataType': 'json'});
        Promise.resolve(xhr).then(function (data) {
            expect(data.atributo).toBe('asd');
            terminar();
        });

    });

    it('pode ser simulado sobrescrevendo $.ajax', function () {
        $.ajax = function() { return Promise.resolve({atributo: 'asd'});};
        
        var xhr = $.ajax({'url': 'asd/qwe/asd',
            'dataType': 'json'});
        Promise.resolve(xhr).then(function (data) {
            expect(data.atributo).toBe('asd');
            terminar();
        });
    });

});
