'use strict';

/* jasmine specs for controllers go here */

describe('carregando fixture html', function () {

    beforeEach(function () {
        var fixtures = jasmine.getFixtures();
        fixtures.fixturesPath = 'base';
        fixtures.load('js-test/fixtures/exemplos/divs.html');
    });

    afterEach(function () {
        var fixtures = jasmine.getFixtures();
        fixtures.cleanUp();
        fixtures.clearCache();
    });


    it('algumas assercoes do jasmine-jquery', function () {
        expect('#div1').toBeInDOM(); 
        expect('#div1').toContainText('div1');
        expect('#div1').toHaveClass('xxx');
        expect('#div1').toBeVisible();

        expect('#div2').toContainText('2');
        expect('#div2').toBeHidden();
    });

});
