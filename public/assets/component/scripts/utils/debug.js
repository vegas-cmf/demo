"use strict";

var debug = {
    mode: false,              
    location: 'tr',
    production : 'production',
    development: 'development',      
    duration: {
        _production : 3000,
        _development: 3500,
        production : 30000,
        development: 35000
    },
    setMode: function(mode) {
        this.mode = mode;
    },
    log: function(mode,params) {
        params.duration = this.duration[mode];
        params.location = this.location;
        if(mode === this.mode || mode === this.development) {
            jQuery.growl(params); 
        }
    },     
    feedback: function(message) {
        jQuery.growl.notice({'title':'','message':message}); 
    },
    notice: function(mode,params) {
        params.duration = this.duration[mode];
        if(mode === this.mode || mode === this.development) {
            jQuery.growl.notice(params); 
        }
    },
    warning: function(mode,params) {
        params.duration = this.duration[mode];
        if(mode === this.mode || mode === this.development) {
            jQuery.growl.warning(params); 
        }
    },        
    error: function(mode,params) {
        params.duration = this.duration[mode];
        if(mode === this.mode || mode === this.development) {
            jQuery.growl.error(params); 
        }
    }
};