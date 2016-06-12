(function($) {
  var dummyObj = {
    doSomething: function(what) {
      console.log('about to ' + what + ' something!');
    },
    getANumber: function() {
      return 404;
    }
  };

  return dummyObj;
}(jQuery));
