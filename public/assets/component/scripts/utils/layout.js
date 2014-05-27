"use strict";

var layout = {
    locked: false,
    overlay: false,
    body: false,
    init: function(){        
        this.overlay = jQuery('#component-overlay');
        this.body = jQuery('body');
        this.bindEvents();
    },
    lock: function(){
        this.locked = true;
    },
    unlock: function(){
        this.locked = false;
    },
    bindEvents: function(){ 
        this.overlay.bind('click',function(event){
            helper.keyboard.addEvent('ESCAPE',controls.cancel);
            layout.lock();
            componentManager.resolveAction(event);
        });
        this.overlay.bind('contextmenu',function(event){
            layout.showMenu(jQuery(this),event);
            event.preventDefault();
        });
    },
    hideOverlay: function(){
        this.overlay.hide();
    },
    moveOverlay: function(element) {
        if( this.locked ) {
            return false;
        }     
        var position = element.offset(),
            width    = element.outerWidth(),
            height   = element.outerHeight(),
            icon     = element.data('icon') ? element.data('icon') : this.overlay.data('icon');    
    
        // move the overlay
        this.overlay.html('<div><i class="' + icon + '"></i></div>');
        this.overlay.removeClass('hide');
        this.overlay.css({
            display: 'block',
            left   : position.left,
            top    : position.top,
            height : height,
            width  : width
        }, 500);
        return true;
    },
    showMenu: function(component,event) {
        if( componentManager.component.data('action') ) {
            controls.resolve(componentManager.getComponent(), event);
        } else {
            helper.modal.backdrop.css('opacity',.1);
            helper.modal.backdrop.show();
            this.lock();
            jQuery('#component-dropdown').css({
                left: event.pageX,
                top: event.pageY
            }).show();
        }
    },
    hideMenu: function() {
        helper.modal.backdrop.hide();
        helper.modal.backdrop.css('opacity',.7);
        this.unlock();
        jQuery('#component-dropdown').hide();
    }
};


