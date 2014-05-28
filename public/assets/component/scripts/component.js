"use strict";

var componentManager = {
    body       : false,
    component  : false,
    settings   : {
        allowed:false,
        blocked:false,
        limit:0
    },
    listCounter: 0,
    init: function () {
        this.body = jQuery('#component-body');
        
        jQuery('.component').disableSelection();
        
        this.bindEvents();
        
        // we can paste a component
        if(helper.cookie.get('component')) {
            this.parseCookie(helper.cookie.get('component'));
        }
    },
    bindEvents: function() {
        jQuery('body').on('mouseenter', '.component', function(event) {
            if( event.type === 'mouseenter' && layout.moveOverlay(jQuery(this)) ) {
                componentManager.setComponent(jQuery(this));                
            }
        }).on('click', '.component-overlay', function(event) {
            if( ! layout.locked ) {
                return false;
            }
            layout.unlock();
            if( layout.moveOverlay(jQuery(this)) ) {
                componentManager.setComponent(jQuery(this));  
                layout.lock();
                componentManager.resolveAction(event);              
            }
        });
        this.body.mouseenter(function(){
            layout.hideOverlay();
        });
        /*
        jQuery('#component-quick-list').sortable({
            items :'a', 
            revert: true, 
            helper: "clone",
            cursorAt: { top: 0, left: 50 },
            start: function(){
                layout.body.addClass('component-is-dragging');
                layout.lock();
                console.log('start');
            },
            stop: function(){
                layout.body.removeClass('component-is-dragging');
                layout.unlock();
                console.log('stop');
            }
        });
        jQuery( 'div.component-list' ).droppable({
            //accept: ".quick-add"
            activate: function(){
                //layout.lock();
                console.log('activate');
            },
            over: function(){
                //layout.lock();
                console.log('over');
            }
        });
        */
        
        // keyboard shortcuts
        helper.keyboard.addEvent(46,componentManager.keyboardDeleteAction);  // DELETE
        helper.keyboard.addGlobalEvent(88,componentManager.cutAction);       // CUT
        helper.keyboard.addGlobalEvent(67,componentManager.copyAction);      // COPY
        helper.keyboard.addGlobalEvent(86,componentManager.paste);     // PASTe
    },
    resolveAction: function(event) {
        if( this.component.data('action') ) {
            // direct action from within component
            controls.resolve(this.component,event);
        } else {
            // give more options via the control bar
            controls.displayCrud();
        }
    },
    setComponent: function(component){ 
        this.component = component;
        this.setComponentList();
    },
    getComponent: function() {
        return this.component;
    },
    setComponentList: function(){ 
        this.componentList = this.component.parents('.component-list');
        this.settings = {
            allowed: this.componentList.data('allowed'),
            blocked: this.componentList.data('blocked'),
            limit: parseInt(this.componentList.data('limit')),
            count: parseInt(this.componentList.data('count'))
        };  
    },
    getComponentList: function() {
        return this.componentList;
    },
    setComponentState: function(state,id) { 

        // there can only be one
        if(state === 'cut' || state === 'copy') {
            jQuery('.component-cut').removeClass('component-cut');
            jQuery('.component-copy').removeClass('component-copy');
            jQuery('.component-state').remove();
        }
        
        var component = jQuery('.component[data-id="' + id + '"]');
        
        // add the state
        component.addClass('component-' + state);
        
        if(state === 'cut') {
            component.find('.component-overlay').html('<i class="fa fa-cut component-state"></i>');
        } else if(state === 'copy') {
            component.find('.component-overlay').html('<i class="fa fa-copy component-state"></i>');
        }
    },
    parseCookie: function(value) {
        value = value.split(':');
        if(value.length === 2) {            
            controls.enable('componentManager.paste');
            controls.enable('componentManager.clearAction');
            this.setComponentState(value[0],value[1]);
        }        
    },
            
    /* actions */
    insertAction: function() {    
        // can we add another one ?
        if(componentManager.settings.limit > 0 && componentManager.settings.limit >= componentManager.settings.count) {
            alert('Max components:' + componentManager.settings.limit);
            return false;
        }
        
        helper.dialog.prompt(i18n.get('component.create.title'),[{
            'text'     : '<i class="fa fa-arrow-up"></i><br/>' + i18n.get('component.create.above'),
            'keyCode'  : 'UP',
            'callback' : function() {
                componentManager.insertAt('before',false);
            }
        },{
            'text'     : i18n.get('component.create.below') + '<br/><i class="fa fa-arrow-down"></i>',
            'keyCode'  : 'DOWN',
            'callback' : function() {
                componentManager.insertAt('after',false);
            }
        }]);
    },
        insertAt: function(position,paste) {
             var params = {
                'level'    : this.getComponentList().data('level'),
                'position' : this.getComponentList().data('position'),
                'page_id'  : config.page.id,
                'settings' : componentManager.settings
            };
            params[position] = this.getComponent().data('id');
            if(paste === true)
                params.paste = true;        
            var url = helper.url.create(urls.component.create,params);
            helper.modal.show(url);
        },
                
    createAction: function(event) {        
        var params = {
            'level'    : this.getComponentList().data('level'),
            'position' : this.getComponentList().data('position'),
            'page_id'  : config.page.id,
            'settings' : componentManager.settings
        };
        if(event.ctrlKey === true) { /* direct paste */
            params.paste = true;    
        }
        var url = helper.url.create(urls.component.create,params);
        helper.modal.show(url);      
    },
    updateAction: function() {
        var url = helper.url.create(urls.component.update,{
            'level'    : this.getComponentList().data('level'),
            'position' : this.getComponentList().data('position'),
            'page_id'  : config.page.id
        });
        url = urls.component.update.replace('%id%',this.component.data('id'));
        helper.modal.show(url);
    },
            
    keyboardDeleteAction: function() {
        if(componentManager.component !== false && layout.locked === true) {
            componentManager.deleteAction();
        }
    },
            
    deleteAction: function() {
        helper.dialog.prompt(i18n.get('component.delete.title'),[{
            'text'     : i18n.get('component.delete.yes'),
            'keyCode'  : 'ENTER',
            'callback' : function() {
                componentManager.deleteConfirmAction();
            }
        },{
            'text'     : i18n.get('component.delete.no'),
            'keyCode'  : 'ESCAPE',
            'callback' : function() {
                helper.modal.hide();
                controls.cancel();
            }
        }]);
    },
        deleteConfirmAction: function() {
            var url = helper.url.create(urls.component.remove,{
                'level'    : this.getComponentList().data('level'),
                'position' : this.getComponentList().data('position'),
                'page_id'  : config.page.id
            });
            url = urls.component.remove.replace('%id%',this.component.data('id'));
            helper.modal.show(url);
        },
            
    cutAction: function() { 
        debug.feedback(i18n.get('feedback.cut'));
        helper.cookie.set('component','cut:' + componentManager.component.data('id'),1);
        componentManager.setComponentState('cut',componentManager.component.data('id'));
        controls.enable('componentManager.paste');
        controls.enable('componentManager.clearAction');
        controls.cancel();
    },
    copyAction: function() { 
        debug.feedback(i18n.get('feedback.copy'));
        helper.cookie.set('component','copy:' + componentManager.component.data('id'),1);
        componentManager.component.addClass('component-copy');
        componentManager.setComponentState('copy',componentManager.component.data('id'));
        controls.enable('componentManager.paste');
        controls.enable('componentManager.clearAction');
        controls.cancel();
    },
    paste: function() {
        if(!layout.locked) {
            return false;
        };
        helper.dialog.prompt(i18n.get('component.paste.title'),[{
            'text'     : '<i class="fa fa-arrow-up"></i><br/>' + i18n.get('component.paste.above'),
            'keyCode'  : 'UP',
            'callback' : function() {
                componentManager.insertAt('before',true);
            }
        },{
            'text'     : i18n.get('component.paste.above') + '<br/><i class="fa fa-arrow-down"></i>',
            'keyCode'  : 'DOWN',
            'callback' : function() {
                componentManager.insertAt('after',true);
            }
        }]);
    },
    clearAction: function() { /* clears the past cookie */
        jQuery('.component-cut').removeClass('component-cut');
        jQuery('.component-copy').removeClass('component-copy');
        jQuery('.component-state').remove();
        controls.disable('componentManager.paste');
        controls.disable('componentManager.clearAction');
        helper.cookie.set('component','',1);
        controls.cancel();
    },
    makeSortableAction: function() { /* make the components sortable within their lists, connect them */
        debug.feedback(i18n.get('feedback.sort'));
        
        controls.disable('componentManager.makeSortableAction');
        controls.enable('componentManager.destroySortableAction');
        
        controls.disable('pageManager.indexAction');
        controls.disable('pageManager.createAction');        
        controls.disable('pageManager.updateAction');
        controls.disable('pageManager.deleteAction');
        
        // clean up the view
        layout.hideOverlay();
        layout.lock();
        jQuery('.component-hint').remove();
        
        // refactor
        jQuery('.component').addClass('component-sorting');
        layout.body.addClass('component-is-sorting');
        
        // refactor
        jQuery( 'div.component-list' ).sortable({   
            disabled            : false,
            cursor              : 'move',
            items               : '.component',
            connectWith         : 'div.component-list',
            forcehelperize     : false,
            forcePlaceholderSize: true,
            placeholder         : 'component-sortable-placeholder',
            helper: function(){
                return jQuery('<div id="component-sortable-helper"></div>');
            }
         });
    },
    destroySortableAction: function() { /* destroy the sortable */

        helper.loading.hide();
        
        controls.enable('componentManager.makeSortableAction');
        controls.disable('componentManager.destroySortableAction');
        
        componentManager.listCounter = 0;
                
        // update components in all lists
        jQuery('.component-list').each(function(){                
            componentManager.listCounter++;
            componentManager.updateComponentPositions(jQuery(this));
        });
    },
    updateComponentPositions: function(componentList) {

        var components = componentList.find('.component'), 
            ids        = [], 
            counter    = 0;
    
        // add all ids
        components.each(function(){
            ids[counter] = jQuery(this).data('id');
            counter++;
        });
                
        // and store this list
        jQuery.post(urls.component.position,{
            level   : componentList.data('level'),
            position: componentList.data('position'),
            ids     : ids
        },function(){
            // we reload after the last list has finished
            componentManager.listCounter--;
            if(componentManager.listCounter === 0) {
                helper.url.reload();
            }
        });
    }
};
