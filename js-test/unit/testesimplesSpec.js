'use strict';

/* jasmine specs for controllers go here */
describe('PhoneCat controllers', function() {

  beforeEach(function(){
    console.log('beforeEach')
  });

  describe('Teste simples', function() {
     var i = 1;
     it('should be 1', function() {
            expect(i).toBe(1);
     });
  });   
});
