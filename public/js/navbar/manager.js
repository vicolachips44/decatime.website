define(
[
  'jquery',
  'knockout',
  'core/base_ctrl'
],
function($, ko, BaseCtrl) {

  var NavbarManager = function() {
    this.popup = $('#private_area_login_box');
  };


  NavbarManager.prototype = new BaseCtrl();
  NavbarManager.prototype.constructor = NavbarManager;
  NavbarManager.prototype.onPrivateLinkClick = function() {
    this.popup.data('controller').init();
    this.popup.modal();
  };

  NavbarManager.prototype.onPrivateLogoutClick = function() {
    var endpoint = this.popup.find('form').first().data('endpoint');
    var tosend = {};

    $.ajax({
      url: endpoint,
      type: 'POST',
      data: tosend,
      success: function() {
        window.location = '/';
      }
    });
  };
  return NavbarManager;
});
