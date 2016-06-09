requirejs.config({
  paths: {
    requireLib: '../vendor/requirejs/require',
    jquery: '../vendor/jquery/dist/jquery',
    knockout: '../vendor/knockout/dist/knockout.debug',
    bootstrap: '../vendor/bootstrap/dist/js/bootstrap'
  },
  shim: {
    jquery: {
      exports: '$'
    },
    knockout: {
      deps: ['jquery'],
      exports: 'ko'
    },
    bootstrap: {
      deps: ['jquery']
    }
  },
  name: 'app',
  findNestedDependencies: true,
  out: 'app.min.js'
});

requirejs([
  'jquery',
  'knockout',
  'bootstrap',
  'app'
],
function($, ko, bootstrap, App) {
  'use strict';

  var app = new App();
  console.log('app instance created... booting');
  app.boot({
    debugMode: $('body').data('debug-mode')
  });
});
