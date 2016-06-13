define(
[
  'jquery',
  'knockout',
  'core/base_ctrl'
],
function($, ko, BaseCtrl) {

  var ArticleEditor = function() {
    console.log('in article editor constructor...');
  };

  ArticleEditor.prototype = new BaseCtrl();
  ArticleEditor.prototype.constructor = ArticleEditor;

  return ArticleEditor;
});
