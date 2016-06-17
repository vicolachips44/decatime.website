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
    var _this = this;
    $('#article_item_validate_button').on('click', function() {
      $('#article_item').modal('hide');
      _this.article.newItemTitle($('#article_item_value').val());
    });
    $('#decatime_dialog').on('click', function() {
      $('#decatime_dialog').modal('hide');
      _this.article.confirmOp();
    });
  };
  ArticleEditor.prototype.boot = function() {

  };

  return ArticleEditor;
});
