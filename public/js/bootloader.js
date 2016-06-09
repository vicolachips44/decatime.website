(function() {
  'use strict';

  window.debugMode = true;

  var script = document.createElement('script');
  script.type = 'text/javascript';

  script.setAttribute('data-main', '/js/require_config.js');
  script.src = '/../vendor/requirejs/require.js';

  document.body.appendChild(script);
}).call(this);
