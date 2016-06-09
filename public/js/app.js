define([
  'jquery',
  'knockout',
  'navbar/manager',
  'modal/private_area'
],
function($) {
  'use strict';

  var App = function() {
    this.modules = [
      { controller: 'navbar/manager', selector: $('#website-navbar-item') },
      { controller: 'modal/private_area', selector: $('#private_area_login_box') }
    ];
    this.params = null;
  };

  App.prototype = {
    constructor: App,
    boot: function(params) {
      this.params = params;
      if (!params.debugMode) {
        // Disable console logging...
        console.log = function() {};
      }

      var _this = this;

      this.modules.forEach(function(module) {
        // jquery selector boot process...
        module.selector.each(function() {
          requirejs([module.controller], function(ModuleInst) {
            var inst = new ModuleInst();
            inst.init(_this);
            inst.boot(module.selector);
          });
        });
      });
    }
  };

  return App;
});
