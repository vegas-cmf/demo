"use strict";

var pageManager = {
    init: function () {        
        this.sidebar.element = jQuery('#component-page-list');
        this.bindEvents();
        if(window.location.hash === '#sidebar') {
            var duration = this.sidebar.duration;
            this.sidebar.duration = 0;
            this.sidebar.toggle();            
            this.sidebar.duration = duration;
        };
    },
    bindEvents: function(){
        this.sidebar.element.on('click','a',function(event){
            window.location.href = jQuery(this).attr('href') + '#sidebar';
            event.preventDefault();
        });
        // keyboard shortcuts
        helper.keyboard.addGlobalEvent(78,pageManager.createAction);   // CTRL + n
        helper.keyboard.addGlobalEvent(69,pageManager.updateAction);   // CTRL + e
        helper.keyboard.addGlobalEvent(46,pageManager.deleteAction);   // CTRL + DELETE
        helper.keyboard.addGlobalEvent(76,pageManager.keyboardToggle); // CTRL + L
    },            
    loadPage: function(page){ 
        this.ajaxLoad(page.attr('href'));
    },    
    ajaxLoad: function(url) {
        helper.loading.hide();
        layout.lock();
        layout.hideOverlay();    
        jQuery.get(url,{
            ajax: true
        },function(html){
            jQuery('#main').html(html);
            
            /* this is the reset of the manager, refactor this */
            jQuery('.component').removeClass('component-sorting');
            layout.body.removeClass('component-is-sorting');
            helper.loading.hide();
            helper.modal.hide();
            controls.cancel();
        });
    },    
    keyboardToggle: function(){
        pageManager.sidebar.toggle();
    },
            
    /* actions */
    indexAction: function(){
        pageManager.sidebar.toggle();
    },
    createAction: function(){
        var url = helper.url.create(urls.page.create);
        helper.modal.show(url);
    },
    updateAction: function(){
        var url = helper.url.create(urls.page.update);
        helper.modal.show(url);
    },
            
    deleteAction: function() {
        controls.hide();
        controls.show('cancel');
        helper.dialog.prompt(i18n.get('page.delete.title'),[{
            'text'     : i18n.get('page.delete.yes'),
            'keyCode'  : 'ENTER',
            'callback' : function() {
                pageManager.deleteConfirmAction();
            }
        },{
            'text'     : i18n.get('page.delete.no'),
            'keyCode'  : 'ESCAPE',
            'callback' : function() {
                helper.modal.hide();
                controls.cancel();
            }
        }]);
    },
        deleteConfirmAction: function() {
            var url = helper.url.create(urls.page.remove);
            helper.modal.show(url);
        }
};

pageManager.sidebar = {
    duration: 500,
    width: 200,
    element: false,
    isVisible: false,
    toggle: function() { 
        layout.lock();
        layout.hideOverlay();
        if(this.isVisible) {
            this.hide();
        } else {
            this.show();
        }
        this.isVisible = ( ! this.isVisible );
        setTimeout(function(){
            layout.unlock();
        },this.duration)
    },
    show: function(){
        window.location.hash = 'sidebar';
        controls.disable('componentManager.makeSortableAction');
        controls.disable('componentManager.destroySortableAction');
        controls.setIcon('pageManager.indexAction','fa-dedent');
        jQuery('html,body').animate({
          scrollTop: 0
        }, this.duration);
        componentManager.body.css({
            width: layout.body.width()
        }).animate({
            paddingLeft: this.width
        },this.duration);
        this.element.animate({
            left: 0
        },this.duration);
    },
    hide: function(){ 
        window.location.hash = '';
        controls.enable('componentManager.makeSortableAction');
        controls.setIcon('pageManager.indexAction','fa-indent');
        componentManager.body.animate({
            paddingLeft: 0
        },this.duration);
        this.element.animate({
            left: - this.width
        },this.duration);
    }
};