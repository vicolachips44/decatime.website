define(
[
  'jquery',
  'knockout',
  'article/chapter'
],
function($, ko, Chapter) {

  var _saveChapter = function(title, article) {
    var newChapter = Chapter.newItem(title, article.chapters().length + 1);

    $.ajax({
      url: $('#article_editor').data('ajax_save_chapter'),
      type: 'POST',
      data: { chapter: newChapter, article_id: article.id },
      success: function(resp) {
        newChapter.id = resp.id;
        var chapter = new Chapter(newChapter, false, article);
        article.chapters.push(chapter);
        article.setActiveChapter(chapter);
      }
    });
  };

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
      var objChapter = JSON.parse(chapter);
      var active = objChapter.position === 1;
      _this.chapters.push(new Chapter(objChapter, active, _this));
    });

    this.activeChapter = null;
    this.activeContent = null;
    this.typeOfAdd = '';

    ko.applyBindings(this, $scope);
  };

  Article.prototype.constructor = Article;
  Article.prototype.setActiveChapter = function (chapter) {
    this.activeChapter = chapter;
    this.chapters().forEach(function(item) {
      item.isActive(item.id === chapter.id);
    });
  };
  Article.prototype.setActiveContent = function (content) {
    this.activeContent = content;
    this.activeChapter.contents().forEach(function(item) {
      item.isActive(item.id === content.id);
    });
  };
  Article.prototype.newItemTitle = function(title) {
    if (this.typeOfAdd === 'chapter') {
      _saveChapter(title, this);
    }
  };
  Article.prototype.onBtnAddChapter = function() {
    this.typeOfAdd = 'chapter';
    $('#article_item_value').val('');
    $('#article_item_title').html('Ajouter un titre de chapitre');
    $('#article_item').modal();

    setTimeout(function() {
      $('#article_item_value').focus();
    }, 500);
  };
  Article.prototype.onBtnRemoveChapter = function() {

  };

  return Article;
});
