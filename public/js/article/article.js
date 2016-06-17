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

  var _deleteActiveChapter = function(article) {
    $.ajax({
      url: $('#article_editor').data('ajax_delete_chapter'),
      type: 'POST',
      data: { chapter_id: article.activeChapter.id },
      success: function() {
        console.log('ok');
        var position = article.activeChapter.position - 1;
        article.chapters.remove(article.activeChapter);
        article.activeChapter = null;
        article.chapters().forEach(function(item) {
          if (article.activeChapter !== null) {
            return;
          }
          if (item.position <= position) {
            article.setActiveChapter(item);
          }
        });
      }
    });
  };

  var Article = function(data, $scope) {
    var _this = this;
    this.id = data.id;
    this.activeChapter = null;
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

    this.activeContent = null;
    this.typeOfOp = null;

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
    if (this.typeOfOp === 'chapter') {
      _saveChapter(title, this);
      this.typeOfOp = null;
    }
  };
  Article.prototype.onBtnAddChapter = function() {
    this.typeOfOp = 'chapter';
    $('#article_item_value').val('');
    $('#article_item_title').html('Ajouter un titre de chapitre');
    $('#article_item').modal();

    setTimeout(function() {
      $('#article_item_value').focus();
    }, 500);
  };
  Article.prototype.onBtnRemoveChapter = function(item) {
    this.typeOfOp = 'chapter';
    $('#dlg_title').html('Suppression de chapitre');
    $('#dlg_content').html('Êtes vous sur de vouloir suprimer le chapitre <b>' + item.title() + '</b>');
    $('#decatime_dialog').modal();

  };
  Article.prototype.confirmOp = function() {
    if (this.typeOfOp === 'chapter') {
      _deleteActiveChapter(this);
    }
    this.typeOfOp = null;
  };

  return Article;
});
