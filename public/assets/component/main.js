"use strict";

jQuery.noConflict();

(function($) {
               
    /* init helpers */
    helper.modal.init(); 
    helper.loading.init();    
    helper.dialog.init();
    helper.keyboard.init();
    
    /* start loading */
    helper.loading.show();
    
    /* init managers */
    componentManager.init();    
    helper.modal.init();
    layout.init();  
    controls.init();    
    pageManager.init();
    
    /* finish loading... */
    setTimeout(function(){
        helper.loading.hide();
    },500);

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
        
    debug.feedback(i18n.get('feedback.load'));

})(jQuery);