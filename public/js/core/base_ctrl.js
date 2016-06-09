define(
[
  'jquery',
  'knockout'
],
function($, ko) {

  var BaseCtrl = function() {
    this.selector = null;
    this.app = null;
  };

  BaseCtrl.prototype = {
    constructor: BaseCtrl,
    init: function(app) {
      this.app = app;
    },
    boot: function(selector) {
      this.selector = selector;
      this.selector.data('controller', this);
      ko.applyBindings(this, this.selector[0]);
    },
    focusFirstInput: function(selector) {
      setTimeout(function() {
        var tbox = selector.find('input')[0];
        tbox.focus();
      }, 600);
    }
  };

  return BaseCtrl;
});
