
var controls = {
    menu: false,
    element: false,
    init: function(){
        this.element = jQuery('#cm-controls').find('ul');
        this.menu     = jQuery('#component-dropdown');
        this.bindEvents();
        this.show('default');
    },
    bindEvents: function(){
        this.element.on('click','a',function(event){
            controls.resolve(jQuery(this),event);
        });
        this.menu.on('click','a',function(event){
            layout.hideMenu();
            controls.resolve(jQuery(this),event);
        });
    },
    resolve: function(control, event){
        if(control.hasClass('control-disabled')) {
            return false;
        }
        var parts = control.data('action').split('.');
        var manager = window[parts[0]];
        manager[parts[1]](event);
    },
    hide: function(){
        this.element.hide();
    },
    show: function(action) {
        this.element.filter('.action-' + action).show();
    },
    displayCrud: function() {
        this.hide();
        this.show('crud');
    },
    enable: function(action) {
        jQuery('a[data-action="' + action + '"]').removeClass('control-disabled');
    },
    disable: function(action) {
        jQuery('a[data-action="' + action + '"]').addClass('control-disabled');
    },
    setIcon: function(action, icon) {
        jQuery('a[data-action="' + action + '"]').find('i').attr('class','fa ' + icon);
    },
    hideHints: function(){
        jQuery('.component-hint').hide();
    },
            
    /* actions */    
    cancel: function() { 
        controls.hide();
        controls.show('default');
        helper.modal.hide();
        helper.dialog.hide();
        layout.unlock();
    }
};