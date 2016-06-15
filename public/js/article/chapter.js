define(
[
  'jquery',
  'knockout',
  'article/content'
],
function($, ko, Content) {

  var Chapter = function(data, active, article) {
    var _this = this;
    this.id = data.id;
    this.article = article;
    this.position = data.position;
    this.title = ko.observable(data.title);
    this.contents = ko.observableArray([]);
    data.contents.forEach(function(content) {
      console.log(JSON.parse(content));
      _this.contents.push(new Content(JSON.parse(content)));
    });
    this.isActive = ko.observable(active);
  };

  Chapter.prototype.constructor = Chapter;
  Chapter.prototype.onChapterClick = function (data, event) {
    this.article.setActiveChapter(this);
    console.log(data);
    console.log(event);
  };

  return Chapter;
});
