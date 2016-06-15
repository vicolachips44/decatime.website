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
    this.isActive = ko.observable(active);

    data.contents.forEach(function(content) {
      var contentObj = JSON.parse(content);
      var isActive = contentObj.position === 1;
      _this.contents.push(new Content(contentObj, isActive, _this));
    });
  };

  Chapter.prototype.constructor = Chapter;
  Chapter.prototype.onChapterClick = function () {
    this.article.setActiveChapter(this);
  };
  Chapter.prototype.setActiveContent = function (content) {
    this.contents().forEach(function(item) {
      item.isActive(item.id === content.id);
    });
  };

  return Chapter;
});
