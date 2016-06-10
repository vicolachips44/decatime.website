define([
  'jquery',
  'knockout',
  'core/base_ctrl'
],
function($, ko, BaseCtrl) {
  'use strict';

  var PrivateArea = function() {
    this.user = ko.observable('');
    this.password = ko.observable('');
    this.errMsg = ko.observable('');
  };

  PrivateArea.prototype = new BaseCtrl();
  PrivateArea.prototype.constructor = PrivateArea;

  PrivateArea.prototype.init = function() {
    this.errMsg('');
    this.user('');
    this.password('');
    if (this.selector !== null) {
      this.focusFirstInput(this.selector);
    }
  };

  PrivateArea.prototype.onValidateClick = function(data, event) {
    var self = this;
    var target = $(event.currentTarget).data('uri-target');
    $.ajax({
      url: this.selector.find('form').first().data('endpoint'),
      type: 'POST',
      data: { login: this.user(), pwd: this.password() },
      success: function(resp) {
        self.selector.modal('hide');
        if (resp.status === 'OK') {
          window.location = target;
        }
      }
    });
  };

  return PrivateArea;
});
