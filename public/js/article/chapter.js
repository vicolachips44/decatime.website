define(
[
  'jquery',
  'knockout',
  'article/content'
],
function($, ko, Content) {

  var Chapter = function(data, active, article) {
    var _this = this;
    this.article = article;
    this.id = data.id;
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

  Chapter.prototype.onChapterClick = function (item) {
    this.article.setActiveChapter(item);
  };

  Chapter.prototype.setActiveContent = function (content) {
    this.contents().forEach(function(item) {
      item.isActive(item.id === content.id);
    });
  };

  // CLASSIFIER SCOPE METHODS
  Chapter.newItem = function(title, pos) {
    return {
      id: null,
      title: title,
      position: pos,
      contents: []
    };
  };

  return Chapter;
});
