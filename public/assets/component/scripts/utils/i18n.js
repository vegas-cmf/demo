
var i18n = {
    get: function(text){ 
        return typeof i18n.library[text] !== "undefined" ? i18n.library[text] : 'Translation for ' + text + ' not available.';
    },
    library: {}
};