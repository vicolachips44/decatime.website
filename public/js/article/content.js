define(
[
  'jquery',
  'knockout',
  'article/paragraph'
],
function($, ko, Paragraph) {

  var Content = function(data, active, article) {
    var _this = this;
    this.id = data.id;
    this.article = article;
    this.position = ko.observable(data.position);
    this.keywords = ko.observable(data.keywords);
    this.title = ko.observable(data.title);
    this.paragraphs = ko.observableArray([]);
    this.isActive = ko.observable(active);

    data.paragraphs.forEach(function(paragraph) {
      _this.paragraphs.push(new Paragraph(JSON.parse(paragraph)));
    });
  };

  Content.prototype.constructor = Content;
  Content.prototype.onContentClick = function() {
    this.article.setActiveContent(this);
  };

  return Content;
});
