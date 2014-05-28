"use strict";

jQuery.noConflict();

(function($) {
               
    /* init helpers */
    helper.modal.init(); 
    helper.loading.init();    
    helper.dialog.init();
    helper.keyboard.init();
    
    /* layout and controls */
    layout.init();  
    controls.init();   
    
    /* init more helpers */   
    helper.modal.init();
    helper.settings.init(); 
    
    /* and the managers */
    componentManager.init(); 
    pageManager.init();
    
    debug.setMode('development');
    
    // move to a position via the hash (#500 == 500px)
    if(window.location.hash) {
        var hash = window.location.hash.substr(1);
        $('html,body').animate({
          scrollTop: hash
        }, 100);
    }    
        
    // html messages to js popup
    $('#component-messages').find('.alert').each(function(){
        debug.feedback($(this).text());
    });
        
    // debug.feedback(i18n.get('feedback.load'));

})(jQuery);