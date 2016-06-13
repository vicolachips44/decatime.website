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
    console.log(this.rawData);
    this.article = new Article(this.rawData, $('#article_editor_article')[0]);
    // this.rawData.chapters.forEach(function(chapter) {
    //   var objChapter = JSON.parse(chapter);
    //   objChapter.contents.forEach(function(content) {
    //     var objContent = JSON.parse(content);
    //     objContent.paragraphs.forEach(function(paragraph) {
    //       var objParagraph = JSON.parse(paragraph);
    //     });
    //   });
    // });
    // console.log(this.rawData);
  };

  ArticleEditor.prototype.constructor = ArticleEditor;
  ArticleEditor.prototype.init = function() {

  };
  ArticleEditor.prototype.boot = function() {

  };

  return ArticleEditor;
});
