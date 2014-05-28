"use strict";

/* helper */
var helper = {};

/* url builder */
helper.url = {
    create: function(url, params) {
        if (typeof params !== "undefined") {
            url += '?' + jQuery.param(params);
        }
        return url;
    },
    reload: function() {
        var position = jQuery('body').scrollTop();
        window.location.hash = position;
        window.parent.location.reload();        
    }
};

/* loading overlay + image */
helper.loading = {
    element: false,
    init: function() {
        this.element = jQuery('#component-loader');
    },
    show: function() {
        helper.modal.backdrop.css({display:'block',opacity:0}).animate({opacity:.7});
        this.element.show();
    },
    hide: function() {
        helper.modal.backdrop.fadeOut();
        this.element.hide();
    }
};

/* modal box w/ iframe */
helper.modal = {
    element: false,
    backdrop: false,
    init: function() {
        this.element = jQuery('#component-modal');
        this.backdrop = jQuery('#component-modal-backdrop');
        this.bindEvents();
    },
    bindEvents: function() {
        this.backdrop.click(function() {
            helper.modal.close();
        });        
        /*this.backdrop.bind('contextmenu',function(event){
            layout.hideMenu();
            event.preventDefault();
        });*/
    },
    show: function(url) {
        controls.hide();
        controls.show('cancel')
        helper.modal.element.html('<iframe id="component-iframe" scrolling="no" frameborder="0" src="' + url + '"></iframe>').show();
        helper.modal.backdrop.css('opacity',.7).show();
        jQuery('#component-iframe').focus();
        helper.keyboard.addEvent('ESCAPE',helper.modal.close);
    },
    hide: function() {
        helper.modal.element.hide();
        helper.modal.backdrop.hide();
        jQuery('#component-dropdown').hide();
    },
    resize: function(height) {
        console.log( height );
        console.log(helper.modal.element.height());
    },
    close: function(){
        helper.modal.hide();
        helper.dialog.element.hide();
        layout.unlock();
        controls.cancel();
    }
};

/* dialogs */
helper.dialog = {
    element: false,
    callbacks: {},
    init: function() {
        this.element = jQuery('#component-dialog');
        this.bindEvents();
    },
    bindEvents: function() {
        this.element.on('click', 'a', function(event) {
            helper.dialog.reply(jQuery(this).data('answer'));
            event.preventDefault();
        })
    },
    hide: function(){
        this.element.hide();
    },
    reply: function(answer) {
        // clean up the dialog
        this.element.hide();
        helper.modal.backdrop.hide();

        // run the callback
        this.callbacks[answer]();
    },
    prompt: function(question, answers) {
        // clear callbacks
        this.callbacks = {};

        // build html
        var html = "<h3>" + question + "</h3><ul>";
        for (var counter in answers) {
            var answer = answers[counter];
            html += '<li>';
                html += '<a data-answer="' + counter + '">' + answer.text + '</a>';
            html += '</li>';
            this.callbacks[counter] = answer.callback;
            
            // inject into the keyboard helper
            if(typeof answer.keyCode !== "undefined") {
                helper.keyboard.addEvent(answer.keyCode,answer.callback);
            }
        }
        html += "</ul>";

        // inject html
        this.element.html(html);

        // and show dialog
        helper.modal.backdrop.show();
        this.element.show();
    }
};

/**
 * Cookie helper
 * @type type
 */
helper.cookie = {
    set: function(name, value, exdays) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var c_value = escape(value) + ((exdays === null) ? "" : "; expires=" + exdate.toUTCString());
        document.cookie = name + "=" + c_value;
    },
    get: function(name) {
        var i, x, y, cookies = document.cookie.split(";");
        for (i = 0; i < cookies.length; i++) {
            x = cookies[i].substr(0, cookies[i].indexOf("="));
            y = cookies[i].substr(cookies[i].indexOf("=") + 1);
            x = x.replace(/^\s+|\s+jQuery/g, "");
            if (x === name) {
                return unescape(y);
            }
        }
    }
};

/**
 * Keyboard helper
 * Add event to keyPress, either via the number on the keyboard, or an alias.
 */
helper.keyboard = {
    alias: {
        ENTER : 13,
        ESCAPE: 27,
        LEFT  : 37,
        RIGHT : 39,
        UP    : 38,
        DOWN  : 40
    },
    events: {},
    global: {},
    init: function() {
        this.bindEvents();
    },
    bindEvents: function(){
        jQuery(window).keydown(function(event){
            helper.keyboard.keyPress(event);
        });
    },
    addEvent: function(keyCode, event){
        if(typeof this.alias[keyCode] !== "undefined") {
            keyCode = this.alias[keyCode];
        } 
        this.events[keyCode] = event;
    },
    addGlobalEvent: function(keyCode, event){
        if(typeof this.alias[keyCode] !== "undefined") {
            keyCode = this.alias[keyCode];
        } 
        this.global[keyCode] = event;
    },
    clearEvents: function(){
        this.events = {};
    },
    keyPress: function(event){
        if(event.ctrlKey && typeof this.global[event.keyCode] !== "undefined") {
            this.global[event.keyCode]();
        } else if(typeof this.events[event.keyCode] !== "undefined") {
            this.events[event.keyCode]();
        } else {
            /*console.log(event.keyCode);
            console.log(event.ctrlKey);*/
        }
    }
};