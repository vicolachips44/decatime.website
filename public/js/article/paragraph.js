define(
[
  'jquery',
  'knockout'
],
function($, ko) {

  var Paragraph = function(data) {
    this.id = data.id;
    this.format = ko.observable(data.format);
    this.position = data.position;
    this.data = ko.observable(data.data);
    if (data.rawData !== null) {
      var rawDataImg = 'data:image/png;base64,' + data.rawData;
      this.rawData = ko.observable(rawDataImg);
    }
    this.version = data.version;
    this.simpleText = data.data !== null && data.data.length > 0;
  };

  Paragraph.prototype.constructor = Paragraph;

  return Paragraph;
});
