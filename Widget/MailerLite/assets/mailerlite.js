/**
 * @package ImpressPages
 *
 */

var IpWidget_MailerLite = function () {
    "use strict";

    var $this = this;

    this.widgetObject = null;
    this.confirmButton = null;
    this.popup = null;
    this.data = {};
    this.textarea = null;

    this.init = function (widgetObject, data) {

        this.widgetObject = widgetObject;
        this.data = data;
        var context = this; // set this so $.proxy would work below
        var $widgetOverlay = $('<div></div>')
            .css('position', 'absolute')
            .css('z-index', 5)
            .width(this.widgetObject.width())
            .height(Math.max(this.widgetObject.height(), 22));
        this.widgetObject.prepend($widgetOverlay);
        $widgetOverlay.on('click', $.proxy(openPopup, context));
    };

    this.onAdd = function () {
        $.proxy(openPopup, this)();
    };


    var openPopup = function () {
        var context = this;
        this.popup = $('#ipsWidgetMailerLitePopup');
        this.confirmButton = this.popup.find('.ipsConfirm');
        this.form = this.popup.find('.ipsModuleFormPublic');
        this.popup.modal(); // open modal popup

        this.popup.find('select[name=selectedGroup]').val(this.data.selectedGroup);

        this.confirmButton.off().on('click', function() {context.form.submit();});
        this.form.off().on('submit', $.proxy(save, this));

    };

    var save = function (e) {
        e.preventDefault();
        var selectedGroup = this.popup.find('select[name=selectedGroup]');

        var data = {
            selectedGroup: selectedGroup.val()
        };

        this.widgetObject.save(data, 1); // save and reload widget
        this.popup.modal('hide');
    };


};


