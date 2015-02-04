describe('apagar topico', function() {
    
    beforeEach(function () {
        $.ajaxReal = $.ajax;
        var fixtures = jasmine.getFixtures();
        fixtures.fixturesPath = 'base';
        fixtures.load('js-test/fixtures/forum/apagarTopico.html');
    });

    afterEach(function () {
        console.log('FIM');
        $.ajax = $.ajaxReal;
        var fixtures = jasmine.getFixtures();
        fixtures.cleanUp();
        fixtures.clearCache();
    });

    it('deve remover o topico do HTML ao apagar', function (done) {
        $.ajax = function() { return $.ajaxReal('/base/js-test/fixtures/forum/apagado.txt', {'dataType': 'json'});}
        
        Forum.apagarTopico(1,3).then(function () {
            expect($('li').last().text()).not.toBe('Suporte');
            done();
        }
        );
    });
});