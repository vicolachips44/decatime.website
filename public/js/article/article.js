define(
[
  'jquery',
  'knockout',
  'article/chapter',
  'article/content'
],
function($, ko, Chapter, Content) {

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
  var _saveContent = function(title, article) {
    var newContent = Content.newItem(title, article.activeChapter.contents().length + 1);
    $.ajax({
      url: $('#article_editor').data('ajax_save_content'),
      type: 'POST',
      data: { content: newContent, chapter_id: article.activeChapter.id },
      success: function(resp) {
        newContent.id = resp.id;
        var content = new Content(newContent, false, article);
        article.activeChapter.contents.push(content);
        article.setActiveContent(content);
      }
    });
  };

  var _deleteActiveChapter = function(article) {
    $.ajax({
      url: $('#article_editor').data('ajax_delete_chapter'),
      type: 'POST',
      data: { id: article.activeChapter.id },
      success: function() {
        var deletedPosition = article.activeChapter.position;
        article.chapters().forEach(function(item) {
          if (item.position > deletedPosition) {
            console.log('changing itm position of ' + item.title());
            item.position = item.position - 1;
          }
        });
        article.chapters.remove(article.activeChapter);
        article.activeChapter = null;
        if (article.chapters().length > -1) {
          article.setActiveChapter(article.chapters()[0]);
        }
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
    console.log('typeofop has been setted to null from constructor...');

    ko.applyBindings(this, $scope);
  };

  Article.prototype.constructor = Article;
  Article.prototype.setActiveChapter = function(chapter) {
    this.activeChapter = chapter;
    this.chapters().forEach(function(item) {
      item.isActive(item.id === chapter.id);
    });
  };
  Article.prototype.setActiveContent = function(content) {
    this.activeContent = content;
    this.activeChapter.contents().forEach(function(item) {
      item.isActive(item.id === content.id);
    });
  };
  Article.prototype.newItemTitle = function(title) {
    console.log('new title provided', title);
    console.log(this);
    console.log('type of operation is', Article.typeOfOp);
    if (Article.typeOfOp === 'chapter') {
      _saveChapter(title, this);
    }
    if (Article.typeOfOp === 'content') {
      _saveContent(title, this);
    }
    Article.typeOfOp = null;
    console.log('type of op has been setted to null from newItemTitle func');
  };
  Article.prototype.onBtnAddChapter = function() {
    Article.typeOfOp = 'chapter';
    $('#article_item_value').val('');
    $('#article_item_title').html('Ajouter un titre de chapitre');
    $('#article_item').modal();

    setTimeout(function() {
      $('#article_item_value').focus();
    }, 500);
  };
  Article.prototype.onBtnRemoveChapter = function(item) {
    var title = item.activeChapter.title();
    Article.typeOfOp = 'chapter';
    $('#dlg_title').html('Suppression de chapitre');
    $('#dlg_content').html('Êtes vous sur de vouloir suprimer le chapitre <b>' + title + '</b>');
    $('#decatime_dialog').modal();
  };
  Article.prototype.onBtnAddContent = function() {
    Article.typeOfOp = 'content';
    $('#article_item_value').val('');
    $('#article_item_title').html('Ajouter un titre de contenu');
    $('#article_item').modal();

    setTimeout(function() {
      $('#article_item_value').focus();
    }, 500);
    console.log('type of operation has been setted to', Article.typeOfOp);
  };
  Article.prototype.onBtnRemoveContent = function() {
    console.log('remove content...');
  };
  Article.prototype.confirmOp = function() {
    console.log('type of operation for confirm is ', Article.typeOfOp);
    if (Article.typeOfOp === 'chapter') {
      _deleteActiveChapter(this);
    }
    if (Article.typeOfOp === 'content') {
      console.log('confirm: delete content');
    }
    Article.typeOfOp = null;
    console.log('type of op has been setted to null from confirmOp function');
  };

  Article.typeOfOp = null;

  return Article;
});
