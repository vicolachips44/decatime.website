define(
[
  'jquery',
  'knockout',
  'article/paragraph'
],
function($, ko, Paragraph) {

  var Content = function(data) {
    var _this = this;
    this.id = data.id;
    this.position = ko.observable(data.position);
    this.keywords = ko.observable(data.keywords);
    this.title = ko.observable(data.title);
    this.paragraphs = ko.observableArray([]);
    data.paragraphs.forEach(function(paragraph) {
      console.log(JSON.parse(paragraph));
      _this.paragraphs.push(new Paragraph(JSON.parse(paragraph)));
    });
  };

  Content.prototype.constructor = Content;

  return Content;
});
