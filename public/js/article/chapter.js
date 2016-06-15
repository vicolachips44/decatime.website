define(
[
  'jquery',
  'knockout',
  'article/content'
],
function($, ko, Content) {

  var Chapter = function(data) {
    var _this = this;
    this.id = data.id;
    this.position = data.position;
    this.title = ko.observable(data.title);
    this.contents = ko.observableArray([]);
    data.contents.forEach(function(content) {
      console.log(JSON.parse(content));
      _this.contents.push(new Content(JSON.parse(content)));
    });
  };

  Chapter.prototype.constructor = Chapter;

  return Chapter;
});
