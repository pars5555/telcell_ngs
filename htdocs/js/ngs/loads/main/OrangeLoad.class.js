ngs.OrangeLoad = Class.create(ngs.AbstractLoad, {
    initialize: function($super, shortCut, ajaxLoader) {
        $super(shortCut, "main", ajaxLoader);
    },
    getUrl: function() {
        return "orange";
    },
    getMethod: function() {
        return "POST";
    },
    getContainer: function() {
        return "main_content_container";
    },
    getName: function() {
        return "orange";
    },
    afterLoad: function() {
         jQuery('#main_content_container').stop();
        jQuery('#main_content_container').css({'opacity':'1'});
        
    }
});
