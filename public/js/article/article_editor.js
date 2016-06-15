define(
[
  'jquery',
  'knockout',
  'article/article'
],
function($, ko, Article) {

  var ArticleEditor = function() {
    console.log('in article editor constructor...');
    this.rawData = $('#article_editor').data('initial');
    this.article = new Article(this.rawData, $('#article_editor')[0]);
  };

  ArticleEditor.prototype.constructor = ArticleEditor;
  ArticleEditor.prototype.init = function() {

  };
  ArticleEditor.prototype.boot = function() {

  };

  return ArticleEditor;
});
