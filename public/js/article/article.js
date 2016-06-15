define(
[
  'jquery',
  'knockout',
  'article/chapter'
],
function($, ko, Chapter) {

  var Article = function(data, $scope) {
    var _this = this;
    this.id = data.id;
    this.title = ko.observable(data.title);
    this.shortDescription = ko.observable(data.shortDescription);
    this.smallImageSrc = data.smallImage === null ?
      null : ko.observable('data:image/png;base64,' + data.smallImage);
    this.smallImagePath = ko.observable(null);
    this.bigImageSrc = data.bigImage === null ?
      null : ko.observable('data:image/png;base64,' + data.bigImage);
    this.createdAt = data.createdAt === null ?
      null : ko.observable(data.createdAt.date);
    this.updatedAt = data.updatedAt === null ?
      null : ko.observable(data.updatedAt.date);
    this.publishedAt = data.publishedAt === null ?
      null : ko.observable(data.publishedAt.date);

    this.chapters = ko.observableArray([]);
    data.chapters.forEach(function(chapter) {
      _this.chapters.push(new Chapter(JSON.parse(chapter)));
    });

    ko.applyBindings(this, $scope);
  };

  Article.prototype.constructor = Article;

  return Article;
});
